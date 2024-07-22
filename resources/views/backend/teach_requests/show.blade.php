@extends('layouts.admin')
@section('content')
    {{-- first section --}}
    <div class="card shadow mb-4">

        {{-- breadcrumb part  --}}
        <div class="card-header py-3 d-flex flex-column flex-sm-row justify-content-between">

            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-edit"></i>
                    {{ __('transf.Course Landing Page') }}
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
                        <a href="{{ route('admin.teach_requests.index') }}">
                            {{ __('panel.show_courses') }}
                        </a>
                    </li>
                </ul>
            </div>


            <div class="ml-auto mt-3 mt-sm-0">
                <form action="{{ route('admin.teach_requests.update_teach_requests_status', $teach_request->id) }}"
                    method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-row align-items-center">
                        <label class="sr-only" for="inlineFormInputGroupOrderStatus">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">{{ __('panel.course_status') }}</div>
                            </div>
                            <select name="teach_request_status" style="outline-style:none;" onchange="this.form.submit()"
                                class="form-control">


                                <option value=""> {{ __('panel.course_choose_appropriate_event') }} </option>
                                @foreach ($teach_request_status_array as $key => $value)
                                    <option value="{{ $key }}"> {{ $value }}</option>
                                @endforeach

                            </select>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        {{-- <div class="row">
            <div class="col-xs-12 col-sm-8">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>{{ __('transf.course_title') }}</th>
                                <td>{{ $teach_request->title }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('transf.Course subtitle') }}</th>
                                <td>
                                    {{ $teach_request->subtitle }}
                                </td>
                            </tr>
                            <tr>
                            </tr>
                            <tr>
                                <th> {{ __('panel.created_at') }} </th>
                                <td>{{ $teach_request->created_at->format('Y-m-d h:i a') }}</td>
                            </tr>
                            <tr>
                                <th> {{ __('panel.course_status') }}</th>
                                <td>{!! $teach_request->statusWithLabel() !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4">
                @php
                    if ($teach_request->photos->first() != null && $teach_request->photos->first()->file_name != null) {
                        $teach_request_image = asset('assets/courses/' . $teach_request->photos->first()->file_name);

                        if (!file_exists(public_path('assets/courses/' . $teach_request->photos->first()->file_name))) {
                            $teach_request_image = asset('image/not_found/item_image_not_found.webp');
                        }
                    } else {
                        $teach_request_image = asset('image/not_found/item_image_not_found.webp');
                    }
                @endphp
                <img src="{{ $teach_request_image }}" style="display: block;width:100%;height:200px;"
                    alt="{{ $teach_request->title }}">
            </div>
        </div> --}}

    </div>
@endsection
