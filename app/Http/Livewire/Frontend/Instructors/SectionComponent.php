<?php

namespace App\Http\Livewire\Frontend\Instructors;


use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Section;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class SectionComponent extends Component
{
    use LivewireAlert;

    public $courseId;
    public $sections = [];

    public $formSubmitted = false;
    public $databaseDataValid = false;
    public $sectionsValid = false;

    public function mount($courseId)
    {
        $this->courseId = $courseId;
        $course = Course::findOrFail($this->courseId);

        // Initialize sections
        if ($course->sections()->exists()) {
            foreach ($course->sections as $section) {
                $this->sections[] = ['title' => $section->title];
            }
        } else {
            $this->sections = [
                ['title' => ''],
            ];
        }

        // Validate database data
        $this->validateDatabaseData();
    }

    protected function validateDatabaseData()
    {
        // Validate sections
        $sectionsValid = true;
        $course = Course::findOrFail($this->courseId);
        $sectionsCount = $course->sections->count();
        if ($sectionsCount > 0) {
            foreach ($course->sections as $section) {
                $validator = Validator::make(['title' => $section->title], [
                    'title' => ['required', 'string', 'min:10', 'max:160'],
                ]);
                if ($validator->fails()) {
                    $sectionsValid = false;
                    break;
                }
            }
        } else {
            $sectionsValid = false;
        }

        // Set flags for sections validation
        $this->databaseDataValid = $sectionsValid;

        $this->sectionsValid = $sectionsValid;
    }

    // add Section 
    public function addSection()
    {
        $this->sections[] = ['title' => ''];
    }

    // remove Section
    public function removeSection($index)
    {
        unset($this->sections[$index]);
        $this->sections = array_values($this->sections);
    }

    public function render()
    {
        $course = Course::findOrFail($this->courseId);
        $course_categories = CourseCategory::whereStatus(1)->get(['id', 'title']);

        // Get active instructor
        $instructors = User::whereHas('roles', function ($query) {
            $query->where('name', 'instructor');
        })->active()->get(['id', 'first_name', 'last_name']);

        return view('livewire.frontend.instructors.section-component', compact('course_categories', 'course', 'instructors'));
    }

    public function storeSections()
    {
        // Validate sections
        $this->validate([
            'sections' => ['required', 'array', 'min:1'],
            'sections.*.title' => ['required', 'string', 'min:10', 'max:160'],
        ], [
            'sections.required' => __('transf.At least one section is required.'),
            'sections.min' => __('transf.At least one section is required.'),
            'sections.*.title.required' => __('transf.The section title is required.'),
            'sections.*.title.string' => __('transf.The section title must be a string.'),
            'sections.*.title.min' => __('transf.The section title must be at least ten characters.'),
            'sections.*.title.max' => __('transf.The section title must not exceed 160 characters.'),
        ]);

        // Store sections
        $course = Course::findOrFail($this->courseId);

        $course->sections()->delete();
        if ($this->sections != null) {
            $course->sections()->createMany($this->sections);
        }

        // Set $databaseDataValid to true
        $this->databaseDataValid = true;

        // Set formSubmitted to true on successful submission
        $this->formSubmitted = true;

        // Show success alert
        $this->alert('success', __('transf.Sections updated successfully!'));
    }
}
