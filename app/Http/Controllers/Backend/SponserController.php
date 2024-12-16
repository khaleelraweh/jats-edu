<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PageRequest;
use App\Http\Requests\Backend\SponserRequest;
use App\Models\Sponser;
use DateTimeImmutable;
use Illuminate\Http\Request;
use illuminate\support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;




class SponserController extends Controller
{

    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_sponsers , show_sponsers')) {
            return redirect('admin/index');
        }

        $sponsers = Sponser::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->where('status', \request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'published_on', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);



        return view('backend.sponsers.index', compact('sponsers'));
    }

    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_sponsers')) {
            return redirect('admin/index');
        }

        return view('backend.sponsers.create');
    }

    public function store(SponserRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_sponsers')) {
            return redirect('admin/index');
        }

        $input['name']                  = $request->name;
        $input['address']               = $request->address;
        $input['phone']                 = $request->phone;
        $input['email']                 = $request->email;
        $input['pox']                   = $request->pox;
        $input['website']               = $request->website;
        $input['coordinator_name']      = $request->coordinator_name;
        $input['coordinator_phone']     = $request->coordinator_phone;
        $input['coordinator_email']     = $request->coordinator_email;

        $input['status']                = $request->status;
        $input['created_by']            = auth()->user()->full_name;

        $published_on                   = $request->published_on . ' ' . $request->published_on_time;
        $published_on                   = new DateTimeImmutable($published_on);
        $input['published_on']          = $published_on;

        if ($image  =  $request->file('logo')) {

            $file_name                  = Str::slug($request->name) . '_' . time() .  "." . $image->getClientOriginalExtension();
            $path                       = public_path('assets/sponsers/' . $file_name);

            Image::make($image->getRealPath())->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);

            $input['logo'] = $file_name;
        }

        $sponser = Sponser::create($input);


        if ($sponser) {
            return redirect()->route('admin.sponsers.index')->with([
                'message' => __('panel.created_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.sponsers.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }



    public function show($id)
    {
        if (!auth()->user()->ability('admin', 'display_sponsers')) {
            return redirect('admin/index');
        }
        return view('backend.sponsers.show');
    }

    public function edit($sponser)
    {
        if (!auth()->user()->ability('admin', 'update_sponsers')) {
            return redirect('admin/index');
        }


        $sponser = Sponser::where('id', $sponser)->first();

        return view('backend.sponsers.edit', compact('sponser'));
    }

    public function update(SponserRequest $request, $sponser)
    {

        $sponser = Sponser::where('id', $sponser)->first();

        $input['name']                  = $request->name;
        $input['address']               = $request->address;
        $input['phone']                 = $request->phone;
        $input['email']                 = $request->email;
        $input['pox']                   = $request->pox;
        $input['website']               = $request->website;
        $input['coordinator_name']      = $request->coordinator_name;
        $input['coordinator_phone']     = $request->coordinator_phone;
        $input['coordinator_email']     = $request->coordinator_email;

        $input['status']                =   $request->status;
        $input['created_by']            = auth()->user()->full_name;

        $published_on                   = $request->published_on . ' ' . $request->published_on_time;
        $published_on                   = new DateTimeImmutable($published_on);
        $input['published_on']          = $published_on;


        if ($image = $request->file('logo')) {
            if ($sponser->logo != null && File::exists('assets/sponsers/' . $sponser->logo)) {
                unlink('assets/sponsers/' . $sponser->logo);
            }

            $file_name = Str::slug($request->name) . '_' . time() .  "." . $image->getClientOriginalExtension();

            $path = public_path('assets/sponsers/' . $file_name);
            Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);

            $input['logo'] = $file_name;
        }

        $sponser->update($input);

        if ($sponser) {
            return redirect()->route('admin.sponsers.index')->with([
                'message' => __('panel.updated_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.sponsers.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }


    public function destroy($sponser)
    {
        if (!auth()->user()->ability('admin', 'delete_sponsers')) {
            return redirect('admin/index');
        }

        $sponser = Sponser::where('id', $sponser)->first()->delete();

        if ($sponser) {
            return redirect()->route('admin.sponsers.index')->with([
                'message' => __('panel.deleted_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.sponsers.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }
}
