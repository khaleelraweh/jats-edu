<?php

namespace App\Http\Livewire\Frontend\Instructors;

use App\Models\Course;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CourseDetailsConfirmationComponent extends Component
{


    public $courseId;
    public $course;


    // General validation 
    public $databaseDataValid           = false;
    public $courseLandingTabValid       = false;
    public $courseObjectiveTabValid     = false;
    public $courseCurriculumTabValid    = false;
    public $coursePricingTabValid       = false;  //doen 
    public $coursePublishedTabValid     = false; //done 



    // Field validation 
    public $titleValid = false;
    public $subtitleValid = false;
    public $descriptionValid = false;
    public $videopromoValid = false;
    public $courseImageValid = false;
    public $objectivesValid = false;
    public $requirementsValid = false;
    public $intendedsValid = false;
    public $sectionsValid = false;
    public $duration_30_minutes_Valid = false;
    public $totalLessonsValid = false;
    public $priceValid = false;
    public $published_onValid = false;
    public $statusValid = false;

    protected $listeners = [
        'updateCourseDEtailsConfirmation' => 'mount'
    ];

    public function mount($courseId)
    {
        $this->courseId = $courseId;
        $this->course = Course::find($this->courseId);
        $this->validateDatabaseData();
    }

    protected function validateDatabaseData()
    {

        $this->validateCourseLanding();
        $this->validateObjective();
        $this->validateCurriculum();
        $this->validatePricing();
        $this->validatePublishData();

        $this->databaseDataValid =
            $this->courseLandingTabValid &&
            $this->courseObjectiveTabValid &&
            $this->courseCurriculumTabValid &&
            $this->coursePricingTabValid &&
            $this->coursePublishedTabValid;
    }

    public function render()
    {
        return view('livewire.frontend.instructors.course-details-confirmation-component', ['course' => $this->course]);
    }

    protected function validateField($value, $field, $rules)
    {
        $validator = Validator::make([$field => $value], [$field => $rules]);
        return !$validator->fails();
    }

    protected function validateCollection($collection, $field, $rules, $minCount = 0)
    {
        if ($collection->count() < $minCount) {
            return false;
        }

        foreach ($collection as $item) {
            if (!$this->validateField($item->{$field}, $field, $rules)) {
                return false;
            }
        }
        return true;
    }


    protected function validateCourseLanding()
    {
        $course = $this->course;

        $this->titleValid = $this->validateField($course->title, 'title', ['required', 'string', 'min:10', 'max:60']);
        $this->subtitleValid = $this->validateField($course->subtitle, 'subtitle', ['required', 'string', 'min:10', 'max:120']);
        $this->descriptionValid = $this->validateField($course->description, 'description', ['required', 'string', 'min_words:100']);
        $this->videopromoValid = $this->validateField($course->video_promo, 'video_promo', ['required', 'url', 'min:10']);

        $this->courseImageValid = $course->firstMedia && file_exists(public_path('assets/courses/' . $course->firstMedia->file_name));

        $this->courseLandingTabValid = $this->titleValid && $this->subtitleValid && $this->descriptionValid && $this->videopromoValid && $this->courseImageValid;
    }

    protected function validateObjective()
    {
        $course = $this->course;

        $this->objectivesValid = $this->validateCollection($course->objectives, 'title', ['required', 'string', 'min:10', 'max:160'], 4);
        $this->requirementsValid = $this->validateCollection($course->requirements, 'title', ['required', 'string', 'min:10', 'max:160'], 1);
        $this->intendedsValid = $this->validateCollection($course->intendeds, 'title', ['required', 'string', 'min:10', 'max:160'], 1);

        $this->courseObjectiveTabValid = $this->objectivesValid && $this->requirementsValid && $this->intendedsValid;
    }

    protected function validateCurriculum()
    {
        $course = Course::where('id', $this->courseId)->first();

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
    }

    protected function validatePricing()
    {
        $course = Course::where('id', $this->courseId)->first();

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
    }

    protected function validatePublishData()
    {
        $course = Course::where('id', $this->courseId)->first();

        // Validate published_on
        $published_onValid = true;
        $validator = Validator::make(['published_on' => $course->published_on], [
            'published_on' => ['required'],
        ]);
        if ($validator->fails()) {
            $published_onValid = false;
        }


        // Validate Status
        $statusValid = true;
        $validator = Validator::make(['status' => $course->status], [
            'status' => ['required', 'numeric', 'min:0'],
        ]);
        if ($validator->fails()) {
            $statusValid = false;
        }

        $this->published_onValid = $published_onValid;
        $this->statusValid = $statusValid;

        $this->coursePublishedTabValid = $published_onValid && $statusValid;
    }
}
