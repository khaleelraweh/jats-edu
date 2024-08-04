<?php

namespace App\Http\Livewire\Frontend\Instructors;

use Livewire\Component;

class EvaluationComponent extends Component
{
    public $courseId;

    public $evaluations = [];
    public $count = 1;
    public $currentevaluationIndex = 0; // Track the currently active evaluation
    public $activeGroupIndex = 0; // Track the currently active group within a evaluation



    public function mount($courseId)
    {
        $this->courseId = $courseId;

        $this->currentevaluationIndex = 0;

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
    }

    public function render()
    {
        return view('livewire.frontend.instructors.evaluation-component');
    }

    public function validateStepThree()
    {
        $this->validate([
            'evaluations.*.doc_evaluation_name'                     => 'required|string',
            'evaluations.*.doc_evaluation_description'              => 'required|string',
            'evaluations.*.groups.*.pg_name'                  => 'required|string',
            'evaluations.*.groups.*.variables.*.pv_name'      => 'required|string',
            'evaluations.*.groups.*.variables.*.pv_question'  => 'required|string',
            'evaluations.*.groups.*.variables.*.pv_type'      => 'required|numeric',
            'evaluations.*.groups.*.variables.*.pv_required'  => 'required|boolean',
            'evaluations.*.groups.*.variables.*.pv_details'   => 'required|string',
        ]);
    }

    public function saveStepThree()
    {
        // // Perform validation
        $this->validateStepThree();

        // Save the data to the database
        foreach ($this->evaluations as $evaluation) {
            $evaluationData = [
                'doc_evaluation_name'         => $evaluation['doc_evaluation_name'],
                'doc_evaluation_description'  => $evaluation['doc_evaluation_description'],
                'document_template_id'  => $this->documentTemplateId,
            ];

            $evaluationModel = Documentevaluation::updateOrCreate($evaluationData);

            foreach ($evaluation['groups'] as $group) {
                $groupData = [
                    'pg_name'           => $group['pg_name'],
                    'document_evaluation_id'  => $evaluationModel->id,
                ];

                $groupModel = evaluationGroup::updateOrCreate($groupData);

                foreach ($group['variables'] as $variable) {

                    $variableData = [
                        'pv_name'       => $variable['pv_name'],
                        'pv_question'   => $variable['pv_question'],
                        'pv_type'       => $variable['pv_type'],
                        'pv_required'   => $variable['pv_required'],
                        'pv_details'    => $variable['pv_details'],
                        'evaluation_group_id' => $groupModel->id,
                    ];

                    evaluationVariable::updateOrCreate($variableData);
                }
            }
        }
    }

    // for saving step3 using btn 
    public function saveStepThreeDataUsingBtn()
    {
        $this->saveStepThree();
    }
}
