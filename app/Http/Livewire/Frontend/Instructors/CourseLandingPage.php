<?php

namespace App\Http\Livewire\Frontend\Instructors;

use App\Models\Course;
use App\Models\CourseCategory;
use Carbon\Carbon;
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
        'deadline' => 'nullable',
    ];



    public function messages()
    {
        return [
            'title.required' => __('transf.title.required'),
            'title.min' => __('transf.title.min'),
            'title.max' => __('transf.title.max'),
            'subtitle.required' => __('transf.subtitle.required'),
            'subtitle.min' => __('transf.subtitle.min'),
            'subtitle.max' => __('transf.subtitle.max'),
            'images.required' => __('transf.images.required'),
            'images.image' => __('transf.images.image'),
            'images.max' => __('transf.images.max'),
            'video_promo.url' => __('transf.video_promo.url'),
            'video_promo.max' => __('transf.video_promo.max'),
            'video_description.url' => __('transf.video_description.url'),
            'video_description.max' => __('transf.video_description.max'),
            'language.required' => __('transf.language.required'),
            'language.in' => __('transf.language.in'),
            'skill_level.required' => __('transf.skill_level.required'),
            'skill_level.in' => __('transf.skill_level.in'),
            'course_type.required' => __('transf.course_type.required'),
            'course_type.in' => __('transf.course_type.in'),
            'course_category_id.required' => __('transf.course_category_id.required'),
            'course_category_id.exists' => __('transf.course_category_id.exists'),
            'certificate.required' => __('transf.certificate.required'),
            'certificate.boolean' => __('transf.certificate.boolean'),
            'deadline.date_format' => __('transf.deadline.date_format'),

        ];
    }



    public function mount($courseId): void
    {
        $course = Course::findOrFail($this->courseId);
        if ($course->deadline) {
            $this->deadline = Carbon::parse($course->deadline)
                ->locale(app()->getLocale()) // Use the current app locale
                ->translatedFormat('Y/m/d g:i A'); // Localized format
        } else {
            $this->deadline = Carbon::now()
                ->locale(app()->getLocale())
                ->translatedFormat('Y/m/d g:i A');
        }

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


        $dead_line = str_replace(['ص', 'م'], ['AM', 'PM'], $this->deadline);
        $dead_line = Carbon::createFromFormat('Y/m/d h:i A', $dead_line)->format('Y-m-d H:i:s');
        $this->deadline = $dead_line;

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
            // $this->addError('images', __('At least one image is required!'));
            $this->addError('image', __('transf.image.required')); // Use the translation key
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
