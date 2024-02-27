@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{ asset('backend/vendor/select2/css/select2.min.css') }}">
    {{-- pickadate calling css --}}
    <link rel="stylesheet" href="{{ asset('backend/vendor/datepicker/themes/classic.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendor/datepicker/themes/classic.date.css') }}">

    {{-- is used to make tab-content --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>

    <style>
        .picker__select--month,
        .picker__select--year {
            padding: 0 !important;
        }

        .picker__list {
            list-style-type: none;
        }

        .x-title {
            border-bottom: 2px solid #E6E9ED;
            padding: 1px 5px 6px;
            margin-bottom: 10px;
        }

        .select2-container {
            display: block !important;
        }

        .note-editor.note-airframe,
        .note-editor.note-frame {
            margin-bottom: 0;
        }

        .require.red {
            color: red;
        }
    </style>
@endsection

@section('content')

    {{-- main holder page  --}}
    <div class="card shadow mb-4">

        {{-- menu part  --}}
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">إضافة منتج</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.products.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">إدارة المنتجات</span>
                </a>
            </div>
        </div>

        {{-- body part  --}}
        <div class="card-body">

            {{-- erorrs show is exists --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            {{-- enctype used cause we will save images  --}}
            <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                {{-- links of tabs --}}
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="content-tab" data-toggle="tab" href="#content" role="tab"
                            aria-controls="content" aria-selected="true">بيانات المحتوي</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pricing-tab" data-toggle="tab" href="#pricing" role="tab"
                            aria-controls="pricing" aria-selected="false">بيانات التسعيرة</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="publish-tab" data-toggle="tab" href="#publish" role="tab"
                            aria-controls="publish" aria-selected="false">بيانات النشر</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="seo-tab" data-toggle="tab" href="#seo" role="tab"
                            aria-controls="seo" aria-selected="false">بيانات SEO</a>
                    </li>

                </ul>

                {{-- contents of links tabs  --}}
                <div class="tab-content" id="myTabContent">

                    {{-- Content Tab --}}
                    <div class="tab-pane fade active show" id="content" role="tabpanel" aria-labelledby="content-tab">
                        <div class="row">
                            {{-- البيانات الاساسية --}}
                            <div class="col-md-7 col-sm-12 ">
                                {{-- category name  field --}}
                                <div class="row pt-4">
                                    <div class="col-12 ">
                                        <label for="category_id">تصنيف المنتج</label>
                                        <select name="product_category_id" class="form-control">
                                            <option value="">---</option>
                                            @forelse ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('product_category_id') == $category->id ? 'selected' : null }}>
                                                    {{ $category->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                {{-- product name field --}}
                                <div class="row pt-4">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="name">العنوان</label>
                                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                                class="form-control" placeholder="name">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- product description field --}}
                                <div class="row pt-4">
                                    <div class="col-12">
                                        <label for="description">Description</label>
                                        <textarea name="description" rows="10" class="form-control summernote">
                                            {!! old('description') !!}
                                        </textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- مرفق الصور  --}}
                            <div class="col-md-5 col-sm-12 ">

                                <div class="row pt-4">
                                    <div class="col-12">
                                        <label for="images">الصورة/ الصور</label>
                                        <br>
                                        <div class="file-loading">
                                            <input type="file" name="images[]" id="product_images"
                                                class="file-input-overview" multiple="multiple">
                                            @error('images')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- Pricing Tab --}}
                    <div class="tab-pane fade" id="pricing" role="tabpanel" aria-labelledby="pricing-tab">
                        {{-- skeu and quantity fields --}}
                        <div class="row">
                            {{-- quantity field --}}
                            <div class="col-md-6 col-sm-12 pt-4">
                                <label for="sku">رمز المنتج sku</label>
                                <input type="text" name="sku" id="sku" value="{{ old('sku') }}"
                                    class="form-control" placeholder="sku..">
                                @error('sku')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- quantity field --}}
                            <div class="col-md-6 col-sm-12 pt-4">
                                <label for="quantity">الكمية</label>
                                <input type="number" name="quantity" id="quantity" value="{{ old(0, 'quantity') }}"
                                    min="0" class="form-control" placeholder="quantity"
                                    data-parsley-range="[-1,1000]" data-parsley-required-message="هذا الحقل مطلوب."
                                    placeholder="0" data-parsley-range="[-1,1000]"
                                    data-parsley-range-message="قيمة هذا الحقل بين [0,999].">
                                @error('quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <div class="col-md-12 col-sm-12 ">
                                    <label class="col-form-label col-md-12 col-sm-12 ">
                                        <input name="Quantity_Unlimited" type="checkbox" class="flat"
                                            onclick="enableDisable(this.checked, 'quantity')"
                                            data-parsley-multiple="Quantity_Unlimited"> الكمية غير محدودة
                                        <script language="javascript">
                                            function enableDisable(bEnable, textBoxID) {
                                                document.getElementById(textBoxID).readOnly = bEnable
                                            }
                                        </script>
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- product price and offer_price fields --}}
                        <div class="row">
                            <div class="col-md-6 col-sm-12 pt-3">
                                <label for="price">السعر المنتج </label>
                                <input type="text" name="price" id="price" value="{{ old('price') }}"
                                    class="form-control" placeholder="price">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 col-sm-12 pt-3">
                                <label for="offer_price">سعر التخفيض </label>
                                <input type="text" name="offer_price" id="offer_price"
                                    value="{{ old('offer_price') }}" class="form-control" placeholder="offer_price">
                                @error('offer_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- offer_ends for price --}}
                        <div class="row">
                            <div class="col-md-6 com-sm-12 pt-4">
                                <label for="offer_ends" class="control-label"><span>اخر موعد للتخفيض </span><span
                                        class="require red">*</span></label>
                                <div class="form-group">
                                    <input type="text" id="offer_ends" name="offer_ends"
                                        value="{{ old('offer_ends', now()->format('Y-m-d')) }}" class="form-control">
                                    @error('offer_ends')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- max quentify accepted field --}}
                            <div class="col-md-6 col-sm-12 pt-4">
                                <label for="max_order">اعلى كمية يمكن طلبها </label>
                                <input type="number" name="max_order" id="max_order" value="{{ old(0, 'max_order') }}"
                                    min="0" class="form-control" placeholder="0" data-parsley-range="[-1,1000]"
                                    data-parsley-required-message="هذا الحقل مطلوب." placeholder="0"
                                    data-parsley-range="[-1,1000]"
                                    data-parsley-range-message="قيمة هذا الحقل بين [0,999].">
                                @error('max_order')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <div class="col-md-12 col-sm-12 ">
                                    <label class="col-form-label col-md-12 col-sm-12 ">
                                        <input name="Quantity_Unlimited" type="checkbox" class="flat"
                                            onclick="enableDisable(this.checked, 'max_order')"
                                            data-parsley-multiple="Quantity_Unlimited"> الكمية غير محدودة
                                        <script language="javascript">
                                            function enableDisable(bEnable, textBoxID) {
                                                document.getElementById(textBoxID).readOnly = bEnable
                                            }
                                        </script>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Publish Tab --}}
                    <div class="tab-pane fade" id="publish" role="tabpanel" aria-labelledby="publish-tab">
                        {{-- status and featured field --}}
                        <div class="row">
                            <div class="col-6 pt-4">
                                <label for="status">الحالة</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ old('status') == '1' ? 'selected' : null }}>مفعل</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : null }}>غير مفعل
                                    </option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-6 pt-4">
                                <label for="featured">عرض في المفضلة</label>
                                <select name="featured" class="form-control">
                                    <option value="1" {{ old('featured') == '1' ? 'selected' : null }}>نعم</option>
                                    <option value="0" {{ old('featured') == '0' ? 'selected' : null }}>لا</option>
                                </select>
                                @error('featured')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- publish_start publish time field --}}
                        <div class="row">
                            <div class="col-sm-12 col-md-6 pt-4">
                                <div class="form-group">
                                    <label for="published_on">تاريخ النشر</label>
                                    <input type="text" id="published_on" name="published_on"
                                        value="{{ old('published_on', now()->format('Y-m-d')) }}" class="form-control">
                                    @error('published_on')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 pt-4">
                                <div class="form-group">
                                    <label for="published_on_time">وقت النشر</label>
                                    <input type="text" id="published_on_time" name="published_on_time"
                                        value="{{ old('published_on_time', now()->format('h:m A')) }}"
                                        class="form-control">
                                    @error('published_on_time')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        {{--  tags field --}}
                        <div class="row ">
                            {{-- Tags field  --}}
                            <div class="col-md-12 col-sm-12 pt-4">
                                <label for="tags">كلمات مفتاحية</label>
                                <select name="tags[]" class="form-control select2" multiple="multiple">
                                    @forelse ($tags as $tag)
                                        <option value="{{ $tag->id }}"
                                            {{ in_array($tag->id, old('tags', [])) ? 'selected' : null }}>
                                            {{ $tag->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                        later work...
                    </div>

                    <div class="form-group pt-4">
                        <button type="submit" name="submit" class="btn btn-primary">Add Product</button>
                    </div>

                </div>


            </form>


        </div>

    </div>

@endsection

@section('script')
    {{-- Call select2 plugin --}}
    <script src="{{ asset('backend/vendor/select2/js/select2.full.min.js') }}"></script>

    {{-- pickadate calling js --}}
    <script src="{{ asset('backend/vendor/datepicker/picker.js') }}"></script>
    <script src="{{ asset('backend/vendor/datepicker/picker.date.js') }}"></script>
    <script src="{{ asset('backend/vendor/datepicker/picker.time.js') }}"></script>

    <script>
        $(function() {

            $("#product_images").fileinput({
                theme: "fa5",
                maxFileCount: 5,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false
            });


            $('#published_on').pickadate({
                format: 'yyyy-mm-dd',
                min: new Date(),
                selectMonths: true, // Creates a dropdown to control month
                selectYears: true, // creates a dropdown to control years
                clear: 'Clear',
                close: 'OK',
                colseOnSelect: true // Close Upon Selecting a date
            });


            var publishedOn = $('#published_on').pickadate(
            'picker'); // set startdate in the picker to the start date in the #start_date elemet

            // when change date 
            $('#published_on').change(function() {
                selected_ci_date = "";
                selected_ci_date = $('#published_on').val();
                if (selected_ci_date != null) {
                    var cidate = new Date(selected_ci_date);
                    min_codate = "";
                    min_codate = new Date();
                    min_codate.setDate(cidate.getDate() + 1);
                    enddate.set('min', min_codate);
                }

            });

            $('#published_on_time').pickatime({
                clear: ''
            });

            $('#offer_ends').pickadate({
                format: 'yyyy-mm-dd',
                selectMonths: true, // Creates a dropdown to control month
                selectYears: true, // creates a dropdown to control years
                clear: 'Clear',
                close: 'OK',
                colseOnSelect: true // Close Upon Selecting a date
            });

            $('.summernote').summernote({
                tabSize: 2,
                height: 150,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });


            //select2: code to search in data 
            function matchStart(params, data) {
                // If there are no search terms, return all of the data
                if ($.trim(params.term) === '') {
                    return data;
                }

                // Skip if there is no 'children' property
                if (typeof data.children === 'undefined') {
                    return null;
                }

                // `data.children` contains the actual options that we are matching against
                var filteredChildren = [];
                $.each(data.children, function(idx, child) {
                    if (child.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
                        filteredChildren.push(child);
                    }
                });

                // If we matched any of the timezone group's children, then set the matched children on the group
                // and return the group object
                if (filteredChildren.length) {
                    var modifiedData = $.extend({}, data, true);
                    modifiedData.children = filteredChildren;

                    // You can return modified objects from here
                    // This includes matching the `children` how you want in nested data sets
                    return modifiedData;
                }

                // Return `null` if the term should not be displayed
                return null;
            }

            // select2 : .select2 : is  identifier used with element to be effected
            $(".select2").select2({
                tags: true,
                colseOnSelect: false,
                minimumResultsForSearch: Infinity,
                matcher: matchStart
            });

        });
    </script>
@endsection
