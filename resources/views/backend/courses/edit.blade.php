@extends('layouts.admin')

@section('style')
    <style>
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
                    <i class="fa fa-edit"></i>
                    {{ __('panel.edit_existing_course') }}
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
            <form id="my_form_id" action="{{ route('admin.courses.update', $course->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')

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
                        <button class="nav-link" id="course_topics-tab" data-bs-toggle="tab" data-bs-target="#course_topics"
                            type="button" role="tab" aria-controls="course_topics"
                            aria-selected="true">{{ __('panel.course_topics_tab') }}
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="course_requirements-tab" data-bs-toggle="tab"
                            data-bs-target="#course_requirements" type="button" role="tab"
                            aria-controls="course_requirements"
                            aria-selected="true">{{ __('panel.course_requirements_tab') }}
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
                                        <div class="row ">
                                            <div class="col-12 pt-4">
                                                <label for="category_id"> {{ __('panel.course_category_name') }}</label>
                                                <select name="course_category_id" class="form-control">
                                                    <option value=""> {{ __('panel.main_category') }} __ </option>
                                                    @forelse ($course_categories as $course_category)
                                                        <option value="{{ $course_category->id }}"
                                                            {{ old('course_category_id', $course->course_category_id) == $course_category->id ? 'selected' : null }}>
                                                            {{ $course_category->category_name }} </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- course name field --}}
                                    <div class="row ">
                                        <div class="col-sm-12 pt-3">
                                            <div class="form-group">
                                                <label for="title[{{ $key }}]">
                                                    {{ __('panel.title') }}
                                                    {{ __('panel.in') }} {{ __('panel.' . $key) }}
                                                </label>
                                                <input type="text" name="title[{{ $key }}]"
                                                    id="title[{{ $key }}]"
                                                    value="{{ old('title.' . $key, $course->getTranslation('title', $key)) }}"
                                                    class="form-control">
                                                @error('title.' . $key)
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- course subtitle field --}}
                                    <div class="row ">
                                        <div class="col-sm-12 pt-3">
                                            <div class="form-group">
                                                <label for="subtitle[{{ $key }}]">
                                                    {{ __('panel.subtitle') }}
                                                    {{ __('panel.in') }} {{ __('panel.' . $key) }}
                                                </label>
                                                <input type="text" name="subtitle[{{ $key }}]"
                                                    id="subtitle[{{ $key }}]"
                                                    value="{{ old('subtitle.' . $key, $course->getTranslation('title', $key)) }}"
                                                    class="form-control">
                                                @error('subtitle.' . $key)
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{--  description field --}}
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 pt-4">
                                            <label for="description[{{ $key }}]">
                                                {{ __('panel.description') }}
                                                {{ __('panel.in') }} {{ __('panel.' . $key) }}
                                            </label>
                                            <textarea name="description[{{ $key }}]" rows="10" class="form-control summernote">
                                            {!! old('description.' . $key, $course->getTranslation('description', $key)) !!}
                                        </textarea>
                                            @error('description.' . $key)
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- مرفق الصور  --}}
                                <div class="{{ $loop->index == 0 ? 'col-md-5' : 'd-none' }} col-sm-12 ">

                                    <div class="row">
                                        <div class="col-12 pt-4">
                                            <label for="images">{{ __('panel.image') }}/
                                                {{ __('panel.images') }}</label>
                                            <br>
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
                                    <option value="1"
                                        {{ old('course_level', $course->course_level) == '1' ? 'selected' : null }}>
                                        {{ __('panel.course_level_beginner') }}
                                    </option>
                                    <option value="2"
                                        {{ old('course_level', $course->course_level) == '2' ? 'selected' : null }}>
                                        {{ __('panel.course_level_intermediate') }}
                                    </option>
                                    <option value="3"
                                        {{ old('course_level', $course->course_level) == '3' ? 'selected' : null }}>
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
                                    <option value="1"
                                        {{ old('course_lang', $course->course_lang) == '1' ? 'selected' : null }}>
                                        {{ __('panel.course_lang_ar') }}
                                    </option>
                                    <option value="2"
                                        {{ old('course_lang', $course->course_lang) == '2' ? 'selected' : null }}>
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
                                    <option value="1"
                                        {{ old('course_evaluation', $course->course_evaluation) == '1' ? 'selected' : null }}>
                                        {{ __('panel.course_evaluation_normal') }}
                                    </option>
                                    <option value="2"
                                        {{ old('course_evaluation', $course->course_evaluation) == '2' ? 'selected' : null }}>
                                        {{ __('panel.course_evaluation_featured') }}
                                    </option>
                                    <option value="3"
                                        {{ old('course_evaluation', $course->course_evaluation) == '3' ? 'selected' : null }}>
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
                                    value="{{ old('course_lessons_number', $course->course_lessons_number) }}"
                                    class="form-control">
                                @error('course_lessons_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 pt-3">
                                <label for="course_lessons_time">{{ __('panel.course_lessons_time') }}</label>
                                <input type="text" name="course_lessons_time" id="course_lessons_time"
                                    value="{{ old('course_lessons_time', $course->course_lessons_time) }}"
                                    class="form-control" placeholder="8h 17m">
                                @error('course_lessons_time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>

                    </div>

                    {{-- price Tab --}}
                    <div class="tab-pane fade" id="price" role="tabpanel" aria-labelledby="price-tab">

                        {{-- course price  --}}
                        <div class="row">
                            <div class="col-md-12 col-sm-12 pt-3">
                                <label for="price"> {{ __('panel.price') }} </label>
                                <input type="text" name="price" id="price"
                                    value="{{ old('price', $course->price) }}" class="form-control">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- offer price  --}}
                        <div class="row">
                            <div class="col-md-12 col-sm-12 pt-3">
                                <label for="offer_price"> {{ __('panel.offer_price') }} </label>
                                <input type="text" id="offer_price" name="offer_price"
                                    value="{{ old('offer_price', $course->offer_price) }}" class="form-control">
                                @error('offer_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- offer_ends  --}}
                        <div class="row">
                            <div class="col-md-12 com-sm-12 pt-4">
                                <label for="offer_ends" class="control-label"><span> {{ __('panel.offer_ends') }}
                                    </span><span class="require red">*</span></label>
                                <div class="form-group">
                                    <input type="text" id="offer_ends" name="offer_ends"
                                        value="{{ old('offer_ends', $course->offer_ends) }}" class="form-control">
                                    @error('offer_ends')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>



                    {{-- course topic content  --}}
                    <div class="tab-pane fade" id="course_topics" role="tabpanel" aria-labelledby="course_topics-tab">


                        <div class="table-responsive">
                            <table class="table" id="course_topics_details">
                                <thead>
                                    <tr class="pt-4">
                                        <th width="30px">{{ __('panel.act') }}</th>
                                        <th width="160px">{{ __('panel.type') }}</th>
                                        <th>{{ __('panel.txt_course_topics') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($course->topics as $item)
                                        <?php
                                        $loopIndex = $loop->index;
                                        ?>
                                        @foreach (config('locales.languages') as $key => $val)
                                            <tr class="cloning_row" id="{{ $loopIndex }}">
                                                <td style="width: 30px !important;">
                                                    @if ($loopIndex == 0)
                                                        {{ '#' }}
                                                    @else
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm delegated-btn"><i
                                                                class="fa fa-minus"></i></button>
                                                    @endif
                                                </td>
                                                <td>{{ __('panel.topic_in_' . $key) }} ({{ $loopIndex }})</td>
                                                <td>
                                                    <input type="text"
                                                        name="course_topic[{{ $loopIndex }}][{{ $key }}]"
                                                        id="course_topic"
                                                        value="{{ old('course_topic' . $key, $item->getTranslation('course_topic', $key)) }}"
                                                        class="course_topic form-control">
                                                    @error('course_topic[{{ $loopIndex }}]' . $key)
                                                        <span class="help-block text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end">
                                            <button type="button"
                                                class="btn_add btn btn-primary">{{ __('panel.btn_add_another_topic') }}</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>

                    {{-- course requirement content --}}
                    <div class="tab-pane fade" id="course_requirements" role="tabpanel"
                        aria-labelledby="course_requirements-tab">


                        <div class="table-responsive">
                            <table class="table" id="course_requirements_details">
                                <thead>
                                    <tr class="pt-4">
                                        <th width="30px">{{ __('panel.act') }}</th>
                                        <th width="160px">{{ __('panel.type') }}</th>
                                        <th>{{ __('panel.txt_course_requirements') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($course->requirements as $item)
                                        <?php
                                        $loopIndex = $loop->index;
                                        ?>
                                        @foreach (config('locales.languages') as $key => $val)
                                            <tr class="cloning_row" id="{{ $loopIndex }}">
                                                <td style="width: 30px !important;">
                                                    @if ($loopIndex == 0)
                                                        {{ '#' }}
                                                    @else
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm delegated-btn"><i
                                                                class="fa fa-minus"></i></button>
                                                    @endif
                                                </td>
                                                <td>{{ __('panel.requirement_in_' . $key) }} ({{ $loopIndex }})</td>
                                                <td>
                                                    <input type="text"
                                                        name="course_requirement[{{ $loopIndex }}][{{ $key }}]"
                                                        id="course_requirement"
                                                        value="{{ old('course_requirement' . $key, $item->getTranslation('course_requirement', $key)) }}"
                                                        class="course_requirement form-control">
                                                    @error('course_requirement[{{ $loopIndex }}]' . $key)
                                                        <span class="help-block text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end">
                                            <button type="button"
                                                class="btn_add_requirement btn btn-primary">{{ __('panel.btn_add_another_requirement') }}</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>

                    {{-- Published Tab --}}
                    <div class="tab-pane fade" id="published" role="tabpanel" aria-labelledby="published-tab">

                        {{-- published_on and published_on_time  --}}
                        <div class="row">
                            <div class="col-sm-12 col-md-12 pt-4">
                                <div class="form-group">
                                    <label for="published_on"> {{ __('panel.published_date') }}</label>
                                    <input type="text" id="published_on" name="published_on"
                                        value="{{ old('published_on', \Carbon\Carbon::parse($course->published_on)->Format('Y-m-d')) }}"
                                        class="form-control">
                                    @error('published_on')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-12 pt-4">
                                <div class="form-group">
                                    <label for="published_on_time">{{ __('panel.published_time') }}</label>
                                    <input type="text" id="published_on_time" name="published_on_time"
                                        value="{{ old('published_on_time', \Carbon\Carbon::parse($course->published_on)->Format('h:i A')) }}"
                                        class="form-control">
                                    @error('published_on_time')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 pt-3">
                                <label for="status" class="control-label col-md-2 col-sm-12 ">
                                    <span>{{ __('panel.status') }}</span>
                                </label>
                                <select name="status" class="form-control">
                                    <option value="1"
                                        {{ old('status', $course->status) == '1' ? 'selected' : null }}>
                                        {{ __('panel.status_active') }}
                                    </option>
                                    <option value="0"
                                        {{ old('status', $course->status) == '0' ? 'selected' : null }}>
                                        {{ __('panel.status_inactive') }}
                                    </option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- featured field --}}
                        <div class="row">
                            <div class="col-sm-12 col-md-12 pt-4">
                                <label for="featured">{{ __('panel.featured') }}</label>
                                <select name="featured" class="form-control">
                                    <option value="1"
                                        {{ old('featured', $course->featured) == '1' ? 'selected' : null }}>
                                        {{ __('panel.yes') }}
                                    </option>
                                    <option value="0"
                                        {{ old('featured', $course->featured) == '0' ? 'selected' : null }}>
                                        {{ __('panel.no') }}
                                    </option>
                                </select>
                                @error('featured')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="form-group pt-4">
                        <button type="submit" name="submit" class="btn btn-primary">
                            {{ __('panel.update_data') }}
                        </button>
                    </div>





                </div>

            </form>
        </div>

    </div>

@endsection

@section('script')
    <script>
        $(function() {
            const link = document.getElementById('checkIn');
            const result = link.hasAttribute('checked');
            if (result) {
                document.getElementById('quantity').readOnly = true;
            }
        });
    </script>

    <script>
        $(function() {

            $("#course_images").fileinput({
                theme: "fa5",
                maxFileCount: 5,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                // اضافات للتعامل مع الصورة عند التعديل علي احد اقسام المنتجات
                // delete images from photos and assets/products 
                // because there are maybe more than one image we will go for each image and show them in the edit page 
                initialPreview: [
                    @if ($course->photos()->count() > 0)
                        @foreach ($course->photos as $media)
                            "{{ asset('assets/courses/' . $media->file_name) }}",
                        @endforeach
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                    @if ($course->photos()->count() > 0)
                        @foreach ($course->photos as $media)
                            {
                                caption: "{{ $media->file_name }}",
                                size: '{{ $media->file_size }}',
                                width: "120px",
                                // url : الراوت المستخدم لحذف الصورة
                                url: "{{ route('admin.courses.remove_image', ['image_id' => $media->id, 'course_id' => $course->id, '_token' => csrf_token()]) }}",
                                key: {{ $media->id }}
                            },
                        @endforeach
                    @endif

                ]
            }).on('filesorted', function(event, params) {
                console.log(params.previewId, params.oldIndex, params.newIndex, params.stack);
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
            $('#published_on').change(function() {
                selected_ci_date = "";
                selected_ci_date = now() // make selected start date in picker = start_date value  

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

            var startdate = $('#offer_ends').pickadate(
                'picker'); // set startdate in the picker to the start date in the #publish_date elemet


            // when change date 
            $('#offer_ends').change(function() {
                selected_ci_date = "";
                selected_ci_date = $('#publish_date')
                    .val(); // make selected start date in picker = publish_date value
                if (selected_ci_date != null) {
                    var cidate = new Date(
                        selected_ci_date
                    ); // make cidate(start date ) = current date you selected in selected ci date (selected start date )
                    min_codate = "";
                    min_codate = new Date();
                    min_codate.setDate(cidate.getDate() +
                        1); // minimum selected date to be expired shoud be current date plus one 
                    enddate.set('min', min_codate);
                }

            });

            $('.summernote').summernote({
                tabSize: 2,
                height: 200,
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
        // check if topic field is not empty before sending form 
        $(document).ready(function() {
            // Submit event handler for the form
            $('#my_form_id').on('submit', function(event) {
                // Flag to track whether there are empty fields
                let isEmpty = false;

                // Loop through each input field and check if it's empty
                $('input.course_topic').each(function() {
                    if ($(this).val() === '') {
                        isEmpty = true;
                        return false; // Exit the loop if any field is empty
                    }
                });

                // If any field is empty, prevent the form submission
                if (isEmpty) {
                    alert('{{ __('panel.msg_one_or_more_topic_field_empty') }}.');
                    event.preventDefault(); // Prevent form submission
                }
            });

            // Click event handler for adding new rows
            $(document).on('click', '.btn_add', function() {
                let trCount = $('#course_topics_details').find('tr.cloning_row:last').length;
                let numberIncr = trCount > 0 ? parseInt($('#course_topics_details').find(
                        'tr.cloning_row:last')
                    .attr('id')) + 1 : 0;

                // Create a flag to check if any field is empty
                let isEmpty = false;

                // Loop through each input field and check if it's empty
                $('#course_topics_details').find('input.course_topic').each(function() {
                    if ($(this).val() === '') {
                        isEmpty = true;
                        return false; // Exit the loop if any field is empty
                    }
                });

                // If any field is empty, display an alert
                if (isEmpty) {
                    alert(
                        '{{ __('panel.msg_please_fill_in_all_topic_fields_before_adding_new') }}.');
                    return false; // Prevent the form from submitting
                }

                <?php foreach (config('locales.languages') as $key => $val){ ?>
                $('#course_topics_details').find('tbody').append($('' +
                    '<tr class="cloning_row" id="' + numberIncr + '">' +
                    '<td>' +
                    '<button type="button" class="btn btn-danger btn-sm delegated-btn"><i class="fa fa-minus"></i></button></td>' +
                    '<td>' +
                    '<span>{{ __('panel.topic_in_' . $key) }} (' + numberIncr + ')</span></td>' +
                    '<td><input type="text" name="course_topic[' + numberIncr +
                    '][<?php echo $key; ?>]" class="course_topic form-control"></td>' +
                    '</tr>'));
                <?php } ?>
            });
        });



        $(document).on('click', '.delegated-btn', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();

        });
    </script>

    <script>
        //  check if topic field is not empty before sending form 
        $(document).ready(function() {
            // Submit event handler for the form
            $('#my_form_id').on('submit', function(event) {
                // Flag to track whether there are empty fields
                let isEmpty = false;

                // Loop through each input field and check if it's empty
                $('input.course_requirement').each(function() {
                    if ($(this).val() === '') {
                        isEmpty = true;
                        return false; // Exit the loop if any field is empty
                    }
                });

                // If any field is empty, prevent the form submission
                if (isEmpty) {
                    alert('{{ __('panel.msg_one_or_more_requirement_field_empty') }}.');
                    event.preventDefault(); // Prevent form submission
                }
            });

            // Click event handler for adding new rows
            $(document).on('click', '.btn_add_requirement', function() {
                let trCount = $('#course_requirements_details').find('tr.cloning_row:last').length;
                let numberIncr = trCount > 0 ? parseInt($('#course_requirements_details').find(
                        'tr.cloning_row:last')
                    .attr('id')) + 1 : 0;

                // Create a flag to check if any field is empty
                let isEmpty = false;

                // Loop through each input field and check if it's empty
                $('#course_requirements_details').find('input.course_requirement').each(function() {
                    if ($(this).val() === '') {
                        isEmpty = true;
                        return false; // Exit the loop if any field is empty
                    }
                });

                // If any field is empty, display an alert
                if (isEmpty) {
                    alert(
                        '{{ __('panel.msg_please_fill_in_all_requirement_fields_before_adding_new') }}.'
                    );
                    return false; // Prevent the form from submitting
                }

                <?php foreach (config('locales.languages') as $key => $val){ ?>
                $('#course_requirements_details').find('tbody').append($('' +
                    '<tr class="cloning_row" id="' + numberIncr + '">' +
                    '<td>' +
                    '<button type="button" class="btn btn-danger btn-sm delegated-btn"><i class="fa fa-minus"></i></button></td>' +
                    '<td>' +
                    '<span>{{ __('panel.requirement_in_' . $key) }} (' + numberIncr +
                    ')</span></td>' +
                    '<td><input type="text" name="course_requirement[' + numberIncr +
                    '][<?php echo $key; ?>]" class="course_requirement form-control"></td>' +
                    '</tr>'));
                <?php } ?>
            });
        });



        $(document).on('click', '.delegated-btn', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();

        });
    </script>
@endsection
