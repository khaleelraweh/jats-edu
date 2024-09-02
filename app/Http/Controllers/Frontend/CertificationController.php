<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
