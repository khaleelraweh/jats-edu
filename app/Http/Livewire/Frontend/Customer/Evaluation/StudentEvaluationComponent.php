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

    protected $listeners = ['evaluationChanged' => 'reloadData'];


    public function  mount($selectedEvaluation)
    {
        $this->selectedEvaluation = $selectedEvaluation;
    }

    public function reloadData($selectedEvaluationId)
    {
        if ($selectedEvaluationId) {
            $selectedEvaluation = Evaluation::find($selectedEvaluationId);
            $this->mount($selectedEvaluation);
        }

        // Update the question count
        if ($this->selectedEvaluation) {
            $this->questionCount = $this->selectedEvaluation->questions()->count();
            $this->totalSteps = $this->questionCount;
        }
    }

    public function render()
    {
        return view('livewire.frontend.customer.evaluation.student-evaluation-component');
    }
}
