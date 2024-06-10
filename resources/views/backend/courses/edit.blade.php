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
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="content-tab" data-bs-toggle="tab" data-bs-target="#content"
                            type="button" role="tab" aria-controls="content" aria-selected="true">
                            {{ __('panel.content_tab') }}
                        </button>
                    </li>

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
                        <button class="nav-link" id="course_objectives-tab" data-bs-toggle="tab"
                            data-bs-target="#course_objectives" type="button" role="tab"
                            aria-controls="course_objectives" aria-selected="true">{{ __('panel.course_objectives_tab') }}
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
                        <button class="nav-link" id="instructor-tab" data-bs-toggle="tab" data-bs-target="#instructor"
                            type="button" role="tab" aria-controls="instructor"
                            aria-selected="false">{{ __('panel.instructor_tab') }}
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
                    <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="content">
                        <div class="row">
                            {{-- البيانات الاساسية --}}
                            <div class="col-md-7 col-sm-12 ">

                                {{-- course name field --}}
                                <div class="row ">
                                    <div class="col-sm-12 pt-3">
                                        <div class="form-group">
                                            <label for="title">
                                                {{ __('transf.course_title') }}
                                            </label>

                                            <div class="input-group">
                                                <input type="text" name="title" id="title"
                                                    value="{{ old('title', $course->title) }}" class="form-control"
                                                    maxlength="60">
                                                <span class="input-group-text" id="charCount">60</span>
                                            </div>

                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- course subtitle field --}}
                                <div class="row ">
                                    <div class="col-sm-12 pt-3">
                                        <div class="form-group">
                                            <label for="subtitle">
                                                {{ __('panel.subtitle') }}

                                            </label>

                                            <div class="input-group">
                                                <input type="text" name="subtitle" id="subtitle"
                                                    value="{{ old('subtitle', $course->subtitle) }}" class="form-control"
                                                    maxlength="60">
                                                <span class="input-group-text" id="charCountSubtitle">120</span>
                                            </div>

                                            @error('subtitle')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{--  description field --}}
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 pt-4">
                                        <label for="description">
                                            {{ __('panel.description') }}

                                        </label>
                                        <textarea name="description" rows="10" class="form-control summernote">
                                            {!! old('description', $course->description) !!}
                                        </textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- مرفق الصور  --}}
                            <div class="col-md-5 col-sm-12 ">

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

                    {{-- Course info --}}
                    <div class="tab-pane fade" id="course_info" role="tabpanel" aria-labelledby="course_info-tab">

                        <div class="row">
                            <div class="col-sm-12 col-md-6 pt-3">
                                <label for="skill_level">{{ __('panel.skill_level') }}</label>
                                <select name="skill_level" class="form-control">
                                    <option value="1"
                                        {{ old('skill_level', $course->skill_level) == '1' ? 'selected' : null }}>
                                        {{ __('panel.skill_level_beginner') }}
                                    </option>
                                    <option value="2"
                                        {{ old('skill_level', $course->skill_level) == '2' ? 'selected' : null }}>
                                        {{ __('panel.skill_level_intermediate') }}
                                    </option>
                                    <option value="3"
                                        {{ old('skill_level', $course->skill_level) == '3' ? 'selected' : null }}>
                                        {{ __('panel.skill_level_advance') }}
                                    </option>
                                </select>
                                @error('skill_level')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-sm-12 col-md-6 pt-3">
                                <label for="language">{{ __('panel.language') }}</label>
                                <select name="language" class="form-control">
                                    <option value="1"
                                        {{ old('language', $course->language) == '1' ? 'selected' : null }}>
                                        {{ __('panel.language_ar') }}
                                    </option>
                                    <option value="2"
                                        {{ old('language', $course->language) == '2' ? 'selected' : null }}>
                                        {{ __('panel.language_en') }}
                                    </option>

                                </select>
                                @error('language')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>

                        {{-- video promo and description  --}}
                        <div class="row">
                            <div class="col-sm-12 col-md-6 pt-3">
                                <label for="video_promo">{{ __('panel.video_promo') }}</label>
                                <input type="text" name="video_promo" id="video_promo"
                                    value="{{ old('video_promo', $course->video_promo) }}" class="form-control">
                                @error('video_promo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-sm-12 col-md-6 pt-3">
                                <label for="video_description">{{ __('panel.video_description') }}</label>
                                <input type="text" name="video_description" id="video_description"
                                    value="{{ old('video_description', $course->video_description) }}"
                                    class="form-control" placeholder="https://video-link">
                                @error('video_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>

                        {{-- course type  --}}
                        <div class="row">
                            <div class="col-sm-12 col-md-6 pt-3">
                                <label for="course_type">{{ __('panel.course_type') }}</label>
                                <select name="course_type" class="form-control">
                                    <option value="1"
                                        {{ old('course_type', $course->course_type) == '1' ? 'selected' : null }}>
                                        {{ __('panel.course_type_presence') }}
                                    </option>
                                    <option value="2"
                                        {{ old('course_type', $course->course_type) == '2' ? 'selected' : null }}>
                                        {{ __('panel.course_type_enrolled') }}
                                    </option>

                                </select>
                                @error('coruse_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-sm-12 col-md-6 pt-4">
                                <label for="category_id"> {{ __('panel.course_title') }}</label>
                                <select name="course_category_id" class="form-control">
                                    <option value=""> {{ __('panel.main_category') }} __ </option>
                                    @forelse ($course_categories as $course_category)
                                        <option value="{{ $course_category->id }}"
                                            {{ old('course_category_id', $course->course_category_id) == $course_category->id ? 'selected' : null }}>
                                            {{ $course_category->title }} </option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        {{-- course deadline and certificate --}}
                        <div class="row deadline">
                            <div class="col-sm-12 col-md-6 pt-3">
                                <div class="form-group">
                                    <label for="deadline">{{ __('panel.deadline') }}</label>
                                    <input type="text" id="deadline" name="deadline"
                                        value="{{ old('deadline', \Carbon\Carbon::parse($course->deadline)->Format('Y-m-d')) }}"
                                        class="form-control">
                                    @error('deadline')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 pt-3">
                                <label for="certificate">{{ __('panel.certificate') }}</label>
                                <select name="certificate" class="form-control">
                                    <option value="1"
                                        {{ old('certificate', $course->certificate) == '1' ? 'selected' : null }}>
                                        {{ __('panel.certificate_yes') }}
                                    </option>
                                    <option value="2"
                                        {{ old('certificate', $course->certificate) == '0' ? 'selected' : null }}>
                                        {{ __('panel.certificate_no') }}
                                    </option>

                                </select>
                                @error('coruse_type')
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

                    {{-- course objectives contents   --}}
                    <div class="tab-pane fade" id="course_objectives" role="tabpanel"
                        aria-labelledby="course_objectives-tab">
                        <div class="table-responsive">
                            <table class="table" id="course_objectives_details">
                                <thead>
                                    <tr class="pt-4">
                                        <th width="30px">{{ __('panel.act') }}</th>
                                        <th width="160px">{{ __('panel.type') }}</th>
                                        <th>{{ __('panel.course_objectives') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($course->objectives as $index => $item)
                                        <tr class="cloning_row" id="{{ $index }}">
                                            <td style="width: 30px !important;">
                                                @if ($index == 0)
                                                    {{ '#' }}
                                                @else
                                                    <button type="button" class="btn btn-danger btn-sm delegated-btn"><i
                                                            class="fa fa-minus"></i></button>
                                                @endif
                                            </td>
                                            <td>{{ __('panel.course_objective') }} ({{ $index }})</td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" name="course_objective[{{ $index }}]"
                                                        id="course_objective"
                                                        value="{{ old('course_objective[' . $index . ']', $item->title) }}"
                                                        class="course_objective form-control" maxlength="160">

                                                    <span class="input-group-text"
                                                        id="charCountCourseObjective">160</span>
                                                </div>

                                                @error('course_objective[{{ $index }}]')
                                                    <span class="help-block text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
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
                                    @foreach ($course->requirements as $index => $item)
                                        <tr class="cloning_row" id="{{ $index }}">
                                            <td style="width: 30px !important;">
                                                @if ($index == 0)
                                                    {{ '#' }}
                                                @else
                                                    <button type="button" class="btn btn-danger btn-sm delegated-btn"><i
                                                            class="fa fa-minus"></i></button>
                                                @endif
                                            </td>
                                            <td>{{ __('panel.course_requirement') }} ({{ $index }})</td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" name="course_requirement[{{ $index }}]"
                                                        id="course_requirement"
                                                        value="{{ old('course_requirement[' . $index . ']', $item->title) }}"
                                                        class="course_requirement form-control" maxlength="160">
                                                    <span class="input-group-text"
                                                        id="charCountCourseRequirement">160</span>
                                                </div>

                                                @error('course_requirement[{{ $index }}]')
                                                    <span class="help-block text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                        </tr>
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

                    {{-- instructor tab --}}
                    <div class="tab-pane fade" id="instructor" role="tabpanel" aria-labelledby="instructor-tab">
                        {{-- instructors row --}}
                        <div class="row pt-4">
                            <div class="col-12">
                                <label for="instructors">{{ __('panel.instructors') }}</label>
                                <select name="instructors[]" class="form-control select2 child" multiple="multiple">
                                    @forelse ($instructors as $instructor)
                                        <option value="{{ $instructor->id }}"
                                            {{ in_array($instructor->id, old('instructors', $courseinstructors)) ? 'selected' : null }}>
                                            {{ $instructor->first_name }} {{ $instructor->last_name }}</option>
                                    @empty
                                    @endforelse
                                </select>

                            </div>
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
                                    <option value="0"
                                        {{ old('status', $course->status) == '0' ? 'selected' : null }}>
                                        {{ __('panel.status_inactive') }}
                                    </option>
                                    <option value="1"
                                        {{ old('status', $course->status) == '1' ? 'selected' : null }}>
                                        {{ __('panel.status_active') }}
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
    {{-- Title counter  --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const titleInput = document.getElementById('title');
            const charCount = document.getElementById('charCount');
            const maxChars = 60;

            // Function to update the character count
            function updateCharCount() {
                const remainingChars = maxChars - titleInput.value.length;
                charCount.textContent = remainingChars;
            }

            // Initialize the character count on page load
            updateCharCount();

            // Update the character count on input
            titleInput.addEventListener('input', updateCharCount);
        });
    </script>

    {{-- subtitle counter  --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const subtitleInput = document.getElementById('subtitle');
            const charCountSubtitle = document.getElementById('charCountSubtitle');
            const maxChars = 120;

            // Function to update the character count
            function updateCharCountSucharCountSubtitle() {
                const remainingChars = maxChars - subtitleInput.value.length;
                charCountSubtitle.textContent = remainingChars;
            }

            // Initialize the character count on page load
            updateCharCountSucharCountSubtitle();

            // Update the character count on input
            subtitleInput.addEventListener('input', updateCharCountSucharCountSubtitle);
        });
    </script>


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

            // deadline start 
            $('#deadline').pickadate({
                format: 'yyyy-mm-dd',
                min: new Date(),
                selectMonths: true, // Creates a dropdown to control month
                selectYears: true, // creates a dropdown to control years
                clear: 'Clear',
                close: 'OK',
                colseOnSelect: true // Close Upon Selecting a date
            });
            var deadline = $('#deadline').pickadate(
                'picker'); // set startdate in the picker to the start date in the #start_date elemet
            $('#deadline').change(function() {
                selected_ci_date = "";
                selected_ci_date = now() // make selected start date in picker = start_date value  

            });
            //deadline end 

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
        $(document).ready(function() {
            // Function to initialize character counter for a specific input field
            function initializeCharCounter($input) {
                var $counter = $input.parent().find('.input-group-text');

                // Update character count on input
                $input.on('input', function() {
                    var remainingChars = 160 - $(this).val().length;
                    $counter.text(remainingChars);
                });

                // Trigger input event to update counter initially
                $input.trigger('input');
            }

            // Initialize character counters for existing rows
            $('#course_objectives_details').find('input.course_objective').each(function() {
                initializeCharCounter($(this));
            });

            // Submit event handler for the form
            $('#my_form_id').on('submit', function(event) {
                // Flag to track whether there are empty fields
                let isEmpty = false;

                // Loop through each input field and check if it's empty
                $('input.course_objective').each(function() {
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
                let trCount = $('#course_objectives_details').find('tr.cloning_row:last').length;
                let numberIncr = trCount > 0 ? parseInt($('#course_objectives_details').find(
                        'tr.cloning_row:last')
                    .attr('id')) + 1 : 0;

                // Create a flag to check if any field is empty
                let isEmpty = false;

                // Loop through each input field and check if it's empty
                $('#course_objectives_details').find('input.course_objective').each(function() {
                    if ($(this).val() === '') {
                        isEmpty = true;
                        return false; // Exit the loop if any field is empty
                    }
                });

                // If any field is empty, display an alert
                if (isEmpty) {
                    alert('{{ __('panel.msg_please_fill_in_all_topic_fields_before_adding_new') }}.');
                    return false; // Prevent the form from submitting
                }

                // Add new row
                var newRow = $('<tr class="cloning_row" id="' + numberIncr + '">' +
                    '<td>' +
                    '<button type="button" class="btn btn-danger btn-sm delegated-btn"><i class="fa fa-minus"></i></button></td>' +
                    '<td>{{ __('panel.course_objective') }} (' + numberIncr + ')</td>' +
                    '<td>' +
                    '<div class="input-group">' +
                    '<input type="text" name="course_objective[' + numberIncr +
                    ']" class="course_objective form-control" maxlength="160">' +
                    '<span class="input-group-text">160</span>' +
                    '</div>' +
                    '</td>' +
                    '</tr>');
                $('#course_objectives_details tbody').append(newRow);

                // Initialize character counter for the new row
                initializeCharCounter(newRow.find('input.course_objective'));
            });

            // Remove row when delete button is clicked
            $(document).on('click', '.delegated-btn', function(e) {
                e.preventDefault();
                $(this).closest('tr').remove();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Function to initialize character counter for a specific input field
            function initializeCharCounter($input) {
                var $counter = $input.parent().find('.input-group-text');

                // Update character count on input
                $input.on('input', function() {
                    var remainingChars = 160 - $(this).val().length;
                    $counter.text(remainingChars);
                });

                // Trigger input event to update counter initially
                $input.trigger('input');
            }

            // Initialize character counters for existing rows
            $('#course_requirements_details').find('input.course_requirement').each(function() {
                initializeCharCounter($(this));
            });

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

                // Add new row
                var newRow = $('<tr class="cloning_row" id="' + numberIncr + '">' +
                    '<td>' +
                    '<button type="button" class="btn btn-danger btn-sm delegated-btn"><i class="fa fa-minus"></i></button></td>' +
                    '<td>{{ __('panel.course_requirement') }} (' + numberIncr + ')</td>' +
                    '<td>' +
                    '<div class="input-group">' +
                    '<input type="text" name="course_requirement[' + numberIncr +
                    ']" class="course_requirement form-control" maxlength="160">' +
                    '<span class="input-group-text">160</span>' +
                    '</div>' +
                    '</td>' +
                    '</tr>');
                $('#course_requirements_details tbody').append(newRow);

                // Initialize character counter for the new row
                initializeCharCounter(newRow.find('input.course_requirement'));
            });

            // Remove row when delete button is clicked
            $(document).on('click', '.delegated-btn', function(e) {
                e.preventDefault();
                $(this).closest('tr').remove();
            });
        });
    </script>
@endsection
