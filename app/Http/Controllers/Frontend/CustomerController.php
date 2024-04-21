<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ProfileRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;


class CustomerController extends Controller
{
    public function dashboard()
    {
        return view('frontend.customer.index');
    }
    public function profile()
    {
        return view('frontend.customer.profile');
    }

    public function update_profile(ProfileRequest $request)
    {

        $user = auth()->user();
        $data['first_name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['email'] = $request->email;
        $data['mobile'] = $request->mobile;

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

    public function remove_profile_image()
    {
        $user = auth()->user();

        if ($user->user_image != '') {
            if (File::exists('assets/users/' . $user->user_image)) {
                unlink('assets/users/' . $user->user_image);
            }

            $user->user_image = null;
            $user->save();
            // toast('profile Image deleted' ,'success');
            return back();
        }
    }

    public function addresses()
    {
        return view('frontend.customer.addresses');
    }
    public function orders()
    {
        return view('frontend.customer.orders');
    }

    //all about course 

    public function courses_list($slug = null)
    {
        $user = Auth::user();

        if ($user) {

            $orders = $user->orders()->where('order_status', 1)->get();


            $courses = [];

            foreach ($orders as $order) {
                $courses = array_merge($courses, $order->courses()->get()->toArray());
            }
        }
        // return view('frontend.course-list', compact('courses', 'course_categories_menu'));
        return view('frontend.customer.course-list', compact('slug', 'courses'));
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

        return view('frontend.customer.course-single', compact('course', 'exposedText', 'hiddenText', 'related_courses', 'latest_courses', 'whatsappShareUrl'));
    }
}
