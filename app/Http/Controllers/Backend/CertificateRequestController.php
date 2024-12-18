<?php

namespace App\Http\Controllers\Backend;

use Altwaireb\World\Models\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CertificateRequestRequest;
use App\Models\CertificateRequest;
use App\Models\Certifications;
use App\Models\Course;
use App\Models\Sponser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use illuminate\support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class CertificateRequestController extends Controller
{

    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_certificate_requests , show_certificate_requests')) {
            return redirect('admin/index');
        }

        $certificate_requests = CertificateRequest::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->where('status', \request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'published_on', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        return view('backend.certificate_requests.index', compact('certificate_requests'));
    }

    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_certificate_requests')) {
            return redirect('admin/index');
        }

        $courses = Course::query()->active()->get(['id', 'title']);
        $sponsers = Sponser::query()->active()->get(['id', 'name']);
        $countries = Country::query()->active()->get(['id', 'name', 'translations']);

        return view('backend.certificate_requests.create', compact('courses', 'sponsers', 'countries'));
    }

    public function store(CertificateRequestRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_certificate_requests')) {
            return redirect('admin/index');
        }



        $input['full_name']                 =   $request->full_name;

        $input['date_of_birth']             = Carbon::createFromFormat('Y/m/d', $request->date_of_birth)->format('Y-m-d');


        $input['nationality']               =   $request->nationality;
        $input['country']                   =   $request->country;
        $input['state']                     =   $request->state;
        $input['city']                      =   $request->city;
        $input['phone']                     =   $request->phone;
        $input['whatsup_phone']             =   $request->whatsup_phone;
        $input['identity_type']             =   $request->identity_type;
        $input['identity_number']           =   $request->identity_number;

        $input['identity_expiration_date']  = Carbon::createFromFormat('Y/m/d', $request->identity_expiration_date)->format('Y-m-d');

        $input['identity_attachment']       =   $request->identity_attachment;
        $input['certificate_name']          =   $request->certificate_name;
        $input['certificate_code']          =   $request->certificate_code;

        $input['certificate_release_date']  = Carbon::createFromFormat('Y/m/d', $request->certificate_release_date)->format('Y-m-d');

        $input['certificate_file']          =   $request->certificate_file;
        $input['certificate_status']        =   $request->certificate_status;

        $input['sponser_id']                =   $request->sponser_id;
        $input['user_id']                   =   $request->user_id;
        $input['course_id']                 =   $request->course_id;


        $published_on                       = str_replace(['ص', 'م'], ['AM', 'PM'], $request->published_on);
        $publishedOn                        = Carbon::createFromFormat('Y/m/d h:i A', $published_on)->format('Y-m-d H:i:s');
        $input['published_on']              = $publishedOn;


        $input['status']                    = $request->status;
        $input['created_by']                = auth()->user()->full_name;


        if ($image =  $request->file('certificate_file')) {

            $file_name                      = Str::slug($request->certificate_code) . '_' . time() .  "." . $image->getClientOriginalExtension();
            $path                           = public_path('assets/certificate_requests/' . $file_name);

            Image::make($image->getRealPath())->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);

            $input['certificate_file'] = $file_name;
        }

        if ($image =  $request->file('identity_attachment')) {

            $file_name                      = Str::slug($request->identity_number) . '_' . time() .  "." . $image->getClientOriginalExtension();
            $path                           = public_path('assets/certificate_requests/' . $file_name);

            Image::make($image->getRealPath())->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);

            $input['identity_attachment'] = $file_name;
        }


        $certificate_request = CertificateRequest::create($input);



        if ($certificate_request) {
            return redirect()->route('admin.certificate_requests.index')->with([
                'message' => __('panel.created_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.certificate_requests.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }



    public function show($id)
    {
        if (!auth()->user()->ability('admin', 'display_certificate_requests')) {
            return redirect('admin/index');
        }
        return view('backend.certificate_requests.show');
    }

    public function edit($certificate_request)
    {
        if (!auth()->user()->ability('admin', 'update_certificate_requests')) {
            return redirect('admin/index');
        }

        $certificate_request = CertificateRequest::where('id', $certificate_request)->first();

        $courses = Course::query()->active()->get(['id', 'title']);
        $sponsers = Sponser::query()->active()->get(['id', 'name']);
        $countries = Country::query()->active()->get(['id', 'name', 'translations']);

        return view('backend.certificate_requests.edit', compact('certificate_request', 'courses', 'sponsers', 'countries'));
    }

    public function update(CertificateRequestRequest $request, $certificate_request)
    {
        $certificate_request = CertificateRequest::where('id', $certificate_request)->first();

        $input['full_name'] = $request->full_name;
        $input['date_of_birth'] = Carbon::createFromFormat('Y/m/d', $request->date_of_birth)->format('Y-m-d');
        $input['nationality'] = $request->nationality;
        $input['country'] = $request->country;
        $input['state'] = $request->state;
        $input['city'] = $request->city;
        $input['phone'] = $request->phone;
        $input['whatsup_phone'] = $request->whatsup_phone;
        $input['identity_type'] = $request->identity_type;
        $input['identity_number'] = $request->identity_number;
        $input['identity_expiration_date'] = Carbon::createFromFormat('Y/m/d', $request->identity_expiration_date)->format('Y-m-d');
        $input['certificate_name'] = $request->certificate_name;
        $input['certificate_code'] = $request->certificate_code;
        $input['certificate_release_date'] = Carbon::createFromFormat('Y/m/d', $request->certificate_release_date)->format('Y-m-d');
        $input['certificate_status'] = $request->certificate_status;
        $input['sponser_id'] = $request->sponser_id;
        $input['user_id'] = $request->user_id;
        $input['course_id'] = $request->course_id;

        $published_on = str_replace(['ص', 'م'], ['AM', 'PM'], $request->published_on);
        $input['published_on'] = Carbon::createFromFormat('Y/m/d h:i A', $published_on)->format('Y-m-d H:i:s');
        $input['status'] = $request->status;
        $input['created_by'] = auth()->user()->full_name;

        if ($image = $request->file('certificate_file')) {
            if ($certificate_request->certificate_file != null && File::exists('assets/certificate_requests/' . $certificate_request->certificate_file)) {
                unlink('assets/certificate_requests/' . $certificate_request->certificate_file);
            }

            $file_name = Str::slug($request->certificate_code) . '_' . time() .  "." . $image->getClientOriginalExtension();

            $path = public_path('assets/certificate_requests/' . $file_name);
            Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);

            $input['certificate_file'] = $file_name;
        }

        // Handle identity attachment
        if ($image = $request->file('identity_attachment')) {
            if ($certificate_request->identity_attachment != null && File::exists('assets/certificate_requests/' . $certificate_request->identity_attachment)) {
                unlink('assets/certificate_requests/' . $certificate_request->identity_attachment);
            }

            $file_name = Str::slug($request->identity_number) . '_' . time() . "." . $image->getClientOriginalExtension();
            $path = public_path('assets/certificate_requests/' . $file_name);

            Image::make($image->getRealPath())->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);

            $input['identity_attachment'] = $file_name;
        } else {
            unset($input['identity_attachment']);
        }

        // Update the certificate request
        $certificate_request->update($input);

        if ($certificate_request) {
            return redirect()->route('admin.certificate_requests.index')->with([
                'message' => __('panel.updated_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.certificate_requests.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }



    public function destroy($certificate_request)
    {
        if (!auth()->user()->ability('admin', 'delete_certificate_requests')) {
            return redirect('admin/index');
        }

        $certificate_request = CertificateRequest::findOrFail($certificate_request);

        if (!empty($certificate_request->certificate_file) && File::exists('assets/certificate_requests/' . $certificate_request->certificate_file)) {
            unlink('assets/certificate_requests/' . $certificate_request->certificate_file);
        }

        if (!empty($certificate_request->identity_attachment) && File::exists('assets/certificate_requests/' . $certificate_request->identity_attachment)) {
            unlink('assets/certificate_requests/' . $certificate_request->identity_attachment);
        }

        // Mark as deleted by the current user
        $certificate_request->deleted_by = auth()->user()->full_name;
        $certificate_request->save();

        // Soft delete the record
        $certificate_request->delete();

        return redirect()->route('admin.certificate_requests.index')->with([
            'message' => __('panel.deleted_successfully'),
            'alert-type' => 'success'
        ]);
    }


    public function remove_certificate_file_image(Request $request)
    {

        if (!auth()->user()->ability('admin', 'delete_certificate_requests')) {
            return redirect('admin/index');
        }

        $certificate_request = CertificateRequest::findOrFail($request->certificate_request_id);
        if (File::exists('assets/certificate_requests/' . $certificate_request->certificate_file)) {
            unlink('assets/certificate_requests/' . $certificate_request->certificate_file);
            $certificate_request->certificate_file = null;
            $certificate_request->save();
        }
        if ($certificate_request->certificate_file != null) {
            $certificate_request->certificate_file = null;
            $certificate_request->save();
        }

        return true;
    }

    public function remove_identity_attachment_image(Request $request)
    {

        if (!auth()->user()->ability('admin', 'delete_certificate_requests')) {
            return redirect('admin/index');
        }

        $certificate_request = CertificateRequest::findOrFail($request->certificate_request_id);
        if (File::exists('assets/certificate_requests/' . $certificate_request->identity_attachment)) {
            unlink('assets/certificate_requests/' . $certificate_request->identity_attachment);
            $certificate_request->identity_attachment = null;
            $certificate_request->save();
        }
        if ($certificate_request->identity_attachment != null) {
            $certificate_request->identity_attachment = null;
            $certificate_request->save();
        }

        return true;
    }
}
