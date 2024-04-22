<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_events , show_events')) {
            return redirect('admin/index');
        }

        $events = Event::with('courseCategory', 'tags')
            ->ActiveCourseCategory()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->where('status', \request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'created_at', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        return view('backend.events.index', compact('events'));
    }
}
