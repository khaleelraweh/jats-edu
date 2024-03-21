<?php

namespace App\Http\Livewire\Frontend\Home;

use App\Models\CourseCategory;
use Livewire\Component;

class TrendingCategoriesComponent extends Component
{

    public  $amount = 8;




    public function render()
    {
        $course_categories = CourseCategory::with('firstMedia')
            ->HasCourses()
            ->Active()
            ->RootCategory()
            ->orderBy('created_at', 'desc')
            // ->take($this->amount)
            ->get();

        return view(
            'livewire.frontend.home.trending-categories-component',
            compact('course_categories')
        );
    }

    public function load_more()
    {
        $this->amount += 4;
    }

    public function load_less()
    {
        $this->amount = 8;
    }
}
