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
        // Check if the user has already made a request
        $existingRequest = TeachRequest::where('user_id', auth()->user()->id)->first();
        if ($existingRequest) {
            // Redirect to the show page with a message if the user has already made a request
            return redirect()->route('frontend.customer.teach_requests.show', $existingRequest->id)
                ->with('error', 'You have already submitted a request.');
        }

        $specializations = Specialization::get(['id', 'name']);
        return view('frontend.customer.teach_requests.create', compact('specializations'));
    }

    public function store(Request $request)
    {
        // Check if the user has already made a request
        $existingRequest = TeachRequest::where('user_id', auth()->user()->id)->first();
        if ($existingRequest) {
            // If a request already exists, return with an error message
            return redirect()->route('frontend.customer.teach_requests.show', $existingRequest->id)
                ->with('error', 'You have already submitted a request.');
        }

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
            'specialization_id'             => 'required|integer',
            'years_of_training_experience'  => 'required|integer',
            'motivation'                    => 'required|string',
            'identity'                      => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'biography'                     => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'Certificates'                  => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $data['full_name']                  = $validatedData['full_name'];
        $data['date_of_birth']              = $validatedData['date_of_birth'];
        $data['place_of_birth']             = $validatedData['place_of_birth'];
        $data['nationality']                = $validatedData['nationality'];
        $data['residence_address']          = $validatedData['residence_address'];
        $data['phone']                      = $validatedData['phone'];
        $data['educational_qualification']  = $validatedData['educational_qualification'];
        $data['specialization_id']          = $validatedData['specialization_id'];
        $data['years_of_training_experience'] = $validatedData['years_of_training_experience'];
        $data['motivation']                 = $validatedData['motivation'];
        $data['user_id']                    = auth()->user()->id;

        // Handle file uploads for identity, biography, and certificates
        $this->handleFileUploads($request, $data);

        // Create a new TeachRequest
        $teach_request = TeachRequest::create($data);

        // Notify admins about the new request
        $admins = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['admin', 'supervisor']);
        })->get();

        foreach ($admins as $admin) {
            $admin->notify(new TeachRequestNotification($teach_request));
        }

        // Redirect to the show page
        return redirect()->route('frontend.customer.teach_requests.show', $teach_request->id);
    }

    private function handleFileUploads(Request $request, &$data)
    {
        foreach (['identity', 'biography', 'Certificates'] as $fileInput) {
            if ($file = $request->file($fileInput)) {
                $fileName = auth()->user()->id . '-' . $fileInput . '-' . time() . '.' . $file->extension();
                $filePath = public_path('assets/teach_requests');
                $file->move($filePath, $fileName); // Move the file
                $data[$fileInput] = $fileName;
            }
        }
    }

    public function show($teach_request)
    {
        $teach_request = TeachRequest::where('id', $teach_request)->first();
        return view('frontend.customer.teach_requests.show', compact('teach_request'));
    }

    public function view_file($file_id)
    {
        return response()->file(public_path('assets/teach_requests/' . $file_id . '.pdf'), ['content-type' => 'application/pdf']);
    }
}
