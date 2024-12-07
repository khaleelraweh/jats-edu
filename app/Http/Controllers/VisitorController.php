<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\PageVisit;

class VisitorController extends Controller
{
    public function index()
    {
        $visitors = Visitor::all();
        $pageVisits = PageVisit::select('page', PageVisit::raw('count(*) as visits'))
            ->groupBy('page')
            ->orderByDesc('visits')
            ->get();

        return view('admin.visitors', compact('visitors', 'pageVisits'));
    }
}
