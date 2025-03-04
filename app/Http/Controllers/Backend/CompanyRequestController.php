<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CompanyRequest;
use Illuminate\Http\Request;

class CompanyRequestController extends Controller
{
    public function index()
    {
        if (!auth()->user()->ability(['admin','supervisor'], 'manage_company_requests , show_company_requests')) {
            return redirect('admin/index');
        }

        $company_requests = CompanyRequest::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->where('status', \request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);


        return view('backend.company_requests.index', compact('company_requests'));
    }


    public function show($company_request)
    {
        if (!auth()->user()->ability('admin', 'display_company_requests')) {
            return redirect('admin/index');
        }

        $company_request = CompanyRequest::where('id', $company_request)->first();

        $company_request_status_array = [
            '0' =>  __('panel.company_request_new_request'),
            '1' =>  __('panel.company_request_under_proccess'),
            '2' =>  __('panel.company_request_accepted'),
            '3' =>  __('panel.company_request_rejected'),

        ];

        $key = array_search($company_request->status, array_keys($company_request_status_array));

        foreach ($company_request_status_array as $k => $v) {
            if ($k <= $key) {
                unset($company_request_status_array[$k]);
            }
        }

        return view('backend.company_requests.show', compact('company_request', 'company_request_status_array'));
    }


    public function updateStatus(Request $request, $company_request)
    {
        $company_request = CompanyRequest::where('id', $company_request)->first();

        $company_request->update(['status' => $request->status]);


        if ($company_request) {
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


    public function destroy($company_request)
    {
        if (!auth()->user()->ability('admin', 'delete_countries')) {
            return redirect('admin/index');
        }

        $company_request = CompanyRequest::where('id', $company_request)->first();
        $company_request->delete();

        return redirect()->route('admin.company_requests.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
