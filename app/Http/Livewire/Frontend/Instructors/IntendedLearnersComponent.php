<?php

namespace App\Http\Livewire\Frontend\Instructors;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\User;
use Livewire\Component;

class IntendedLearnersComponent extends Component
{
    public $courseId;

    // start 
    public $orderProducts = [];
    // end 



    public function mount($courseId)
    {
        $this->courseId = $courseId;
        // start 
        $this->orderProducts = [
            ['product_id' => '', 'quantity' => 1]
        ];
        //end 
    }


    // Start adding 
    public function addProduct()
    {
        $this->orderProducts[] = ['product_id' => '', 'quantity' => 1];
    }

    public function removeProduct($index)
    {
        unset($this->orderProducts[$index]);
        $this->orderProducts = array_values($this->orderProducts);
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
}
