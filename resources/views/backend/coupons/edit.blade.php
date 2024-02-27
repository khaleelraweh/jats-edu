@extends('layouts.admin')

@section('content')

    {{-- main holder page  --}}
    <div class="card shadow mb-4">

        {{-- breadcrumb part  --}}
        <div class="card-header py-3 d-flex justify-content-between">

            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-edit"></i>
                    {{ __('panel.edit_existing_coupon') }}
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
                        <a href="{{ route('admin.coupons.index') }}">
                            {{ __('panel.show_coupons') }}
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
            <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                {{-- links of tabs --}}
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="content-tab" data-bs-toggle="tab" data-bs-target="#content"
                            type="button" role="tab" aria-controls="content"
                            aria-selected="true">{{ __('panel.content_tab') }}</button>
                    </li>


                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="published-tab" data-bs-toggle="tab" data-bs-target="#published"
                            type="button" role="tab" aria-controls="published"
                            aria-selected="false">{{ __('panel.published_tab') }}</button>
                    </li>

                </ul>

                <div class="tab-content" id="myTabContent">

                    {{-- content tab --}}
                    <div class="tab-pane fade active show" id="content" role="tabpanel" aria-labelledby="content-tab">

                        <div class="row">

                            <div class="col-sm-12 col-md-7">

                                <div class="row ">
                                    @foreach (config('locales.languages') as $key => $val)
                                        <div class="col-sm-12 col-md-<?php echo 12 / count(config('locales.languages')); ?> pt-3">
                                            <div class="form-group">
                                                <label for="code[{{ $key }}]">{{ __('panel.coupon_code') }}
                                                    ({{ $key }})
                                                </label>
                                                <input type="text" name="code[{{ $key }}]"
                                                    id="code[{{ $key }}]"
                                                    value="{{ old('code.' . $key, $coupon->getTranslation('code', $key)) }}"
                                                    class="form-control">
                                                @error('code.' . $key)
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-6 pt-4">
                                        <label for="type"> {{ __('panel.coupon_type') }}</label>
                                        <select name="type" class="form-control">
                                            <option value="">---</option>
                                            <option value="fixed"
                                                {{ old('type', $coupon->type) == 'fixed' ? 'selected' : null }}>
                                                {{ __('panel.static_value') }}
                                            </option>
                                            <option value="percentage"
                                                {{ old('type', $coupon->type) == 'percentage' ? 'selected' : null }}>
                                                {{ __('panel.percentage_value') }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-6 pt-4">
                                        <div class="form-group">
                                            <label for="value"> {{ __('panel.coupon_value') }} </label>
                                            <input type="number" id="value" name="value"
                                                value="{{ old('value', $coupon->value) }}" class="form-control">
                                            @error('value')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- start date and expired date of the coupon use  --}}
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 pt-4">
                                        <div class="form-group">
                                            <label for="start_date"> {{ __('panel.coupon_start_date') }} </label>
                                            <input type="text" id="start_date" name="start_date"
                                                value="{{ old('start_date', $coupon->start_date->format('Y-m-d')) }}"
                                                class="form-control">
                                            @error('start_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 pt-4">
                                        <div class="form-group">
                                            <label for="expire_date"> {{ __('panel.coupon_expire_date') }} </label>
                                            <input type="text" id="expire_date" name="expire_date"
                                                value="{{ old('expire_date', $coupon->expire_date->format('Y-m-d')) }}"
                                                class="form-control">
                                            @error('expire_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                {{-- greater than field  --}}
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 pt-4">
                                        <div class="form-group">
                                            <label for="use_times"> {{ __('panel.use_time') }} </label>
                                            <input type="number" id="use_times" name="use_times"
                                                value="{{ old('use_times', $coupon->use_times) }}" class="form-control">
                                            @error('use_times')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 pt-4">
                                        <div class="form-group">
                                            <label for="greater_than"> {{ __('panel.price_greater_than') }} </label>
                                            <input type="number" id="greater_than" name="greater_than"
                                                value="{{ old('greater_than', $coupon->greater_than) }}"
                                                class="form-control">
                                            @error('greater_than')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="col-sm-12 col-md-5">

                                {{-- links of tabs --}}
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    @foreach (config('locales.languages') as $key => $val)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link {{ $loop->index == 0 ? 'active' : '' }}"
                                                id="{{ $key }}-tab" data-bs-toggle="tab"
                                                data-bs-target="#{{ $key }}" type="button" role="tab"
                                                aria-controls="{{ $key }}" aria-selected="true">
                                                {{ __('panel.coupon_description') }}({{ $key }})
                                            </button>
                                        </li>
                                    @endforeach

                                </ul>

                                <div class="tab-content" id="myTabContent">
                                    @foreach (config('locales.languages') as $key => $val)
                                        <div class="tab-pane fade {{ $loop->index == 0 ? 'show active' : '' }}"
                                            id="{{ $key }}" role="tabpanel"
                                            aria-labelledby="{{ $key }}">

                                            <div class="row">
                                                <div class="col-sm-12">

                                                    {{--  description field --}}
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-12 pt-3">
                                                            <label for="description[{{ $key }}]">
                                                                {{ __('panel.coupon_description') }}
                                                                {{ __('panel.in') }} {{ __('panel.' . $key) }}
                                                            </label>
                                                            <textarea name="description[{{ $key }}]" rows="10" class="form-control summernote">
                                                                {!! old('description.' . $key, $coupon->getTranslation('description', $key)) !!}
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Publish Tab --}}
                    <div class="tab-pane fade" id="published" role="tabpanel" aria-labelledby="published-tab">

                        <div class="row">
                            <div class="col-sm-12 col-md-12 pt-4">
                                <div class="form-group">
                                    <label for="published_on">{{ __('panel.published_date') }} </label>
                                    <input type="text" id="published_on" name="published_on"
                                        value="{{ old('published_on', \Carbon\Carbon::parse($coupon->published_on)->Format('Y-m-d')) }}"
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
                                    <label for="published_on_time"> {{ __('panel.published_time') }}</label>
                                    <input type="text" id="published_on_time" name="published_on_time"
                                        value="{{ old('published_on_time', \Carbon\Carbon::parse($coupon->published_on)->Format('h:i A')) }}"
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
                                        {{ old('status', $coupon->status) == '1' ? 'selected' : null }}>
                                        {{ __('panel.status_active') }}
                                    </option>
                                    <option value="0"
                                        {{ old('status', $coupon->status) == '0' ? 'selected' : null }}>
                                        {{ __('panel.status_inactive') }}
                                    </option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group pt-3">
                                <button type="submit" name="submit" class="btn btn-primary">
                                    {{ __('panel.update_data') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>







            </form>
        </div>

    </div>

@endsection

@section('script')
    {{-- pickadate calling js --}}

    <script src="{{ asset('backend/vendor/datepicker/picker.js') }}"></script>
    <script src="{{ asset('backend/vendor/datepicker/picker.date.js') }}"></script>
    <script>
        $(function() {

            // ======= start pickadate codeing ===========
            $('#start_date').pickadate({
                format: 'yyyy-mm-dd',
                min: new Date(),
                selectMonths: true, // Creates a dropdown to control month
                selectYears: true, // creates a dropdown to control years
                clear: 'Clear',
                close: 'OK',
                colseOnSelect: true // Close Upon Selecting a date
            });

            $('#expire_date').pickadate({
                format: 'yyyy-mm-dd',
                min: new Date(),
                selectMonths: true, // Creates a dropdoen to control month
                selectYears: true, // Creates a dropdown to control month 
                clear: 'Clear',
                close: 'OK',
                colseOnSelect: true // Close upon selecting a date ,
            });

            var startdate = $('#start_date').pickadate(
                'picker'); // set startdate in the picker to the start date in the #start_date elemet
            var enddate = $('#expire_date').pickadate('picker');

            // when change date 
            $('#start_date').change(function() {
                selected_ci_date = "";
                selected_ci_date = $('#start_date')
                    .val(); // make selected start date in picker = start_date value
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


            // ======= End pickadate codeing ===========

            // ======= start pickadate codeing  for start and end date ===========
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
                selected_ci_date = now() // make selected start date in picker = start_date value  

            });

            $('#published_on_time').pickatime({
                clear: ''
            });
            // ======= End pickadate codeing for publish start and end date  ===========

            $('#code').keyup(function() {
                this.value = this.value.toUpperCase();
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


        });
    </script>
@endsection
