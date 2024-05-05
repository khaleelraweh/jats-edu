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
        if ($course->objectives != null && $course->objectives->isNotEmpty()) {
            foreach ($course->objectives as $item) {
                $this->objectives[] = ['title' => $item->title];
            }
        } else {
            $this->objectives = [
                ['title' => ''],
            ];
        }

        if ($course->requirements != null && $course->requirements->isNotEmpty()) {
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


        // Validate objectives
        $this->validate([
            'objectives' => ['required', 'array', 'min:3'],
            'objectives.*.title' => ['required', 'string', 'min:10'],
        ], [
            'objectives.required' => 'At least three objectives are required.',
            'objectives.min' => 'At least three objectives are required.',
            'objectives.*.title.required' => 'The objective field is required.',
            'objectives.*.title.string' => 'The objective must be a string.',
            'objectives.*.title.min' => 'The objective must be at least ten characters.',
        ]);


        // add Objectives
        $course->objectives()->delete();
        if ($this->objectives != null) {
            $objectives = $course->objectives()->createMany($this->objectives);
        }


        // Validate requirements
        $this->validate([
            'requirements' => ['required', 'array', 'min:3'],
            'requirements.*.title' => ['required', 'string', 'min:10'],
        ], [
            'requirements.required' => 'At least three requirements are required.',
            'requirements.min' => 'At least three requirements are required.',
            'requirements.*.title.required' => 'The requirement field is required.',
            'requirements.*.title.string' => 'The requirement must be a string.',
            'requirements.*.title.min' => 'The requirement must be at least ten characters.',
        ]);

        //add Requirements
        $course->requirements()->delete();
        if ($this->requirements != null) {
            $requirements = $course->requirements()->createMany($this->requirements);
        }


        // $this->reset(['rating', 'title', 'message']);

        $this->alert('success', __('Review submitted successfully!'));
    }
}
