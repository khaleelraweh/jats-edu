<?php

namespace App\Http\Livewire\Frontend\Customer;

use App\Models\Course;
use App\Models\Evaluation;
use Livewire\Component;

class StudentLessonSingleComponent extends Component
{
    public $slug;
    public $videoUrl;
    public $selectedLessonUrl;
    public $evaluations = []; // New: Store evaluations


    // ============== new part ================
    public $showEvaluation = false;
    public $selectedEvaluation;
    public $curriculumSections;



    public function mount()
    {
        // get the course 
        $course = Course::query()->where('slug->' . app()->getLocale(), $this->slug)->first();

        // Assuming each course has many sections and each section has many lessons and evaluations
        $this->curriculumSections = $course->sections()->with(['lessons', 'evaluations'])->get();
        $urlId = $this->curriculumSections->first()->lessons->first()->url;
        $this->updateContent($urlId);
    }


    public function updateContent($urlOrEvaluationId, $isEvaluation = false)
    {
        if ($isEvaluation) {
            // Hide the video frame and show the evaluation
            $this->showEvaluation = true;
            $this->selectedEvaluation = $urlOrEvaluationId; // This would be the evaluation ID
        } else {
            // Show the video frame and hide the evaluation
            $this->showEvaluation = false;
            $this->videoUrl = $urlOrEvaluationId;
            $this->selectedLessonUrl = $urlOrEvaluationId;
        }
    }



    // public function mount()
    // {
    //     $course = Course::with('sections.lessons')->where('slug->' . app()->getLocale(), $this->slug)->first();
    //     $url = $course->sections->first()->lessons->first()->url;

    //     if (empty($this->videoUrl)) {
    //         $this->videoUrl = $url;
    //         $this->selectedLessonUrl = $url; // Initialize the selected lesson URL

    //     }

    //     // Load evaluations here
    //     // $this->loadEvaluations();
    // }

    public function render()
    {
        $course = Course::with('sections.lessons')->where('slug->' . app()->getLocale(), $this->slug)->first();
        // Calculate total duration for each section
        $totalDurations = [];
        foreach ($course->sections as $section) {
            $totalDuration = $section->lessons->sum('duration_minutes');
            $totalDurations[$section->id] = $totalDuration;
        }

        return view('livewire.frontend.customer.student-lesson-single-component', compact('course', 'totalDurations'));
    }

    public function updateVideoUrl($url)
    {
        $this->videoUrl = $url;
        $this->selectedLessonUrl = $url; // Update the selected lesson URL

        // Update evaluations when the video changes
        // $this->loadEvaluations();
    }

    // private function loadEvaluations()
    // {
    //     // Fetch the course based on the slug
    //     $course = Course::with('sections.lessons')
    //         ->where('slug->' . app()->getLocale(), $this->slug)
    //         ->first();


    //     // Get the selected lesson based on the URL
    //     $selectedLesson = $course->sections->flatMap->lessons->where('url', $this->selectedLessonUrl)->first();



    //     // Ensure that the selected lesson is found
    //     if ($selectedLesson) {
    //         // Fetch evaluations for the section that contains the selected lesson
    //         $this->evaluations = Evaluation::where('course_section_id', $selectedLesson->course_section_id)->get();
    //         // dd($this->evaluations);
    //     } else {
    //         // Handle case where the lesson is not found
    //         $this->evaluations = collect(); // or an empty array if you prefer
    //     }
    // }
}
