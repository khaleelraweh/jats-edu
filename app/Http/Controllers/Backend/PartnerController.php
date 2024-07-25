<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_partners , show_partners')) {
            return redirect('admin/index');
        }

        $partners = Partner::query()

            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->where('status', \request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'created_at', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        return view('backend.partners.index', compact('partners'));
    }

    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_partners')) {
            return redirect('admin/index');
        }
        return view('backend.partners.create');
    }
}
