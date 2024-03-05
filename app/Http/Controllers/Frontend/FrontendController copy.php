<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CommonQuestion;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Currency;
use App\Models\Instructor;
use App\Models\News;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductReview;
use App\Models\SiteSetting;
use App\Models\Slider;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class FrontendController extends Controller
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginationLimit = 15;


    public function index()
    {
        $main_sliders = Slider::with('firstMedia')
            // ->MainSliders()
            // ->inRandomOrder()
            ->orderBy('published_on', 'desc')
            ->Active()
            ->take(
                8
            )
            ->get();

        $instructors = Instructor::with('courses')->Active()->take(8)->get();

        return view('frontend.index', compact('main_sliders', 'instructors'));
    }
    public function home()
    {
        return view('frontend.home');
    }

    public function courses($slug = null)
    {
        $courses = Course::with('photos', 'firstMedia');
        if ($slug == null) {
            $courses = $courses->ActiveCourseCategory();
        } else {

            $course_category = CourseCategory::where('slug->' . app()->getLocale(), $slug)
                ->whereStatus(true)
                ->first();

            $courses = $courses->where('course_category_id', $course_category->id);
        }

        $courses = $courses->active()
            ->inRandomOrder()
            ->paginate($this->paginationLimit);

        $course_categories_menu = CourseCategory::get();






        $free_courses = self::free($course_categories_menu);
        $paid_courses = self::paid($course_categories_menu);

        return view('frontend.course-list', compact('courses', 'course_categories_menu', 'free_courses', 'paid_courses'));
    }

    public function free($categories)
    {
        $free = 0;
        foreach ($categories as $category) {
            $free +=   $category->courses->where('price', '=', 0)->count();
        }
        return $free;
    }
    public function paid($categories)
    {
        $free = 0;
        foreach ($categories as $category) {
            $free +=   $category->courses->where('price', '>', 0)->count();
        }
        return $free;
    }

    public function service()
    {
        return view('frontend.terms_of_service');
    }
}
