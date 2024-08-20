<?php

namespace App\Http\Livewire\Frontend\Instructors;

use App\Models\Course;
use App\Models\CourseSection;
use App\Models\Evaluation;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class EvaluationComponent extends Component
{
    use LivewireAlert;

    public $courseId;
    public $course;

    public $evaluations = [];
    public  $count = 1;
    public $currentEvaluationIndex = 0; // Track the currently active evaluation
    public $activeQuestionIndex = 0; // Track the currently active question within a evaluation


    // validation check 
    public $formSubmitted = false;
    public $databaseDataValid = false;

    public $evaluationsValid = false;
    public $questionsValid = false;
    public $optionsValid = false;




    public function mount($courseId)
    {
        $this->courseId = $courseId;
        $this->currentEvaluationIndex = 0;

        // Fetch the course instance
        $course = Course::where('id', $this->courseId)->with('sections.evaluations.questions.options')->first();

        if ($course) {
            // Initialize the evaluations array from the sections' evaluations
            $evaluations = $course->sections->flatMap(function ($section) {
                return $section->evaluations->map(function ($evaluation) {
                    return [
                        'title' => $evaluation->title,
                        'description' => $evaluation->description,
                        'course_section_id' => $evaluation->course_section_id,

                        'questions' => $evaluation->questions->map(function ($question) {
                            return [
                                'question_text' => $question->question_text,
                                'question_type' => $question->question_type,

                                'options' => $question->options->map(function ($option) {
                                    return [
                                        'option_text' => $option->option_text,
                                        'is_correct' => $option->is_correct,
                                    ];
                                })->toArray(),
                            ];
                        })->toArray(),
                        'saved' => true,
                    ];
                })->toArray();
            })->toArray();

            // If no evaluations are found, set default data
            if (empty($evaluations)) {
                $this->evaluations = [
                    [
                        'title' => 'التقييم' . $this->count,
                        'description' => 'الوصف' . $this->count,
                        'course_section_id' => $course->sections->first()->id ?? null,
                        'questions' => [
                            [
                                'question_text' => '',
                                'question_type' => 0,
                                'options' => [
                                    [
                                        'option_text' => '',
                                        'is_correct' => 1,
                                    ],
                                ],
                            ],
                        ],
                    ],
                ];
            } else {
                $this->evaluations = $evaluations;
            }
        } else {
            // If no course is found, set default data
            $this->evaluations = [
                [
                    'title' => 'التقييم' . $this->count,
                    'description' => 'الوصف' . $this->count,
                    'course_section_id' => null,
                    'questions' => [
                        [
                            'question_text' => '',
                            'question_type' => 0,
                            'options' => [
                                [
                                    'option_text' => '',
                                    'is_correct' => 1,
                                ],
                            ],
                        ],
                    ],
                ],
            ];
        }

        $this->count = count($this->evaluations);

        // Set the current evaluation index to the new evaluation
        $this->currentEvaluationIndex = count($this->evaluations) - 1;

        $this->setActiveEvaluation($this->currentEvaluationIndex);

        $this->validateDatabaseData();

        if ($this->databaseDataValid == true) {
            $this->formSubmitted = true;
        }
    }





    public function render()
    {
        $course_sections = CourseSection::where('course_id', $this->courseId)->get();
        return view('livewire.frontend.instructors.evaluation-component', [
            'course_sections'   => $course_sections,
        ]);
    }

    public function validateEvaluation()
    {
        $this->validate([
            'evaluations.*.title'                               => 'required|string',
            'evaluations.*.description'                         => 'required|string',
            'evaluations.*.course_section_id'                   => 'required',

            'evaluations.*.questions.*.question_text'           => 'required|string',
            'evaluations.*.questions.*.question_type'           => 'required',

            'evaluations.*.questions.*.options.*.option_text'   => 'required|string',
            'evaluations.*.questions.*.options.*.is_correct'    => 'required|bool',

        ]);
    }



    protected function validateDatabaseData()
    {
        $evaluationsValid = true;
        $course = Course::with('sections.evaluations')->findOrFail($this->courseId);

        // Check if there are any evaluations
        $evaluationCount = $course->sections->sum(function ($section) {
            return $section->evaluations->count();
        });

        if ($evaluationCount > 0) {
            foreach ($course->sections as $section) {
                foreach ($section->evaluations as $evaluation) {
                    $validator = Validator::make(
                        [
                            'title' => $evaluation->title,
                            'description' => $evaluation->description,
                        ],
                        [
                            'title' => ['required', 'string', 'min:3', 'max:80'],
                            'description' => ['required', 'string', 'min:3', 'max:255'],
                            'course_section_id' => ['required'],
                        ]
                    );
                    if ($validator->fails()) {
                        $evaluationsValid = false;
                        break;
                    }
                }
            }
        } else {
            $evaluationsValid = false;
        }

        // Validate question
        $questionsValid = true;
        $course = Course::findOrFail($this->courseId);

        $questionCount = 0;
        foreach ($course->sections as $section) {
            foreach ($section->evaluations as $evaluation) {
                $questionCount += $evaluation->questions->count();
            }
        }

        if ($questionCount > 0) {
            foreach ($course->sections as $section) {
                foreach ($section->evaluations as $evaluation) {
                    foreach ($evaluation->questions as $question) {
                        $validator = Validator::make(
                            [
                                'question_text' => $question->question_text,
                                'question_type' => $question->question_type,
                            ],
                            [
                                'question_text' => ['required', 'string', 'min:3', 'max:80'],
                                'question_type' => ['required'],
                            ]
                        );
                        if ($validator->fails()) {
                            $questionsValid = false;
                            break;
                        }
                    }
                }
            }
        } else {
            $questionsValid = false;
        }

        // Validate options
        $optionsValid = true;
        $course = Course::findOrFail($this->courseId);

        $optionCount = 0;
        foreach ($course->sections as $section) {
            foreach ($section->evaluations as $evaluation) {
                foreach ($evaluation->questions as $question) {
                    $optionCount += $question->options->count();
                }
            }
        }
        if ($optionCount > 0) {

            foreach ($course->sections as $section) {
                foreach ($section->evaluations as $evaluation) {
                    foreach ($evaluation->questions as $question) {
                        foreach ($question->options as $option) {
                            $validator = Validator::make(
                                [
                                    'option_text' => $option->option_text,
                                    'is_correct' => $option->is_correct,
                                ],
                                [
                                    'option_text' => ['required', 'string', 'min:3', 'max:80'],
                                    'is_correct' => ['required', 'boolean'],
                                ]
                            );
                            if ($validator->fails()) {
                                $optionsValid = false;
                                break;
                            }
                        }
                    }
                }
            }
        } else {
            $optionsValid = false;
        }


        // Set flags for sections validation
        $this->databaseDataValid = $evaluationsValid && $questionsValid && $optionsValid;

        $this->evaluationsValid = $evaluationsValid;
        $this->questionsValid = $questionsValid;
        $this->optionsValid = $optionsValid;
    }



    // for saving step3 using btn 
    public function saveEvaluationBtn()
    {
        $this->validateEvaluation();


        // Fetch the course and its sections
        $course = Course::with('sections.evaluations.questions.options')
            ->where('id', $this->courseId)
            ->first();

        if ($course) {
            // Iterate through each section
            foreach ($course->sections as $section) {
                // Iterate through each evaluation
                foreach ($section->evaluations as $evaluation) {
                    // Iterate through each question
                    foreach ($evaluation->questions as $question) {
                        // Delete options related to the question
                        $question->options()->delete();
                    }
                    // Delete questions related to the evaluation
                    $evaluation->questions()->delete();
                    // Delete the evaluation itself
                    $evaluation->delete();
                }
            }
        }


        // Save or update the new evaluations, questions, and options
        foreach ($this->evaluations as $evaluation) {
            $evaluationModel = Evaluation::updateOrCreate(
                ['id' => $evaluation['id'] ?? null],
                [
                    'title' => $evaluation['title'],
                    'description' => $evaluation['description'],
                    'course_section_id' => $evaluation['course_section_id'],
                ]
            );

            foreach ($evaluation['questions'] as $question) {
                $questionModel = Question::updateOrCreate(
                    ['id' => $question['id'] ?? null],
                    [
                        'question_text' => $question['question_text'],
                        'question_type' => $question['question_type'],
                        'evaluation_id' => $evaluationModel->id,
                    ]
                );

                foreach ($question['options'] as $option) {
                    Option::updateOrCreate(
                        ['id' => $option['id'] ?? null],
                        [
                            'option_text' => $option['option_text'],
                            'is_correct' => $option['is_correct'],
                            'question_id' => $questionModel->id,
                        ]
                    );
                }
            }
        }

        $this->emit('updateCourseDEtailsConfirmation', $this->courseId);

        $this->formSubmitted = true;

        // Validate database data
        $this->validateDatabaseData();
        $this->alert('success', 'تم حفظ البيانات بنجاح');
    }



    // Method to add a new evaluation
    public function addEvaluation()
    {
        $this->count++;

        $this->evaluations[] = [
            'evaluationId'      => 1,
            'title'             => __('panel.evaluation') . ' 1',
            'description'       => 'Description 1',
            'course_section_id' =>  '',

            'questions' => [
                [
                    'question_text'     =>  '',
                    'question_type'     =>  0,
                    'options' => [
                        [
                            'option_text'          =>  '',
                            'is_correct'           =>  1,
                        ],
                    ],
                ],
            ],
            'saved' => false, // Initialize saved as false
        ];

        // Set the current evaluation index to the new evaluation
        $this->currentEvaluationIndex = count($this->evaluations) - 1;

        $this->setActiveEvaluation($this->currentEvaluationIndex);
    }


    public function addQuestion($evaluationIndex)
    {
        $this->evaluations[$evaluationIndex]['questions'][] = [
            'question_text'     =>  '',
            'question_type'     =>  0,
            'options' => [
                [
                    'option_text'          =>  '',
                    'is_correct'           =>  1,
                ],
            ],
        ];

        // Set the new question as the active question
        $this->activeQuestionIndex = count($this->evaluations[$evaluationIndex]['questions']) - 1;
    }

    public function addOption($evaluationIndex, $questionIndex)
    {
        $this->evaluations[$evaluationIndex]['questions'][$questionIndex]['options'][] = [
            'option_text'          =>  '',
            'is_correct'           =>  1,
        ];
    }

    public function setActiveEvaluation($index)
    {
        // Ensure the index is within bounds
        if ($index >= 0 && $index < count($this->evaluations)) {
            $this->currentEvaluationIndex = $index;
            $this->activeQuestionIndex = 0; // Reset the active question index

        }
    }

    public function setActiveQuestion($evaluationIndex, $questionIndex)
    {
        // Ensure the indexes are within bounds
        if (
            $evaluationIndex >= 0 && $evaluationIndex < count($this->evaluations) &&
            $questionIndex >= 0 && $questionIndex < count($this->evaluations[$evaluationIndex]['questions'])
        ) {
            $this->currentEvaluationIndex = $evaluationIndex;
            $this->activeQuestionIndex = $questionIndex;
        }
    }

    // Method to remove a evaluation
    public function removeEvaluation($evaluationIndex)
    {
        if (isset($this->evaluations[$evaluationIndex])) {
            array_splice($this->evaluations, $evaluationIndex, 1);
            $this->count--;

            // Adjust the currentEvaluationIndex if necessary
            if ($this->currentEvaluationIndex >= count($this->evaluations)) {
                $this->currentEvaluationIndex = count($this->evaluations) - 1;
            }

            if ($this->currentEvaluationIndex < 0) {
                $this->currentEvaluationIndex = 0;
            }
        }
    }

    // Method to remove a question
    public function removeQuestion($evaluationIndex, $questionIndex)
    {
        if (isset($this->evaluations[$evaluationIndex]['questions'][$questionIndex])) {
            array_splice($this->evaluations[$evaluationIndex]['questions'], $questionIndex, 1);

            // Adjust the activeQuestionIndex if necessary
            if ($this->activeQuestionIndex >= count($this->evaluations[$evaluationIndex]['questions'])) {
                $this->activeQuestionIndex = count($this->evaluations[$evaluationIndex]['questions']) - 1;
            }

            if ($this->activeQuestionIndex < 0) {
                $this->activeQuestionIndex = 0;
            }
        }
    }


    // Method to remove a option
    public function removeOption($evaluationIndex, $questionIndex, $optionIndex)
    {
        if (isset($this->evaluations[$evaluationIndex]['questions'][$questionIndex]['options'][$optionIndex])) {
            array_splice($this->evaluations[$evaluationIndex]['questions'][$questionIndex]['options'], $optionIndex, 1);
        }
    }
}
