<?php

namespace App\Http\Livewire\Frontend\Instructors;

use App\Models\Evaluation;
use App\Models\Option;
use App\Models\Question;
use Livewire\Component;

class EvaluationComponent extends Component
{
    public $courseId;

    public $evaluations = [];
    public $count = 1;
    public $currentEvaluationIndex = 0; // Track the currently active evaluation
    public $activeQuestionIndex = 0; // Track the currently active question within a evaluation



    public function mount($courseId)
    {
        $this->courseId = $courseId;

        $this->currentEvaluationIndex = 0;

        // Initialize the evaluations array with a default evaluation if it's empty
        if (empty($this->evaluations)) {
            $this->evaluations = [
                [
                    'evaluationId' => 1,
                    'title' => __('panel.evaluation') . ' 1',
                    'description' => 'Description 1',
                    'questions' => [
                        [
                            'question_text' =>  '',
                            'question_type' =>  '',
                            'options' => [
                                [
                                    'option_text'               =>  '',
                                    'is_correct'           =>  '',
                                ],
                            ],

                        ],

                    ],
                    'saved' => false, // Initialize saved as false
                ]
            ];
        }

        $this->count = count($this->evaluations);

        // Set the current evaluation index to the new evaluation
        $this->currentEvaluationIndex = count($this->evaluations) - 1;

        $this->setActiveEvaluation($this->currentEvaluationIndex);
    }

    public function render()
    {
        return view('livewire.frontend.instructors.evaluation-component');
    }

    public function validateStepThree()
    {
        $this->validate([
            'evaluations.*.title'                               => 'required|string',
            'evaluations.*.description'                         => 'required|string',

            'evaluations.*.questions.*.question_text'           => 'required|string',
            'evaluations.*.questions.*.question_type'           => 'required|string',

            'evaluations.*.questions.*.options.*.option_text'   => 'required|string',
            'evaluations.*.questions.*.options.*.is_correct'    => 'required|bool',

        ]);
    }

    public function saveStepThree()
    {
        // // Perform validation
        $this->validateStepThree();

        // Save the data to the database
        foreach ($this->evaluations as $evaluation) {
            $evaluationData = [
                'title'         => $evaluation['title'],
                'description'  => $evaluation['description'],
                'course_section_id'  => $this->courseId, // will be change to course section Id
            ];

            $evaluationModel = Evaluation::updateOrCreate($evaluationData);

            foreach ($evaluation['questions'] as $question) {
                $questionData = [
                    'question_text'           => $question['question_text'],
                    'evaluation_id'           => $evaluationModel->id,
                ];

                $questionModel = Question::updateOrCreate($questionData);

                foreach ($question['options'] as $option) {

                    $optionData = [
                        'option_text'       => $option['option_text'],
                        'is_correct'        => $option['is_correct'],
                        'question_id'       => $option->id,
                    ];
                    Option::updateOrCreate($optionData);
                }
            }
        }
    }

    // for saving step3 using btn 
    public function saveStepThreeDataUsingBtn()
    {
        $this->saveStepThree();
    }


    // Method to add a new evaluation
    public function addEvaluation()
    {
        $this->count++;

        $this->evaluations[] = [
            'evaluationId'      => 1,
            'title'             => __('panel.evaluation') . ' 1',
            'description'       => 'Description 1',

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

    // Method to remove a question
    public function removeOption($evaluationIndex, $questionIndex, $optionIndex)
    {
        if (isset($this->evaluations[$evaluationIndex]['questions'][$questionIndex]['questions'][$optionIndex])) {
            array_splice($this->evaluations[$evaluationIndex]['questions'][$questionIndex]['questions'], $optionIndex, 1);
        }
    }
}