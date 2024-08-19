<?php

namespace App\Http\Livewire\Frontend\Customer\Evaluation;

use App\Models\Evaluation;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class StudentEvaluationComponent extends Component
{

    use LivewireAlert;

    //global variables
    public $currentStep = 1;
    public $totalSteps = 4;

    public $selectedEvaluation;
    public $questionCount;

    public $questionData = [];

    protected $listeners = ['evaluationChanged' => 'reloadData'];

    public function mount($selectedEvaluation)
    {
        $this->selectedEvaluation = $selectedEvaluation;

        if ($this->selectedEvaluation) {
            // Populate the questionData array
            $this->questionData = [
                'evaluation_id'                 => $this->selectedEvaluation->id,
                'evaluation_title'              => $this->selectedEvaluation->title,
                'evaluation_description'        => $this->selectedEvaluation->description,
                'evaluation_course_section_id'  => $this->selectedEvaluation->course_section_id,

                'questions' => $this->selectedEvaluation->questions->map(function ($question) {
                    return [
                        'question_id'               =>  $question->id,
                        'question_text'             => $question->question_text,
                        'question_type'             => $question->question_type,
                        'question_evaluation_id'    => $question->evaluation_id,

                        'options' => $question->options->map(function ($option) {
                            return [
                                'option_id'             => $option->id,
                                'option_text'           => $option->option_text,
                                'is_correct'            => $option->is_correct,
                                'option_question_id'    => $option->question_id,
                                'option_value'          => '',
                            ];
                        })->toArray(),
                    ];
                })->toArray(),
            ];

            // Set the question count and total steps
            $this->questionCount = count($this->questionData['questions']);
            $this->totalSteps = $this->questionCount;
        }
    }


    public function reloadData($selectedEvaluationId)
    {
        if ($selectedEvaluationId) {
            $this->selectedEvaluation = Evaluation::with('questions.options')->find($selectedEvaluationId);
            $this->mount($this->selectedEvaluation);
        }
    }

    public function render()
    {
        return view('livewire.frontend.customer.evaluation.student-evaluation-component');
    }


    public function previousStep()
    {
        $this->currentStep--;
    }

    public function nextStep()
    {

        $this->currentStep++;
    }

    public function finish()
    {
        // // $this->validateStep();
        // $this->saveStepData();
        // return redirect()->route('admin.documents.show', $this->document_id);
    }
}
