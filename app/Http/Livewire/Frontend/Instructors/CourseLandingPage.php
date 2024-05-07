<?php

namespace App\Http\Livewire\Frontend\Instructors;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\User;
use Livewire\Component;

class CourseLandingPage extends Component
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
        $course_categories = CourseCategory::whereStatus(1)->get(['id', 'title']);

        // Get active instructor
        $instructors = User::whereHas('roles', function ($query) {
            $query->where('name', 'instructor');
        })->active()->get(['id', 'first_name', 'last_name']);


        $courseinstructors = $course->users->pluck(['id'])->toArray();

        return view('livewire.frontend.instructors.course-landing-page', compact('course_categories', 'course', 'instructors', 'courseinstructors'));
    }
}
