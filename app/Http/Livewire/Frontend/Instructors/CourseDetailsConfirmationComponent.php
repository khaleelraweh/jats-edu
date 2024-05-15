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

    public $objectivesValid = false;
    public $requirementsValid = false;
    public $intendedsValid = false;

    public $sectionsValid = false;
    public $duration_30_minutes_Valid = false;
    public $totalLessonsValid = false;

    public $priceValid = false;

    public $published_onValid = false;
    public $statusValid = false;



    protected $rules = [
        'price' => ['required', 'numeric', 'min:0'],
        'published_on' => ['required'],
        'status' => ['required', 'numeric', 'min:0'],
        'sections' => ['required', 'array', 'min:1'],
        'sections.*.title' => ['required', 'string', 'min:10', 'max:160'],
    ];



    public function mount($courseId)
    {
        $this->validateDatabaseData();
    }



    protected function validateDatabaseData()
    {
        $course = Course::where('id', $this->courseId)->first();


        // ===================== Start Objective Tab Validation ===============//

        // Validate objectives
        $objectivesValid = true;
        $objectivesCount = $course->objectives->count();
        if ($objectivesCount >= 4) {
            foreach ($course->objectives as $item) {
                $validator = Validator::make(['title' => $item->title], [
                    'title' => ['required', 'string', 'min:10', 'max:160'],
                ]);
                if ($validator->fails()) {
                    $objectivesValid = false;
                    break;
                }
            }
        } else {
            $objectivesValid = false;
        }

        // Validate requirements
        $requirementsValid = true;
        $requirementsCount = $course->requirements->count();
        if ($requirementsCount >= 1) {
            foreach ($course->requirements as $item) {
                $validator = Validator::make(['title' => $item->title], [
                    'title' => ['required', 'string', 'min:10', 'max:160'],
                ]);
                if ($validator->fails()) {
                    $requirementsValid = false;
                    break;
                }
            }
        } else {
            $requirementsValid = false;
        }

        // Validate intendeds
        $intendedsValid = true;
        $intendedsCount = $course->intendeds->count();
        if ($intendedsCount >= 1) {
            foreach ($course->intendeds as $item) {
                $validator = Validator::make(['title' => $item->title], [
                    'title' => ['required', 'string', 'min:10', 'max:160'],
                ]);
                if ($validator->fails()) {
                    $intendedsValid = false;
                    break;
                }
            }
        } else {
            $intendedsValid = false;
        }

        $this->objectivesValid = $objectivesValid;
        $this->requirementsValid = $requirementsValid;
        $this->intendedsValid = $intendedsValid;

        $this->courseObjectiveTabValid = $objectivesValid && $requirementsValid && $intendedsValid;


        // ===================== End Objective Tab Validation ===============//


        // ===================== Start Curriculum Tab Validation ===============//
        // Validate sections
        $sectionsValid = true;

        $sectionsCount = $course->sections->count();

        if ($sectionsCount > 0) {
            foreach ($course->sections as $section) {
                $validator = Validator::make(['title' => $section->title], [
                    'title' => ['required', 'string', 'min:3', 'max:80'],
                ]);
                if ($validator->fails()) {
                    $sectionsValid = false;
                    break;
                }
            }
        } else {
            $sectionsValid = false;
        }

        // duration validation more than or equal to 30 minutes 
        $duration_30_minutes_Valid = true;
        $totalDurations = 0;
        foreach ($course->sections as $section) {
            $totalDurations += $section->lessons->sum(
                'duration_minutes',
            );
        }
        if ($totalDurations < 30) {
            $duration_30_minutes_Valid = false;
        }

        // lesson total more than 5 lectures 
        $totalLessonsValid = true;
        if ($course->totalLessonsCount() < 5) {
            $totalLessonsValid = false;
        }

        $this->sectionsValid = $sectionsValid;
        $this->duration_30_minutes_Valid = $duration_30_minutes_Valid;
        $this->totalLessonsValid = $totalLessonsValid;

        $this->courseCurriculumTabValid = $sectionsValid && $duration_30_minutes_Valid && $totalLessonsValid;

        // ===================== End Curriculum Tab Validation ===============//


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

        $this->databaseDataValid = $this->courseObjectiveTabValid && $this->courseCurriculumTabValid && $this->coursePricingTabValid && $this->coursePublishedTabValid;
    }

    public function render()
    {
        $course = Course::where('id', $this->courseId)->first();
        return view('livewire.frontend.instructors.course-details-confirmation-component', compact('course'));
    }
}
