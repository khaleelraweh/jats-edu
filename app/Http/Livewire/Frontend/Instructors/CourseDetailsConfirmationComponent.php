<?php

namespace App\Http\Livewire\Frontend\Instructors;

use App\Models\Course;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CourseDetailsConfirmationComponent extends Component
{

    public $courseId;

    // General validation 
    public $databaseDataValid           = false;

    public $courseLandingTabValid       = false;
    public $courseObjectiveTabValid     = false;
    public $courseCurriculumTabValid    = false;
    public $coursePricingTabValid       = false;  //doen 
    public $coursePublishedTabValid     = false; //done 


    // Field validation 
    public $priceValid = false;
    public $published_onValid = false;
    public $statusValid = false;


    protected $rules = [
        'price' => ['required', 'numeric', 'min:0'],
        'published_on' => ['required'],
        'status' => ['required', 'numeric', 'min:0'],
    ];



    public function mount($courseId)
    {
        $this->validateDatabaseData();
    }



    protected function validateDatabaseData()
    {
        $course = Course::where('id', $this->courseId)->first();


        // ===================== Start Price Tab Validation ===============//
        // Validate price 
        $priceValid = true;
        $validator = Validator::make(['price' => $course->price], [
            'price' => ['required', 'numeric', 'min:0'],
        ]);
        if ($validator->fails()) {
            $priceValid = false;
        }

        $this->priceValid = $priceValid;
        $this->coursePricingTabValid = $priceValid;

        // ===================== End Price Tab Validation ===============//

        // ===================== Start publish Tab Validation ===============//
        // Validate published_on
        $published_onValid = true;
        $validator = Validator::make(['published_on' => $course->published_on], [
            'published_on' => ['required'],
        ]);
        if ($validator->fails()) {
            $published_onValid = false;
        }

        $this->published_onValid = $published_onValid;

        // Validate Status
        $statusValid = true;
        $validator = Validator::make(['status' => $course->status], [
            'status' => ['required', 'numeric', 'min:0'],
        ]);
        if ($validator->fails()) {
            $statusValid = false;
        }

        $this->statusValid = $statusValid;

        $this->coursePublishedTabValid = $published_onValid && $statusValid;

        // ===================== End publish Tab Validation ===============//

        $this->databaseDataValid = $this->coursePricingTabValid && $this->coursePublishedTabValid;
    }

    public function render()
    {
        $course = Course::where('id', $this->courseId)->first();
        return view('livewire.frontend.instructors.course-details-confirmation-component', compact('course'));
    }
}
