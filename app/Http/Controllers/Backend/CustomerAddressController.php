<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CustomerAddressRequest;
use App\Models\Country;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class CustomerAddressController extends Controller
{
    public function index()
    {
        if (!auth()->user()->ability(['admin','supervisor'], 'manage_customer_addresses , show_customer_addresses')) {
            return redirect('admin/index');
        }

        $customer_addresses = UserAddress::with('user')
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->whereDefaultAddress(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        return view('backend.customer_addresses.index', compact('customer_addresses'));
    }

    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_customer_addresses')) {
            return redirect('admin/index');
        }

        // get countries where its status is true means active get there id and name
        $countries = Country::whereStatus(true)->get(['id', 'name']);

        return view('backend.customer_addresses.create', compact('countries'));
    }

    public function store(CustomerAddressRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_customer_addresses')) {
            return redirect('admin/index');
        }


        $customer_address = UserAddress::create($request->validated());


        if ($customer_address) {
            return redirect()->route('admin.customer_addresses.index')->with([
                'message' => __('panel.created_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.customer_addresses.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function show(UserAddress $customer_address)
    {
        if (!auth()->user()->ability('admin', 'display_customer_addresses')) {
            return redirect('admin/index');
        }
        return view('backend.customer_addresses.show', compact('customer_address'));
    }

    public function edit(UserAddress $customer_address)
    {
        if (!auth()->user()->ability('admin', 'update_customer_addresses')) {
            return redirect('admin/index');
        }


        // get countries where its status is true means active get there id and name
        $countries = Country::whereStatus(true)->get(['id', 'name']);
        return view('backend.customer_addresses.edit', compact('customer_address', 'countries'));
    }

    public function update(CustomerAddressRequest $request, UserAddress $customer_address)
    {
        if (!auth()->user()->ability('admin', 'update_customer_addresses')) {
            return redirect('admin/index');
        }

        $customer_address->update($request->validated());


        if ($customer_address) {
            return redirect()->route('admin.customer_addresses.index')->with([
                'message' => __('panel.updated_successfully'),
                'alert-type' => 'success'
            ]);
        }
        return redirect()->route('admin.customer_addresses.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function destroy(UserAddress $customer_address)
    {
        if (!auth()->user()->ability('admin', 'delete_customer_addresses')) {
            return redirect('admin/index');
        }

        $customer_address->delete();


        if ($customer_address) {
            return redirect()->route('admin.customer_addresses.index')->with([
                'message' => __('panel.deleted_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.customer_addresses.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }
}
