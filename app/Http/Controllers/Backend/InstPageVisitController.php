<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\InstPageVisit;
use Illuminate\Http\Request;

class InstPageVisitController extends Controller
{

    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_inst_page_visits , show_inst_page_visits')) {
            return redirect('admin/index');
        }

        // $inst_page_visits = InstPageVisit::query()
        $inst_page_visits = InstPageVisit::with('courses', 'posts', 'users')
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->where('status', \request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'created_at', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);


        return view('backend.inst_page_visits.index', compact('inst_page_visits'));
    }
}
