<?php

namespace App\Http\Livewire\CourseSingle;

use App\Models\Course;
use App\Models\CourseReview;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CourseReviewComponent extends Component
{
    public $courseId;
    public $rating;
    public $title;
    public $message;
    public $ratingCounts = [];
    public $totalReviews;

    protected $rules = [
        'rating' => 'required|numeric|min:0.5|max:5',
        'title' => 'required|string|max:255',
        'message' => 'required|string',
    ];

    public function mount()
    {
        // Fetch the count for each rating level in descending order
        $this->ratingCounts = CourseReview::where('course_id', $this->courseId)
            ->selectRaw('rating, count(*) as count')
            ->groupBy('rating')
            ->pluck('count', 'rating')
            ->toArray();

        // Calculate the total number of reviews
        $this->totalReviews = array_sum($this->ratingCounts);
    }

    public function render()
    {
        // Retrieve the course along with its reviews
        $course = Course::with('reviews')->find($this->courseId);

        // Calculate the average rating
        $averageRating = $course->reviews->avg('rating');

        $reviews = $course->reviews;

        return view('livewire.course-single.course-review-component', compact('reviews', 'averageRating'));
    }

    public function storeReview()
    {
        // Validate input
        $this->validate();

        // Check if the user is logged in
        if (!Auth::check()) {
            session()->flash('review_error', __('transf.msg_reviewers_register_login'));
            return;
        }

        // Check if the user has already submitted a review for this course
        $existingReview = CourseReview::where('user_id', auth()->user()->id)
            ->where('course_id', $this->courseId)
            ->exists();

        if ($existingReview) {
            session()->flash('review_error', 'You have already submitted a review for this course.');
            return;
        }

        // Create the review
        CourseReview::create([
            'user_id' => auth()->user()->id,
            'course_id' => $this->courseId,
            'title' => $this->title,
            'message' => $this->message,
            'rating' => $this->rating,
        ]);

        // Refresh the rating counts after adding a new review
        $this->mount();

        // Reset form fields
        $this->reset(['rating', 'title', 'message']);

        $this->emit('reviewAdded');

        $this->emit('alert', ['type' => 'success', 'message' => __('Review submitted successfully!')]);
    }
}
