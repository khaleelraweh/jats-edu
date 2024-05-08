<?php

namespace App\Http\Livewire\Frontend\Instructors;

use App\Models\Course;
use Livewire\Component;

class CoursePublishDataComponent extends Component
{
    public $courseId;

    public function mount($courseId)
    {
        $this->courseId = $courseId;
        $course = Course::findOrFail($this->courseId);
    }

    public function render()
    {
        $course = Course::where('id', $this->courseId)->first();
        return view('livewire.frontend.instructors.course-publish-data-component', compact('course'));
    }
}
