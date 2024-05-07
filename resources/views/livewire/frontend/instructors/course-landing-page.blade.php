<div>
    <p class="h6 py-3 text-muted">{{ __('transf.Course Landing Page Description') }} </p>

    {{-- main holder page  --}}
    <div class="card shadow mb-4">

        {{-- breadcrumb part  --}}
        <div class="card-header py-3 d-flex justify-content-between">

            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-edit"></i>
                    {{ __('transf.Course Landing Page') }}
                </h3>
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
                        <button class="nav-link active" id="course_content-tab" data-bs-toggle="tab"
                            data-bs-target="#course_content" type="button" role="tab"
                            aria-controls="course_content" aria-selected="true">{{ __('transf.course_content_tab') }}
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="course_info-tab" data-bs-toggle="tab" data-bs-target="#course_info"
                            type="button" role="tab" aria-controls="course_info"
                            aria-selected="true">{{ __('transf.course_info_tab') }}
                        </button>
                    </li>


                </ul>

                {{-- contents of links tabs  --}}
                <div class="tab-content" id="myTabContent">


                    {{-- Course info --}}
                    <div class="tab-pane fade show active" id="course_content" role="tabpanel"
                        aria-labelledby="course_content-tab">

                        <div class="row">
                            {{-- البيانات الاساسية --}}
                            <div class="col-md-12 col-sm-12 ">
                                {{-- course name field --}}
                                <div class="row ">
                                    <div class="col-sm-12 pt-3">
                                        <div class="form-group">
                                            <label for="title">
                                                {{ __('transf.course_title') }}
                                            </label>
                                            <input type="text" name="title" id="title"
                                                value="{{ old('title', $course->title) }}" class="form-control"
                                                placeholder="{{ __('transf.Insert your course title.') }}"
                                                style="height: 45px;">
                                            <span class="text-muted d-inline-block mt-1">
                                                <small>
                                                    {{ __('transf.Insert your course title tip.') }}
                                                </small>
                                            </span>
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
                                            <input type="text" name="subtitle" id="subtitle"
                                                value="{{ old('subtitle', $course->subtitle) }}" class="form-control"
                                                placeholder="{{ __('transf.Insert your course subtitle.') }}"
                                                style="height: 45px;">
                                            <span class="text-muted d-inline-block mt-1">
                                                <small>
                                                    {{ __('transf.Course subtitle tip.') }}
                                                </small>
                                            </span>
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
                                            {{ __('transf.Course description') }}
                                        </label>
                                        <textarea name="description" rows="10" class="form-control summernote"
                                            placeholder="{{ __('transf.Insert your course description.') }}">{!! old('description', $course->description) !!}</textarea>
                                        <span class="text-muted d-inline-block mt-1">
                                            <small>
                                                {{ __('transf.Course description tip.') }}
                                            </small>
                                        </span>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- مرفق الصور  --}}
                            {{-- <div class="col-md-5 col-sm-12 ">

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

                            </div> --}}
                        </div>

                    </div>

                    {{-- Course basic info --}}
                    <div class="tab-pane fade" id="course_info" role="tabpanel" aria-labelledby="course_info-tab">

                        {{-- category name  field --}}
                        <div class="row ">
                            <div class="col-12 pt-4">
                                <label for="category_id"> {{ __('panel.course_title') }}</label>
                                <select name="course_category_id" class="form-control">
                                    <option value=""> {{ __('panel.main_category') }} __
                                    </option>
                                    @forelse ($course_categories as $course_category)
                                        <option value="{{ $course_category->id }}"
                                            {{ old('course_category_id', $course->course_category_id) == $course_category->id ? 'selected' : null }}>
                                            {{ $course_category->title }} </option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>

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


                        {{-- lecture numbers and course duration --}}
                        <div class="row">
                            <div class="col-sm-12 col-md-6 pt-3">
                                <label for="lecture_numbers">{{ __('panel.lecture_numbers') }}</label>
                                <input type="number" name="lecture_numbers" id="lecture_numbers"
                                    value="{{ old('lecture_numbers', $course->lecture_numbers) }}"
                                    class="form-control">
                                @error('lecture_numbers')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="col-sm-12 col-md-6 pt-3">
                                <label for="course_duration">{{ __('panel.course_duration') }}</label>
                                <input type="text" name="course_duration" id="course_duration"
                                    value="{{ old('course_duration', $course->course_duration) }}"
                                    class="form-control" placeholder="8h 17m">
                                @error('course_duration')
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

                        {{-- course type and evaluation --}}
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
                            <div class="col-sm-12 col-md-6 pt-3">
                                <label for="evaluation">{{ __('panel.evaluation') }}</label>
                                <select name="evaluation" class="form-control">
                                    <option value="1"
                                        {{ old('evaluation', $course->evaluation) == '1' ? 'selected' : null }}>
                                        {{ __('panel.evaluation_normal') }}
                                    </option>
                                    <option value="2"
                                        {{ old('evaluation', $course->evaluation) == '2' ? 'selected' : null }}>
                                        {{ __('panel.evaluation_featured') }}
                                    </option>
                                    <option value="3"
                                        {{ old('evaluation', $course->evaluation) == '3' ? 'selected' : null }}>
                                        {{ __('panel.evaluation_best_seller') }}
                                    </option>

                                </select>
                                @error('evaluation')
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




                    <div class="form-group pt-4">
                        <button type="submit" name="submit" class="btn btn-primary">
                            {{ __('panel.update_data') }}
                        </button>
                    </div>


                </div>

            </form>
        </div>

    </div>
</div>
