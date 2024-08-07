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
}
