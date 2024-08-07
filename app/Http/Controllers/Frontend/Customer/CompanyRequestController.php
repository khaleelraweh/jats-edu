<?php

namespace App\Http\Controllers\Frontend\Customer;

use App\Http\Controllers\Controller;
use App\Models\CompanyRequest;
use Illuminate\Http\Request;

class CompanyRequestController extends Controller
{

    public function create()
    {
        return view('frontend.customer.company_requests.create');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'cp_user_name' => 'required|string|max:255',
            'cp_user_email' => 'required|email|max:255',
            'cp_user_phone' => 'required|string|max:20',
            'cp_company_name' => 'required|string|max:255',
            'cp_job_title' => 'required|string|max:255',
            'cp_company_size' => 'required|string|max:255',
            'cp_company_country' => 'required|string|max:255',
            'cp_company_city' => 'required|string|max:255',
        ]);

        // Create a new CompanyRequest record
        CompanyRequest::create($validatedData);

        // Redirect to a success page or back to the form with a success message
        return redirect()->route('company_requests.create')->with('success', 'Request submitted successfully!');
    }
}
