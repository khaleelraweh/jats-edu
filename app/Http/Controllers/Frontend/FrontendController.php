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

    // public function courses()
    // {
    //     $courses = Course::with('firstMedia', 'lastMedia', 'courseCategory')->inRandomOrder()->Active()->ActiveCourseCategory()
    //         ->paginate($this->paginationLimit);
    //     return view('frontend.course-list', compact('courses'));
    // }

    public function courses($slug = null)
    {
        $courses = Course::with('photos', 'firstMedia', 'courseCategory');
        if ($slug == null) {
            // $courses = $courses->inRandomOrder()->Active()->ActiveCourseCategory()
            //     ->paginate($this->paginationLimit);
            $courses = $courses->ActiveCourseCategory();
        } else {

            // get product category where its slug is equail to came slug 
            $course_category = CourseCategory::whereSlug($slug)
                ->whereStatus(true)
                ->first();

            //check product category if its parent_id is null means its one of the main category
            if (is_null($course_category->parent_id)) {

                // get all sub categories id where there parentId is equals to $product_category->parent_id than mentioned in the check which are main category
                $categoriesIds = ProductCategory::whereParentId($course_category->id)
                    ->whereStatus(true)
                    ->pluck('id')
                    ->toArray();

                // get all products from all sub categories by using whereHas('category',...)
                $courses = $courses->whereHas('courseCategory', function ($query) use ($categoriesIds) {
                    $query->whereIn('id', $categoriesIds);
                });
            } else {

                //else if product category is submenu 

                //get all products related to this sub category where subcategory's slug equal to came slug and its status is true :means active
                $courses = $courses->with('courseCategory')->whereHas('courseCategory', function ($query) use ($slug) {
                    $query->where([
                        'slug' => $slug,
                        'status'   => true
                    ]);
                });
            }
        }

        //check product if is active and has quantity and order it by switch case choise
        $courses = $courses->active()
            ->inRandomOrder()
            ->paginate($this->paginationLimit);


        return view('frontend.course-list', compact('courses'));
    }

    public function service()
    {
        return view('frontend.terms_of_service');
    }
}
