<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ProfileRequest;
use App\Models\Certifications;
use App\Models\Course;
use App\Models\RequestToTeach;
use App\Models\Role;
use App\Models\Specialization;
use App\Models\User;
use App\Notifications\Frontend\Customer\RequestTeachNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use ArPHP\I18N\Arabic;


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

    public function student_courses_list($slug = null)
    {
        $user = Auth::user();

        if ($user) {

            // $orders = $user->orders()->where('order_status', 1)->get();
            $orders = $user->orders()->where('order_status', 3)->get();


            $courses = [];

            foreach ($orders as $order) {

                $courses = array_merge($courses, $order->courses()->get()->toArray());
            }
        }
        // return view('frontend.course-list', compact('courses', 'course_categories_menu'));
        return view('frontend.customer.student-course-list', compact('slug', 'courses'));
    }


    public function lesson_single($slug)
    {
        return view('frontend.customer.student-lesson-single', compact('slug'));
    }

    public function certification($course_id)
    {
        return view('frontend.customer.certification', compact('course_id'));
    }

    public function create_certification(Request $request)
    {
        // إنشاء السجل الخاص بالشهادة
        $certification = Certifications::create([
            'full_name' => $request->full_name,
            'user_id'   => Auth::user()->id,
            'course_id' => $request->course_id,
            'date_of_issue' => Carbon::now(),
            'cert_code' => 2024,
        ]);

        $certification->cert_code = Carbon::now()->format('Y') . $certification->id;
        $certification->update();


        $course = Course::find($request->course_id);
        $course_title = $course->title;


        // ============= Add Student nme ==========//
        // تجهيز النص لإضافته إلى الصورة
        $arabic = new Arabic();


        $fontPath = public_path('fonts/DINNextLTArabic-Bold-2.ttf');
        $fontSize = 120;

        // تحميل الصورة
        $cover = Image::make('assets/certifications/certificate.jpg');

        // الحصول على أبعاد الصورة
        $width = $cover->getWidth();
        $height = $cover->getHeight();


        //=======================  User name =======================//
        $userName = $arabic->utf8Glyphs($request->full_name);

        //  حساب أبعاد النص للإسم
        $textBoxUserName = imagettfbbox($fontSize, 0, $fontPath, $userName);
        $textWidthUserName = abs($textBoxUserName[2] - $textBoxUserName[0]);
        $textHeightUserName = abs($textBoxUserName[1] - $textBoxUserName[7]);

        // حساب الموقع الأفقي (X) لوضع النص في منتصف الصورة
        $x_user_name = ($width / 2);
        // نضيف ارتفاع النص لتوسيطه عموديًا
        $y_user_name = ($height + $textHeightUserName) / 2 - 160;


        // إضافة النص الاسم إلى الصورة
        $cover->text($userName, $x_user_name, $y_user_name, function ($font) use ($fontPath, $fontSize) {
            $font->file($fontPath);
            $font->size($fontSize);
            $font->color('#ff0000');
            $font->align('center'); // محاذاة النص إلى المركز
            $font->valign('middle'); // محاذاة النص إلى المنتصف عموديًا
        });

        //=======================  Course Title =======================//
        $courseTitle = $arabic->utf8Glyphs($course_title);

        // حساب أبعاد النص لعنوان الكورس
        $textBoxCourseTitle = imagettfbbox($fontSize, 0, $fontPath, $courseTitle);
        $textWidthCourseTitle = abs($textBoxCourseTitle[2] - $textBoxCourseTitle[0]);
        $textHeightCourseTitle = abs($textBoxCourseTitle[1] - $textBoxCourseTitle[7]);

        $x_course_title = ($width / 2);
        $y_course_title = ($height + $textHeightCourseTitle) / 2 + 130;


        // إضافة عنوان الكورس إلى الصورة
        $cover->text($courseTitle, $x_course_title, $y_course_title, function ($font) use ($fontPath, $fontSize) {
            $font->file($fontPath);
            $font->size($fontSize);
            $font->color('#ff0000');
            $font->align('center'); // محاذاة النص إلى المركز
            $font->valign('middle'); // محاذاة النص إلى المنتصف عموديًا
        });


        //=======================  date of issue =======================//
        $dateOfIssue = $arabic->utf8Glyphs($certification->date_of_issue->format('Y-m-d'));

        // حساب ابعاد النص لكود الشهادة
        $textBoxDateOfIssue = imagettfbbox($fontSize, 0, $fontPath, $dateOfIssue);
        $textWidthDateOfIssue = abs($textBoxDateOfIssue[2] - $textBoxDateOfIssue[0]);
        $textHeightDateOfIssue = abs($textBoxDateOfIssue[1] - $textBoxDateOfIssue[7]);


        $x_date_of_issue = 2650;
        $y_date_of_issue = $height - 190;

        // إضافة عنوان الكورس إلى الصورة
        $cover->text($dateOfIssue, $x_date_of_issue, $y_date_of_issue, function ($font) use ($fontPath) {
            $font->file($fontPath);
            $font->size(100);
            $font->color('#ff0000');
            $font->align('center'); // محاذاة النص إلى المركز
            $font->valign('middle'); // محاذاة النص إلى المنتصف عموديًا
        });


        //=======================  Cert Code =======================//
        $certCode = $arabic->utf8Glyphs($certification->cert_code);

        // حساب ابعاد النص لكود الشهادة
        $textBoxCertCode = imagettfbbox($fontSize, 0, $fontPath, $certCode);
        $textWidthCertCode = abs($textBoxCertCode[2] - $textBoxCertCode[0]);
        $textHeightCertCode = abs($textBoxCertCode[1] - $textBoxCertCode[7]);


        $x_cet_code = 400;
        $y_cet_code = $height - 150;

        // إضافة عنوان الكورس إلى الصورة
        $cover->text($certCode, $x_cet_code, $y_cet_code, function ($font) use ($fontPath) {
            $font->file($fontPath);
            $font->size(100);
            $font->color('#ff0000');
            $font->align('center'); // محاذاة النص إلى المركز
            $font->valign('middle'); // محاذاة النص إلى المنتصف عموديًا
        });


        // حفظ الصورة مع النص
        $cover->save('assets/certifications/5.jpg');

        // إرجاع استجابة الصورة
        return $cover->response();
    }

    public function show_certification($certificate_id)
    {
        return view('frontend.customer.certificate_show', compact('certificate_id'));
    }





    public function lesson_certificate($id)
    {
        return view('frontend.customer.certification');
    }

    public function Teach_on_jats()
    {
        $specializations = Specialization::get(['id', 'name']);
        return view('frontend.customer.request-to-teach', compact('specializations'));
    }

    public function request_to_teach(Request $request)
    {

        // Validate the request
        $validatedData = $request->validate([
            'full_name'                     => 'required|array',
            'full_name.ar'                  => 'required|string',
            'full_name.en'                  => 'required|string',
            'date_of_birth'                 => 'required|date',
            'place_of_birth'                => 'required|string',
            'nationality'                   => 'required|string',
            'residence_address'             => 'required|string',
            'phone'                         => 'required|string',
            'educational_qualification'     => 'required|integer',
            'specialization'                => 'required|integer',
            'years_of_training_experience'  => 'required|integer',
            'motivation'                    => 'required|string',
            'identity'                      => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'biography'                     => 'required|file|mimes:pdf|max:2048',
            'Certificates'                  => 'required|file|mimes:pdf|max:2048',
        ]);

        $data['full_name']                      = $validatedData['full_name'];
        $data['date_of_birth']                  = $validatedData['date_of_birth'];
        $data['place_of_birth']                 = $validatedData['place_of_birth'];
        $data['nationality']                    = $validatedData['nationality'];
        $data['residence_address']              = $validatedData['residence_address'];
        $data['phone']                          = $validatedData['phone'];
        $data['educational_qualification']      = $validatedData['educational_qualification'];
        $data['specialization']                 = $validatedData['specialization'];
        $data['years_of_training_experience']   = $validatedData['years_of_training_experience'];
        $data['motivation']                     = $validatedData['motivation'];
        $data['user_id']                        = auth()->user()->id;



        // Handle file uploads
        if ($identity = $request->file('identity')) {
            $fileName = auth()->user()->id . '-identity-' . time() . '.' . $identity->extension();
            $filePath = public_path('assets/teach');
            $identity->move($filePath, $fileName); // Move image file
            $data['identity'] = $fileName;
        }

        foreach (['biography', 'Certificates'] as $fileInput) {
            if ($file = $request->file($fileInput)) {
                $fileName = auth()->user()->id . '-' . $fileInput . '-' . time() . '.' . $file->extension();
                $filePath = public_path('assets/teach');
                $file->move($filePath, $fileName); // Move PDF files
                $data[$fileInput] = $fileName;
            }
        }

        $requestTeach =  RequestToTeach::create($data);

        $admins = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['admin', 'supervisor']);
        })->get();

        foreach ($admins as $admin) {
            $admin->notify(new RequestTeachNotification($requestTeach));
        }

        return redirect()->back()->with('success', 'Your request has been submitted successfully.');
    }
}
