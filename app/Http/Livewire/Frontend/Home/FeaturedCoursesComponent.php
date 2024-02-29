<?php

namespace App\Http\Livewire\Frontend\Home;

use App\Models\Course;
use Livewire\Component;

class FeaturedCoursesComponent extends Component
{
    public function render()
    {
        // $featured_courses = Course::with('firstMedia', 'lastMedia', 'courseCategory')->inRandomOrder()->Active()->ActiveCourseCategory()
        $featured_courses = Course::with('firstMedia', 'lastMedia', 'courseCategory')->inRandomOrder()->Active()->ActiveCourseCategory()
            ->take(8)
            ->get();
        return view('livewire.frontend.home.featured-courses-component', compact('featured_courses'));
    }
}
