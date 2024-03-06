<?php

namespace App\Http\Livewire\Frontend\Home;

use App\Models\Course;
use App\Models\CourseCategory;
use Livewire\Component;

class FeaturedCoursesComponent extends Component
{

    //To filter by categories choosen 
    public $categoryInputs = [];
    protected $queryString = ['categoryInputs'];


    public function render()
    {
        $course_categories_menu = CourseCategory::withCount('courses')->get();

        // $featured_courses = Course::with('firstMedia', 'lastMedia', 'courseCategory')->inRandomOrder()->Active()->ActiveCourseCategory()
        $featured_courses = Course::with('firstMedia', 'lastMedia', 'courseCategory')
            ->inRandomOrder()
            ->Active()
            ->ActiveCourseCategory()
            ->when($this->categoryInputs, function ($query) {
                $query->where('course_category_id', $this->categoryInputs);
            })
            ->take(8)
            ->get();
        return view('livewire.frontend.home.featured-courses-component', compact('featured_courses', 'course_categories_menu'));
    }
}
