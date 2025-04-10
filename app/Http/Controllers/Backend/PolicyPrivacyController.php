<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\SupportMenuRequest;
use App\Models\WebMenu;
use DateTimeImmutable;
use Illuminate\Http\Request;

class PolicyPrivacyController extends Controller
{

    public function index()
    {
        if (!auth()->user()->ability(['admin','supervisor'], 'manage_policy_privacy_menus , show_policy_privacy_menus')) {
            return redirect('admin/index');
        }

        $policy_privacy_menus = WebMenu::query()->where('section', 6)
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->where('status', \request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'published_on', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        return view('backend.policy_privacy_menus.index', compact('policy_privacy_menus'));
    }

    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_policy_privacy_menus')) {
            return redirect('admin/index');
        }

        return view('backend.policy_privacy_menus.create');
    }

    public function store(SupportMenuRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_policy_privacy_menus')) {
            return redirect('admin/index');
        }

        $input['title'] = $request->title;
        $input['link'] = $request->link;
        $input['icon'] = $request->icon;


        $input['section']    = $request->section; // company menu
        $input['status']     =   $request->status;
        $input['created_by'] = auth()->user()->full_name;
        $published_on = $request->published_on . ' ' . $request->published_on_time;
        $published_on = new DateTimeImmutable($published_on);
        $input['published_on'] = $published_on;
        $input['section']       = 6;

        $policy_privacy_menu = WebMenu::create($input);


        if ($policy_privacy_menu) {
            return redirect()->route('admin.policy_privacy_menus.index')->with([
                'message' => __('panel.created_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.policy_privacy_menus.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }


    public function show($id)
    {
        if (!auth()->user()->ability('admin', 'display_policy_privacy_menus')) {
            return redirect('admin/index');
        }
        return view('backend.policy_privacy_menus.show');
    }


    public function edit($policyPrivacyMenu)
    {
        if (!auth()->user()->ability('admin', 'update_policy_privacy_menus')) {
            return redirect('admin/index');
        }

        $policyPrivacyMenu = WebMenu::where('id', $policyPrivacyMenu)->first();

        return view('backend.policy_privacy_menus.edit', compact('policyPrivacyMenu'));
    }

    public function update(SupportMenuRequest $request,  $policyPrivacyMenu)
    {
        if (!auth()->user()->ability('admin', 'update_policy_privacy_menus')) {
            return redirect('admin/index');
        }

        $policyPrivacyMenu = WebMenu::where('id', $policyPrivacyMenu)->first();

        $input['title']     = $request->title;
        $input['link']      = $request->link;
        $input['icon']      = $request->icon;
        // $input['section']    = $request->section;
        $input['section']       = 6;

        $input['status']    =   $request->status;
        $input['updated_by'] =   auth()->user()->full_name;
        $published_on = $request->published_on . ' ' . $request->published_on_time;
        $published_on = new DateTimeImmutable($published_on);
        $input['published_on'] = $published_on;

        $policyPrivacyMenu->update($input);

        if ($policyPrivacyMenu) {
            return redirect()->route('admin.policy_privacy_menus.index')->with([
                'message' => __('panel.updated_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.policy_privacy_menus.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function destroy($policyPrivacyMenu)
    {

        if (!auth()->user()->ability('admin', 'delete_policy_privacy_menus')) {
            return redirect('admin/index');
        }

        $policyPrivacyMenu = WebMenu::where('id', $policyPrivacyMenu)->first();

        $policyPrivacyMenu->delete();

        if ($policyPrivacyMenu) {
            return redirect()->route('admin.policy_privacy_menus.index')->with([
                'message' => __('panel.deleted_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.policy_privacy_menus.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }
}
