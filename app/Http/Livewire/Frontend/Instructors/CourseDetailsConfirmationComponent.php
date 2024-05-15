<?php

namespace App\Http\Livewire\Frontend\Instructors;

use App\Models\Course;
use Livewire\Component;

class CourseDetailsConfirmationComponent extends Component
{

    public $courseId;

    public function render()
    {
        $course = Course::where('id', $this->courseId)->first();
        return view('livewire.frontend.instructors.course-details-confirmation-component', compact('course'));
    }
}
