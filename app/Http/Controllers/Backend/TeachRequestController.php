<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\RequestToTeach;
use App\Models\Role;
use App\Models\TeachRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

class TeachRequestController extends Controller
{

    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_teach_requests , show_teach_requests')) {
            return redirect('admin/index');
        }

        $teach_requests = TeachRequest::query()

            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->where('status', \request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'created_at', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        return view('backend.teach_requests.index', compact('teach_requests'));
    }

    public function show($teach_request)
    {
        if (!auth()->user()->ability('admin', 'display_teach_requests')) {
            return redirect('admin/index');
        }

        $teach_request = TeachRequest::where('id', $teach_request)->first();

        $teach_request_status_array = [
            '0' =>  __('panel.teach_request_new_request'),
            '1' =>  __('panel.teach_request_under_proccess'),
            '2' =>  __('panel.teach_request_accepted'),
            '3' =>  __('panel.teach_request_rejected'),

        ];



        $key = array_search($teach_request->teach_request_status, array_keys($teach_request_status_array));

        foreach ($teach_request_status_array as $k => $v) {
            if ($k <= $key) {
                unset($teach_request_status_array[$k]);
            }
        }

        return view('backend.teach_requests.show', compact('teach_request', 'teach_request_status_array'));
    }

    public function updateStatus(Request $request, $teach_request)
    {
        $teach_request = TeachRequest::where('id', $teach_request)->first();



        $teach_request->update(['teach_request_status' => $request->teach_request_status]);


        // $instructorRoleId = Role::whereName('instructor')->first()->id;
        // $user = Auth()->user();

        // Check if the user does not already have the instructor role
        // if (!$user->hasRole('instructor')) {
        //     $user->attachRole($instructorRoleId);
        // }
        // return view('frontend.instructor.dashboard');

        // return view('frontend.customer.instructor-greating');
        // return view('frontend.customer.instructor-request');



        if ($teach_request) {
            if ($request->teach_request_status == 2) {

                $instructorRoleId = Role::whereName('instructor')->first()->id;
                $user = $teach_request->user;

                // Check if the user does not already have the instructor role
                if (!$user->hasRole('instructor')) {
                    $user->attachRole($instructorRoleId);
                }
            } else if ($request->teach_request_status == 3) {
                //we should remove role from the user 
            }
        }




        // foreach ($course->instructors as $instructor) {
        //     $instructor->notify(new CourseNotification($course));
        // }


        if ($teach_request) {
            return back()->with([
                'message' => __('panel.updated_successfully'),
                'alert-type' => 'success'
            ]);
        }


        return back()->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function view_file($file_id)
    {

        return response()->file(public_path('assets/teach_requests/' . $file_id . '.pdf'), ['content-type' => 'application/pdf']);
    }
}
