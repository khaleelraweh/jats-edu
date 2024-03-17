<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\LecturerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Role;
use App\Models\Specialization;
use App\Models\User;
use Intervention\Image\Facades\Image;
use illuminate\support\Str;

class LecturersController extends Controller
{
    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_lecturers , show_lecturers')) {
            return redirect('admin/index');
        }

        //get users where has roles 
        $lecturers = User::with('specializations')->whereHas('roles', function ($query) {
            //this roles its name is customer
            $query->where('name', 'lecturer');
        })
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->where('status', \request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        return view('backend.lecturers.index', compact('lecturers'));
    }

    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_lecturers')) {
            return redirect('admin/index');
        }
        $specializations = Specialization::get(['id', 'name']);
        return view('backend.lecturers.create', compact('specializations'));
    }

    public function store(LecturerRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_lecturers')) {
            return redirect('admin/index');
        }

        $input['first_name'] = $request->first_name;
        $input['last_name'] = $request->last_name;
        $input['username'] = $request->username;
        $input['email'] = $request->email;
        $input['email_verified_at'] = now();
        $input['mobile'] = $request->mobile;
        $input['password'] = bcrypt($request->password);

        $input['description'] = $request->description;
        $input['motavation'] = $request->motavation;
        $input['facebook'] = $request->facebook;
        $input['twitter'] = $request->twitter;
        $input['instagram'] = $request->instagram;
        $input['linkedin'] = $request->linkedin;

        $input['status'] = $request->status;
        $input['created_by'] = auth()->user()->full_name;

        if ($image = $request->file('user_image')) {
            $file_name = Str::slug($request->username) . '_' . time() .  "." . $image->getClientOriginalExtension();
            $path = public_path('assets/lecturers/' . $file_name);
            Image::make($image->getRealPath())->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);

            $input['user_image'] = $file_name;
        }

        $lecturer = User::create($input);

        //Attach the new lecturer to role lecturer
        $lecturer->attachRole(Role::whereName('lecturer')->first()->id);

        //add specifications
        if (isset($request->specializations) && count($request->specializations) > 0) {
            $lecturer->specializations()->sync($request->specializations);
        }

        if ($lecturer) {
            return redirect()->route('admin.lecturers.index')->with([
                'message' => __('panel.created_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.lecturers.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function show(User $lecturer)
    {
        if (!auth()->user()->ability('admin', 'display_lecturers')) {
            return redirect('admin/index');
        }
        return view('backend.lecturers.show', compact('lecturer'));
    }

    public function edit(User $lecturer)
    {
        if (!auth()->user()->ability('admin', 'update_lecturers')) {
            return redirect('admin/index');
        }

        $specializations = Specialization::get(['id', 'name']);

        $lecturerSpecializations = $lecturer->specializations->pluck(['id'])->toArray();

        return view('backend.lecturers.edit', compact('lecturer', 'specializations', 'lecturerSpecializations'));
    }

    public function update(LecturerRequest $request, User $lecturer)
    {
        if (!auth()->user()->ability('admin', 'update_lecturers')) {
            return redirect('admin/index');
        }

        $input['first_name'] = $request->first_name;
        $input['last_name'] = $request->last_name;
        $input['username'] = $request->username;
        $input['email'] = $request->email;
        $input['mobile'] = $request->mobile;
        if (trim($request->password) != '') {
            $input['password'] = bcrypt($request->password);
        }

        $input['description'] = $request->description;
        $input['motavation'] = $request->motavation;
        $input['facebook'] = $request->facebook;
        $input['twitter'] = $request->twitter;
        $input['instagram'] = $request->instagram;
        $input['linkedin'] = $request->linkedin;


        $input['status'] = $request->status;
        $input['updated_by'] = auth()->user()->full_name;

        if ($image = $request->file('user_image')) {

            if ($lecturer->user_image != null && File::exists('assets/lecturers/' . $lecturer->user_image)) {
                unlink('assets/lecturers/' . $lecturer->user_image);
            }

            $file_name = Str::slug($request->username) . '_' . time() .  "." . $image->getClientOriginalExtension();

            $path = public_path('assets/lecturers/' . $file_name);
            Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);

            $input['user_image'] = $file_name;
        }

        $lecturer->update($input);

        //update specifications
        if (isset($request->specializations) && count($request->specializations) > 0) {
            $lecturer->specializations()->sync($request->specializations);
        }

        if ($lecturer) {
            return redirect()->route('admin.lecturers.index')->with([
                'message' => __('panel.updated_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.lecturers.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function destroy(User $lecturer)
    {
        if (!auth()->user()->ability('admin', 'delete_lecturers')) {
            return redirect('admin/index');
        }

        // first: delete image from users path 
        if (File::exists('assets/lecturers/' . $lecturer->user_image)) {
            unlink('assets/lecturers/' . $lecturer->user_image);
        }

        $lecturer->deleted_by = auth()->user()->full_name;
        $lecturer->save();

        //second : delete customer from users table
        $lecturer->delete();

        if ($lecturer) {
            return redirect()->route('admin.lecturers.index')->with([
                'message' => __('panel.deleted_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.lecturers.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function remove_image(Request $request)
    {

        if (!auth()->user()->ability('admin', 'delete_lecturers')) {
            return redirect('admin/index');
        }

        $lecturer = User::findOrFail($request->lecturer_id);
        if (File::exists('assets/lecturers/' . $lecturer->user_image)) {
            unlink('assets/lecturers/' . $lecturer->user_image);
            $lecturer->user_image = null;
            $lecturer->save();
        }
        if ($lecturer->user_image != null) {
            $lecturer->user_image = null;
            $lecturer->save();
        }

        return true;
    }

    public function get_lecturers()
    {
        //get user where has relation with roles and this role its name is customer
        $lecturers = User::whereHas('roles', function ($query) {
            $query->where('name', 'lecturer');
        })
            ->when(\request()->input('query') != '', function ($query) {
                $query->search(\request()->input('query'));
            })
            ->get(['id', 'first_name', 'last_name', 'email'])->toArray();

        return response()->json($lecturers);
    }
}
