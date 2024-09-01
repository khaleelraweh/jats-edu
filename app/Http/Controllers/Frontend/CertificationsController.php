<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CertificationsController extends Controller
{

    public function show($course)
    {

        $course = Course::where('id', $course)->first();

        return view('frontend.certifications.show');
    }
}
