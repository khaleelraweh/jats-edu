<?php

namespace App\Http\Livewire\Frontend\Instructors;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Photo;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CourseLandingPage extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $courseId;
    public $title;
    public $subtitle;
    public $description;
    // Add more properties for other fields
    public $video_promo;
    public $video_description;
    public $language;
    public $skill_level;
    public $course_type;
    public $course_category_id;
    public $certificate;
    public $deadline = null; // Set deadline to null by default

    public $images; // For image uploads
    public $currentImage; // For displaying the current image






    protected $rules = [

        'title' => 'required|string|max:255',
        'subtitle' => 'required|string|max:255',
        'description' => 'required|string',
        'images.*' => 'nullable|image|max:2048', // Validation rule for images (nullable and max size 2MB)
        'video_promo' => 'nullable|url|max:255', // Example validation for video_promo (nullable, url, max length 255)
        'video_description' => 'nullable|url|max:255', // Example validation for video_promo (nullable, url, max length 255)
        'language' => 'required|in:1,2', // Example validation for language (required and should be one of the given values)
        'skill_level' => 'required|in:1,2,3,4', // Example validation for skill_level (required and should be one of the given values)
        'course_type' => 'required|in:1,2', // Example validation for course_type (required and should be one of the given values)
        'course_category_id' => 'required|exists:course_categories,id', // Example validation for course_category_id (required and should exist in course_categories table)
        'certificate' => 'required|boolean', // Example validation for certificate (required and should be boolean)
        // 'deadline' => 'nullable|date_format:Y-m-d H:i K', // Valid datetime format
    ];

    public function mount($courseId)
    {
        $this->courseId = $courseId;
        $course = Course::with('photos', 'firstMedia')->findOrFail($this->courseId);
        $this->title = $course->title;
        $this->subtitle = $course->subtitle;
        $this->description = $course->description;
        // Set other properties for other fields

        $this->video_promo = $course->video_promo;
        $this->video_description = $course->video_description;
        $this->language = $course->language;
        $this->skill_level = $course->skill_level;
        $this->course_type = $course->course_type;

        $this->course_category_id = $course->course_category_id;
        $this->certificate = $course->certificate;
        $this->deadline = $course->deadline;

        $this->images = $course->images;
        $this->currentImage = $course->images;
    }






    public function render()
    {
        $course = Course::with('photos', 'firstMedia')->where('id', $this->courseId)->first();
        $course_categories = CourseCategory::whereStatus(1)->get(['id', 'title']);

        return view('livewire.frontend.instructors.course-landing-page', compact('course_categories', 'course'));
    }

    public function updateCourse()
    {

        $this->validate();
        $course = Course::with('photos', 'firstMedia')->findOrFail($this->courseId);
        $course->update([
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'description' => $this->description,
            // Update other fields similarly

            'video_promo' => $this->video_promo,
            'video_description' => $this->video_description,
            'language' => $this->language,
            'skill_level' => $this->skill_level,
            'course_type' => $this->course_type,
            'course_category_id' => $this->course_category_id,
            'certificate' => $this->certificate,
            'deadline' => $this->deadline,
        ]);

        $course->photos()->delete();

        // Handle image uploads
        if ($this->images && count($this->images) > 0) {
            $i = $course->photos->count() + 1;

            foreach ($this->images as $image) {
                // Save the image to the storage
                $file_name = $course->slug . '_' . time() . $i . '.' . $image->getClientOriginalExtension();
                $file_size = $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('assets/courses/' . $file_name);
                Image::make($image->getRealPath())->save($path);

                // Create a new photo record in the database
                $course->photos()->create([
                    'file_name' => $file_name,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                    'file_status' => 'true',
                    'file_sort' => $i,
                ]);

                $i++;
            }
        }

        $this->alert('success', 'Course Updated Successfully! ');
    }
}
