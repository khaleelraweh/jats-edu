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
    public $requirements = [];



    public function mount($courseId)
    {
        $this->courseId = $courseId;

        $course = Course::where('id', $this->courseId)->first();



        // objectives
        if ($course->objectives != null) {
            foreach ($course->objectives as $item) {
                $this->objectives[] = ['title' => $item->title];
            }
        } else {
            $this->objectives = [
                ['title' => ''],
            ];
        }


        //requirements
        if ($course->requirements != null) {
            foreach ($course->requirements as $item) {
                $this->requirements[] = ['title' => $item->title];
            }
        } else {
            $this->requirements = [
                ['title' => ''],
            ];
        }
    }


    // add Objective 
    public function addObjective()
    {
        $this->objectives[] = ['title' => ''];
    }

    //add Requirement
    public function addRequirement()
    {
        $this->requirements[] = ['title' => ''];
    }

    // remove Objective
    public function removeObjective($index)
    {
        unset($this->objectives[$index]);
        $this->objectives = array_values($this->objectives);
    }

    // remove Requirement
    public function removeRequirement($index)
    {
        unset($this->requirements[$index]);
        $this->requirements = array_values($this->requirements);
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

        return view('livewire.frontend.instructors.intended-learners-component', compact('course_categories', 'course', 'instructors', 'courseinstructors'));
    }

    public function storeObjective()
    {

        $course = Course::where('id', $this->courseId)->first();

        // add Objectives
        $course->objectives()->delete();
        if ($this->objectives != null) {
            $objectives = $course->objectives()->createMany($this->objectives);
        }

        //add Requirements
        $course->requirements()->delete();
        if ($this->requirements != null) {
            $requirements = $course->requirements()->createMany($this->requirements);
        }


        // $this->reset(['rating', 'title', 'message']);

        $this->alert('success', __('Review submitted successfully!'));
    }
}
