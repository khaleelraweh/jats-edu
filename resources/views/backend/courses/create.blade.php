@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{ asset('backend/vendor/select2/css/select2.min.css') }}">
    <style>
        .select2-container {
            display: block !important;
        }

        .note-editor.note-airframe,
        .note-editor.note-frame {
            margin-bottom: 0;
        }
    </style>
@endsection

@section('content')

    {{-- main holder page  --}}
    <div class="card shadow mb-4">

        {{-- breadcrumb part  --}}
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-plus-square"></i>
                    {{ __('panel.add_new_course') }}
                </h3>
                <ul class="breadcrumb">
                    <li>
                        <a href="{{ route('admin.index') }}">{{ __('panel.main') }}</a>
                        @if (config('locales.languages')[app()->getLocale()]['rtl_support'] == 'rtl')
                            <i class="fa fa-solid fa-chevron-left chevron"></i>
                        @else
                            <i class="fa fa-solid fa-chevron-right chevron"></i>
                        @endif
                    </li>
                    <li>
                        <a href="{{ route('admin.courses.index') }}">
                            {{ __('panel.show_courses') }}
                        </a>
                    </li>
                </ul>
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
            <form action="{{ route('admin.courses.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                {{-- links of tabs --}}
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @foreach (config('locales.languages') as $key => $val)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $loop->index == 0 ? 'active' : '' }}" id="{{ $key }}-tab"
                                data-bs-toggle="tab" data-bs-target="#{{ $key }}" type="button" role="tab"
                                aria-controls="{{ $key }}" aria-selected="true">
                                {{ __('panel.content_tab') }}({{ $key }})
                            </button>
                        </li>
                    @endforeach

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="course_info-tab" data-bs-toggle="tab" data-bs-target="#course_info"
                            type="button" role="tab" aria-controls="course_info"
                            aria-selected="true">{{ __('panel.course_info_tab') }}
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="price-tab" data-bs-toggle="tab" data-bs-target="#price" type="button"
                            role="tab" aria-controls="price" aria-selected="true">{{ __('panel.price_tab') }}
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="published-tab" data-bs-toggle="tab" data-bs-target="#published"
                            type="button" role="tab" aria-controls="published"
                            aria-selected="false">{{ __('panel.published_tab') }}
                        </button>
                    </li>

                </ul>

                {{-- contents of links tabs  --}}
                <div class="tab-content" id="myTabContent">

                    {{-- Content Tab --}}
                    @foreach (config('locales.languages') as $key => $val)
                        <div class="tab-pane fade {{ $loop->index == 0 ? 'show active' : '' }}" id="{{ $key }}"
                            role="tabpanel" aria-labelledby="{{ $key }}">

                            <div class="row">
                                {{-- البيانات الاساسية --}}
                                <div class="{{ $loop->index == 0 ? 'col-md-7' : '' }} col-sm-12 ">
                                    {{-- category name  field --}}
                                    @if ($loop->first)
                                        <div class="row pt-3">
                                            <div class="col-12 ">
                                                <label for="category_id">{{ __('panel.course_category_name') }}</label>
                                                <select name="course_category_id" class="form-control"
                                                    id="course_category_id">
                                                    <option value="">{{ __('panel.main_category') }} __</option>
                                                    @forelse ($course_categories as $course_category)
                                                        <option value="{{ $course_category->id }}"
                                                            {{ old('course_category_id') == $course_category->id ? 'selected' : null }}>
                                                            {{ $course_category->category_name }}
                                                        </option>

                                                    @empty
                                                    @endforelse
                                                </select>
                                                @error('course_category_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>
                                    @endif

                                    {{-- course name field --}}
                                    <div class="row ">
                                        <div class="col-sm-12 pt-3">
                                            <div class="form-group">
                                                <label for="course_name[{{ $key }}]">
                                                    {{ __('panel.course_name') }}
                                                    {{ __('panel.in') }} {{ __('panel.' . $key) }}
                                                </label>
                                                <input type="text" name="course_name[{{ $key }}]"
                                                    id="course_name[{{ $key }}]"
                                                    value="{{ old('course_name.' . $key) }}" class="form-control">
                                                @error('course_name.' . $key)
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- course description field --}}
                                    {{--  description field --}}
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 pt-3">
                                            <label for="description[{{ $key }}]">
                                                {{ __('panel.description') }}
                                                {{ __('panel.in') }} {{ __('panel.' . $key) }}
                                            </label>
                                            <textarea name="description[{{ $key }}]" rows="10" class="form-control summernote">
                                            {!! old('description.' . $key) !!}
                                        </textarea>
                                            @error('course_category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- مرفق الصور  --}}
                                <div class="{{ $loop->index == 0 ? 'col-md-5' : 'd-none' }}   col-sm-12 ">

                                    <div class="row ">
                                        <div class="col-sm-12 col-md-12 pt-3">
                                            <label for="images">
                                                {{ __('panel.image') }}
                                                /
                                                {{ __('panel.images') }}
                                            </label>
                                            <div class="file-loading">
                                                <input type="file" name="images[]" id="course_images"
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
                    @endforeach

                    {{-- Course info --}}
                    <div class="tab-pane fade" id="course_info" role="tabpanel" aria-labelledby="course_info-tab">

                        <div class="row">
                            <div class="col-sm-12 pt-3">
                                <label for="course_level">{{ __('panel.course_level') }}</label>
                                <select name="course_level" class="form-control">
                                    <option value="1" {{ old('course_level') == '1' ? 'selected' : null }}>
                                        {{ __('panel.course_level_beginner') }}
                                    </option>
                                    <option value="2" {{ old('course_level') == '2' ? 'selected' : null }}>
                                        {{ __('panel.course_level_intermediate') }}
                                    </option>
                                    <option value="3" {{ old('course_level') == '3' ? 'selected' : null }}>
                                        {{ __('panel.course_level_advance') }}
                                    </option>
                                </select>
                                @error('course_level')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 pt-3">
                                <label for="course_lang">{{ __('panel.course_lang') }}</label>
                                <select name="course_lang" class="form-control">
                                    <option value="1" {{ old('course_lang') == '1' ? 'selected' : null }}>
                                        {{ __('panel.course_lang_ar') }}
                                    </option>
                                    <option value="2" {{ old('course_lang') == '2' ? 'selected' : null }}>
                                        {{ __('panel.course_lang_en') }}
                                    </option>

                                </select>
                                @error('course_lang')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 pt-3">
                                <label for="course_evaluation">{{ __('panel.course_evaluation') }}</label>
                                <select name="course_evaluation" class="form-control">
                                    <option value="1" {{ old('course_evaluation') == '1' ? 'selected' : null }}>
                                        {{ __('panel.course_evaluation_normal') }}
                                    </option>
                                    <option value="2" {{ old('course_evaluation') == '2' ? 'selected' : null }}>
                                        {{ __('panel.course_evaluation_featured') }}
                                    </option>
                                    <option value="3" {{ old('course_evaluation') == '3' ? 'selected' : null }}>
                                        {{ __('panel.course_evaluation_best_seller') }}
                                    </option>

                                </select>
                                @error('course_evaluation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 pt-3">
                                <label for="course_lessons_number">{{ __('panel.course_lessons_number') }}</label>
                                <input type="number" name="course_lessons_number" id="course_lessons_number"
                                    value="{{ old('course_lessons_number') }}" class="form-control">
                                @error('course_lessons_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 pt-3">
                                <label for="course_lessons_time">{{ __('panel.course_lessons_time') }}</label>
                                <input type="text" name="course_lessons_time" id="course_lessons_time"
                                    value="{{ old('course_lessons_time') }}" class="form-control" placeholder="8h 17m">
                                @error('course_lessons_time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>

                    </div>

                    {{-- Pricing Tab --}}
                    <div class="tab-pane fade" id="price" role="tabpanel" aria-labelledby="price-tab">
                        {{-- skeu and quantity fields --}}
                        <div class="row">
                            {{-- quantity field --}}
                            <div class="col-md-6 col-sm-12 pt-3">
                                <label for="sku">{{ __('panel.sku') }}</label>
                                <input type="text" name="sku" id="sku" value="{{ old('sku') }}"
                                    class="form-control">
                                @error('sku')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- quantity field --}}
                            <div class="col-md-6 col-sm-12 pt-3">
                                <label for="quantity">{{ __('panel.qty') }}</label>
                                <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}"
                                    min="0" class="form-control child">
                                @error('quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                {{-- child class is used to make disabled and enabled to select part --}}
                                <div class="col-md-12 col-sm-12 ">
                                    <label class="col-form-label col-md-12 col-sm-12 ">
                                        <input class='child' type='checkbox' name="Quantity_Unlimited"
                                            id="Quantity_Unlimited" value="-1"
                                            {{ old('Quantity_Unlimited') ? 'checked' : '' }} />
                                        {{ __('panel.qty_not_limited') }}
                                    </label>
                                </div>



                            </div>

                        </div>

                        {{-- course price and offer_price fields --}}
                        <div class="row">
                            <div class="col-md-6 col-sm-12 pt-3">
                                <label for="price"> {{ __('panel.price') }} </label>
                                <input type="number" name="price" id="price" value="{{ old('price') }}"
                                    class="form-control" min="1">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 col-sm-12 pt-3">
                                <label for="offer_price"> {{ __('panel.offer_price') }} </label>
                                <input type="number" name="offer_price" id="offer_price"
                                    value="{{ old('offer_price') }}" class="form-control" min="0">
                                @error('offer_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- offer_ends for price --}}
                        <div class="row">
                            <div class="col-md-6 com-sm-12 pt-3">
                                <label for="offer_ends" class="control-label"><span> {{ __('panel.offer_ends') }}
                                    </span><span class="require red">*</span></label>
                                <div class="form-group">
                                    <input type="text" id="offer_ends" name="offer_ends"
                                        value="{{ old('offer_ends', now()->format('Y-m-d')) }}" class="form-control">
                                    @error('offer_ends')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- max quentify accepted field --}}
                            <div class="col-md-6 col-sm-12 pt-3">
                                <label for="max_order"> {{ __('panel.max_order') }} </label>
                                <input type="number" name="max_order" id="max_order" value="{{ old('max_order') }}"
                                    min="0" class="form-control child2">
                                @error('max_order')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                {{-- child class is used to make disabled and enabled to select part --}}
                                <div class="col-md-12 col-sm-12 ">
                                    <label class="col-form-label col-md-12 col-sm-12 ">
                                        <input class='child2' type='checkbox' name="Quantity_Unlimited_max_order"
                                            id="Quantity_Unlimited_max_order" value="-1"
                                            {{ old('Quantity_Unlimited_max_order') ? 'checked' : '' }} />
                                        {{ __('panel.qty_not_limited') }}
                                    </label>
                                </div>



                            </div>

                        </div>
                    </div>

                    {{-- Published Tab --}}
                    <div class="tab-pane fade" id="published" role="tabpanel" aria-labelledby="published-tab">

                        {{-- publish_start publish time field --}}
                        <div class="row">
                            <div class="col-sm-12 col-md-12 pt-3">
                                <div class="form-group">
                                    <label for="published_on">{{ __('panel.published_date') }}</label>
                                    <input type="text" id="published_on" name="published_on"
                                        value="{{ old('published_on', now()->format('Y-m-d')) }}" class="form-control">
                                    @error('published_on')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-12 pt-3">
                                <div class="form-group">
                                    <label for="published_on_time">{{ __('panel.published_time') }}</label>
                                    <input type="text" id="published_on_time" name="published_on_time"
                                        value="{{ old('published_on_time', now()->format('h:m A')) }}"
                                        class="form-control">
                                    @error('published_on_time')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        {{-- status and featured field --}}
                        <div class="row">
                            <div class="col-sm-12 col-md-12 pt-3">
                                <label for="status">{{ __('panel.status') }}</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ old('status') == '1' ? 'selected' : null }}>
                                        {{ __('panel.status_active') }}
                                    </option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : null }}>
                                        {{ __('panel.status_inactive') }}
                                    </option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 pt-3">
                                <label for="featured">{{ __('panel.featured') }}</label>
                                <select name="featured" class="form-control">
                                    <option value="1" {{ old('featured') == '1' ? 'selected' : null }}>
                                        {{ __('panel.yes') }}
                                    </option>
                                    <option value="0" {{ old('featured') == '0' ? 'selected' : null }}>
                                        {{ __('panel.no') }}
                                    </option>
                                </select>
                                @error('featured')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="form-group pt-3">
                        <button type="submit" name="submit" class="btn btn-primary">
                            {{ __('panel.save_data') }}</button>
                    </div>

                </div>


            </form>


        </div>

    </div>

@endsection

@section('script')
    {{-- Call select2 plugin --}}
    <script src="{{ asset('backend/vendor/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            $("#course_images").fileinput({
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

            // ======= start pickadate codeing ===========
            $('#publish_date').pickadate({
                format: 'yyyy-mm-dd',
                selectMonths: true, // Creates a dropdown to control month
                selectYears: true, // creates a dropdown to control years
                clear: 'Clear',
                close: 'OK',
                colseOnSelect: true // Close Upon Selecting a date
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


    {{-- is related to select permision disable and enable by child class --}}
    <script language="javascript">
        var $cbox = $('.child').change(function() {
            if (this.checked) {
                $cbox.not(this).attr('disabled', 'disabled');
            } else {
                $cbox.removeAttr('disabled');
            }
        });

        var $cbox2 = $('.child2').change(function() {
            if (this.checked) {
                $cbox2.not(this).attr('disabled', 'disabled');
            } else {
                $cbox2.removeAttr('disabled');
            }
        });
    </script>


    <script>
        $(document).ready(function() {

            if ($("#Quantity_Unlimited").attr("checked"))
                $("#quantity").attr('disabled', 'disabled');
            else
                $("#quantity").removeAttr('disabled');


            if ($("#Quantity_Unlimited_max_order").attr("checked"))
                $("#max_order").attr('disabled', 'disabled');
            else
                $("#max_order").removeAttr('disabled');
        });
    </script>
@endsection
