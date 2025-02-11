@extends('layouts.admin')
@section('content')
    {{-- First Section: Course Overview --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-column flex-sm-row justify-content-between align-items-center">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary mb-0">
                    <i class="fa fa-edit mr-2"></i>
                    {{ __('transf.Course Landing Page') }}
                </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.index') }}">{{ __('panel.main') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.courses.index') }}">{{ __('panel.show_courses') }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $course->title }}</li>
                    </ol>
                </nav>
            </div>
            <div class="mt-3 mt-sm-0">
                <form action="{{ route('admin.courses.update_course_status', $course->id) }}" method="post"
                    class="form-inline">
                    @csrf
                    @method('PUT')
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">{{ __('panel.course_status') }}</span>
                        </div>
                        <select name="course_status" class="form-control" onchange="this.form.submit()">
                            <option value="">{{ __('panel.course_choose_appropriate_event') }}</option>
                            @foreach ($course_status_array as $key => $value)
                                <option value="{{ $key }}" {{ $course->status == $key ? 'selected' : '' }}>
                                    {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>{{ __('transf.course_title') }}</th>
                                    <td>{{ $course->title }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('transf.Course subtitle') }}</th>
                                    <td>{{ $course->subtitle }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('panel.created_at') }}</th>
                                    <td>{{ $course->created_at->format('Y-m-d h:i a') }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('panel.course_status') }}</th>
                                    <td>{!! $course->statusWithLabel() !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-4">
                    @php
                        $course_image =
                            $course->photos->first() && $course->photos->first()->file_name
                                ? asset('assets/courses/' . $course->photos->first()->file_name)
                                : asset('image/not_found/placeholder.jpg');
                        if (!file_exists(public_path('assets/courses/' . $course->photos->first()->file_name))) {
                            $course_image = asset('image/not_found/placeholder.jpg');
                        }
                    @endphp
                    <img src="{{ $course_image }}" class="img-fluid rounded shadow" alt="{{ $course->title }}">
                </div>
            </div>
        </div>
    </div>

    {{-- Second Section: Course Description --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="font-weight-bold text-primary mb-0">
                <i class="fa fa-edit mr-2"></i>
                {{ __('transf.Course Landing Page') }}
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <textarea name="description" id="tinymceExample" rows="10" class="form-control">{!! old('description', $course->description) !!}</textarea>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ $course->video_promo }}" class="d-block text-center" data-fancybox>
                                <div class="position-relative">
                                    <img src="{{ $course_image }}" class="img-fluid rounded shadow" alt="Promo Video">
                                    <div class="position-absolute top-50 start-50 translate-middle">
                                        <div class="bg-white rounded-circle p-3">
                                            <i class="fa fa-play text-primary fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Third Section: Course Information --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="font-weight-bold text-primary mb-0">
                <i class="fa fa-edit mr-2"></i>
                {{ __('transf.course_info_tab') }}
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>{{ __('transf.Course Language') }}</th>
                                    <td>{{ $course->language() }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('transf.Course Level') }}</th>
                                    <td>{{ $course->skill_level() }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('transf.Course type') }}</th>
                                    <td>{{ $course->course_type() }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('transf.course_category_title') }}</th>
                                    <td>{{ $course->courseCategory->title }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('transf.certificate') }}</th>
                                    <td>{{ $course->certificate() }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('transf.deadline_of_the_course') }}</th>
                                    <td>{{ $course->deadline }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>{{ __('panel.price') }}</th>
                                    <td>{{ $course->price }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('panel.offer_price') }}</th>
                                    <td>{{ $course->offer_price }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('panel.offer_ends') }}</th>
                                    <td>{{ $course->offer_ends }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('panel.published_date') }}</th>
                                    <td>{{ $course->published_on }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('panel.status') }}</th>
                                    <td>{{ $course->status() }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('transf.Descriptional video') }}</th>
                                    <td>
                                        <a href="{{ $course->video_description }}" class="btn btn-link p-0">Click here to
                                            see</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Fourth Section: Course Objectives --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="font-weight-bold text-primary mb-0">
                <i class="fa fa-edit mr-2"></i>
                {{ __('transf.intended_learners') }}
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="font-weight-bold text-primary">
                        <i class="fa fa-edit mr-2"></i>
                        {{ __('transf.what_will_students_learn_in_your_course?') }}
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                                @if ($course->objectives->isNotEmpty())
                                    @foreach ($course->objectives as $index => $item)
                                        <tr>
                                            <th style="width: 45px;">{{ $index + 1 }}.</th>
                                            <td>{{ $item->title }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="2" class="text-muted">No objectives available.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4 class="font-weight-bold text-primary">
                        <i class="fa fa-edit mr-2"></i>
                        {{ __('transf.what_are_the_requirements_or_prerequisites_for_taking_your_course?') }}
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                                @if ($course->requirements->isNotEmpty())
                                    @foreach ($course->requirements as $index => $item)
                                        <tr>
                                            <th style="width: 45px;">{{ $index + 1 }}.</th>
                                            <td>{{ $item->title }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="2" class="text-muted">No requirements available.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <h4 class="font-weight-bold text-primary mt-4">
                        <i class="fa fa-edit mr-2"></i>
                        {{ __('transf.who_is_this_course_for?') }}
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                                @if ($course->intendeds->isNotEmpty())
                                    @foreach ($course->intendeds as $index => $item)
                                        <tr>
                                            <th style="width: 45px;">{{ $index + 1 }}.</th>
                                            <td>{{ $item->title }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="2" class="text-muted">No intended learners specified.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Fifth Section: Course Curriculum --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="font-weight-bold text-primary mb-0">
                <i class="fa fa-edit mr-2"></i>
                {{ __('transf.curriculum') }}
            </h3>
        </div>
        <div class="card-body">
            @if ($course->sections->isNotEmpty())
                <div class="accordion" id="courseSectionsAccordion">
                    @foreach ($course->sections as $index => $section)
                        <div class="card mb-3">
                            <div class="card-header" id="sectionHeading{{ $index }}">
                                <h3 class="mb-0">
                                    <button class="btn btn-link btn-block text-left text-primary font-weight-bold"
                                        type="button" data-toggle="collapse"
                                        data-target="#sectionCollapse{{ $index }}" aria-expanded="true"
                                        aria-controls="sectionCollapse{{ $index }}">
                                        <i class="fa fa-edit mr-2"></i>
                                        {{ $section->title }}
                                    </button>
                                </h3>
                            </div>
                            <div id="sectionCollapse{{ $index }}"
                                class="collapse {{ $index === 0 ? 'show' : '' }}"
                                aria-labelledby="sectionHeading{{ $index }}"
                                data-parent="#courseSectionsAccordion">
                                <div class="card-body">
                                    @if ($section->lessons->isNotEmpty())
                                        <div class="list-group">
                                            @foreach ($section->lessons as $lesson)
                                                <div
                                                    class="list-group-item list-group-item-action flex-column align-items-start">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <h5 class="mb-1">{{ $lesson->title }}</h5>
                                                        <small>{{ $lesson->duration_minutes }}
                                                            {{ __('panel.mins') }}</small>
                                                    </div>
                                                    <div class="mt-2">
                                                        <a href="{{ $lesson->url }}"
                                                            class="btn btn-outline-primary btn-sm" target="_blank">
                                                            <i class="fa fa-play-circle mr-1"></i>
                                                            {{ __('panel.watch_video') }}
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted">No lessons available in this section.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">No sections available for this course.</p>
            @endif
        </div>
    </div>
@endsection
