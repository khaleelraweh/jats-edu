<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use App\Models\TeachRequest;
use App\Models\User;
use App\Notifications\Frontend\Customer\TeachRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class TeachRequestController extends Controller
{
    public function create()
    {
        $specializations = Specialization::get(['id', 'name']);
        return view('frontend.customer.teach_requests.create', compact('specializations'));
    }


    public function store(Request $request)
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


        // if ($request->user_image) {

        //     $file_name = auth()->user()->id  . 'identity-face' . time() . '.' . $request->user_image->getClientOriginalExtension();
        //     $path = public_path('assets/courses/' . $file_name);
        //     Image::make($request->user_image->getRealPath())->save($path);
        // }


        // Handle file uploads
        if ($identity = $request->file('user_image')) {
            $fileName = auth()->user()->id . '-face-' . time() . '.' . $identity->extension();
            $filePath = public_path('assets/teach_requests');
            $identity->move($filePath, $fileName); // Move image file
            $data['user_image'] = $fileName;
        }


        // Handle file uploads
        if ($identity = $request->file('identity')) {
            $fileName = auth()->user()->id . '-identity-' . time() . '.' . $identity->extension();
            $filePath = public_path('assets/teach_requests');
            $identity->move($filePath, $fileName); // Move image file
            $data['identity'] = $fileName;
        }

        foreach (['biography', 'Certificates'] as $fileInput) {
            if ($file = $request->file($fileInput)) {
                $fileName = auth()->user()->id . '-' . $fileInput . '-' . time() . '.' . $file->extension();
                $filePath = public_path('assets/teach_requests');
                $file->move($filePath, $fileName); // Move PDF files
                $data[$fileInput] = $fileName;
            }
        }

        $teach_request =  TeachRequest::create($data);

        $admins = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['admin', 'supervisor']);
        })->get();

        foreach ($admins as $admin) {
            $admin->notify(new TeachRequestNotification($teach_request));
        }

        // return redirect()->back()->with('success', 'Your request has been submitted successfully.');
        return redirect()->route('frontend.customer.teach_requests.show', $teach_request->id);
    }

    public function show($teach_request)
    {

        $teach_request = TeachRequest::where('id', $teach_request)->first();

        return view('frontend.customer.teach_requests.show', compact('teach_request'));
    }
}
