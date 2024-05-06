<?php

namespace App\Http\Livewire\Frontend\Instructors;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CurriculumComponent extends Component
{

    use LivewireAlert;

    public $courseId;
    public $sections = [];
    public $formSubmitted = false;


    public function mount($courseId)
    {
        $this->courseId = $courseId;

        $course = Course::where('id', $this->courseId)->first();

        // Initialize Sections
        if ($course->sections != null && $course->sections->isNotEmpty()) {
            foreach ($course->sections as $item) {
                $this->sections[] = ['title' => $item->title, 'objective' => $item->objective];
            }
        } else {
            $this->sections = [
                ['title' => '', 'objective' => ''],

            ];
        }
    }


    // add section 
    public function addSection()
    {
        $this->sections[] = ['title' => '', 'objective' => ''];
    }

    // remove Section
    public function removeSection($index)
    {
        unset($this->sections[$index]);
        $this->sections = array_values($this->sections);
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

        return view('livewire.frontend.instructors.curriculum-component', compact('course_categories', 'course', 'instructors', 'courseinstructors'));
    }

    // Store section 
    public function storeSection()
    {
        // Validate sections  
        $this->validate([
            'sections' => ['required', 'array', 'min:1'],
            'sections.*.title' => ['required', 'string', 'min:3', 'max:80'],
            'sections.*.objective' => ['required', 'string', 'min:10', 'max:200'],
        ], [
            'sections.required' => __('transf.At least one sections are required.'),
            'sections.min' => __('transf.At least one sections are required.'),

            'sections.*.title.required' => __('transf.The section field is required.'),
            'sections.*.title.string' => __('transf.The section must be a string.'),
            'sections.*.title.min' => __('transf.The section must be at least three characters.'),
            'sections.*.title.max' => __('transf.The section must not exceed 80 characters.'),

            'sections.*.objective.required' => __('transf.The section field is required.'),
            'sections.*.objective.string' => __('transf.The section must be a string.'),
            'sections.*.objective.min' => __('transf.The section must be at least ten characters.'),
            'sections.*.objective.max' => __('transf.The section must not exceed 200 characters.'),

        ]);

        // Store sections
        $course = Course::where('id', $this->courseId)->first();

        $course->sections()->delete();
        if ($this->sections != null) {
            $course->sections()->createMany($this->sections);
        }

        // Set formSubmitted to true on successful submission
        $this->formSubmitted = true;

        // Show success alert
        $this->alert('success', __('transf.intended_learners') . ' ' . __('transf.completed_successfully!'));
    }
}
