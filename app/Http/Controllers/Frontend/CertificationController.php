<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Certifications;
use App\Models\Course;
use App\Models\CourseSection;
use App\Models\Evaluation;
use App\Models\StudentEvaluation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use ArPHP\I18N\Arabic;


class CertificationController extends Controller
{
    public function index()
    {
        return view('frontend.certifications.index');
    }

    public function show()
    {
        return view('frontend.certifications.show');
    }

    // public function certification($course_id)
    // {
    //     return view('frontend.customer.certification', compact('course_id'));
    // }

    public function certification($course_id)
    {
        // Check if the user already has a certification for this course
        $existingCertification = Certifications::where('user_id', Auth::id())
            ->where('course_id', $course_id)
            ->first();

        if ($existingCertification) {
            // Redirect the user to view their existing certification
            return redirect()->route('customer.show_certification', $existingCertification->id);
        }

        // If no certification exists, load the certification creation view
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


        $certCode = 0;

        if ($certification->id < 9) {
            $certCode = '00' . $certification->id;
        } elseif ($certification->id < 99) {
            $certCode = '0' . $certification->id;
        } else {
            $certCode = '0' . $certification->id;
        }

        $certification->cert_code = Carbon::now()->format('Y') . $certCode;
        $certification->cert_file = $certification->id . ".jpg";
        $certification->update();


        $course = Course::find($request->course_id);
        $course_title = $course->title;


        // ============= Add Student nme ==========//
        // تجهيز النص لإضافته إلى الصورة
        $arabic = new Arabic();


        // $fontPath = public_path('fonts/DINNextLTArabic-Bold-2.ttf');
        $fontPath = public_path('fonts/DINNextLTArabic-Regular-3.ttf');
        $fontSize = 100;

        // تحميل الصورة
        $cover = Image::make('assets/certifications/certificate.jpg');

        // الحصول على أبعاد الصورة
        $width = $cover->getWidth();
        $height = $cover->getHeight();


        //=======================  User name =======================//
        $userName = $arabic->utf8Glyphs($request->full_name);

        $fontPathUserName = public_path('fonts/DINNextLTArabic-Regular-3.ttf');
        $fontSizeUserName = 100;

        //  حساب أبعاد النص للإسم
        $textBoxUserName = imagettfbbox($fontSize, 0, $fontPath, $userName);
        $textWidthUserName = abs($textBoxUserName[2] - $textBoxUserName[0]);
        $textHeightUserName = abs($textBoxUserName[1] - $textBoxUserName[7]);

        // حساب الموقع الأفقي (X) لوضع النص في منتصف الصورة
        $x_user_name = ($width / 2);
        // نضيف ارتفاع النص لتوسيطه عموديًا
        $y_user_name = ($height + $textHeightUserName) / 2 - 160;


        // إضافة النص الاسم إلى الصورة
        $cover->text($userName, $x_user_name, $y_user_name, function ($font) use ($fontPathUserName, $fontSizeUserName) {
            $font->file($fontPathUserName);
            $font->size($fontSizeUserName);
            // $font->color('#ff0000');
            $font->color('#191919');
            $font->align('center'); // محاذاة النص إلى المركز
            $font->valign('middle'); // محاذاة النص إلى المنتصف عموديًا
        });

        //=======================  Course Title =======================//
        $courseTitle = $arabic->utf8Glyphs($course_title);

        $fontPathCourseTitle = public_path('fonts/DINNextLTArabic-Regular-3.ttf');
        $fontSizeCourseTitle = 100;

        // حساب أبعاد النص لعنوان الكورس
        $textBoxCourseTitle = imagettfbbox($fontSize, 0, $fontPath, $courseTitle);
        $textWidthCourseTitle = abs($textBoxCourseTitle[2] - $textBoxCourseTitle[0]);
        $textHeightCourseTitle = abs($textBoxCourseTitle[1] - $textBoxCourseTitle[7]);

        $x_course_title = ($width / 2);
        $y_course_title = ($height + $textHeightCourseTitle) / 2 + 145;


        // إضافة عنوان الكورس إلى الصورة
        $cover->text($courseTitle, $x_course_title, $y_course_title, function ($font) use ($fontPathCourseTitle, $fontSizeCourseTitle) {
            $font->file($fontPathCourseTitle);
            $font->size($fontSizeCourseTitle);
            $font->color('#191919');
            $font->align('center'); // محاذاة النص إلى المركز
            $font->valign('middle'); // محاذاة النص إلى المنتصف عموديًا
        });


        //=======================  date of issue =======================//
        $dateOfIssue = 'م ' . $certification->date_of_issue->format('Y/m/d');

        $fontPathdateOfIssue = public_path('fonts/DINNextLTArabic-Regular-3.ttf');
        $fontSizedateOfIssue = 70;

        // حساب ابعاد النص لكود الشهادة
        $textBoxDateOfIssue = imagettfbbox($fontSize, 0, $fontPath, $dateOfIssue);
        $textWidthDateOfIssue = abs($textBoxDateOfIssue[2] - $textBoxDateOfIssue[0]);
        $textHeightDateOfIssue = abs($textBoxDateOfIssue[1] - $textBoxDateOfIssue[7]);


        $x_date_of_issue = 2755;
        $y_date_of_issue = $height - 210;

        // إضافة تاريخ الشهادة إلى الصورة
        $cover->text($dateOfIssue, $x_date_of_issue, $y_date_of_issue, function ($font) use ($fontPathdateOfIssue, $fontSizedateOfIssue) {
            $font->file($fontPathdateOfIssue);
            $font->size($fontSizedateOfIssue);
            $font->color('#191919');
            $font->align('center'); // محاذاة النص إلى المركز
            $font->valign('middle'); // محاذاة النص إلى المنتصف عموديًا
        });


        //=======================  Cert Code =======================//
        $certCode = $certification->cert_code;

        $fontPathCertCode = public_path('fonts/DINNextLTArabic-Regular-3.ttf');
        $fontSizeCertCode = 90;

        // حساب ابعاد نص لكود الشهادة
        $textBoxCertCode = imagettfbbox($fontSize, 0, $fontPath, $certCode);
        $textWidthCertCode = abs($textBoxCertCode[2] - $textBoxCertCode[0]);
        $textHeightCertCode = abs($textBoxCertCode[1] - $textBoxCertCode[7]);


        $x_cet_code = 400;
        $y_cet_code = $height - 140;

        // إضافة كود الكورس إلى الصورة
        $cover->text($certCode, $x_cet_code, $y_cet_code, function ($font) use ($fontPathCertCode, $fontSizeCertCode) {
            $font->file($fontPathCertCode);
            $font->size($fontSizeCertCode);
            $font->color('#191919');
            $font->align('center'); // محاذاة النص إلى المركز
            $font->valign('middle'); // محاذاة النص إلى المنتصف عموديًا
        });


        // حفظ الصورة مع النص
        // $cover->save('assets/certifications/5.jpg');

        $cover->save('assets/certifications/' . $certification->cert_file);

        // إرجاع استجابة الصورة
        // return $cover->response();

        return redirect()->route('customer.show_certification', $certification->id);
    }

    public function show_certification($certificate_id)
    {
        $certificate = Certifications::find($certificate_id);

        $studentScore = $this->calculateStudentScore(Auth::user()->id, $certificate->course_id);
        return view('frontend.customer.show_certification', compact('certificate', 'studentScore'));
    }

    public function calculateStudentScore($studentId, $courseId)
    {
        // Get all course sections related to the course
        $courseSectionIds = CourseSection::where('course_id', $courseId)->pluck('id');

        // Get all evaluations related to these course sections
        $evaluations = Evaluation::whereIn('course_section_id', $courseSectionIds)->get();

        // Initialize total score and total possible score
        $totalScore = 0;
        $totalPossibleScore = 100; // The score is distributed out of 100
        $evaluationCount = $evaluations->count();

        // Score per evaluation
        $scorePerEvaluation = $totalPossibleScore / ($evaluationCount > 0 ? $evaluationCount : 1);


        foreach ($evaluations as $evaluation) {
            // Get the student's completed evaluation
            $studentEvaluation = StudentEvaluation::where('user_id', $studentId)
                ->where('evaluation_id', $evaluation->id)
                ->first();

            if ($studentEvaluation && $studentEvaluation->completed_at) {
                // Calculate score for this evaluation
                // $totalQuestions = $evaluation->questions()->count();

                $totalQuestions = $studentEvaluation->count();

                // dd($totalQuestions);

                // $answeredQuestions = $studentEvaluation->answeredQuestions()->count();
                $answeredQuestions = $studentEvaluation->score;



                $evaluationScore = ($answeredQuestions / $totalQuestions) * $scorePerEvaluation;

                $totalScore += $evaluationScore;
            }
        }

        return round($totalScore, 2); // Return the total score rounded to 2 decimal places
    }
}
