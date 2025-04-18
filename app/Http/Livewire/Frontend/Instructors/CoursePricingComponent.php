<?php

namespace App\Http\Livewire\Frontend\Instructors;

use App\Models\Course;
use Carbon\Carbon as CarbonCarbon;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CoursePricingComponent extends Component
{
    use LivewireAlert;

    public $courseId;
    public $price;
    public $offer_price;
    public $offer_ends;

    // validation check 
    public $formSubmitted = false;
    public $databaseDataValid = false;
    public $priceValid = false;

    public $date;

    protected $rules = [
        'price' => ['required', 'numeric', 'min:0'],
        'offer_price' => ['nullable', 'numeric', 'min:0'],
        // 'offer_ends' => ['required', 'date'],
    ];



    public function mount($courseId)
    {
        $this->courseId = $courseId;
        $course = Course::findOrFail($this->courseId);
        $this->price = $course->price;
        $this->offer_price = $course->offer_price;
        // $this->offer_ends = $course->offer_ends;

        if ($course->published_on) {
            $this->offer_ends = Carbon::parse($course->offer_ends)
                ->locale(app()->getLocale()) // Use the current app locale
                ->translatedFormat('Y/m/d g:i A'); // Localized format
        } else {
            $this->offer_ends = Carbon::now()
                ->locale(app()->getLocale())
                ->translatedFormat('Y/m/d g:i A');
        }

        $this->validateDatabaseData();
    }


    public function save()
    {
        // dd($this->offer_ends);
        $this->validate();

        $course = Course::findOrFail($this->courseId);

        $offer_ends = str_replace(['ص', 'م'], ['AM', 'PM'], $this->offer_ends);
        $offerEnds = CarbonCarbon::createFromFormat('Y/m/d h:i A', $offer_ends)->format('Y-m-d H:i:s');

        $course->update([
            'price' => $this->price,
            'offer_price' => $this->offer_price,
            'offer_ends' => $offerEnds,
        ]);

        $this->formSubmitted = true;

        $this->alert('success', __('transf.Price Updated Successfully!'));
    }

    protected function validateDatabaseData()
    {
        $course = Course::where('id', $this->courseId)->first();

        // Validate title
        $priceValid = true;
        $validator = Validator::make(['price' => $course->price], [
            'price' => ['required', 'numeric', 'min:0'],
        ]);
        if ($validator->fails()) {
            $priceValid = false;
        }


        $this->databaseDataValid = $priceValid;
        $this->priceValid = $priceValid;
    }

    public function render()
    {
        $course = Course::where('id', $this->courseId)->first();
        return view('livewire.frontend.instructors.course-pricing-component', compact('course'));
    }
}
