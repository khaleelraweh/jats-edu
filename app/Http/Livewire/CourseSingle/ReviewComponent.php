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
        $course = Course::with('reviews')->find($this->courseId);
        $totalReviews = $course->reviews->count();
        $totalRatings = $course->reviews->sum('rating');

        // Calculate the average rating
        $averageRating = $totalReviews > 0 ? $totalRatings / $totalReviews : 0;



        $reviews = $course->reviews;

        return view('livewire.course-single.review-component', compact('reviews', 'averageRating'));
    }
}
