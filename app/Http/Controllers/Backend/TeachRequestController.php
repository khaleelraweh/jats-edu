<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\RequestToTeach;
use Illuminate\Http\Request;

class TeachRequestController extends Controller
{
    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_teach_requests , show_teach_requests')) {
            return redirect('admin/index');
        }

        $teach_requests = RequestToTeach::query()

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

    public function show(RequestToTeach $requestToTeach)
    {
        if (!auth()->user()->ability('admin', 'display_teach_requests')) {
            return redirect('admin/index');
        }

        $teach_request_status_array = [
            '0' =>  __('panel.teach_request_new_request'),
            '1' =>  __('panel.teach_request_under_proccess'),
            '2' =>  __('panel.teach_request_accepted'),
            '3' =>  __('panel.teach_request_rejected'),

        ];

        $key = array_search($requestToTeach->request_status, array_keys($teach_request_status_array));

        // This will delete order status element from order_status_array if its key is les or equail t request status in the table request_to_teach
        foreach ($teach_request_status_array as $k => $v) {
            if ($k <= $key) {
                unset($teach_request_status_array[$k]);
            }
        }

        return view('backend.orders.show', compact('requestToTeach', 'teach_request_status_array'));
    }
}
