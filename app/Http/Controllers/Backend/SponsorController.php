<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PageRequest;
use App\Http\Requests\Backend\SponsorRequest;
use App\Models\Sponsor;
use DateTimeImmutable;
use Illuminate\Http\Request;
use illuminate\support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class SponsorController extends Controller
{

    public function index()
    {
        if (!auth()->user()->ability(['admin','supervisor'], 'manage_sponsors , show_sponsors')) {
            return redirect('admin/index');
        }

        $sponsors = Sponsor::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->where('status', \request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'published_on', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);



        return view('backend.sponsors.index', compact('sponsors'));
    }

    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_sponsors')) {
            return redirect('admin/index');
        }

        return view('backend.sponsors.create');
    }

    public function store(SponsorRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_sponsors')) {
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

            $file_name                  = Str::slug($request->name['en']) . '_' . time() .  "." . $image->getClientOriginalExtension();
            $path                       = public_path('assets/sponsors/' . $file_name);

            Image::make($image->getRealPath())->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);

            $input['logo'] = $file_name;
        }

        $sponsor = Sponsor::create($input);


        if ($sponsor) {
            return redirect()->route('admin.sponsors.index')->with([
                'message' => __('panel.created_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.sponsors.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }



    public function show($id)
    {
        if (!auth()->user()->ability('admin', 'display_sponsors')) {
            return redirect('admin/index');
        }
        return view('backend.sponsors.show');
    }

    public function edit($sponsor)
    {
        if (!auth()->user()->ability('admin', 'update_sponsors')) {
            return redirect('admin/index');
        }


        $sponsor = Sponsor::where('id', $sponsor)->first();

        return view('backend.sponsors.edit', compact('sponsor'));
    }

    public function update(SponsorRequest $request, $sponsor)
    {

        $sponsor = Sponsor::where('id', $sponsor)->first();

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
            if ($sponsor->logo != null && File::exists('assets/sponsors/' . $sponsor->logo)) {
                unlink('assets/sponsors/' . $sponsor->logo);
            }

            $file_name = Str::slug($request->name['en']) . '_' . time() .  "." . $image->getClientOriginalExtension();

            $path = public_path('assets/sponsors/' . $file_name);
            Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);

            $input['logo'] = $file_name;
        }

        $sponsor->update($input);

        if ($sponsor) {
            return redirect()->route('admin.sponsors.index')->with([
                'message' => __('panel.updated_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.sponsors.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }


    public function destroy($sponsor)
    {
        if (!auth()->user()->ability('admin', 'delete_sponsors')) {
            return redirect('admin/index');
        }

        $sponsor = Sponsor::where('id', $sponsor)->first();


        if (!empty($sponsor->logo) && File::exists('assets/sponsors/' . $sponsor->logo)) {

            unlink('assets/sponsors/' . $sponsor->logo);
        }

        $sponsor->deleted_by = auth()->user()->full_name;
        $sponsor->save();

        $sponsor->delete();

        if ($sponsor) {
            return redirect()->route('admin.sponsors.index')->with([
                'message' => __('panel.deleted_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.sponsors.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function remove_image(Request $request)
    {

        if (!auth()->user()->ability('admin', 'delete_sponsors')) {
            return redirect('admin/index');
        }

        $sponsor = Sponsor::findOrFail($request->sponsor_id);
        if (File::exists('assets/sponsor/' . $sponsor->logo)) {
            unlink('assets/sponsor/' . $sponsor->logo);
            $sponsor->logo = null;
            $sponsor->save();
        }
        if ($sponsor->logo != null) {
            $sponsor->logo = null;
            $sponsor->save();
        }

        return true;
    }
}
