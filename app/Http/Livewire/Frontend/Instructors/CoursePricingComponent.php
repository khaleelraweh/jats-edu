<?php

namespace App\Http\Livewire\Frontend\Instructors;

use App\Models\Course;
use Illuminate\Support\Carbon;
use Livewire\Component;

class CoursePricingComponent extends Component
{
    public $courseId;
    public $price;
    public $offer_price;
    public $offer_ends;

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
        $this->offer_ends = $course->offer_ends;
    }


    public function save()
    {
        // dd($this->offer_ends);
        $this->validate();

        $course = Course::findOrFail($this->courseId);
        $course->update([
            'price' => $this->price,
            'offer_price' => $this->offer_price,
            'offer_ends' => $this->offer_ends,
        ]);


        // You can redirect to another page or emit an event if needed
    }

    public function render()
    {
        $course = Course::where('id', $this->courseId)->first();
        return view('livewire.frontend.instructors.course-pricing-component', compact('course'));
    }
}
