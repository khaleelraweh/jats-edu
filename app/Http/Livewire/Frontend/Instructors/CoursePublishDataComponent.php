<?php

namespace App\Http\Livewire\Frontend\Instructors;

use App\Models\Course;
use DateTimeImmutable;
use Livewire\Component;

class CoursePublishDataComponent extends Component
{

    public $courseId;
    public $status;
    public $published_on;

    public $date;

    protected $rules = [
        'status' => ['required', 'numeric', 'min:0'],
    ];



    public function mount($courseId)
    {
        $this->courseId = $courseId;
        $course = Course::findOrFail($this->courseId);
        $this->status = $course->status;
        $this->published_on = $course->published_on;
    }


    public function save()
    {
        // dd($this->published_on);
        $this->validate();

        $course = Course::findOrFail($this->courseId);
        $course->update([
            'status' => $this->status,
            'published_on' => $this->published_on,
        ]);


        // You can redirect to another page or emit an event if needed
    }

    public function render()
    {
        $course = Course::where('id', $this->courseId)->first();
        return view('livewire.frontend.instructors.course-publish-data-component', compact('course'));
    }
}