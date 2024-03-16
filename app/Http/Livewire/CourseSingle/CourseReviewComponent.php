<?php

namespace App\Http\Livewire\CourseSingle;

use App\Models\Course;
use App\Models\CourseReview;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CourseReviewComponent extends Component
{
    use LivewireAlert;

    public $courseId;
    public $rating;
    public $title;
    public $message;
    public $ratingCounts = [];
    public $totalReviews;




    public function  mount()
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

        $course = Course::find($this->courseId);

        // Generate WhatsApp share URL
        $whatsappShareUrl = 'https://api.whatsapp.com/send?text=' . urlencode($course->slug . ': ' . route('frontend.course_single', $course->id));


        $courseRating = CourseReview::where('course_id', $this->courseId)->pluck('rating');
        $averageRating = $courseRating->avg();

        $reviews = CourseReview::where('course_id', $this->courseId)->get();
        return view('livewire.course-single.course-review-component', compact('reviews', 'averageRating', 'whatsappShareUrl'));
    }

    public function storeReview()
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            session()->flash('review_error', __('transf.msg_reviewers_register_login'));
            return;
        }

        // Check if the user has already submitted a review for this course
        $existingReview = CourseReview::where('user_id', auth()->user()->id)
            ->where('course_id', $this->courseId)
            ->first();

        if ($existingReview) {
            session()->flash('review_error', 'You have already submitted a review for this course.');
            return;
        }

        $validatedData = $this->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        CourseReview::create([
            'user_id' => auth()->user()->id,
            'course_id' => $this->courseId,
            'name' => auth()->user()->full_name,
            'email' => auth()->user()->email,
            'title' => $this->title,
            'message' => $this->message,
            'rating' => $this->rating,
        ]);

        // Refresh the rating counts after adding a new review
        $this->mount();

        // $this->emit('reviewAdded');

        $this->reset(['rating', 'title', 'message']);


        $this->alert('success', __('Review submitted successfully!'));
    }
}
