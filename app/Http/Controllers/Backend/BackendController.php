<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AdminInfoRequest;
use App\Models\CompanyRequest;
use App\Models\Course;
use App\Models\Order;
use App\Models\PageVisit;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use illuminate\support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;


class BackendController extends Controller
{

    public function login()
    {

        return view('backend.admin-login');
    }

    public function register()
    {
        return view('backend.admin-register');
    }

    public function lock_screen()
    {
        return view('backend.admin-lock-screen');
    }

    public function recover_password()
    {
        return view('backend.admin-recoverpw');
    }

    public function index()
    {
        $total_students = User::whereHas('roles', function ($query) {
            $query->where('name', 'customer');
        })->count();

        $total_instructors = User::with('specializations')->whereHas('roles', function ($query) {
            $query->where('name', 'instructor');
        })->count();

        // for courses 
        $total_courses = Course::count();
        $total_new_courses = Course::query()->where('course_status', '=', 0)->count();
        $total_courses_completed = Course::query()->where('course_status', '=', 1)->count();
        $total_courses_under_proccess = Course::query()->where('course_status', '=', 2)->count();
        $total_courses_review_finished = Course::query()->where('course_status', '=', 3)->count();
        $total_courses_published = Course::query()->where('course_status', '=', 4)->count();
        $total_courses_rejected = Course::query()->where('course_status', '=', 5)->count();

        $total_orders = Order::count();
        $total_new_orders = Order::query()->where('order_status', '=', 0)->count();
        $total_completed_orders = Order::query()->where('order_status', '=', 1)->count();
        $total_under_proccess_orders = Order::query()->where('order_status', '=', 2)->count();
        $total_finished_orders = Order::query()->where('order_status', '=', 3)->count();
        $total_rejected_orders = Order::query()->where('order_status', '=', 4)->count();
        $total_canceled_orders = Order::query()->where('order_status', '=', 5)->count();

        //end for courses 

        $total_company_requests = CompanyRequest::count();


        $visitors = Visitor::all();
        $pageVisits = PageVisit::select('page', PageVisit::raw('count(*) as visits'))
            ->groupBy('page')
            ->orderByDesc('visits')
            ->get();


        return view('backend.index', compact('total_students', 'total_instructors', 'total_company_requests', 'total_courses', 'total_new_courses', 'total_courses_completed', 'total_courses_under_proccess', 'total_courses_review_finished', 'total_courses_published', 'total_courses_rejected', 'total_orders', 'total_new_orders', 'total_completed_orders', 'total_under_proccess_orders', 'total_finished_orders', 'total_rejected_orders', 'total_canceled_orders', 'visitors', 'pageVisits'));
    }

    public function create_update_theme(Request $request)
    {
        $theme = $request->input('theme_choice');

        if ($theme && in_array($theme, ['light', 'dark'])) {

            $cookie = cookie('theme', $theme, 60 * 25 * 365, "/"); // just one year
        }

        return back()->withCookie($cookie);
    }

    public function account_settings()
    {
        return view('backend.account_settings');
    }


    public function update_account_settings(AdminInfoRequest $request)
    {

        $user = auth()->user();
        $data['first_name'] =   $request->first_name;
        $data['last_name']  =   $request->last_name;
        $data['username']   =   $request->username;
        $data['email']      =   $request->email;
        $data['mobile']     =   $request->mobile;

        if (!empty($request->password) && !Hash::check($request->password, $user->password)) {
            $data['password'] = bcrypt($request->password);
        }

        if ($user_image = $request->file('user_image')) {
            if ($user->user_image != '') {
                if (File::exists('assets/users/' . $user->user_image)) {
                    unlink('assets/users/' . $user->user_image);
                }
            }

            $file_name = $user->username . '.' . $user_image->extension();
            $path = public_path('assets/users/' . $file_name);
            Image::make($user_image->getRealPath())->resize(300, null, function ($constraints) {
                $constraints->aspectRatio();
            })->save($path, 100);

            $data['user_image'] = $file_name;
        }

        $user->update($data);

        // toast('Profile updated' , 'success');
        return back();
    }

    public function remove_image(Request $request)
    {



        $user = auth()->user();

        if ($user->user_image != '') {
            if (File::exists('assets/users/' . $user->user_image)) {
                unlink('assets/users/' . $user->user_image);
            }

            $user->user_image = null;
            $user->save();

            // toast('profile Image deleted' ,'success');
            // return back();
            return true;
        }
    }
}
