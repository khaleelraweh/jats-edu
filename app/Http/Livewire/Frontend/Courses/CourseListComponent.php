<?php

namespace App\Http\Livewire\Frontend\Courses;

use App\Models\Course;
use App\Models\CourseCategory;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class CourseListComponent extends Component
{


    use LivewireAlert;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginationLimit = 12;

    public $slug;
    public $sortingBy = "default";

    //To filter by categories choosen 
    public $categoryInputs = [];

    // To Filter by level choosen 
    public $courseLevels = [];

    // To filter by price type 
    public $priceInput;

    protected $queryString = ['categoryInputs', 'courseLevels', 'priceInput'];


    public function render()
    {
        switch ($this->sortingBy) {
            case 'popularity':
                $sort_field = "id";
                $sort_type = "asc";
                break;
            case 'new-courses':
                $sort_field = "created_at";
                $sort_type = "asc";
                break;

            case 'low-high':
                $sort_field = "price";
                $sort_type = "asc";
                break;

            case 'high-low':
                $sort_field = "price";
                $sort_type = "desc";
                break;

            default:
                $sort_field = "id";
                $sort_type = "asc";
        }

        $courses = Course::with('photos', 'firstMedia');
        if ($this->slug == null) {
            $courses = $courses->ActiveCourseCategory();
            if ($this->categoryInputs != null) {
                $courseCategoryIds = CourseCategory::whereIn('slug->' . app()->getLocale(), $this->categoryInputs)->pluck('id')->toArray();
                $courses = $courses->whereIn('course_category_id', $courseCategoryIds);
            }
        } else {

            if ($this->categoryInputs == null) {
                // $courseCategoryIds = CourseCategory::whereIn('slug->' . app()->getLocale(), $this->slug)->pluck('id')->toArray();
                $course_category = CourseCategory::where('slug->' . app()->getLocale(), $this->slug)
                    ->whereStatus(true)
                    ->first();
                $courses = $courses->where('course_category_id', $course_category->id);
            } else {
                $courseCategoryIds = CourseCategory::whereIn('slug->' . app()->getLocale(), $this->categoryInputs)->pluck('id')->toArray();
                $courses = $courses->whereIn('course_category_id', $courseCategoryIds);
            }



            // dd($courseCategoryIds);
        }

        // if ($this->courseLevels != null) {
        //     $courses = $courses->whereIn('skill_level', $this->courseLevels);
        // }

        $courses = $courses->active()
            ->when($this->courseLevels, function ($query) {
                $query->whereIn('skill_level', $this->courseLevels);
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
            ->orderBy($sort_field, $sort_type)
            ->paginate($this->paginationLimit);




        $course_categories_menu = CourseCategory::withCount('courses')->get();

        return view('livewire.frontend.courses.course-list-component', [
            'courses'   =>  $courses,
            'course_categories_menu' => $course_categories_menu,
            'sortingBy' => $this->sortingBy
        ]);
    }
}
