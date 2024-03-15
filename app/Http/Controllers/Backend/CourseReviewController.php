<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\CourseReviewRequest;
use App\Models\CourseReview;
use Illuminate\Http\Request;

class CourseReviewController extends Controller
{
    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_course_reviews , show_course_reviews')) {
            return redirect('admin/index');
        }

        $reviews = CourseReview::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->where('status', \request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        return view('backend.course_reviews.index', compact('reviews'));
    }

    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_course_reviews')) {
            return redirect('admin/index');
        }
        //
    }

    public function store(CourseReviewRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_course_reviews')) {
            return redirect('admin/index');
        }


        return redirect()->route('admin.course_reviews.index')->with([
            'message' => 'created successfully',
            'alert-type' => 'success'
        ]);
    }

    public function show(CourseReview $courseReview)
    {
        if (!auth()->user()->ability('admin', 'display_course_reviews')) {
            return redirect('admin/index');
        }
        return view('backend.course_reviews.show', compact('courseReview'));
    }

    public function edit(CourseReview $courseReview)
    {
        if (!auth()->user()->ability('admin', 'update_course_reviews')) {
            return redirect('admin/index');
        }

        return view('backend.course_reviews.edit', compact('courseReview'));
    }

    public function update(CourseReviewRequest $request, CourseReview $courseReview)
    {
        if (!auth()->user()->ability('admin', 'update_course_reviews')) {
            return redirect('admin/index');
        }

        $courseReview->update($request->validated());


        return redirect()->route('admin.course_reviews.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(CourseReview $courseReview)
    {
        if (!auth()->user()->ability('admin', 'delete_course_reviews')) {
            return redirect('admin/index');
        }

        $courseReview->delete();

        return redirect()->route('admin.course_reviews.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
