<?php

namespace App\Http\Livewire\Frontend\Instructors;

use App\Models\Course;
use Carbon\Carbon;
use DateTimeImmutable;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CoursePublishDataComponent extends Component
{

    use LivewireAlert;

    public $courseId;
    public $status;
    public $published_on;


    public $formSubmitted = false;
    public $databaseDataValid = false;
    public $statusValid = false;
    public $published_onValid = false;

    public $date;

    protected $rules = [
        'status' => ['required', 'numeric', 'min:0'],
        'published_on' => ['required'],
    ];



    public function mount($courseId)
    {
        $this->courseId = $courseId;
        $course = Course::findOrFail($this->courseId);
        $this->status = $course->status;
        // $this->published_on = $course->published_on;

        // Format the date to Arabic-compatible format if it exists
        if ($course->published_on) {
            $this->published_on = Carbon::parse($course->published_on)
                ->locale(app()->getLocale()) // Use the current app locale
                ->translatedFormat('Y/m/d g:i A'); // Localized format
        } else {
            $this->published_on = Carbon::now()
                ->locale(app()->getLocale())
                ->translatedFormat('Y/m/d g:i A');
        }

        $this->validateDatabaseData();
    }


    public function save()
    {
        // dd($this->published_on);
        $this->validate();

        // dd($this->published_on);
        $course = Course::findOrFail($this->courseId);

        $published_on = str_replace(['ص', 'م'], ['AM', 'PM'], $this->published_on);
        $publishedOn = Carbon::createFromFormat('Y/m/d h:i A', $published_on)->format('Y-m-d H:i:s');


        $course->update([
            'status' => $this->status,
            // 'published_on' => $this->published_on,
            'published_on' => $publishedOn,
        ]);

        $this->formSubmitted = true;

        $this->emit('updateCourseDEtailsConfirmation', $this->courseId);

        $this->alert('success', __('transf.PublishData Updated Successfully!'));
    }

    protected function validateDatabaseData()
    {
        $course = Course::where('id', $this->courseId)->first();

        // Validate Status
        $statusValid = true;
        $validator = Validator::make(['status' => $course->status], [
            'status' => ['required', 'numeric', 'min:0'],
        ]);
        if ($validator->fails()) {
            $statusValid = false;
        }


        // Validate published_on
        $published_onValid = true;
        $validator = Validator::make(['published_on' => $course->published_on], [
            'published_on' => ['required'],
        ]);
        if ($validator->fails()) {
            $published_onValid = false;
        }


        $this->databaseDataValid = $statusValid && $published_onValid;
        $this->statusValid = $statusValid;
        $this->published_onValid = $published_onValid;
    }

    public function render()
    {
        $course = Course::where('id', $this->courseId)->first();
        return view('livewire.frontend.instructors.course-publish-data-component', compact('course'));
    }
}
