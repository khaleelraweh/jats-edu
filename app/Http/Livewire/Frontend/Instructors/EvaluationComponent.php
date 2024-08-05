<?php

namespace App\Http\Livewire\Frontend\Instructors;

use App\Models\Course;
use App\Models\CourseSection;
use App\Models\Evaluation;
use App\Models\Option;
use App\Models\Question;
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



    public function mount($courseId)
    {
        $this->courseId = $courseId;
        $this->currentEvaluationIndex = 0;

        // Fetch the course instance
        $course = Course::where('id', $this->courseId)->first(); // Use first() to get the single model instance

        if ($course) {
            // Initialize the pages array from the documentPages relationship
            $this->evaluations = $course->sections->flatMap(function ($section) {
                return $section->evaluations->map(function ($evaluation) {
                    return [
                        'title' => $evaluation->title,
                        'description' => $evaluation->description,
                        'course_section_id' => $evaluation->course_section_id,

                        'questions' => $evaluation->questions->map(function ($question) {
                            return [
                                'question_text' => $question->question_text,
                                'question_type' =>  $question->question_type,

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
        } else {
            $this->evaluations = [
                [
                    'title' => 'التقييم' . $this->count,
                    'description' => 'الوصف' . $this->count,
                    'course_section_id' => null,
                    'questions' => [
                        [
                            'question_text' => '',
                            'question_type' => 'single_choice',
                            'options' => [
                                [
                                    'option_text' => '',
                                    'is_correct' => false,
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
            'evaluations.*.questions.*.question_type'           => 'required|string',

            'evaluations.*.questions.*.options.*.option_text'   => 'required|string',
            'evaluations.*.questions.*.options.*.is_correct'    => 'required|bool',

        ]);
    }



    // for saving step3 using btn 
    public function saveEvaluationBtn()
    {
        $this->validateEvaluation();

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

        $this->alert('success', 'تم حفظ البيانات بنجاح');

        session()->flash('message', 'Evaluation saved successfully.');
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
                    'question_type'     =>  '',
                    'options' => [
                        [
                            'option_text'          =>  '',
                            'is_correct'           =>  '',
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
            'question_type'     =>  '',
            'options' => [
                [
                    'option_text'          =>  '',
                    'is_correct'           =>  '',
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
            'is_correct'           =>  '',
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
