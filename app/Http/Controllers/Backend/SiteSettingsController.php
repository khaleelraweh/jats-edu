<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use illuminate\support\Str;
use Intervention\Image\Facades\Image;

class SiteSettingsController extends Controller
{

    // =============== start info site ===============//
    public function info_index()
    {
        // $site_infos = SiteSetting::where('section',1)->get();
        // return view('backend.site_settings.info_index' , compact('site_infos'));
        return view('backend.site_infos.index');
    }

    public function info_update(Request $request, $id)
    {

        $data = $request->except('_token', 'submit');

        foreach ($data as $key => $value) {
            $site = SiteSetting::where('name', $key)
                ->where('section', $id)
                ->get()
                ->first()
                ->update([
                    'value' => $value
                ]);
        }

        $site_image = SiteSetting::where('name', 'site_img')
            ->where('section', $id)
            ->get()
            ->first();

        if ($image = $request->file('site_img')) {

            if ($site_image->value != null && File::exists('assets/site_settings/' . $site_image->value)) {
                unlink('assets/site_settings/' . $site_image->value);
            }

            $file_name = Str::slug($request->site_name) . "." . $image->getClientOriginalExtension();
            $path = public_path('assets/site_settings/' . $file_name);
            Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);


            $site_image->update([
                'value' => $file_name
            ]);
        }

        return redirect()->route('admin.site_infos.info_index')->with([
            'message' => __('panel.updated_successfully'),
            'alert-type' => 'success'
        ]);
    }

    public function remove_image(Request $request)
    {

        $site_image = SiteSetting::findOrFail($request->site_info_id);
        if (File::exists('assets/site_settings/' . $site_image->value)) {
            unlink('assets/site_settings/' . $site_image->value);
            $site_image->value = null;
            $site_image->save();
        }
        if ($site_image->value != null) {
            $site_image->value = null;
            $site_image->save();
        }

        return true;
    }


    // =============== end info site ===============//


    // =============== start contact site ===============//
    public function contact_index()
    {
        return view('backend.site_contacts.index');
    }

    public function contact_update(Request $request, $id)
    {

        $data = $request->except('_token', 'submit');

        foreach ($data as $key => $value) {
            $site = SiteSetting::where('name', $key)
                ->where('section', $id)
                ->get()
                ->first()
                ->update([
                    'value' => $value
                ]);
        }

        return redirect()->route('admin.site_contacts.contact_index')->with([
            'message' => __('panel.updated_successfully'),
            'alert-type' => 'success'
        ]);
    }
    // =============== end contact site ===============//


    // =============== start social site ===============//
    public function social_index()
    {
        return view('backend.site_socials.index');
    }

    public function social_update(Request $request, $id)
    {

        $data = $request->except('_token', 'submit');

        foreach ($data as $key => $value) {
            $site = SiteSetting::where('name', $key)
                ->where('section', $id)
                ->get()
                ->first()
                ->update([
                    'value' => $value
                ]);
        }

        return redirect()->route('admin.site_socials.social_index')->with([
            'message' => __('panel.updated_successfully'),
            'alert-type' => 'success'
        ]);
    }

    // =============== end social site ===============//

    // =============== end meta site ===============//
    public function meta_index()
    {
        return view('backend.site_metas.index');
    }

    public function meta_update(Request $request, $id)
    {

        $data = $request->except('_token', 'submit');

        foreach ($data as $key => $value) {
            $site = SiteSetting::where('name', $key)
                ->where('section', $id)
                ->get()
                ->first()
                ->update([
                    'value' => $value
                ]);
        }

        return redirect()->route('admin.site_metas.meta_index')->with([
            'message' => __('panel.updated_successfully'),
            'alert-type' => 'success'
        ]);
    }
    // =============== end meta site ===============//

    // =============== start payment method site ===============//
    public function payment_method_index()
    {

        $site_payment_setting = SiteSetting::whereNotNull('value')
            ->where('section', 5)
            ->pluck('value', 'name')->toArray();

        return view('backend.site_payment_methods.index', compact('site_payment_setting'));
    }

    public function payment_method_update(Request $request, $id)
    {

        // dd($request);

        $data = $request->except('_token', 'submit');

        foreach ($data as $key => $value) {
            $site = SiteSetting::where('name', $key)
                ->where('section', $id)
                ->get()
                ->first()
                ->update([
                    'value' => $value
                ]);
        }

        return redirect()->route('admin.site_payment_methods.payment_method_index')->with([
            'message' => __('panel.updated_successfully'),
            'alert-type' => 'success'
        ]);
    }
    // =============== end payment method site ===============//


    // =============== start payment method site ===============//
    public function counter_index()
    {

        $site_counter_setting = SiteSetting::whereNotNull('value')
            ->where('section', 6)
            ->pluck('value', 'name')->toArray();

        return view('backend.site_counters.index', compact('site_counter_setting'));
    }

    public function counter_update(Request $request, $id)
    {

        // dd($request);

        $data = $request->except('_token', 'submit');

        foreach ($data as $key => $value) {
            $site = SiteSetting::where('name', $key)
                ->where('section', $id)
                ->get()
                ->first()
                ->update([
                    'value' => $value
                ]);
        }

        return redirect()->route('admin.site_counters.counter_index')->with([
            'message' => __('panel.updated_successfully'),
            'alert-type' => 'success'
        ]);
    }
    // =============== end payment method site ===============//

}
