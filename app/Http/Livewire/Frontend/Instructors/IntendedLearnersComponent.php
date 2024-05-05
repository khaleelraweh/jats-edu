<?php

namespace App\Http\Livewire\Frontend\Instructors;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Objective;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class IntendedLearnersComponent extends Component
{
    use LivewireAlert;

    public $courseId;
    public $objectives = [];



    public function mount($courseId)
    {
        $this->courseId = $courseId;

        $this->objectives = [
            ['title' => ''],
        ];
    }


    // Start adding 
    public function addObjective()
    {
        $this->objectives[] = ['title' => ''];
    }

    public function removeObjective($index)
    {
        unset($this->objectives[$index]);
        $this->objectives = array_values($this->objectives);
    }
    // End adding 

    public function render()
    {

        $course = Course::where('id', $this->courseId)->first();

        $course_categories = CourseCategory::whereStatus(1)->get(['id', 'title']);


        // Get active instructor
        $instructors = User::whereHas('roles', function ($query) {
            $query->where('name', 'instructor');
        })->active()->get(['id', 'first_name', 'last_name']);


        $courseinstructors = $course->users->pluck(['id'])->toArray();

        return view('livewire.frontend.instructors.intended-learners-component', compact('course_categories', 'course', 'instructors', 'courseinstructors'));
    }

    public function storeObjective()
    {

        $course = Course::where('id', $this->courseId)->first();


        $course->objectives()->delete();

        if ($this->objectives != null) {
            $objectives = $course->objectives()->createMany($this->objectives);
        }


        // $this->reset(['rating', 'title', 'message']);

        $this->alert('success', __('Review submitted successfully!'));
    }
}
