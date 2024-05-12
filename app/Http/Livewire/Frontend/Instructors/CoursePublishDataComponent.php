<?php

namespace App\Http\Livewire\Frontend\Instructors;

use App\Models\Course;
use DateTimeImmutable;
use Livewire\Component;

class CoursePublishDataComponent extends Component
{
    public $courseId;
    public $published_on;
    public $published_on_time;
    public $status;


    public function mount($courseId)
    {
        $this->courseId = $courseId;
        $course = Course::findOrFail($this->courseId);
    }

    public function save()
    {
        // dd($this->status);
        $course = Course::findOrFail($this->courseId);


        $published = $this->published_on . ' ' . $this->published_on_time;
        $published = new DateTimeImmutable($published);

        $course->update([
            'published_on' => $published,
            'status' => $this->status
        ]);


        // You can redirect to another page or emit an event if needed
    }

    public function render()
    {
        $course = Course::where('id', $this->courseId)->first();
        return view('livewire.frontend.instructors.course-publish-data-component', compact('course'));
    }
}
