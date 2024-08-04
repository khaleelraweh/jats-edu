<?php

namespace App\Http\Livewire\Frontend\Instructors;

use Livewire\Component;

class EvaluationComponent extends Component
{
    public $courseId;


    public function mount($courseId)
    {
        $this->courseId = $courseId;
    }

    public function render()
    {
        return view('livewire.frontend.instructors.evaluation-component');
    }
}
