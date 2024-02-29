<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CommonQuestion;
use App\Models\CourseCategory;
use App\Models\Currency;
use App\Models\News;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductReview;
use App\Models\SiteSetting;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{


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

        return view('frontend.index', compact('main_sliders'));
    }
    public function home()
    {
        return view('frontend.home');
    }

    public function service()
    {
        return view('frontend.terms_of_service');
    }
}
