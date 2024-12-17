<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CertificateRequest;
use App\Http\Requests\Backend\PageRequest;
use App\Models\Certifications;
use App\Models\Course;
use App\Models\Page;
use App\Models\User;
use App\Models\WebMenu;
use Carbon\Carbon;
use DateTimeImmutable;
use Illuminate\Http\Request;

use illuminate\support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class CertificateController extends Controller
{

    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_certificates , show_certificates')) {
            return redirect('admin/index');
        }

        $certificates = Certifications::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->where('status', \request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'published_on', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        return view('backend.certificates.index', compact('certificates'));
    }

    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_certificates')) {
            return redirect('admin/index');
        }

        $courses = Course::query()->active()->get(['id', 'title']);

        return view('backend.certificates.create', compact('courses'));
    }

    public function store(CertificateRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_certificates')) {
            return redirect('admin/index');
        }


        $input['user_id']                   = $request->user_id;
        $input['full_name']                 = $request->full_name;
        $input['course_id']                 = $request->course_id;

        $date_of_issue                      = str_replace(['ص', 'م'], ['AM', 'PM'], $request->date_of_issue);
        $DateOfIssue                        = Carbon::createFromFormat('Y/m/d h:i A', $date_of_issue)->format('Y-m-d H:i:s');
        $input['date_of_issue']             = $DateOfIssue;

        $input['cert_code']                 = $request->cert_code;

        $published_on                       = str_replace(['ص', 'م'], ['AM', 'PM'], $request->published_on);
        $publishedOn                        = Carbon::createFromFormat('Y/m/d h:i A', $published_on)->format('Y-m-d H:i:s');
        $input['published_on']              = $publishedOn;


        $input['status']                    = $request->status;
        $input['created_by']                = auth()->user()->full_name;


        if ($image =  $request->file('cert_file')) {

            $file_name                  = Str::slug($request->cert_code) . '_' . time() .  "." . $image->getClientOriginalExtension();
            $path                       = public_path('assets/certifications/' . $file_name);

            Image::make($image->getRealPath())->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);

            $input['cert_file'] = $file_name;
        }


        $certificate = Certifications::create($input);


        if ($certificate) {
            return redirect()->route('admin.certificates.index')->with([
                'message' => __('panel.created_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.certificates.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }



    public function show($id)
    {
        if (!auth()->user()->ability('admin', 'display_certificates')) {
            return redirect('admin/index');
        }
        return view('backend.certificates.show');
    }

    public function edit($certificate)
    {
        if (!auth()->user()->ability('admin', 'update_certificates')) {
            return redirect('admin/index');
        }

        $certificate = Certifications::where('id', $certificate)->first();
        $courses = Course::query()->active()->get(['id', 'title']);



        return view('backend.certificates.edit', compact('certificate', 'courses'));
    }

    public function update(PageRequest $request, $page)
    {

        $page = Page::where('id', $page)->first();

        $input['title'] = $request->title;
        $input['content'] = $request->content;

        $input['status']            =   $request->status;
        $input['created_by'] = auth()->user()->full_name;
        $published_on = $request->published_on . ' ' . $request->published_on_time;
        $published_on = new DateTimeImmutable($published_on);
        $input['published_on'] = $published_on;

        $page->update($input);

        if ($page) {
            return redirect()->route('admin.certificates.index')->with([
                'message' => __('panel.updated_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.certificates.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }


    public function destroy($page)
    {
        if (!auth()->user()->ability('admin', 'delete_certificates')) {
            return redirect('admin/index');
        }

        $page = Page::where('id', $page)->first()->delete();

        if ($page) {
            return redirect()->route('admin.certificates.index')->with([
                'message' => __('panel.deleted_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.certificates.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }
}
