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
    public $selectedEvaluationId;
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
            $this->selectedEvaluationId = $urlOrEvaluationId; // This would be the evaluation ID
            $this->selectedEvaluation = Evaluation::find($urlOrEvaluationId);
            $this->emit('evaluationChanged', $this->selectedEvaluationId);
            $this->selectedLessonUrl = $urlOrEvaluationId;
        } else {
            // Show the video frame and hide the evaluation
            $this->showEvaluation = false;
            $this->videoUrl = $urlOrEvaluationId;
            $this->selectedLessonUrl = $urlOrEvaluationId;
        }
    }





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
}
