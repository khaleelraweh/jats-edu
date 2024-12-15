<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\InstPageVisit;
use Illuminate\Http\Request;

class InstPageVisitController extends Controller
{


    // public function index()
    // {
    //     $inst_page_visits = InstPageVisit::select('page', InstPageVisit::raw('count(*) as visits'))
    //         ->groupBy('page')
    //         ->orderByDesc('visits')
    //         ->get();
    // }

    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_inst_page_visits , show_inst_page_visits')) {
            return redirect('admin/index');
        }

        $inst_page_visits = InstPageVisit::query()
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

    // public function index()
    // {
    //     // Ensure the user has the required ability
    //     if (!auth()->user()->ability('admin', 'manage_inst_page_visits , show_inst_page_visits')) {
    //         return redirect('admin/index');
    //     }

    //     // Query with grouping, filtering, and ordering
    //     $inst_page_visits = InstPageVisit::select('page', InstPageVisit::raw('count(*) as visits'))
    //         ->when(\request()->keyword != null, function ($query) {
    //             // Search keyword in the 'page' column
    //             $query->where('page', 'like', '%' . \request()->keyword . '%');
    //         })
    //         ->when(\request()->status != null, function ($query) {
    //             // Filter by status if provided
    //             $query->where('status', \request()->status);
    //         })
    //         ->groupBy('page') // Group by page
    //         ->orderBy(\request()->sort_by ?? 'visits', \request()->order_by ?? 'desc') // Sort by specified field or visits
    //         ->paginate(\request()->limit_by ?? 10); // Paginate the results

    //     // Return the view with the queried data
    //     return view('backend.inst_page_visits.index', compact('inst_page_visits'));
    // }
}
