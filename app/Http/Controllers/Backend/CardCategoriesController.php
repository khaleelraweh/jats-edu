<?php

namespace App\Http\Controllers\Backend;

use illuminate\support\Str;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CardCategoryRequest;
use App\Models\ProductCategory;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CardCategoriesController extends Controller
{

    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_card_categories , show_card_categories')) {
            return redirect('admin/index');
        }

        $categories = ProductCategory::withCount('products')->where('section', 2)
            ->when(\request()->keyword != null, function ($query) {
                // $query->where('name','like','%'.\request()->keyword .'%');
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($query) {
                $query->where('status', \request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'published_on', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        return view('backend.card_categories.index', compact('categories'));
    }

    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_card_categories')) {
            return redirect('admin/index');
        }

        return view('backend.card_categories.create');
    }

    public function store(CardCategoryRequest $request)
    {
        if (!auth()->user()->ability('admin', 'create_card_categories')) {
            return redirect('admin/index');
        }

        $input['category_name'] = $request->category_name;
        $input['description'] = $request->description;
        $input['views'] = 0;
        $input['created_by'] = auth()->user()->full_name;
        $input['section'] = 2;
        $input['featured'] = $request->featured;

        $input['status']            =   $request->status;
        $input['updated_by']        =   auth()->user()->full_name;

        $published_on = $request->published_on . ' ' . $request->published_on_time;
        $published_on = new DateTimeImmutable($published_on);
        $input['published_on'] = $published_on;

        $cardCategory = ProductCategory::create($input);

        // add images to media db and to path : public/assets/products
        if ($request->images && count($request->images) > 0) {

            $i = 1; // $i is used for making sort to image 

            foreach ($request->images as $image) {

                // $file_name = Str::slug($request->name).".".$image->getClientOriginalExtension(); // will not used because product already created to db and slug is there by steps upove
                $file_name = $cardCategory->slug . '_' . time() . $i . '.' . $image->getClientOriginalExtension(); // time() and $id used to avoid repeating image name 
                $file_size = $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('assets/card_categories/' . $file_name);

                // get the real path of this image then resize its width to 500 and height let it aspect it with width
                Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100); //then make copy of this image in new path as $path say with new name as $file_name say with clear 100%

                // add this media to db using media relational function
                $cardCategory->photo()->create([
                    'file_name' => $file_name,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                    'file_status' => 'true',
                    'file_sort' => $i,
                ]);

                $i++; // step ahead by one for sort new image 
            }
        }

        if ($cardCategory) {
            return redirect()->route('admin.card_categories.index')->with([
                'message' => __('panel.created_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.card_categories.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function show($id)
    {
        if (!auth()->user()->ability('admin', 'display_card_categories')) {
            return redirect('admin/index');
        }
        return view('backend.card_categories.show');
    }


    public function edit($cardCategory)
    {
        if (!auth()->user()->ability('admin', 'update_card_categories')) {
            return redirect('admin/index');
        }

        $cardCategory = ProductCategory::where('id', $cardCategory)->first();

        return view('backend.card_categories.edit', compact('cardCategory'));
    }

    public function update(CardCategoryRequest $request,  $cardCategory)
    {
        if (!auth()->user()->ability('admin', 'update_card_categories')) {
            return redirect('admin/index');
        }

        $cardCategory = ProductCategory::where('id', $cardCategory)->first();


        $input['category_name'] = $request->category_name;
        $input['parent_id'] = $request->parent_id;
        $input['description'] = $request->description;
        $input['views'] = 0;
        $input['updated_by'] = auth()->user()->full_name;
        $input['section'] = 2;
        $input['featured'] = $request->featured;

        $input['status']            =   $request->status;
        $input['updated_by']        =   auth()->user()->full_name;

        $published_on = $request->published_on . ' ' . $request->published_on_time;
        $published_on = new DateTimeImmutable($published_on);
        $input['published_on'] = $published_on;

        $cardCategory->update($input);



        // edit images in media db and in path : public/assets/products
        if ($request->images && count($request->images) > 0) {

            $i = $cardCategory->photo()->count() + 1; // $i is used for making sort to image 

            foreach ($request->images as $image) {

                // $file_name = Str::slug($request->name).".".$image->getClientOriginalExtension(); // will not used because product already created to db and slug is there by steps upove
                $file_name = $cardCategory->slug . '_' . time() . $i . '.' . $image->getClientOriginalExtension(); // time() and $id used to avoid repeating image name 
                $file_size = $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('assets/card_categories/' . $file_name);

                // get the real path of this image then resize its width to 500 and height let it aspect it with width
                Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100); //then make copy of this image in new path as $path say with new name as $file_name say with clear 100%

                // add this media to db using media relational function
                $cardCategory->photo()->create([
                    'file_name' => $file_name,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                    'file_status' => 'true',
                    'file_sort' => $i,
                ]);

                $i++; // step ahead by one for sort new image 
            }
        }


        if ($cardCategory) {
            return redirect()->route('admin.card_categories.index')->with([
                'message' => __('panel.updated_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.card_categories.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }



    public function destroy($cardCategory)
    {

        if (!auth()->user()->ability('admin', 'delete_card_categories')) {
            return redirect('admin/index');
        }

        $cardCategory = ProductCategory::where('id', $cardCategory)->first();


        if ($cardCategory->photo()->count() > 0) {
            foreach ($cardCategory->photo() as $photo) {

                if (File::exists('assets/card_categories/' . $photo->file_name)) {
                    unlink('assets/card_categories/' . $photo->file_name);
                }

                $photo->delete();
            }
        }

        $cardCategory->views = 0;
        $cardCategory->deleted_by = auth()->user()->full_name;
        $cardCategory->save();
        $cardCategory->delete();


        if ($cardCategory) {
            return redirect()->route('admin.card_categories.index')->with([
                'message' => __('panel.deleted_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.card_categories.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function remove_image(Request $request)
    {

        if (!auth()->user()->ability('admin', 'delete_card_categories')) {
            return redirect('admin/index');
        }

        // dd($request);

        $category = ProductCategory::findOrFail($request->product_category_id);

        //find media image from media table 
        $image = $category->photo()->whereId($request->image_id)->first();

        if (File::exists('assets/card_categories/' . $image->file_name)) {
            unlink('assets/card_categories/' . $image->file_name);
        }

        $image->delete();

        return true;
    }
}
