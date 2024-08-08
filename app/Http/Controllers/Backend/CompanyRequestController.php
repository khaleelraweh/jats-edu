<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CompanyRequest;
use Illuminate\Http\Request;

class CompanyRequestController extends Controller
{
    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_company_requests , show_company_requests')) {
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
            '0' =>  __('panel.teach_request_new_request'),
            '1' =>  __('panel.teach_request_under_proccess'),
            '2' =>  __('panel.teach_request_accepted'),
            '3' =>  __('panel.teach_request_rejected'),

        ];

        $key = array_search($company_request->teach_request_status, array_keys($company_request_status_array));

        foreach ($company_request_status_array as $k => $v) {
            if ($k <= $key) {
                unset($company_request_status_array[$k]);
            }
        }

        return view('backend.teach_requests.show', compact('teach_request', 'teach_request_status_array'));
    }
}
