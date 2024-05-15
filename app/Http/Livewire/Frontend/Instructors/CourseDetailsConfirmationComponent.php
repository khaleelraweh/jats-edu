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
    public $coursePricingTabValid       = false;
    public $coursePublishedTabValid     = false;


    // Field validation 
    public $priceValid = false;


    protected $rules = [
        'price' => ['required', 'numeric', 'min:0'],
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

        $this->databaseDataValid = $this->coursePricingTabValid;
    }

    public function render()
    {
        $course = Course::where('id', $this->courseId)->first();
        return view('livewire.frontend.instructors.course-details-confirmation-component', compact('course'));
    }
}
