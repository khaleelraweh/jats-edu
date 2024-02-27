<?php

namespace App\Http\Controllers\Backend;

use illuminate\support\Str;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductCategoryRequest;
use App\Models\ProductCategory;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductCategoriesController extends Controller
{
   
    public function index()
    { 
        if(!auth()->user()->ability('admin','manage_product_categories , show_product_categories')){
            return redirect('admin/index');
        }

        $categories = ProductCategory::withCount('products')->where('section',1)
        ->when(\request()->keyword != null , function($query){
            // $query->where('name','like','%'.\request()->keyword .'%');
            $query->search(\request()->keyword);
        })
        ->when(\request()->status != null , function($query){
            $query->where('status',\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'published_on' , \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);
        
        return view('backend.product_categories.index',compact('categories'));
        
    }

    public function create()
    {
        if(!auth()->user()->ability('admin','create_product_categories')){
            return redirect('admin/index');
        }

        $main_categories =ProductCategory::whereNull('parent_id')->where('section',1)->get(['id','name']);
        return view('backend.product_categories.create',compact('main_categories'));
    }

    public function store(ProductCategoryRequest $request)
    {
        if(!auth()->user()->ability('admin','create_product_categories')){
            return redirect('admin/index');
        }

        $input['name'] = $request->name;
        $input['parent_id'] = $request->parent_id;
        $input['featured'] = $request->featured;
        $input['description'] = $request->description;
        $input['views'] = 0;
        $input['created_by'] = auth()->user()->full_name;
        $input['section'] = 1;

        $input['status']            =   $request->status;
        $input['updated_by']        =   auth()->user()->full_name;

        $published_on = $request->published_on.' '.$request->published_on_time;
        $published_on = new DateTimeImmutable($published_on);
        $input['published_on'] = $published_on;

        $productCategory = ProductCategory::create($input);

        // add images to media db and to path : public/assets/products
        if($request->images && count( $request->images) > 0){

            $i = 1; // $i is used for making sort to image 

            foreach ($request->images as $image) {
                
                // $file_name = Str::slug($request->name).".".$image->getClientOriginalExtension(); // will not used because product already created to db and slug is there by steps upove
                $file_name = $productCategory->slug. '_' . time() . $i . '.' . $image->getClientOriginalExtension(); // time() and $id used to avoid repeating image name 
                $file_size = $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('assets/product_categories/' . $file_name);
                
                // get the real path of this image then resize its width to 500 and height let it aspect it with width
                Image::make($image->getRealPath())->resize(500,null,function($constraint){
                    $constraint->aspectRatio();
                })->save($path,100);//then make copy of this image in new path as $path say with new name as $file_name say with clear 100%

                // add this media to db using media relational function
                $productCategory->photo()->create([
                    'file_name' =>$file_name,
                    'file_size' =>$file_size,
                    'file_type' =>$file_type,
                    'file_status' => 'true',
                    'file_sort' =>$i,
                ]); 

                $i++; // step ahead by one for sort new image 
            }
        }

        // اعادة التوجية الي صفحة العرض مع رسالة نجاح العملية 
        return redirect()->route('admin.product_categories.index')->with([
            'message' => 'تم الانشاء بنجاح',
            'alert-type' => 'success'
        ]);
    }
    
    public function show($id)
    {
        if(!auth()->user()->ability('admin','display_product_categories')){
            return redirect('admin/index');
        }
        return view('backend.product_categories.show');
    }

    public function edit(ProductCategory $productCategory)
    {
        if(!auth()->user()->ability('admin','update_product_categories')){
            return redirect('admin/index');
        }
        

        $main_categories = ProductCategory::whereNull('parent_id')->get(['id','name']);
        return view('backend.product_categories.edit',compact('main_categories' , 'productCategory'));
    }
    
    public function update(ProductCategoryRequest $request, ProductCategory $productCategory)
    {
        if(!auth()->user()->ability('admin','update_product_categories')){
            return redirect('admin/index');
        }

        
        $input['name'] = $request->name;
        $input['parent_id'] = $request->parent_id;
        $input['description'] = $request->description;
        $input['views'] = 0;
        $input['updated_by'] = auth()->user()->full_name;
        $input['featured'] = $request->featured;

        $input['status']            =   $request->status;
        $input['updated_by']        =   auth()->user()->full_name;

        $published_on = $request->published_on.' '.$request->published_on_time;
        $published_on = new DateTimeImmutable($published_on);
        $input['published_on'] = $published_on;

        $productCategory->update($input);
       

        // edit images in media db and in path : public/assets/products
        if($request->images && count( $request->images) > 0){

            $i = $productCategory->photo()->count() + 1; // $i is used for making sort to image 

            foreach ($request->images as $image) {
                
                // $file_name = Str::slug($request->name).".".$image->getClientOriginalExtension(); // will not used because product already created to db and slug is there by steps upove
                $file_name = $productCategory->slug. '_' . time() . $i . '.' . $image->getClientOriginalExtension(); // time() and $id used to avoid repeating image name 
                $file_size = $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('assets/product_categories/' . $file_name);
                
                // get the real path of this image then resize its width to 500 and height let it aspect it with width
                Image::make($image->getRealPath())->resize(500,null,function($constraint){
                    $constraint->aspectRatio();
                })->save($path,100);//then make copy of this image in new path as $path say with new name as $file_name say with clear 100%

                // add this media to db using media relational function
                $productCategory->photo()->create([
                    'file_name' =>$file_name,
                    'file_size' =>$file_size,
                    'file_type' =>$file_type,
                    'file_status' => 'true',
                    'file_sort' =>$i,
                ]); 

                $i++; // step ahead by one for sort new image 
            }
        }

        return redirect()->route('admin.product_categories.index')->with([
            'message' => 'تم التعديل بنجاح',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(ProductCategory $productCategory)
    {
        if(!auth()->user()->ability('admin','delete_product_categories')){
            return redirect('admin/index');
        }

        if($productCategory->photo()->count() > 0){
            foreach($productCategory->photo() as $photo){
                
                if(File::exists('assets/product_categories/' . $photo->file_name)){
                    unlink('assets/product_categories/' . $photo->file_name);
                }
                
                $photo->delete();
            }
        }

        $productCategory->views = 0;
        $productCategory->deleted_by = auth()->user()->full_name;
        $productCategory->save();
        $productCategory->delete();

        return redirect()->route('admin.product_categories.index')->with([
            'message' => 'تم الحذف بنجاح',
            'alert-type' => 'success'
        ]);
    }

    public function remove_image(Request $request){

        if(!auth()->user()->ability('admin','delete_product_categories')){
            return redirect('admin/index');
        }

        // dd($request);

        $category = ProductCategory::findOrFail($request->product_category_id);

         //find media image from media table 
         $image = $category->photo()->whereId($request->image_id)->first();

        if(File::exists('assets/product_categories/' . $image->file_name)){
            unlink('assets/product_categories/' . $image->file_name);
        }

        $image->delete();

        return true;
    }
}