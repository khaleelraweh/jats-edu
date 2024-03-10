<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CourseRequest;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use DateTimeImmutable;

class CourseController extends Controller
{

    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_courses , show_courses')) {
            return redirect('admin/index');
        }

        $courses = Course::with('courseCategory', 'tags', 'firstMedia')
            ->ActiveCourseCategory()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->where('status', \request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'created_at', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        return view('backend.courses.index', compact('courses'));
    }

    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_courses')) {
            return redirect('admin/index');
        }

        $course_categories = CourseCategory::whereStatus(1)->get(['id', 'category_name']);

        $tags = Tag::whereStatus(1)->get(['id', 'name']);

        return view('backend.courses.create', compact('course_categories', 'tags'));
    }

    public function store(CourseRequest $request)
    {

        if (!auth()->user()->ability('admin', 'create_courses')) {
            return redirect('admin/index');
        }

        // dd($request);

        $input['title']                  =   $request->title;
        $input['subtitle']                  =   $request->subtitle;
        $input['description']           =   $request->description;
        // $input['quantity']              =   $request->quantity;

        $input['course_level']                      =   $request->course_level;
        $input['course_lang']                       =   $request->course_lang;
        $input['course_evaluation']                 =   $request->course_evaluation;
        $input['course_lessons_number']             =   $request->course_lessons_number;
        $input['course_lessons_time']               =   $request->course_lessons_time;


        $input['price']                 =   $request->price;
        $input['offer_price']           =   $request->offer_price;
        $input['offer_ends']            =   $request->offer_ends;

        $input['course_category_id']   =   $request->course_category_id;
        $input['featured']              =   $request->featured;

        $input['status']                =   $request->status;
        $input['created_by']            =   auth()->user()->full_name;

        $published_on = $request->published_on . ' ' . $request->published_on_time;
        $published_on = new DateTimeImmutable($published_on);
        $input['published_on'] = $published_on;

        $course = Course::create($input);

        $course->tags()->attach($request->tags);

        // course topics start 
        $topics_list = [];
        for ($i = 0; $i < count($request->course_topic); $i++) {
            $topics_list[$i]['course_topic'] = $request->course_topic[$i];
        }
        $topics = $course->topics()->createMany($topics_list);
        // course topics start 

        // course requirement start 
        $requirements_list = [];
        for ($i = 0; $i < count($request->course_requirement); $i++) {
            $requirements_list[$i]['course_requirement'] = $request->course_requirement[$i];
        }
        // dd($requirements_list);
        $requirements = $course->requirements()->createMany($requirements_list);
        // course topics start 



        if ($request->images && count($request->images) > 0) {

            $i = 1;

            foreach ($request->images as $image) {

                $file_name = $course->slug . '_' . time() . $i . '.' . $image->getClientOriginalExtension();
                $file_size = $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('assets/courses/' . $file_name);

                Image::make($image->getRealPath())->save($path);

                $course->photos()->create([
                    'file_name' => $file_name,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                    'file_status' => 'true',
                    'file_sort' => $i,
                ]);

                $i++;
            }
        }

        if ($course) {
            return redirect()->route('admin.courses.index')->with([
                'message' => __('panel.created_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.courses.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function show($id)
    {
        if (!auth()->user()->ability('admin', 'display_courses')) {
            return redirect('admin/index');
        }

        return view('backend.courses.show');
    }

    public function edit($course)
    {

        if (!auth()->user()->ability('admin', 'update_courses')) {
            return redirect('admin/index');
        }


        $course = Course::where('id', $course)->first();

        $course_categories = CourseCategory::whereStatus(1)->get(['id', 'category_name']);

        $tags = Tag::whereStatus(1)->get(['id', 'name']);

        return view('backend.courses.edit', compact('course_categories', 'tags', 'course'));
    }

    public function update(CourseRequest $request,  $course)
    {
        if (!auth()->user()->ability('admin', 'update_courses')) {
            return redirect('admin/index');
        }


        $course = Course::where('id', $course)->first();


        // get Input from create.blade.php form request using CourseRequest to validate fields
        $input['title']                   =   $request->title;
        $input['subtitle']                  =   $request->subtitle;
        $input['description']                   =   $request->description;
        // $input['quantity']                   =   $request->quantity;

        $input['course_level']                      =   $request->course_level;
        $input['course_lang']                       =   $request->course_lang;
        $input['course_evaluation']                 =   $request->course_evaluation;
        $input['course_lessons_number']             =   $request->course_lessons_number;
        $input['course_lessons_time']               =   $request->course_lessons_time;

        $input['price']                 =   $request->price;
        $input['offer_price']           =   $request->offer_price;
        $input['offer_ends']            =   $request->offer_ends;


        $input['course_category_id']   =   $request->course_category_id;
        $input['featured']              =   $request->featured;

        $input['status']            =   $request->status;
        $input['updated_by']        =   auth()->user()->full_name;

        $published_on = $request->published_on . ' ' . $request->published_on_time;
        $published_on = new DateTimeImmutable($published_on);
        $input['published_on'] = $published_on;

        $course->update($input);

        $course->tags()->sync($request->tags);

        // course topics start 
        $course->topics()->delete();

        $topics_list = [];
        for ($i = 0; $i < count($request->course_topic); $i++) {
            $topics_list[$i]['course_topic'] = $request->course_topic[$i];
        }
        $topics = $course->topics()->createMany($topics_list);
        // course topics start 


        if ($request->images && count($request->images) > 0) {

            $i = $course->photos->count() + 1;

            foreach ($request->images as $image) {

                $file_name = $course->slug . '_' . time() . $i . '.' . $image->getClientOriginalExtension();
                $file_size = $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('assets/courses/' . $file_name);

                Image::make($image->getRealPath())->save($path);

                $course->photos()->create([
                    'file_name' => $file_name,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                    'file_status' => 'true',
                    'file_sort' => $i,
                ]);

                $i++;
            }
        }

        if ($course) {
            return redirect()->route('admin.courses.index')->with([
                'message' => __('panel.updated_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.courses.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function destroy($course)
    {
        if (!auth()->user()->ability('admin', 'delete_courses')) {
            return redirect('admin/index');
        }

        $course = Course::where('id', $course)->first();


        if ($course->photos->count() > 0) {
            foreach ($course->photos as $photo) {
                if (File::exists('assets/courses/' . $photo->file_name)) {
                    unlink('assets/courses/' . $photo->file_name);
                }
                $photo->delete();
            }
        }

        $course->delete();

        if ($course) {
            return redirect()->route('admin.courses.index')->with([
                'message' => __('panel.deleted_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.courses.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function remove_image(Request $request)
    {

        if (!auth()->user()->ability('admin', 'delete_courses')) {
            return redirect('admin/index');
        }

        $course = Course::findOrFail($request->course_id);

        $image = $course->photos()->where('id', $request->image_id)->first();

        if (File::exists('assets/courses/' . $image->file_name)) {
            unlink('assets/courses/' . $image->file_name);
        }
        $image->delete();

        return true;
    }
}
