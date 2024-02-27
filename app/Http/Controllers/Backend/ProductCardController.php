<?php

namespace App\Http\Controllers\Backend;

use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductCardController extends Controller
{

    public function index()
    {
        if(!auth()->user()->ability('admin','manage_product_cards , show_product_cards')){
            return redirect('admin/index');
        }

        $products = Product::with('category','tags','firstMedia')
        ->ActiveCategory()
        ->CardCategory()
        ->when(\request()->keyword != null , function($query){
            $query->search(\request()->keyword);
        })
        ->when(\request()->status != null , function($query){
            $query->where('status',\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'id' , \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);
        
        return view('backend.product_cards.index',compact('products'));
        
    }

    public function create()
    {
        if(!auth()->user()->ability('admin','create_product_cards')){
            return redirect('admin/index');
        }
        
        // get all categories that are active to choose one of them to be parent of product
        $categories =ProductCategory::whereStatus(1)->whereSection(2)->get(['id','name']);
        // get all tags to add some of them to product 
        $tags = Tag::whereStatus(1)->get(['id','name']);

        return view('backend.product_cards.create',compact('categories','tags'));
    }

    public function store(ProductRequest $request)
    {
     
        if(!auth()->user()->ability('admin','create_product_cards')){
            return redirect('admin/index');
        }

        // get Input from create.blade.php form request using ProductRequest to validate fields
        $input['name']                  =   $request->name;
        $input['description']           =   $request->description;
        $input['quantity']              =   $request->quantity;
        $input['price']                 =   $request->price;
        $input['offer_price']           =   $request->offer_price;
        $input['offer_ends']            =   $request->offer_ends;
        $input['sku']                   =   $request->sku;
        $input['max_order']             =   $request->max_order;
        $input['publish_date']          =   $request->publish_date;
        $input['publish_time']          =   $request->publish_time;
        $input['view_in_main']          =   $request->view_in_main;
        $input['product_category_id']   =   $request->product_category_id;
        $input['featured']              =   $request->featured;
        $input['status']                =   $request->status;
        $input['created_by']            =   auth()->user()->full_name;

        //Add product to db with save instance of it in $product to use it later 
        $product = Product::create($input);
        
        // make relation between this product with tags choosed using tags()->attach(tags_id)
        $product->tags()->attach($request->tags); 

        // add images to photos db and to path : public/assets/products
        if($request->images && count( $request->images) > 0){

            $i = 1; // $i is used for making sort to image 

            foreach ($request->images as $image) {
                
                // $file_name = Str::slug($request->name).".".$image->getClientOriginalExtension(); // will not used because product already created to db and slug is there by steps upove
                $file_name = $product->slug. '_' . time() . $i . '.' . $image->getClientOriginalExtension(); // time() and $id used to avoid repeating image name 
                $file_size = $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('assets/products/' . $file_name);
                
                // get the real path of this image then resize its width to 500 and height let it aspect it with width
                Image::make($image->getRealPath())->resize(500,null,function($constraint){
                    $constraint->aspectRatio();
                })->save($path,100);//then make copy of this image in new path as $path say with new name as $file_name say with clear 100%

                // add this photos to db using photos relational function
                $product->photos()->create([
                    'file_name' =>$file_name,
                    'file_size' =>$file_size,
                    'file_type' =>$file_type,
                    'file_status' => 'true',
                    'file_sort' =>$i,
                ]); 

                $i++; // step ahead by one for sort new image 
            }
        }

        return redirect()->route('admin.product_cards.index')->with([
            'message' => 'تمت الاضافة بنجاح',
            'alert-type' =>'success'
        ]);

    }

    public function show($id)
    {
        if(!auth()->user()->ability('admin','display_product_cards')){
            return redirect('admin/index');
        }

        return view('backend.product_cards.show');
    }

    public function edit( Product $product , $id)
    {
        
        if(!auth()->user()->ability('admin','update_product_cards')){
            return redirect('admin/index');
        }

        $product = Product::findOrFail($id);
        

        // get all categories that are active to choose one of them to be parent of product
        $categories =ProductCategory::whereStatus(1)->whereSection(2)->get(['id','name']);
        // get all tags to add some of them to product 
        $tags = Tag::whereStatus(1)->get(['id','name']); 

        return view('backend.product_cards.edit',compact('categories' , 'tags' ,'product'));
    }

    public function update(ProductRequest $request, Product $product , $id)
    {
        if(!auth()->user()->ability('admin','update_product_cards')){
            return redirect('admin/index');
        }

        $product = Product::findOrFail($id);

         // get Input from create.blade.php form request using ProductRequest to validate fields
        $input['name']                  =   $request->name;
        $input['description']           =   $request->description;
        $input['quantity']              =   $request->quantity;
        $input['price']                 =   $request->price;
        $input['offer_price']           =   $request->offer_price;
        $input['offer_ends']            =   $request->offer_ends;
        $input['sku']                   =   $request->sku;
        $input['max_order']             =   $request->max_order;
        $input['publish_date']          =   $request->publish_date;
        $input['publish_time']          =   $request->publish_time;
        $input['view_in_main']          =   $request->view_in_main;
        $input['product_category_id']   =   $request->product_category_id;
        $input['featured']              =   $request->featured;
        $input['status']                =   $request->status;
        $input['updated_by']            =   auth()->user()->full_name;
 
         //Add product to db with save instance of it in $product to use it later 
         $product->update($input);
         
        //  دالة السينك اذا كان في جديد ستضيفة فوق الاول اذا كان شي محذوف ستحذفة من الاول
         $product->tags()->sync($request->tags);


        // edit images in photos db and in path : public/assets/products
        if($request->images && count( $request->images) > 0){

            $i = $product->photos->count() + 1; // $i is used for making sort to image 

            foreach ($request->images as $image) {
                
                // $file_name = Str::slug($request->name).".".$image->getClientOriginalExtension(); // will not used because product already created to db and slug is there by steps upove
                $file_name = $product->slug. '_' . time() . $i . '.' . $image->getClientOriginalExtension(); // time() and $id used to avoid repeating image name 
                $file_size = $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('assets/products/' . $file_name);
                
                // get the real path of this image then resize its width to 500 and height let it aspect it with width
                Image::make($image->getRealPath())->resize(500,null,function($constraint){
                    $constraint->aspectRatio();
                })->save($path,100);//then make copy of this image in new path as $path say with new name as $file_name say with clear 100%

                // add this photos to db using photos relational function
                $product->photos()->create([
                    'file_name' =>$file_name,
                    'file_size' =>$file_size,
                    'file_type' =>$file_type,
                    'file_status' => 'true',
                    'file_sort' =>$i,
                ]); 

                $i++; // step ahead by one for sort new image 
            }
        }

        return redirect()->route('admin.product_cards.index')->with([
            'message' => 'تم التعديل بنجاح',
            'alert-type' =>'success'
        ]);

    }

    public function destroy(Product $product , $id)
    {
        if(!auth()->user()->ability('admin','delete_product_cards')){
            return redirect('admin/index');
        }

        $product = Product::findOrFail($id);

        if($product->photos->count() > 0){
            foreach($product->photos as $photo){
                if(File::exists('assets/products/' . $photo->file_name)){
                    unlink('assets/products/' . $photo->file_name);
                }
                $photo->delete();
            }
        }

        $product->delete();

        return redirect()->route('admin.product_cards.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }

    public function remove_image(Request $request){

        if(!auth()->user()->ability('admin','delete_product_cards')){
            return redirect('admin/index');
        }

        

        //find product from product table 
         $product = Product::findOrFail($request->product_id);

         //find photos image from photos table 
         $image = $product->photos()->where('id',$request->image_id)->first();

         if(File::exists('assets/products/' . $image->file_name)){
            // delete image from path 
             unlink('assets/products/' . $image->file_name);
         }
            //delete image from db
            $image->delete();

         return true;

    }
}
