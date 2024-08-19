<?php

namespace App\Http\Livewire\Frontend\Customer\Evaluation;

use App\Models\Evaluation;
use Livewire\Component;

class StudentEvaluationComponent extends Component
{
    public $selectedEvaluation;

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
    }

    public function render()
    {
        return view('livewire.frontend.customer.evaluation.student-evaluation-component');
    }
}
