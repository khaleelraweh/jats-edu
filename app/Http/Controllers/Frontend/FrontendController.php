<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CommonQuestion;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Currency;
use App\Models\Instructor;
use App\Models\News;
use App\Models\Post;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductReview;
use App\Models\SiteSetting;
use App\Models\Slider;
use App\Models\User;
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
            ->orderBy('published_on', 'desc')
            ->Active()
            ->take(
                8
            )
            ->get();


        // Get lecturers
        $lecturers = User::whereHas('roles', function ($query) {
            $query->where('name', 'lecturer');
        })
            ->active()
            ->HasCourses()
            ->inRandomOrder()
            ->take(10)
            ->get();

        $events = Post::with('photos')->where('section', 1)->orderBy('created_at', 'ASC')->get();

        return view('frontend.index', compact('main_sliders', 'lecturers', 'events'));
    }
    public function home()
    {
        return view('frontend.home');
    }

    public function courses_list($slug = null)
    {
        // return view('frontend.course-list', compact('courses', 'course_categories_menu'));
        return view('frontend.course-list', compact('slug'));
    }



    public function course_single($slug)
    {
        // Retrieve the text from the database
        $course  = Course::with('courseCategory', 'photos', 'users', 'reviews')
            ->where('slug->' . app()->getLocale(), $slug)
            ->Active()
            ->ActiveCourseCategory()
            ->firstOrFail();


        // Trim the text to remove leading and trailing spaces
        $course->description = trim($course->description);
        // Get the first 200 characters
        $exposedText = substr($course->description, 0, 200);
        // Get the rest of the text
        $hiddenText = substr($course->description, 200);


        //get all related course that are the same of courseCategory of the this choisen course
        $related_courses = Course::with('firstMedia', 'photos', 'courseCategory')->whereHas('courseCategory', function ($query) use ($course) {
            $query->whereId($course->course_category_id)->whereStatus(true);
        })->inRandomOrder()
            ->Active()
            ->take(8)
            ->get();

        $latest_courses = Course::with('firstMedia', 'photos', 'courseCategory')
            ->orderBy('created_at', 'desc') // Order by creation date in descending order
            ->Active()
            ->take(4)
            ->get();



        // Generate WhatsApp share URL
        $whatsappShareUrl = 'https://api.whatsapp.com/send?text=' . urlencode($course->name . ': ' . route('frontend.course_single', $course->slug));

        return view('frontend.course-single', compact('course', 'exposedText', 'hiddenText', 'related_courses', 'latest_courses', 'whatsappShareUrl'));
    }

    public function instructors_list($slug = null)
    {

        return view('frontend.instructors-list');
    }

    public function instructors_single($slug)
    {

        $lecturer = User::whereId($slug)->first();

        // Trim the text to remove leading and trailing spaces
        $lecturer->description = trim($lecturer->description);
        // Get the first 200 characters
        $exposedText = substr($lecturer->description, 0, 200);
        // Get the rest of the text
        $hiddenText = substr($lecturer->description, 200);


        return view('frontend.instructors-single', compact('lecturer', 'exposedText', 'hiddenText'));
    }

    public function event_list($slug = null)
    {
        return view('frontend.event-list', compact('slug'));
    }

    public function event_single($slug)
    {
        return view('frontend.event-single');
    }

    public function blog_list($slug = null)
    {

        return view('frontend.blog-list', compact('slug'));
    }

    public function blog_single($slug)
    {
        return view('frontend.blog-single');
    }

    public function shop_cart()
    {
        return view('frontend.shop-cart');
    }

    public function shop_checkout()
    {
        return view('frontend.shop-checkout');
    }

    public function shop_order_completed()
    {
        return view('frontend.shop-order-completed');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact_us()
    {
        return view('frontend.contact-us');
    }


    public function service()
    {
        return view('frontend.terms_of_service');
    }
}
