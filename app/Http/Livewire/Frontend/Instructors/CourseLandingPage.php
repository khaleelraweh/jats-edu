<?php

namespace App\Http\Livewire\Frontend\Instructors;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Photo;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;

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


    // checking validation 
    public $databaseDataValid = false;
    public $formSubmitted = false;

    public $titleValid = false;
    public $subtitleValid = false;
    public $descriptionValid = false;
    public $videopromoValid = false;


    protected $rules = [

        'title' => 'required|string|max:60',
        'subtitle' => 'required|string|max:120',
        'description' => 'required|string|min_words:100',  // min_words came from AppServiceProvider I made it 
        'images.*' => 'required|image|max:2048', // Validation rule for images (nullable and max size 2MB)
        'video_promo' => 'required|url|max:255', // Example validation for video_promo (nullable, url, max length 255)
        'video_description' => 'nullable|url|max:255', // Example validation for video_promo (nullable, url, max length 255)
        'language' => 'required|in:1,2', // Example validation for language (required and should be one of the given values)
        'skill_level' => 'required|in:1,2,3,4', // Example validation for skill_level (required and should be one of the given values)
        'course_type' => 'required|in:1,2', // Example validation for course_type (required and should be one of the given values)
        'course_category_id' => 'required|exists:course_categories,id', // Example validation for course_category_id (required and should exist in course_categories table)
        'certificate' => 'required|boolean', // Example validation for certificate (required and should be boolean)
        'deadline' => 'nullable|date_format:Y-m-d H:i:s',
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

        // Validate database data
        $this->validateDatabaseData();
    }

    protected function validateDatabaseData()
    {
        $course = Course::where('id', $this->courseId)->first();

        // Validate title
        $titleValid = true;
        $validator = Validator::make(['title' => $course->title], [
            'title' => ['required', 'string', 'min:10', 'max:60'],
        ]);
        if ($validator->fails()) {
            $titleValid = false;
        }

        // Validate subtitle
        $subtitleValid = true;
        $validator = Validator::make(['subtitle' => $course->subtitle], [
            'subtitle' => ['required', 'string', 'min:10', 'max:120'],
        ]);
        if ($validator->fails()) {
            $subtitleValid = false;
        }


        // Validate description
        $descriptionValid = true;
        $validator = Validator::make(['description' => $course->description], [
            'description' => ['required', 'string', 'min_words:100'],
        ]);
        if ($validator->fails()) {
            $descriptionValid = false;
        }

        // Validate video promotional
        $videopromoValid = true;
        $validator = Validator::make(['video_promo' => $course->video_promo], [
            'video_promo' => ['required', 'url', 'min:10'],
        ]);
        if ($validator->fails()) {
            $videopromoValid = false;
        }

        $this->databaseDataValid = $titleValid && $subtitleValid && $descriptionValid && $videopromoValid;

        $this->titleValid = $titleValid;
        $this->subtitleValid = $subtitleValid;
        $this->descriptionValid = $descriptionValid;
        $this->videopromoValid = $videopromoValid;
    }

    public function render()
    {
        $course = Course::with('photos', 'firstMedia')->where('id', $this->courseId)->first();
        $course_categories = CourseCategory::whereStatus(1)->get(['id', 'title']);

        return view('livewire.frontend.instructors.course-landing-page', compact('course_categories', 'course'));
    }

    public function updateCourse()
    {

        // Validate the data
        $validatedData = $this->validate();

        // Remove the images field from validated data
        unset($validatedData['images']);

        // Check if at least one image is uploaded or exists in the database
        $course = Course::with('photos', 'firstMedia')->findOrFail($this->courseId);

        // Update the course with the validated data
        $course->update($validatedData);

        // Handle images if any new ones are uploaded
        if (!empty($this->images)) {
            // Delete existing photos if new images are uploaded
            $course->photos()->delete();

            $this->handleImageUpload($course);
        }

        $this->formSubmitted = true;
        $this->alert('success', 'Course Updated Successfully!');
    }

    protected function handleImageUpload($course)
    {
        foreach ($this->images as $image) {
            $file_name = $this->saveImage($image, $course);
            $course->photos()->create([
                'file_name' => $file_name,
                'file_size' => $image->getSize(),
                'file_type' => $image->getMimeType(),
                'file_status' => 'true',
                'file_sort' => $course->photos->count() + 1,
            ]);
        }
    }

    protected function saveImage($image, $course)
    {
        $file_name = $course->slug . '_' . time() . '.' . $image->getClientOriginalExtension();
        $path = public_path('assets/courses/' . $file_name);
        Image::make($image->getRealPath())->save($path);
        return $file_name;
    }
}
