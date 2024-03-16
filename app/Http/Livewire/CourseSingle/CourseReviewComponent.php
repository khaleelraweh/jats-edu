<?php

namespace App\Http\Livewire\CourseSingle;

use App\Models\Course;
use App\Models\CourseReview;
use Livewire\Component;

class CourseReviewComponent extends Component
{
    public $courseId;
    public $rating;
    public $title;
    public $message;

    public function  mount()
    {
    }

    public function render()
    {
        $reviews = CourseReview::where('course_id', $this->courseId)->get();
        return view('livewire.course-single.course-review-component', compact('reviews'));
    }

    public function storeReview()
    {
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

        $this->emit('reviewAdded');

        $this->reset(['rating', 'title', 'message']);

        session()->flash('message', 'Review submitted successfully!');
    }
}
