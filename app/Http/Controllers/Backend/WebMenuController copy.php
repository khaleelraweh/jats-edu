<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\WebMenuRequest;
use Illuminate\Http\Request;
use App\Models\WebMenu;
use illuminate\support\Str;
use Intervention\Image\Facades\Image;
use DateTimeImmutable;
use Illuminate\Support\Facades\File;

class WebMenuController extends Controller
{
   
    public function index()
    { 
        if(!auth()->user()->ability('admin','manage_web_menus , show_web_menus')){
            return redirect('admin/index');
        }

        $menus = WebMenu::query()->where('section',1)
        ->when(\request()->keyword != null , function($query){
            $query->search(\request()->keyword);
        })
        ->when(\request()->status != null , function($query){
            $query->where('status',\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'published_on' , \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);
        
        return view('backend.web_menus.index',compact('menus'));
    }

    public function create()
    {
        if(!auth()->user()->ability('admin','create_web_menus')){
            return redirect('admin/index');
        }

        $main_menus =WebMenu::whereNull('parent_id')->where('section',1)->get(['id','name_ar']);
        return view('backend.web_menus.create',compact('main_menus'));
    }

    public function store(WebMenuRequest $request)
    {
        if(!auth()->user()->ability('admin','create_web_menus')){
            return redirect('admin/index');
        }

        $input['name_ar'] = $request->name_ar;
        $input['name_en'] = $request->name_en;

        $input['link'] = $request->link;

        $input['parent_id'] = $request->parent_id;

        

        $input['section'] = 1; // main menu 

        $input['status']            =   $request->status;
        $input['created_by'] = auth()->user()->full_name;

        $published_on = $request->published_on.' '.$request->published_on_time;
        $published_on = new DateTimeImmutable($published_on);
        $input['published_on'] = $published_on;

        $productCategory = WebMenu::create($input);

       
        return redirect()->route('admin.web_menus.index')->with([
            'message' => 'تم الانشاء بنجاح',
            'alert-type' => 'success'
        ]);
    }

    public function store(Request $request)
    {

        $niceNames = [];
        $attr = [];

        foreach (config('locales.languages') as $key => $val) {
            $attr['title.' . $key] = 'required';
            $attr['body.' . $key] = 'required';
            $niceNames['title.' . $key] = __('posts.title'). ' (' . $val['name'] . ')';
            $niceNames['body.' . $key] = __('posts.body'). ' (' . $val['name'] . ')';
        }

        $validation = Validator::make($request->all(), $attr);
        $validation->setAttributeNames($niceNames);
        if ($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $data['title'] = $request->title;
        $data['body'] = $request->body;

        $post = Post::create($data);

        if ($post) {
            return redirect()->route('posts.show', $post)->with([
                'message' => __('posts.created_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('posts.index')->with([
            'message' => __('posts.something_was_wrong'),
            'alert-type' => 'danger'
        ]);

    }
    
    
    public function show($id)
    {
        if(!auth()->user()->ability('admin','display_web_menus')){
            return redirect('admin/index');
        }
        return view('backend.web_menus.show');
    }

    public function edit(WebMenu $webMenu)
    {
        if(!auth()->user()->ability('admin','update_web_menus')){
            return redirect('admin/index');
        }
        
        $main_menus = WebMenu::whereNull('parent_id')->get(['id','name_ar']);
        return view('backend.web_menus.edit',compact('main_menus' , 'webMenu'));
    }
    
    public function update(WebMenuRequest $request, WebMenu $webMenu)
    {
        if(!auth()->user()->ability('admin','update_web_menus')){
            return redirect('admin/index');
        }

        
        $input['name_ar']   = $request->name_ar;
        $input['name_en']   = $request->name_en;

        $input['link']      = $request->link;

        $input['parent_id'] = $request->parent_id;

        $input['status']    =   $request->status;
        $input['updated_by']=   auth()->user()->full_name;

        $published_on = $request->published_on.' '.$request->published_on_time;
        $published_on = new DateTimeImmutable($published_on);
        $input['published_on'] = $published_on;

        $webMenu->update($input);
       

        return redirect()->route('admin.web_menus.index')->with([
            'message' => 'تم التعديل بنجاح',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(WebMenu $webMenu)
    {
        if(!auth()->user()->ability('admin','delete_web_menus')){
            return redirect('admin/index');
        }

      
        $webMenu->deleted_by = auth()->user()->full_name;
        $webMenu->save();
        $webMenu->delete();

        return redirect()->route('admin.web_menus.index')->with([
            'message' => 'تم الحذف بنجاح',
            'alert-type' => 'success'
        ]);
    }
}
