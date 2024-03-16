<?php

namespace App\Http\Livewire\CourseSingle;

use App\Models\Course;
use App\Models\CourseReview;
use Livewire\Component;

class ReviewComponent extends Component
{

    protected $listeners = [
        'reviewAdded' => 'render'
    ];


    public $courseId;
    public function render()
    {
        $reviews = CourseReview::where('course_id', $this->courseId)->get();
        $courseRating = $reviews->pluck('rating');
        $averageRating = $courseRating->avg();

        return view('livewire.course-single.review-component', compact('reviews', 'averageRating'));
    }
}
