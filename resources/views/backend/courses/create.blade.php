@extends('layouts.admin')
@section('style')
    <style>
        .note-editor.note-airframe,
        .note-editor.note-frame {
            margin-bottom: 0;
        }

        #offer_ends_group .picker--opened .picker__holder {
            transform: translateY(-342px) perspective(600px) rotateX(0);
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
            <form id="my_form_id" action="{{ route('admin.courses.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- links of tabs --}}
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="content-tab" data-bs-toggle="tab" data-bs-target="#content"
                            type="button" role="tab" aria-controls="content" aria-selected="true">
                            {{ __('panel.content_tab') }}
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="course_info-tab" data-bs-toggle="tab" data-bs-target="#course_info"
                            type="button" role="tab" aria-controls="course_info"
                            aria-selected="true">{{ __('transf.course_info_tab') }}
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
                        <button class="nav-link" id="course_intendeds-tab" data-bs-toggle="tab"
                            data-bs-target="#course_intendeds" type="button" role="tab"
                            aria-controls="course_intendeds" aria-selected="true">{{ __('panel.course_intendeds_tab') }}
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
                                {{-- category name  field --}}

                                {{-- course title field --}}
                                <div class="row">
                                    <div class="col-sm-12 pt-3">
                                        <div class="form-group">
                                            <label for="title">
                                                {{ __('transf.course_title') }}
                                            </label>
                                            <div class="input-group">
                                                <input type="text" name="title" id="title"
                                                    value="{{ old('title') }}" class="form-control" maxlength="60">
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
                                                {{ __('transf.Course subtitle') }}
                                            </label>
                                            <div class="input-group">
                                                <input type="text" name="subtitle" id="subtitle"
                                                    value="{{ old('subtitle') }}" class="form-control" maxlength="120">
                                                <span class="input-group-text" id="charCountSubtitle">120</span>
                                            </div>

                                            @error('subtitle')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- course description field --}}
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 pt-3">
                                        <label for="description">
                                            {{ __('panel.description') }}
                                        </label>
                                        <textarea name="description" rows="10" class="form-control" id="tinymceExample">
                                            {!! old('description') !!}
                                        </textarea>
                                        @error('course_category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            {{-- مرفق الصور  --}}
                            <div class="col-md-5  col-sm-12 ">

                                <div class="row ">
                                    <div class="col-sm-12 col-md-12 pt-3">
                                        <label for="images">
                                            {{ __('panel.image') }}
                                            /
                                            {{ __('panel.images') }}
                                            <span><small> ( {{ __('panel.best_size') }}: 250 * 180 )</small></span>

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


                    {{-- Course info --}}
                    <div class="tab-pane fade" id="course_info" role="tabpanel" aria-labelledby="course_info-tab">

                        <div class="row">
                            <div class="col-sm-12 col-md-6 pt-3">
                                <label for="skill_level">{{ __('panel.skill_level') }}</label>
                                <select name="skill_level" class="form-control">
                                    <option value="1" {{ old('skill_level') == '1' ? 'selected' : null }}>
                                        {{ __('panel.skill_level_beginner') }}
                                    </option>
                                    <option value="2" {{ old('skill_level') == '2' ? 'selected' : null }}>
                                        {{ __('panel.skill_level_intermediate') }}
                                    </option>
                                    <option value="3" {{ old('skill_level') == '3' ? 'selected' : null }}>
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
                                    <option value="1" {{ old('language') == '1' ? 'selected' : null }}>
                                        {{ __('panel.language_ar') }}
                                    </option>
                                    <option value="2" {{ old('language') == '2' ? 'selected' : null }}>
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
                                    value="{{ old('video_promo') }}" class="form-control">
                                @error('video_promo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-sm-12 col-md-6 pt-3">
                                <label for="video_description">{{ __('panel.video_description') }}</label>
                                <input type="text" name="video_description" id="video_description"
                                    value="{{ old('video_description') }}" class="form-control" placeholder="">
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
                                    <option value="1" {{ old('course_type') == '1' ? 'selected' : null }}>
                                        {{ __('panel.course_type_presence') }}
                                    </option>
                                    <option value="2" {{ old('course_type') == '2' ? 'selected' : null }}>
                                        {{ __('panel.course_type_enrolled') }}
                                    </option>

                                </select>
                                @error('coruse_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="col-sm-12 col-md-6 pt-3 ">
                                <label for="category_id">{{ __('panel.course_title') }}</label>
                                <select name="course_category_id" class="form-control" id="course_category_id">
                                    <option value="">{{ __('panel.main_category') }} __</option>
                                    @forelse ($course_categories as $course_category)
                                        <option value="{{ $course_category->id }}"
                                            {{ old('course_category_id') == $course_category->id ? 'selected' : null }}>
                                            {{ $course_category->title }}
                                        </option>

                                    @empty
                                    @endforelse
                                </select>
                                @error('course_category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>

                        {{-- course deadline and certificate --}}
                        <div class="row deadline">
                            <div class="col-sm-12 col-md-6 pt-3">
                                <div class="form-group">
                                    <label for="deadline">{{ __('panel.deadline') }}</label>
                                    <input type="text" id="deadline" name="deadline"
                                        value="{{ old('deadline', now()->format('Y-m-d')) }}" class="form-control">
                                    @error('deadline')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 pt-3">
                                <label for="certificate">{{ __('panel.certificate') }}</label>
                                <select name="certificate" class="form-control">
                                    <option value="1" {{ old('certificate') == '1' ? 'selected' : null }}>
                                        {{ __('panel.certificate_yes') }}
                                    </option>
                                    <option value="2" {{ old('certificate') == '0' ? 'selected' : null }}>
                                        {{ __('panel.certificate_no') }}
                                    </option>

                                </select>
                                @error('coruse_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>


                        </div>



                    </div>

                    {{-- Pricing Tab --}}
                    <div class="tab-pane fade" id="price" role="tabpanel" aria-labelledby="price-tab">


                        {{-- course price and offer_price fields --}}
                        <div class="row">
                            <div class="col-md-12 col-sm-12 pt-3">
                                <label for="price"> {{ __('panel.price') }} </label>
                                <input type="number" name="price" id="price" value="{{ old('price') }}"
                                    class="form-control" min="1">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 pt-3">
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
                            <div class="col-md-12 com-sm-12 pt-3">
                                <label for="offer_ends" class="control-label">
                                    <span> {{ __('panel.offer_ends') }}
                                    </span>
                                    <span class="require red">*</span>
                                </label>
                                <div class="form-group" id="offer_ends_group">
                                    <input type="text" id="offer_ends" name="offer_ends"
                                        value="{{ old('offer_ends', now()->format('Y-m-d')) }}" class="form-control">
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
                                    <tr class="cloning_row" id="0">
                                        <td>#</td>
                                        <td>{{ __('panel.course_objective') }} (0) </td>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" name="course_objective[0]" id="course_objective"
                                                    class="course_objective form-control" maxlength="160">
                                                <span class="input-group-text" id="charCountCourseObjective">160</span>
                                            </div>

                                            @error('course_objective')
                                                <span class="help-block text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>

                                    </tr>

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

                    {{-- course requirements contents   --}}
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
                                    <tr class="cloning_row" id="0">
                                        <td>#</td>
                                        <td>{{ __('panel.course_requirement') }} (0)</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" name="course_requirement[0]"
                                                    id="course_requirement" class="course_requirement form-control"
                                                    maxlength="160">
                                                <span class="input-group-text" id="charCountCourseRequirement">160</span>
                                            </div>
                                            @error('course_requirement')
                                                <span class="help-block text-danger">{{ $message }}</span>
                                            @enderror


                                        </td>

                                    </tr>

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


                    {{-- course intendeds contents   --}}
                    <div class="tab-pane fade" id="course_intendeds" role="tabpanel"
                        aria-labelledby="course_intendeds-tab">
                        <div class="table-responsive">
                            <table class="table" id="course_intendeds_details">
                                <thead>
                                    <tr class="pt-4">
                                        <th width="30px">{{ __('panel.act') }}</th>
                                        <th width="160px">{{ __('panel.type') }}</th>
                                        <th>{{ __('panel.txt_course_intendeds') }}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="cloning_row" id="0">
                                        <td>#</td>
                                        <td>{{ __('panel.course_intended') }} (0)</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" name="course_intended[0]" id="course_intended"
                                                    class="course_intended form-control" maxlength="160">
                                                <span class="input-group-text" id="charCountCourseintended">160</span>
                                            </div>
                                            @error('course_intended')
                                                <span class="help-block text-danger">{{ $message }}</span>
                                            @enderror


                                        </td>

                                    </tr>

                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end">
                                            <button type="button"
                                                class="btn_add_intended btn btn-primary">{{ __('panel.btn_add_another_intended') }}</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    {{-- instructor tab --}}
                    <div class="tab-pane fade" id="instructor" role="tabpanel" aria-labelledby="instructor-tab">
                        {{-- specialization row --}}
                        <div class="row pt-4">

                            <div class="col-md-12 col-sm-12 ">

                                <label for="instructors"> {{ __('panel.instructors') }} </label>
                                <select name="instructors[]" class="form-control select2 child" multiple="multiple">
                                    @forelse ($instructors as $instructor)
                                        <option value="{{ $instructor->id }}"
                                            {{ in_array($instructor->id, old('instructors', [])) ? 'selected' : null }}>
                                            {{ $instructor->first_name }} {{ $instructor->last_name }}</option>
                                    @empty
                                    @endforelse
                                </select>
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
                                    <option value="0" {{ old('status') == '0' ? 'selected' : null }}>
                                        {{ __('panel.status_inactive') }}
                                    </option>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : null }}>
                                        {{ __('panel.status_active') }}
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
                // min: new Date(),
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
                // if (selected_ci_date != null) {
                //     var cidate = new Date(selected_ci_date);
                //     min_codate = "";
                //     min_codate = new Date();
                //     min_codate.setDate(cidate.getDate() + 1);
                //     enddate.set('min', min_codate);
                // }
            });

            $('#published_on_time').pickatime({
                clear: ''
            });

            // start deadline
            $('#deadline').pickadate({
                format: 'yyyy-mm-dd',
                // min: new Date(),
                selectMonths: true, // Creates a dropdown to control month
                selectYears: true, // creates a dropdown to control years
                clear: 'Clear',
                close: 'OK',
                colseOnSelect: true // Close Upon Selecting a date
            });

            var publishedOn = $('#deadline').pickadate(
                'picker'); // set startdate in the picker to the start date in the #start_date elemet

            // when change date
            $('#deadline').change(function() {
                selected_ci_date = "";
                selected_ci_date = $('#deadline').val();
                // if (selected_ci_date != null) {
                //     var cidate = new Date(selected_ci_date);
                //     min_codate = "";
                //     min_codate = new Date();
                //     min_codate.setDate(cidate.getDate() + 1);
                //     enddate.set('min', min_codate);
                // }

            });
            // end deadline

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

            // Add row functionality remains unchanged
            $(document).on('click', '.btn_add', function() {
                let trCount = $('#course_objectives_details').find('tr.cloning_row:last').length;
                let numberIncr = trCount > 0 ? parseInt($('#course_objectives_details').find(
                        'tr.cloning_row:last')
                    .attr('id')) + 1 : 0;
                let isValid = true;

                // Check if any of the existing fields are empty
                $('#course_objectives_details').find('input.course_objective').each(function() {
                    if ($(this).val() === '') {
                        isValid = false;
                        return false; // Exit the loop if any field is empty
                    }
                });

                if (!isValid) {
                    alert('{{ __('panel.msg_please_fill_in_all_topic_fields_before_adding_new') }}');
                    return false; // Prevent adding a new row if existing fields are empty
                }

                // Add new row
                var newRow = $('<tr class="cloning_row" id="' + numberIncr + '">' +
                    '<td><button type="button" class="btn btn-danger btn-sm delegated-btn"><i class="fa fa-minus"></i></button></td>' +
                    '<td><span>{{ __('panel.course_objective') }} (' + numberIncr + ')</span></td>' +
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

            // Initialize character counters for existing rows
            $('#course_objectives_details tbody').find('input.course_objective').each(function() {
                initializeCharCounter($(this));
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

            // Add row functionality remains unchanged
            $(document).on('click', '.btn_add_requirement', function() {
                let trCount = $('#course_requirements_details').find('tr.cloning_row:last').length;
                let numberIncr = trCount > 0 ? parseInt($('#course_requirements_details').find(
                        'tr.cloning_row:last')
                    .attr('id')) + 1 : 0;
                let isValid = true;

                // Check if any of the existing fields are empty
                $('#course_requirements_details').find('input.course_requirement').each(function() {
                    if ($(this).val() === '') {
                        isValid = false;
                        return false; // Exit the loop if any field is empty
                    }
                });

                if (!isValid) {
                    alert(
                        '{{ __('panel.msg_please_fill_in_all_requirement_fields_before_adding_new') }}'
                    );
                    return false; // Prevent adding a new row if existing fields are empty
                }

                // Add new row
                var newRow = $('<tr class="cloning_row" id="' + numberIncr + '">' +
                    '<td><button type="button" class="btn btn-danger btn-sm delegated-btn"><i class="fa fa-minus"></i></button></td>' +
                    '<td><span>{{ __('panel.course_requirement') }} (' + numberIncr +
                    ')</span></td>' +
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

            // Initialize character counters for existing rows
            $('#course_requirements_details tbody').find('input.course_requirement').each(function() {
                initializeCharCounter($(this));
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

            // Submit event handler for the form
            $('#my_form_id').on('submit', function(event) {
                // Flag to track whether there are empty fields
                let isEmpty = false;

                // Loop through each input field and check if it's empty
                $('input.course_intended').each(function() {
                    if ($(this).val() === '') {
                        isEmpty = true;
                        return false; // Exit the loop if any field is empty
                    }
                });

                // If any field is empty, prevent the form submission
                if (isEmpty) {
                    alert('{{ __('panel.msg_one_or_more_intended_field_empty') }}.');
                    event.preventDefault(); // Prevent form submission
                }
            });

            // Add row functionality remains unchanged
            $(document).on('click', '.btn_add_intended', function() {
                let trCount = $('#course_intendeds_details').find('tr.cloning_row:last').length;
                let numberIncr = trCount > 0 ? parseInt($('#course_intendeds_details').find(
                        'tr.cloning_row:last')
                    .attr('id')) + 1 : 0;
                let isValid = true;

                // Check if any of the existing fields are empty
                $('#course_intendeds_details').find('input.course_intended').each(function() {
                    if ($(this).val() === '') {
                        isValid = false;
                        return false; // Exit the loop if any field is empty
                    }
                });

                if (!isValid) {
                    alert(
                        '{{ __('panel.msg_please_fill_in_all_intended_fields_before_adding_new') }}'
                    );
                    return false; // Prevent adding a new row if existing fields are empty
                }

                // Add new row
                var newRow = $('<tr class="cloning_row" id="' + numberIncr + '">' +
                    '<td><button type="button" class="btn btn-danger btn-sm delegated-btn"><i class="fa fa-minus"></i></button></td>' +
                    '<td><span>{{ __('panel.course_intended') }} (' + numberIncr +
                    ')</span></td>' +
                    '<td>' +
                    '<div class="input-group">' +
                    '<input type="text" name="course_intended[' + numberIncr +
                    ']" class="course_intended form-control" maxlength="160">' +
                    '<span class="input-group-text">160</span>' +
                    '</div>' +
                    '</td>' +
                    '</tr>');
                $('#course_intendeds_details tbody').append(newRow);

                // Initialize character counter for the new row
                initializeCharCounter(newRow.find('input.course_intended'));
            });

            // Initialize character counters for existing rows
            $('#course_intendeds_details tbody').find('input.course_intended').each(function() {
                initializeCharCounter($(this));
            });

            // Remove row when delete button is clicked
            $(document).on('click', '.delegated-btn', function(e) {
                e.preventDefault();
                $(this).closest('tr').remove();
            });
        });
    </script>
@endsection
