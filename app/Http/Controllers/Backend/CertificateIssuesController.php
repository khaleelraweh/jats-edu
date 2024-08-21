<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CertificateIssue;
use Illuminate\Http\Request;

class CertificateIssuesController extends Controller
{
    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_certificate_issues , show_certificate_issues')) {
            return redirect('admin/index');
        }

        $certificates = CertificateIssue::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->where('status', \request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'created_at', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        return view('backend.certificate_issues.index', compact('certificates'));
    }
}
