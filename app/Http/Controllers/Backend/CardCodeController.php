<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CardCodeRequest;
use App\Models\CardCode;
use App\Models\Product;
use App\Models\ProductCategory;
use DateTimeImmutable;
use Illuminate\Http\Request;

class CardCodeController extends Controller
{

    public function index()
    {
        if (!auth()->user()->ability('admin', 'manage_card_codes , show_card_codes')) {
            return redirect('admin/index');
        }

        $available_card_codes = CardCode::with('product')
            ->ActiveProduct()
            ->CardCategory()
            ->where('order_id', '<=', 0)
            ->when(\request()->keyword_available_codes != null, function ($query) {
                $query->search(\request()->keyword_available_codes);
            })
            ->when(\request()->status_available_codes != null, function ($query) {
                $query->where('status', \request()->status_available_codes);
            })
            ->when(\request()->code_type_available_codes != null, function ($query) {
                $query->where('code_type', \request()->code_type_available_codes);
            })
            ->orderBy(\request()->sort_by_available_codes ?? 'created_at', \request()->order_by_available_codes ?? 'desc')
            ->paginate(\request()->limit_by_available_codes ?? 10, ['*'], 'available_codes');




        $used_card_codes = CardCode::with('product')
            ->ActiveProduct()
            ->CardCategory()
            ->where('order_id', '>', 0)
            ->when(\request()->keyword_used_code != null, function ($query) {
                $query->search(\request()->keyword_used_code);
            })
            ->when(\request()->status_used_code != null, function ($query) {
                $query->where('status', \request()->status_used_code);
            })
            ->orderBy(\request()->sort_by_used_code ?? 'created_at', \request()->order_by_used_code ?? 'desc')
            ->paginate(\request()->limit_by_used_code ?? 10, ['*'], 'used_codes');

        return view('backend.card_codes.index', compact('available_card_codes', 'used_card_codes'));
    }

    public function create()
    {
        if (!auth()->user()->ability('admin', 'create_card_codes')) {
            return redirect('admin/index');
        }

        // get all categories that are active to choose one of them to be parent of product
        $product_categories = ProductCategory::whereStatus(1)->whereSection(2)->get(['id', 'category_name']);
        // $cards = Product::whereStatus(1)->cardCategory()->get(['id', 'product_name']);
        $cards = Product::whereStatus(1)->cardCategory()->get(['id', 'product_name']);

        return view('backend.card_codes.create', compact('product_categories', 'cards'));
    }

    public function store(CardCodeRequest $request)
    {

        if (!auth()->user()->ability('admin', 'create_card_codes')) {
            return redirect('admin/index');
        }

        // dd($request->code);
        $input['product_id']        =   $request->product_id;
        $input['code_type']         =   0;
        $input['encoding_type']     =   0;
        $input['order_id']          =   0;
        $input['status']            =   1;
        $input['published_on']      =   now();


        $arr = explode("\n", $request->code);

        // foreach ($arr as $key => $value) {
        //     echo $value . "<br>";
        // }

        foreach ($arr as $key => $value) {
            $input['code']      =   trim($value);
            $card_codes = CardCode::create($input);
        }

        if ($card_codes) {
            return redirect()->route('admin.card_codes.index')->with([
                'message' => __('panel.created_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.card_codes.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }


    public function  store_custom_codes(Request $request)
    {

        // dd($request->code[0]);

        $custom_codes_list = [];
        for ($i = 0; $i < count($request->code_name); $i++) {
            if (!empty($request->code_name[$i]  && !empty(trim($request->code[$i])))) {
                $custom_codes_list[$i]['code_name']         =   $request->code_name[$i];
                $custom_codes_list[$i]['code']              =   trim($request->code[$i]);
                $custom_codes_list[$i]['product_id']        =   $request->product_id;
                $custom_codes_list[$i]['created_at']        =   now();
            }
        }

        // dd($custom_codes_list);

        $custom_codes = CardCode::insert($custom_codes_list);

        if ($custom_codes) {
            return redirect()->route('admin.card_codes.index')->with([
                'message' => __('panel.created_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.card_codes.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function  store_custom_group_codes(Request $request)
    {

        // dd($request);

        $custom_codes = true;



        for ($i = 0; $i < count($request->code_name); $i++) {
            $custom_codes_list = [];
            $arr = [];

            $arr = explode("\n", $request->code[$i]);

            foreach ($arr as $key => $value) {
                if (!empty($request->code_name[$i]  && !empty(trim($value)))) {

                    $custom_codes_list[$i]['code_name']         =   $request->code_name[$i];
                    $custom_codes_list[$i]['code']              =   trim($value);
                    $custom_codes_list[$i]['product_id']        =   $request->product_id;
                    $custom_codes_list[$i]['created_at']        =   now();

                    $card_codes                                 =   CardCode::insert($custom_codes_list);
                }
            }
        }



        if ($custom_codes) {
            return redirect()->route('admin.card_codes.index')->with([
                'message' => __('panel.created_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.card_codes.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function show($id)
    {
        if (!auth()->user()->ability('admin', 'display_card_codes')) {
            return redirect('admin/index');
        }

        return view('backend.cards.show');
    }

    public function edit($card)
    {

        if (!auth()->user()->ability('admin', 'update_card_codes')) {
            return redirect('admin/index');
        }


        $card = Product::where('id', $card)->first();

        // get all categories that are active to choose one of them to be parent of product
        $categories = ProductCategory::whereStatus(1)->whereSection(2)->get(['id', 'category_name']);
        // get all tags to add some of them to product 
        $tags = Tag::whereStatus(1)->get(['id', 'name']);

        return view('backend.cards.edit', compact('categories', 'tags', 'card'));
    }

    public function update(CardRequest $request,  $card)
    {
        if (!auth()->user()->ability('admin', 'update_card_codes')) {
            return redirect('admin/index');
        }


        $card = Product::where('id', $card)->first();


        // get Input from create.blade.php form request using CardRequest to validate fields
        $input['product_name']                  =   $request->product_name;
        $input['description']           =   $request->description;
        // $input['quantity']              =   $request->quantity;

        if (isset($request->Quantity_Unlimited)) {
            $input['quantity']          =   $request->Quantity_Unlimited;
        } else {
            $input['quantity']          =   $request->quantity;
        }

        $input['price']                 =   $request->price;
        $input['offer_price']           =   $request->offer_price;
        $input['offer_ends']            =   $request->offer_ends;
        $input['sku']                   =   $request->sku;

        if (isset($request->Quantity_Unlimited_max_order)) {
            $input['max_order']          =   $request->Quantity_Unlimited_max_order;
        } else {
            $input['max_order']          =   $request->max_order;
        }

        $input['product_category_id']   =   $request->product_category_id;
        $input['featured']              =   $request->featured;

        $input['status']            =   $request->status;
        $input['updated_by']        =   auth()->user()->full_name;

        $published_on = $request->published_on . ' ' . $request->published_on_time;
        $published_on = new DateTimeImmutable($published_on);
        $input['published_on'] = $published_on;

        //Add product to db with save instance of it in $card to use it later 
        $card->update($input);

        //  دالة السينك اذا كان في جديد ستضيفة فوق الاول اذا كان شي محذوف ستحذفة من الاول
        $card->tags()->sync($request->tags);


        // edit images in photos db and in path : public/assets/products
        if ($request->images && count($request->images) > 0) {

            $i = $card->photos->count() + 1; // $i is used for making sort to image 

            foreach ($request->images as $image) {

                // $file_name = Str::slug($request->name).".".$image->getClientOriginalExtension(); // will not used because product already created to db and slug is there by steps upove
                $file_name = $card->slug . '_' . time() . $i . '.' . $image->getClientOriginalExtension(); // time() and $id used to avoid repeating image name 
                $file_size = $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('assets/cards/' . $file_name);

                // get the real path of this image then resize its width to 500 and height let it aspect it with width
                Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100); //then make copy of this image in new path as $path say with new name as $file_name say with clear 100%

                // add this photos to db using photos relational function
                $card->photos()->create([
                    'file_name' => $file_name,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                    'file_status' => 'true',
                    'file_sort' => $i,
                ]);

                $i++; // step ahead by one for sort new image 
            }
        }

        if ($card) {
            return redirect()->route('admin.cards.index')->with([
                'message' => __('panel.updated_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.cards.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function destroy($card)
    {
        if (!auth()->user()->ability('admin', 'delete_card_codes')) {
            return redirect('admin/index');
        }

        $card = Product::where('id', $card)->first();


        if ($card->photos->count() > 0) {
            foreach ($card->photos as $photo) {
                if (File::exists('assets/cards/' . $photo->file_name)) {
                    unlink('assets/cards/' . $photo->file_name);
                }
                $photo->delete();
            }
        }

        $card->delete();

        if ($card) {
            return redirect()->route('admin.cards.index')->with([
                'message' => __('panel.deleted_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('admin.cards.index')->with([
            'message' => __('panel.something_was_wrong'),
            'alert-type' => 'danger'
        ]);
    }

    public function remove_image(Request $request)
    {

        if (!auth()->user()->ability('admin', 'delete_card_codes')) {
            return redirect('admin/index');
        }

        //find product from product table 
        $card = Product::findOrFail($request->product_id);

        //find photos image from photos table 
        $image = $card->photos()->where('id', $request->image_id)->first();

        if (File::exists('assets/cards/' . $image->file_name)) {
            // delete image from path 
            unlink('assets/cards/' . $image->file_name);
        }
        //delete image from db
        $image->delete();

        return true;
    }
}
