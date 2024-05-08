<?php

namespace App\Http\Livewire\Frontend\Instructors;

use App\Models\Course;
use Livewire\Component;

class CoursePricingComponent extends Component
{
    public $courseId;


    public function mount($courseId)
    {
        $this->courseId = $courseId;
        $course = Course::where('id', $this->courseId)->first();
    }


    public function render()
    {
        $course = Course::where('id', $this->courseId)->first();
        return view('livewire.frontend.instructors.course-pricing-component', compact('course'));
    }
}
