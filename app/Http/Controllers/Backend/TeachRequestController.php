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


        $order_status_array = [
            '0' =>  __('panel.order_new_order'),
            '1' =>  __('panel.order_paid'),
            '2' =>  __('panel.order_under_process'),
            '3' =>  __('panel.order_finished'),
            '4' =>  __('panel.order_rejected'),
            '5' =>  __('panel.order_canceled'),
            '6' =>  __('panel.order_refund_requested'),
            '7' =>  __('panel.order_returned_order'),
            '8' =>  __('panel.order_refunded')
        ];

        $key = array_search($order->order_status, array_keys($order_status_array));

        // This will delete order status element from order_status_array if its key is les or equail t order status in the table orders
        foreach ($order_status_array as $k => $v) {
            if ($k <= $key) {
                unset($order_status_array[$k]);
            }
        }

        return view('backend.orders.show', compact('order', 'order_status_array'));
    }
}
