<?php

namespace App\Http\Controllers;

use App\Http\Requests\backend\InstructorRequest;
use App\Models\Instructor;
use Intervention\Image\Facades\Image;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class InstructorController extends Controller
{

    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_instructors , show_instructors')) {
            return redirect('admin/index');
        }

        $instructors = Instructor::with('firstMedia')
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->where('status', \request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'published_on', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);


        return view('backend.instructors.index', compact('instructors'));
    }

    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_instructors')) {
            return redirect('admin/index');
        }


        return view('backend.instructors.create');
    }

    public function store(InstructorRequest $request)
    {

        if (!auth()->user()->ability('admin', 'create_instructors')) {
            return redirect('admin/index');
        }

        $input['name']          =   $request->name;
        $input['specialization']        =   $request->specialization;
        $input['email']            =   $request->email;
        $input['phone']         =   $request->phone;

        $input['status']            =   $request->status;
        $input['created_by']        =   auth()->user()->full_name;
        $published_on = $request->published_on . ' ' . $request->published_on_time;
        $published_on = new DateTimeImmutable($published_on);
        $input['published_on'] = $published_on;

        $instructor = Instructor::create($input);


        if ($request->images && count($request->images) > 0) {
            $i = 1;
            foreach ($request->images as $image) {
                $file_name = $instructor->slug . '_' . time() . $i . '.' . $image->getClientOriginalExtension(); // time() and $id used to avoid repeating image name 
                $file_size = $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('assets/instructors/' . $file_name);


                Image::make($image->getRealPath())->save($path);

                $instructor->photos()->create([
                    'file_name' => $file_name,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                    'file_status' => 'true',
                    'file_sort' => $i,
                ]);

                $i++;
            }
        }

        if ($instructor) {
            return redirect()->route('admin.instructors.index')->with([
                'message' => __('panel.created_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.instructors.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function show($id)
    {
        if (!auth()->user()->ability('admin', 'display_sliders')) {
            return redirect('admin/index');
        }

        return view('backend.instructors.show');
    }


    public function edit($instructor)
    {
        if (!auth()->user()->ability('admin', 'update_instructors')) {
            return redirect('admin/index');
        }

        $instructor =  Slider::where('id', $instructor)->first();
        return view('backend.instructors.edit', compact('mainSlider'));
    }

    public function update(InstructorRequest $request,  $instructor)
    {
        if (!auth()->user()->ability('admin', 'update_instructors')) {
            return redirect('admin/index');
        }

        $instructor = Slider::where('id', $instructor)->first();


        $input['title']          =   $request->title;
        $input['description']        =   $request->description;
        $input['url']            =   $request->url;
        $input['target']         =   $request->target;
        $input['section']        =   1;
        //  $input['start_date']        =   $request->start_date;
        //  $input['expire_date']       =   $request->expire_date;

        $input['showInfo']            =   $request->showInfo;
        $input['status']            =   $request->status;
        $input['updated_by']        =   auth()->user()->full_name;

        $published_on = $request->published_on . ' ' . $request->published_on_time;
        $published_on = new DateTimeImmutable($published_on);
        $input['published_on'] = $published_on;
        $instructor->update($input);

        if ($request->images && count($request->images) > 0) {

            $i = $instructor->photos->count() + 1;

            foreach ($request->images as $image) {

                $file_name = $instructor->slug . '_' . time() . $i . '.' . $image->getClientOriginalExtension();
                $file_size = $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('assets/main_sliders/' . $file_name);

                // Image::make($image->getRealPath())->resize(500,null,function($constraint){
                //     $constraint->aspectRatio();
                // })->save($path,100);

                Image::make($image->getRealPath())->save($path);
                $instructor->photos()->create([
                    'file_name' => $file_name,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                    'file_status' => 'true',
                    'file_sort' => $i,
                ]);

                $i++;
            }
        }

        if ($instructor) {
            return redirect()->route('admin.instructors.index')->with([
                'message' => __('panel.updated_successfully'),
                'alert-type' => 'success'
            ]);
        }
        return redirect()->route('admin.instructors.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }



    public function destroy($instructor)
    {
        if (!auth()->user()->ability('admin', 'delete_instructors')) {
            return redirect('admin/index');
        }

        $instructor = Slider::where('id', $instructor)->first();


        if ($instructor->photos->count() > 0) {
            foreach ($instructor->photos as $photo) {
                if (File::exists('assets/main_sliders/' . $photo->file_name)) {
                    unlink('assets/main_sliders/' . $photo->file_name);
                }
                $photo->delete();
            }
        }

        $instructor->delete();

        if ($instructor) {
            return redirect()->route('admin.instructors.index')->with([
                'message' => __('panel.deleted_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.instructors.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function remove_image(Request $request)
    {

        if (!auth()->user()->ability('admin', 'delete_instructors')) {
            return redirect('admin/index');
        }


        $slider = Slider::findOrFail($request->slider_id);

        $image = $slider->photos()->where('id', $request->image_id)->first();

        if (File::exists('assets/main_sliders/' . $image->file_name)) {
            unlink('assets/main_sliders/' . $image->file_name);
        }
        $image->delete();

        return true;
    }
}
