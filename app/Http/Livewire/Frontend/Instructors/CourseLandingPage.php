<?php

namespace App\Http\Livewire\Frontend\Instructors;

use App\Models\Course;
use App\Models\CourseCategory;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CourseLandingPage extends Component
{
    use WithFileUploads, LivewireAlert;

    public $courseId;
    public $title;
    public $subtitle;
    public $description;
    public $video_promo;
    public $video_description;
    public $language;
    public $skill_level;
    public $course_type;
    public $course_category_id;
    public $certificate;
    public $deadline = null;
    public $images;
    public $currentImage;
    public $databaseDataValid = false;
    public $formSubmitted = false;
    public $titleValid = false;
    public $subtitleValid = false;
    public $descriptionValid = false;
    public $videopromoValid = false;


    public $wordCount = 0;



    protected $listeners = [
        'updateCourseLanding' => 'mount',
        'updateWordCount' => 'updateWordCount'
    ];

    protected $rules = [
        'title' => 'required|string|min:10|max:60',
        'subtitle' => 'required|string|min:10|max:120',
        // 'description' => 'required|string|min_words:100',
        'description' => 'nullable',
        'images.*' => 'required|image|max:2048',
        'video_promo' => 'nullable|url|max:255', // updated from required into nullable
        'video_description' => 'nullable|url|max:255',
        'language' => 'required|in:1,2',
        'skill_level' => 'required|in:1,2,3,4',
        'course_type' => 'required|in:1,2',
        'course_category_id' => 'required|exists:course_categories,id',
        'certificate' => 'required|boolean',
        'deadline' => 'nullable|date_format:Y-m-d H:i:s',
    ];

    // Custom validation messages
    protected $messages = [
        'title.required' => 'The title field is required.',
        'title.min' => 'The title must be at least 10 characters.',
        'title.max' => 'The title may not be greater than 60 characters.',
        'subtitle.required' => 'The subtitle field is required.',
        'subtitle.min' => 'The subtitle must be at least 10 characters.',
        'subtitle.max' => 'The subtitle may not be greater than 120 characters.',
        'images.*.required' => 'At least one image is required.',
        'images.*.image' => 'The file must be an image.',
        'images.*.max' => 'The image may not be greater than 2MB.',
        'video_promo.url' => 'The video promo must be a valid URL.',
        'video_promo.max' => 'The video promo may not be greater than 255 characters.',
        'video_description.url' => 'The video description must be a valid URL.',
        'video_description.max' => 'The video description may not be greater than 255 characters.',
        'language.required' => 'The language field is required.',
        'language.in' => 'The selected language is invalid.',
        'skill_level.required' => 'The skill level field is required.',
        'skill_level.in' => 'The selected skill level is invalid.',
        'course_type.required' => 'The course type field is required.',
        'course_type.in' => 'The selected course type is invalid.',
        'course_category_id.required' => 'The course category field is required.',
        'course_category_id.exists' => 'The selected course category is invalid.',
        'certificate.required' => 'The certificate field is required.',
        'certificate.boolean' => 'The certificate field must be true or false.',
        'deadline.date_format' => 'The deadline must be a valid date and time.',
    ];




    public function mount($courseId): void
    {
        $this->courseId = $courseId;
        $this->loadCourseData();
        $this->validateDatabaseData();

        $this->wordCount = str_word_count($this->description);
    }


    public function updateWordCount($wordCount)
    {
        $this->wordCount = $wordCount;
    }

    // Compute remaining words
    public function getRemainingWordsProperty()
    {
        return max(100 - $this->wordCount, 0);
    }

    private function loadCourseData(): void
    {
        $course = Course::with('photos', 'firstMedia')->findOrFail($this->courseId);

        $this->title = $course->title ?? '';
        $this->subtitle = $course->subtitle ?? '';
        $this->description = $course->description ?? '';
        $this->video_promo = $course->video_promo ?? '';
        $this->video_description = $course->video_description ?? '';
        $this->language = $course->language ?? '';
        $this->skill_level = $course->skill_level ?? '';
        $this->course_type = $course->course_type ?? '';
        $this->course_category_id = $course->course_category_id ?? '';
        $this->certificate = $course->certificate ?? '';
        $this->deadline = $course->deadline;

        $this->images = $course->images;

        if ($course->firstMedia && $course->firstMedia->file_name) {
            $this->currentImage = asset('assets/courses/' . $course->firstMedia->file_name);
            if (!file_exists(public_path('assets/courses/' . $course->firstMedia->file_name))) {
                $this->currentImage = asset('image/not_found/placeholder.jpg');
            }
        } else {
            $this->currentImage = asset('image/not_found/placeholder.jpg');
        }
    }


    private function validateDatabaseData(): void
    {
        $course = Course::findOrFail($this->courseId);

        $this->titleValid = $this->validateField('title', $course->title);
        $this->subtitleValid = $this->validateField('subtitle', $course->subtitle);
        $this->descriptionValid = $this->validateField('description', $course->description);
        // $this->videopromoValid = $this->validateField('video_promo', $course->video_promo);

        // $this->databaseDataValid = $this->titleValid && $this->subtitleValid && $this->descriptionValid && $this->videopromoValid;
        $this->databaseDataValid = $this->titleValid && $this->subtitleValid && $this->descriptionValid;
    }

    private function validateField(string $field, ?string $value): bool
    {
        if (is_null($value)) {
            return false;
        }

        $rules = [$field => $this->rules[$field]];
        $validator = Validator::make([$field => $value], $rules);
        return !$validator->fails();
    }

    public function render()
    {
        $course = Course::with('photos', 'firstMedia')->findOrFail($this->courseId);
        $course_categories = CourseCategory::whereStatus(1)->get(['id', 'title']);


        $this->emit('initializeTinyMCE'); // Trigger JavaScript re-initialization


        return view(
            'livewire.frontend.instructors.course-landing-page',
            [
                'remainingWords' => $this->remainingWords,
                'course_categories' => $course_categories,
                'course'            => $course
            ]

            // compact('course_categories', 'course', $this->remainingWords)
        );
    }

    public function updateCourse(): void
    {
        $validatedData = $this->validate();
        unset($validatedData['images']);

        $course = Course::with('photos', 'firstMedia')->findOrFail($this->courseId);

        if (!$this->existingImageExists($course) && empty($this->images)) {
            $this->addError('images', __('At least one image is required!'));
            return;
        }

        $course->update($validatedData);

        if (!empty($this->images)) {
            $this->handleImageUpload($course);
        }

        $this->emit('updateCourseLanding', $this->courseId);
        $this->emit('updateCourseDetailsConfirmation', $this->courseId);

        $this->formSubmitted = true;
        $this->alert('success', __('transf.Course Updated Successfully!'));
    }

    private function existingImageExists(Course $course): bool
    {
        if ($course->firstMedia && $course->firstMedia->file_name) {
            return file_exists(public_path('assets/courses/' . $course->firstMedia->file_name));
        }
        return false;
    }

    private function handleImageUpload(Course $course): void
    {
        $course->photos()->delete();
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

    private function saveImage($image, Course $course): string
    {
        $file_name = $course->slug . '_' . time() . '.' . $image->getClientOriginalExtension();
        $path = public_path('assets/courses/' . $file_name);
        Image::make($image->getRealPath())->save($path);
        return $file_name;
    }
}
