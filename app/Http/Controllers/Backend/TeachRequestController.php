<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\RequestToTeach;
use App\Models\TeachRequest;
use Illuminate\Http\Request;

class TeachRequestController extends Controller
{
    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_teach_requests , show_teach_requests')) {
            return redirect('admin/index');
        }

        $teach_requests = TeachRequest::query()

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
}
