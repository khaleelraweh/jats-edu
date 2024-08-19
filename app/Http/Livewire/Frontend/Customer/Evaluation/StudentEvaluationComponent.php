<?php

namespace App\Http\Livewire\Frontend\Customer\Evaluation;

use Livewire\Component;

class StudentEvaluationComponent extends Component
{
    public $selectedEvaluation;


    public function  mount($selectedEvaluation)
    {
        $this->selectedEvaluation = $selectedEvaluation;
    }

    public function render()
    {
        return view('livewire.frontend.customer.evaluation.student-evaluation-component', [
            'selectedEvaluation'    =>  $this->selectedEvaluation,
        ]);
    }
}
