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
    public $studentScore = 0;

    protected $listeners = ['evaluationCompleted' => 'updateAfterEvaluation'];


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


    // This method is triggered by the evaluationCompleted event
    public function updateAfterEvaluation($evaluationId)
    {
        // Get the course and student ID
        $course = Course::where('slug->' . app()->getLocale(), $this->slug)->first();
        $studentId = Auth::id();

        // Recalculate the completion and score
        $this->isComplete = $this->checkAllCourseEvaluationsCompletion($studentId, $course->id);

        if ($this->isComplete) {
            $this->hasCertificate = $this->checkStudentCertificate($studentId, $course->id);
            $this->studentScore = $this->calculateStudentScore($studentId, $course->id);
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

        // $this->hasCertificate = $this->checkStudentCertificate(Auth::id(), $courseId);

        if ($this->isComplete) {
            $this->hasCertificate = $this->checkStudentCertificate(Auth::id(), $courseId);

            $this->studentScore = $this->calculateStudentScore(Auth::id(), $course->id);
        } else {
            $student = User::find($studentId);
            $student->certifications()->where('course_id', $courseId)->delete();
        }


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

    public function calculateStudentScore($studentId, $courseId)
    {
        // Get all course sections related to the course
        $courseSectionIds = CourseSection::where('course_id', $courseId)->pluck('id');

        // Get all evaluations related to these course sections
        $evaluations = Evaluation::whereIn('course_section_id', $courseSectionIds)->get();

        // Initialize total score and total possible score
        $totalScore = 0;
        $totalPossibleScore = 100; // The score is distributed out of 100
        $evaluationCount = $evaluations->count();

        // Score per evaluation
        $scorePerEvaluation = $totalPossibleScore / ($evaluationCount > 0 ? $evaluationCount : 1);


        foreach ($evaluations as $evaluation) {
            // Get the student's completed evaluation
            $studentEvaluation = StudentEvaluation::where('user_id', $studentId)
                ->where('evaluation_id', $evaluation->id)
                ->first();

            if ($studentEvaluation && $studentEvaluation->completed_at) {
                // Calculate score for this evaluation
                // $totalQuestions = $evaluation->questions()->count();

                $totalQuestions = $studentEvaluation->count();

                // $answeredQuestions = $studentEvaluation->answeredQuestions()->count();
                $answeredQuestions = $studentEvaluation->score;



                $evaluationScore = ($answeredQuestions / $totalQuestions) * $scorePerEvaluation;

                $totalScore += $evaluationScore;
            }
        }

        return round($totalScore, 2); // Return the total score rounded to 2 decimal places
    }
}
