<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PageRequest;
use App\Models\Page;
use App\Models\WebMenu;
use DateTimeImmutable;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_pages , show_pages')) {
            return redirect('admin/index');
        }

        $pages = Page::query()
            ->when(\request()->keyword != null, function ($query) {
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->where('status', \request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'published_on', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);



        return view('backend.pages.index', compact('pages'));
    }

    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_pages')) {
            return redirect('admin/index');
        }

        $main_menus = WebMenu::tree();

        return view('backend.pages.create', compact('main_menus'));
    }

    public function store(PageRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_pages')) {
            return redirect('admin/index');
        }



        $input['title'] = $request->title;
        $input['content'] = $request->content;
        $input['web_menu_id'] = $request->parent_id;

        $input['status']            =   $request->status;
        $input['created_by'] = auth()->user()->full_name;
        $published_on = $request->published_on . ' ' . $request->published_on_time;
        $published_on = new DateTimeImmutable($published_on);
        $input['published_on'] = $published_on;

        $page = Page::create($input);


        if ($page) {
            return redirect()->route('admin.pages.index')->with([
                'message' => __('panel.created_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.pages.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }



    public function show($id)
    {
        if (!auth()->user()->ability('admin', 'display_pages')) {
            return redirect('admin/index');
        }
        return view('backend.pages.show');
    }

    public function edit($page)
    {
        if (!auth()->user()->ability('admin', 'update_pages')) {
            return redirect('admin/index');
        }

        $main_menus = WebMenu::tree();

        $page = Page::where('id', $page)->first();

        return view('backend.pages.edit', compact('main_menus', 'page'));
    }

    public function update(WebMenuRequest $request, $webMenu)
    {

        $webMenu = WebMenu::where('id', $webMenu)->first();

        $input['title'] = $request->title;
        $input['link'] = $request->link;
        $input['icon'] = $request->icon;
        $input['parent_id'] = $request->parent_id;
        $input['section'] = 1;

        $input['status']            =   $request->status;
        $input['created_by'] = auth()->user()->full_name;
        $published_on = $request->published_on . ' ' . $request->published_on_time;
        $published_on = new DateTimeImmutable($published_on);
        $input['published_on'] = $published_on;

        $webMenu->update($input);

        if ($webMenu) {
            return redirect()->route('admin.pages.index')->with([
                'message' => __('panel.updated_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.pages.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    // public function update(WebMenuRequest $request, WebMenu $webMenu)
    // {
    //     if(!auth()->user()->ability('admin','update_pages')){
    //         return redirect('admin/index');
    //     }


    //     $input['title']   = $request->title;
    //     $input['name_en']   = $request->name_en;

    //     $input['link']      = $request->link;

    //     $input['parent_id'] = $request->parent_id;

    //     $input['status']    =   $request->status;
    //     $input['updated_by']=   auth()->user()->full_name;

    //     $published_on = $request->published_on.' '.$request->published_on_time;
    //     $published_on = new DateTimeImmutable($published_on);
    //     $input['published_on'] = $published_on;

    //     $webMenu->update($input);


    //     return redirect()->route('admin.pages.index')->with([
    //         'message' => 'تم التعديل بنجاح',
    //         'alert-type' => 'success'
    //     ]);
    // }




    public function destroy($webMenu)
    {
        if (!auth()->user()->ability('admin', 'delete_pages')) {
            return redirect('admin/index');
        }

        $webMenu = WebMenu::where('id', $webMenu)->first()->delete();

        if ($webMenu) {
            return redirect()->route('admin.pages.index')->with([
                'message' => __('panel.deleted_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.pages.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }
}
