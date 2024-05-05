<?php

namespace App\Http\Livewire\Frontend\Instructors;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Objective;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;


class IntendedLearnersComponent extends Component
{
    use LivewireAlert;

    public $courseId;
    public $objectives = [];
    public $requirements = [];

    public $formSubmitted = false;
    public $databaseDataValid = false;



    public function mount($courseId)
    {
        $this->courseId = $courseId;
        $course = Course::where('id', $this->courseId)->first();

        // Initialize objectives
        if ($course->objectives != null && $course->objectives->isNotEmpty()) {
            foreach ($course->objectives as $item) {
                $this->objectives[] = ['title' => $item->title];
            }
        } else {
            $this->objectives = [
                ['title' => ''],
                ['title' => ''],
                ['title' => ''],
                ['title' => ''],
            ];
        }

        // Initialize Requirements
        if ($course->requirements != null && $course->requirements->isNotEmpty()) {
            foreach ($course->requirements as $item) {
                $this->requirements[] = ['title' => $item->title];
            }
        } else {
            $this->requirements = [
                ['title' => ''],
            ];
        }

        // Validate database data
        $this->validateDatabaseData();
    }


    protected function validateDatabaseData()
    {
        $course = Course::where('id', $this->courseId)->first();

        // Validate objectives
        $objectivesCount = $course->objectives->count();
        if ($objectivesCount >= 4) {
            foreach ($course->objectives as $item) {
                $validator = Validator::make(['title' => $item->title], [
                    'title' => ['required', 'string', 'min:10', 'max:160'],
                ]);

                if ($validator->fails()) {
                    $this->databaseDataValid = false;
                    return;
                }
            }
        } else {
            $this->databaseDataValid = false;
            return;
        }

        // Validate requirements
        $requirementsCount = $course->requirements->count();
        if ($requirementsCount >= 1) {
            foreach ($course->requirements as $item) {
                $validator = Validator::make(['title' => $item->title], [
                    'title' => ['required', 'string', 'min:10', 'max:160'],
                ]);

                if ($validator->fails()) {
                    $this->databaseDataValid = false;
                    return;
                }
            }
        } else {
            $this->databaseDataValid = false;
            return;
        }

        // If all data passes validation
        $this->databaseDataValid = true;
    }





    // add Objective 
    public function addObjective()
    {
        $this->objectives[] = ['title' => ''];
    }

    //add Requirement
    public function addRequirement()
    {
        $this->requirements[] = ['title' => ''];
    }

    // remove Objective
    public function removeObjective($index)
    {
        unset($this->objectives[$index]);
        $this->objectives = array_values($this->objectives);
    }

    // remove Requirement
    public function removeRequirement($index)
    {
        unset($this->requirements[$index]);
        $this->requirements = array_values($this->requirements);
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

        return view('livewire.frontend.instructors.intended-learners-component', compact('course_categories', 'course', 'instructors', 'courseinstructors'));
    }

    public function storeObjective()
    {
        // Validate objectives and requirements
        $this->validate([
            'objectives' => ['required', 'array', 'min:4'],
            'objectives.*.title' => ['required', 'string', 'min:10', 'max:160'],
            'requirements' => ['required', 'array', 'min:1'],
            'requirements.*.title' => ['required', 'string', 'min:10', 'max:160'],
        ], [
            'objectives.required' => 'At least four objectives are required.',
            'objectives.min' => 'At least four objectives are required.',
            'objectives.*.title.required' => 'The objective field is required.',
            'objectives.*.title.string' => 'The objective must be a string.',
            'objectives.*.title.min' => 'The objective must be at least ten characters.',
            'objectives.*.title.max' => 'The objective must not exceed 160 characters.',
            'requirements.required' => 'At least one requirement is required.',
            'requirements.min' => 'At least one requirement is required.',
            'requirements.*.title.required' => 'The requirement field is required.',
            'requirements.*.title.string' => 'The requirement must be a string.',
            'requirements.*.title.min' => 'The requirement must be at least ten characters.',
            'requirements.*.title.max' => 'The requirement must not exceed 160 characters.',
        ]);

        // Store objectives and requirements
        $course = Course::where('id', $this->courseId)->first();
        $course->objectives()->delete();
        if ($this->objectives != null) {
            $course->objectives()->createMany($this->objectives);
        }
        $course->requirements()->delete();
        if ($this->requirements != null) {
            $course->requirements()->createMany($this->requirements);
        }

        // Set $databaseDataValid to true
        $this->databaseDataValid = true;

        // Set formSubmitted to true on successful submission
        $this->formSubmitted = true;

        // Show success alert
        $this->alert('success', __('Review submitted successfully!'));
    }
}
