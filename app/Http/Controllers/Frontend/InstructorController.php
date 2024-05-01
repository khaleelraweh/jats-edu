<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function dashboard()
    {
        return view('frontend.instructor.dashboard');
    }
}
