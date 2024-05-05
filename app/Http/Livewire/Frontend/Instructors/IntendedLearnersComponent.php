<?php

namespace App\Http\Livewire\Frontend\Instructors;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Objective;
use App\Models\User;
use Livewire\Component;

class IntendedLearnersComponent extends Component
{
    public $courseId;

    // start 
    public $objectives = [];
    // end 



    public function mount($courseId)
    {
        $this->courseId = $courseId;
        // start 
        $this->objectives = [
            ['product_id' => '', 'quantity' => 'Enter title '],
        ];
        //end 
    }


    // Start adding 
    public function addObjective()
    {
        $this->objectives[] = ['product_id' => '', 'quantity' => 'Enter title '];
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

        // dd("khaleel");

        $course = Course::where('id', $this->courseId)->first();

        // $validatedData = $this->validate([
        //     'objectives' => 'required|string|max:255',
        // ]);


        dd($this->objectives);

        // course objectives start 

        $course->objectives()->delete();

        if ($this->objectives != null) {
            $objectives_list = [];
            for ($i = 0; $i < count($this->objectives); $i++) {
                $objectives_list[$i]['title'] = $this->objectives[$i];
            }
            // dd($requirements_list);
            $objectives = $course->objectives()->createMany($objectives_list);
        }


        // $this->reset(['rating', 'title', 'message']);

        $this->alert('success', __('Review submitted successfully!'));
    }
}
