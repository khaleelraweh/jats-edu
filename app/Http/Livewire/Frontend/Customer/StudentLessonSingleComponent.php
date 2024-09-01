<?php

namespace App\Http\Livewire\Frontend\Customer;

use App\Models\Course;
use App\Models\CourseSection;
use App\Models\Evaluation;
use App\Models\StudentEvaluation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
    public $isComplete = false;
    public $hasCertificate = false;



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

        // This is the evaluation test part 
        $studentId = Auth()->id(); // replace with the actual student ID
        $courseId = $course->id; // replace with the actual course ID

        $this->isComplete = $this->checkAllCourseEvaluationsCompletion($studentId, $courseId);

        $this->hasCertificate = $this->checkStudentCertificate(Auth::id(), $courseId);

        // if ($isComplete) {
        //     echo "The student has completed all evaluations in the course.";
        // } else {
        //     echo "The student has not completed all evaluations in the course.";
        // }


        return view('livewire.frontend.customer.student-lesson-single-component', compact('course', 'totalDurations'));
    }

    public function checkAllCourseEvaluationsCompletion($studentId, $courseId)
    {
        // Get all course sections related to the course
        $courseSectionIds = CourseSection::where('course_id', $courseId)->pluck('id');

        // Get all evaluations related to these course sections
        $evaluations = Evaluation::whereIn('course_section_id', $courseSectionIds)->get();

        // Get all evaluations completed by the student in the specified course
        $completedEvaluations = StudentEvaluation::where('user_id', $studentId)
            ->whereNotNull('completed_at') // Only consider evaluations that have been completed
            ->whereHas('evaluation', function ($query) use ($courseSectionIds) {
                $query->whereIn('course_section_id', $courseSectionIds);
            })
            ->pluck('evaluation_id');

        // Check if all evaluations are completed
        $allCompleted = $evaluations->pluck('id')->diff($completedEvaluations)->isEmpty();

        return $allCompleted;
    }

    public function checkStudentCertificate($studentId, $courseId)
    {
        // Find the student by ID (or use Auth::user() if checking the authenticated user)
        $student = User::find($studentId);

        if (!$student) {
            return false; // Student not found
        }

        // Check if the student has a certificate for the given course
        $hasCertificate = $student->certifications()->where('course_id', $courseId)->exists();

        return $hasCertificate;
    }
}
