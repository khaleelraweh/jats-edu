<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyRequestController extends Controller
{
    public function index()
    {
        return view('backend.company_requests.index');
    }
}
