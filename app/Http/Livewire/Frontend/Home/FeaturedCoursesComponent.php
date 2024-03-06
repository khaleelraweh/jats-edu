<?php

namespace App\Http\Livewire\Frontend\Home;

use App\Models\Course;
use App\Models\CourseCategory;
use Livewire\Component;

class FeaturedCoursesComponent extends Component
{

    public  $amount = 8;

    //To filter by categories choosen 
    public $categoryInputs;

    // To filter by levels 
    public $courseLevels;

    // To filter by price 
    public $priceInput;

    //To sort by 
    public $sortingBy;

    protected $queryString = ['categoryInputs', 'courseLevels', 'priceInput', 'sortingBy'];




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
            ->when($this->courseLevels, function ($query) {
                $query->where('course_level', $this->courseLevels);
            })
            ->when($this->priceInput, function ($query) {
                $query
                    ->when($this->priceInput == 'all', function ($query2) {
                        $query2->where('price', '>=', 0);
                    })
                    ->when($this->priceInput == 'free', function ($query2) {
                        $query2->where('price', '=', 0);
                    })
                    ->when($this->priceInput == 'paid', function ($query2) {
                        $query2->where('price', '>', 0);
                    });
            })
            ->when($this->sortingBy, function ($query) {
                $query
                    ->when($this->sortingBy == 'default', function ($query2) {
                        $query2->orderBy('id', 'ASC');
                    })
                    ->when($this->sortingBy == 'popularity', function ($query2) {
                        $query2->orderBy('id', 'ASC');
                    })
                    ->when($this->sortingBy == 'new-courses', function ($query2) {
                        $query2->orderBy('created_at', 'ASC');
                    })
                    ->when($this->sortingBy == 'low-high', function ($query2) {
                        $query2->orderBy('price', 'ASC');
                    })
                    ->when($this->sortingBy == 'high-low', function ($query2) {
                        $query2->orderBy('price', 'DESC');
                    });
            })
            // ->take($this->amount)
            ->get();
        return view('livewire.frontend.home.featured-courses-component', compact('featured_courses', 'course_categories_menu'));
    }

    public function load_more()
    {
        $this->amount += 8;
    }

    public function load_less()
    {
        $this->amount = 8;
    }
}
