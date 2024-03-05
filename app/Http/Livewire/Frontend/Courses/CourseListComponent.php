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

    public function render()
    {

        $courses = Course::with('photos', 'firstMedia');
        if ($this->slug == null) {
            $courses = $courses->ActiveCourseCategory();
        } else {

            $course_category = CourseCategory::where('slug->' . app()->getLocale(), $this->slug)
                ->whereStatus(true)
                ->first();

            $courses = $courses->where('course_category_id', $course_category->id);
        }

        $courses = $courses->active()
            ->inRandomOrder()
            ->paginate($this->paginationLimit);

        $course_categories_menu = CourseCategory::withCount('courses')->get();

        return view('livewire.frontend.courses.course-list-component', compact('courses', 'course_categories_menu'));
    }
}
