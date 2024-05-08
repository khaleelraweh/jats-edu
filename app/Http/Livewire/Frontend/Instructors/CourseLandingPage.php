<?php

namespace App\Http\Livewire\Frontend\Instructors;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\User;
use Livewire\Component;

class CourseLandingPage extends Component
{
    public $courseId;
    public $title;
    public $subtitle;
    public $description;
    // Add more properties for other fields
    public $images;
    public $video_promo;
    public $language;
    public $skill_level;
    public $course_type;
    public $course_category_id;
    public $certificate;
    public $deadline;




    protected $rules = [

        'title' => 'required|string|max:255',
        'subtitle' => 'required|string|max:255',
        'description' => 'required|string',
        'images.*' => 'nullable|image|max:2048', // Example validation for images (nullable and max size 2MB)
        'video_promo' => 'nullable|url|max:255', // Example validation for video_promo (nullable, url, max length 255)
        'language' => 'required|in:1,2', // Example validation for language (required and should be one of the given values)
        'skill_level' => 'required|in:1,2,3,4', // Example validation for skill_level (required and should be one of the given values)
        'course_type' => 'required|in:1,2', // Example validation for course_type (required and should be one of the given values)
        'course_category_id' => 'required|exists:course_categories,id', // Example validation for course_category_id (required and should exist in course_categories table)
        'certificate' => 'required|boolean', // Example validation for certificate (required and should be boolean)
        'deadline' => 'nullable|date', // Example validation for deadline (nullable and should be a date)
    ];

    public function mount($courseId)
    {
        $this->courseId = $courseId;
        $course = Course::findOrFail($this->courseId);
        $this->title = $course->title;
        $this->subtitle = $course->subtitle;
        $this->description = $course->description;
        // Set other properties for other fields

        $this->video_promo = $course->video_promo;
        $this->language = $course->language;
        $this->skill_level = $course->skill_level;
        $this->course_type = $course->course_type;
        $this->course_category_id = $course->course_category_id;
        $this->certificate = $course->certificate;
        $this->deadline = $course->deadline ? $course->deadline->format('Y-m-d') : null;

        // Retrieve image URLs or paths
        $this->images = $course->images;
    }

    public function render()
    {
        $course = Course::where('id', $this->courseId)->first();
        $course_categories = CourseCategory::whereStatus(1)->get(['id', 'title']);

        // Get active instructor
        $instructors = User::whereHas('roles', function ($query) {
            $query->where('name', 'instructor');
        })->active()->get(['id', 'first_name', 'last_name']);


        $courseinstructors = $course->users->pluck(['id'])->toArray();

        return view('livewire.frontend.instructors.course-landing-page', compact('course_categories', 'course', 'instructors', 'courseinstructors'));
    }

    public function updateCourse()
    {
        $this->validate();

        $course = Course::findOrFail($this->courseId);
        $course->update([
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'description' => $this->description,
            // Update other fields similarly

            'video_promo' => $this->video_promo,
            'language' => $this->language,
            'skill_level' => $this->skill_level,
            'course_type' => $this->course_type,
            'course_category_id' => $this->course_category_id,
            'certificate' => $this->certificate,
            'deadline' => $this->deadline,
        ]);

        session()->flash('message', 'Course updated successfully.');

        // return redirect()->route('admin.courses.update', $course->id);
    }
}
