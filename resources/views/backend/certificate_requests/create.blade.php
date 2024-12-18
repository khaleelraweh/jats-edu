@extends('layouts.admin')

@section('content')

    {{-- main holder certificate_request  --}}
    <div class="card shadow mb-4">

        {{-- breadcrumb part  --}}
        <div class="card-header py-3 d-flex justify-content-between">

            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-plus-square"></i>
                    {{ __('panel.add_new_certificate_request') }}
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
                        <a href="{{ route('admin.certificate_requests.index') }}">
                            {{ __('panel.show_certificate_requests') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- body part  --}}
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form action="{{ route('admin.certificate_requests.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="content-tab" data-bs-toggle="tab" data-bs-target="#content"
                            type="button" role="tab" aria-controls="content"
                            aria-selected="true">{{ __('panel.content_tab') }}
                        </button>
                    </li>

                </ul>

                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="content-tab">


                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="user_id">{{ __('panel.student_account') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" class="form-control typeahead" name="customer_name" id="customer_name"
                                    value="{{ old('customer_name', request()->input('customer_name')) }}"
                                    placeholder="{{ __('panel.type_student_name_or_email') }}">
                                <input type="hidden" class="form-control" name="user_id" id="user_id"
                                    value="{{ old('user_id', request()->input('user_id')) }}" readonly>
                                @error('user_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        @foreach (config('locales.languages') as $key => $val)
                            <div class="row ">
                                <div class="col-sm-12 col-md-2 pt-3">
                                    <label for="full_name[{{ $key }}]">
                                        {{ __('panel.full_name') }}
                                        {{ __('panel.in') }} ({{ __('panel.' . $key) }})
                                    </label>
                                </div>
                                <div class="col-sm-12 col-md-10 pt-3">
                                    <input type="text" name="full_name[{{ $key }}]"
                                        id="full_name[{{ $key }}]" value="{{ old('full_name.' . $key) }}"
                                        class="form-control">
                                    @error('full_name.' . $key)
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                        @endforeach

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="date_of_birth">
                                    {{ __('panel.date_of_birth') }}
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="input-group flatpickr" id="flatpickr-datebirth">
                                    <input type="text" name="date_of_birth" value="{{ old('date_of_birth') }}"
                                        class="form-control" placeholder="Select date" data-input>
                                    <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                                @error('date_of_birth')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="nationality">
                                    {{ __('panel.address_of_residence') }}
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="row">
                                    <div class="col-sm-12 col-md-3">
                                        <select id="nationality" name="nationality" class="form-control">
                                            <option value="">{{ __('panel.nationality') }}</option>
                                            @foreach (getCountries() as $country)
                                                <option value="{{ $country->id }}"
                                                    {{ old('nationality') == $country->id ? 'selected' : '' }}>
                                                    {{ app()->getLocale() == 'ar' ? $country->translations['ar'] : $country->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('nationality')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-3">

                                        <select name="country" id="country" class="form-control">
                                            <option value="">{{ __('panel.country') }}</option>
                                            @forelse ($countries as $country)
                                                <option value="{{ $country->id }}"
                                                    {{ old('country') == $country->id ? 'selected' : null }}>
                                                    {{ app()->getLocale() == 'ar' ? $country->translations['ar'] : $country->name }}

                                                </option>
                                            @empty
                                            @endforelse
                                        </select>
                                        @error('country_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <input type="text" class="form-control " name="state" id="state"
                                            value="{{ old('state') }}" placeholder="{{ __('panel.state') }}">
                                        @error('state')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <input type="text" class="form-control " name="city" id="city"
                                            value="{{ old('city') }}" placeholder="{{ __('panel.city') }}">
                                        @error('city')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="nationality">
                                    {{ __('panel.phone_number') }}
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" class="form-control " name="phone" id="phone"
                                    value="{{ old('phone') }}" placeholder="{{ __('panel.phone') }}">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="nationality">
                                    {{ __('panel.whatsup_phone') }}
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" class="form-control " name="whatsup_phone" id="whatsup_phone"
                                    value="{{ old('whatsup_phone') }}" placeholder="{{ __('panel.whatsup_phone') }}">
                                @error('whatsup_phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="status" class="control-label">
                                    <span>{{ __('panel.identity_type') }}</span>
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="identity_type"
                                        id="identity_type_passport" value="1"
                                        {{ old('identity_type', '1') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="identity_type_passport">
                                        {{ __('panel.identity_type_passport') }}
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="identity_type"
                                        id="identity_type_personal_card" value="0"
                                        {{ old('identity_type') == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="identity_type_personal_card">
                                        {{ __('panel.identity_type_personal_card') }}
                                    </label>
                                </div>
                                @error('identity_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="nationality">
                                    {{ __('panel.identity_number') }}
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" class="form-control " name="identity_number" id="identity_number"
                                    value="{{ old('identity_number') }}"
                                    placeholder="{{ __('panel.identity_number') }}">
                                @error('identity_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="identity_expiration_date" class="control-label">
                                    <span>{{ __('panel.identity_expiration_date') }}</span>
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="input-group flatpickr" id="flatpickr-identityExpirationDate">
                                    <input type="text" name="identity_expiration_date"
                                        value="{{ old('identity_expiration_date') }}" class="form-control"
                                        placeholder="Select date" data-input>
                                    <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                                @error('identity_expiration_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="identity_attachment"> {{ __('panel.identity_attachment') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="file-loading">
                                    <input type="file" name="identity_attachment" id="identity_attachment"
                                        value="{{ old('identity_attachment') }}" class="file-input-overview ">
                                    @error('identity_attachment')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <hr>




                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="course_id"> {{ __('panel.course_name') }} </label>
                            </div>

                            <div class="col-sm-12 col-md-10 pt-3">
                                <select name="course_id" id="course_id" class="form-control select2 child">
                                    <option value="">{{ __('panel.select_course') }}</option>
                                    @forelse ($courses as $course)
                                        <option value="{{ $course->id }}"
                                            {{ (old('course_id') ?? ($certificate_request->course_id ?? '')) == $course->id ? 'selected' : '' }}>
                                            {{ $course->title }}
                                        </option>
                                    @empty
                                        <option value="">{{ __('panel.no_courses_available') }}</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="certificate_name">
                                    {{ __('panel.certificate_name') }}
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" class="form-control " name="certificate_name"
                                    id="certificate_name" value="{{ old('certificate_name') }}"
                                    placeholder="{{ __('panel.certificate_name') }}">
                                @error('certificate_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="certificate_code">{{ __('panel.certificate_code') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" class="form-control " name="certificate_code"
                                    id="certificate_code" value="{{ old('certificate_code') }}">
                                @error('certificate_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="flatpickr-datetime"> {{ __('panel.certificate_release_date') }} </label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="input-group flatpickr" id="flatpickr-certificateReleaseDate">
                                    <input type="text" name="certificate_release_date"
                                        value="{{ old('certificate_release_date') }}" class="form-control"
                                        placeholder="Select date" data-input>
                                    <span class="input-group-text input-group-addon" data-toggle>
                                        <i class="fas fa-calendar"></i>
                                    </span>
                                </div>
                                @error('certificate_release_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="row ">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="certificate_file"> {{ __('panel.certification_file') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="file-loading">
                                    <input type="file" name="certificate_file" id="certificate_file"
                                        value="{{ old('certificate_file') }}" class="file-input-overview ">
                                    @error('certificate_file')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="sponser_id"> {{ __('panel.sponser_name') }} </label>
                            </div>

                            <div class="col-sm-12 col-md-10 pt-3">
                                <select name="sponser_id" id="sponser_id" class="form-control select2 child">
                                    <option value="">{{ __('panel.select_sponser') }}</option>
                                    @forelse ($sponsers as $sponser)
                                        <option value="{{ $sponser->id }}"
                                            {{ (old('sponser_id') ?? ($certificate_request->sponser_id ?? '')) == $sponser->id ? 'selected' : '' }}>
                                            {{ $sponser->name }}
                                        </option>
                                    @empty
                                        <option value="">{{ __('panel.no_sponsers_available') }}</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="certificate_status" class="control-label">
                                    <span>{{ __('panel.certificate_status') }}</span>
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="certificate_status"
                                        id="under_review" value="0"
                                        {{ old('certificate_status', '0') == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="under_review">
                                        {{ __('panel.under_review') }}
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="certificate_status"
                                        id="under_treatment" value="1"
                                        {{ old('certificate_status') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="under_treatment">
                                        {{ __('panel.under_treatment') }}
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="certificate_status"
                                        id="released" value="2"
                                        {{ old('certificate_status') == '2' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="released">
                                        {{ __('panel.released') }}
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="certificate_status"
                                        id="rejected" value="3"
                                        {{ old('certificate_status') == '3' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="rejected">
                                        {{ __('panel.rejected') }}
                                    </label>
                                </div>
                                @error('certificate_status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <hr>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="published_on" class="control-label">
                                    <span>{{ __('panel.published_on') }}</span>
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="input-group flatpickr" id="flatpickr-datetime">
                                    <input type="text" name="published_on" value="{{ old('published_on') }}"
                                        class="form-control" placeholder="Select date" data-input>
                                    <span class="input-group-text input-group-addon" data-toggle>
                                        <i data-feather="calendar"></i>
                                    </span>
                                </div>
                                @error('published_on')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="status" class="control-label">
                                    <span>{{ __('panel.status') }}</span>
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="status" id="status_active"
                                        value="1" {{ old('status', '1') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_active">
                                        {{ __('panel.status_active') }}
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="status" id="status_inactive"
                                        value="0" {{ old('status') == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_inactive">
                                        {{ __('panel.status_inactive') }}
                                    </label>
                                </div>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <hr>

                    </div>


                    <div class="row">
                        <div class="col-sm-12 col-md-2 pt-3 d-none d-md-block">
                        </div>
                        <div class="col-sm-12 col-md-10 pt-3">

                            <button type="submit" name="submit" class="btn btn-primary">
                                <i class="icon-lg  me-2" data-feather="corner-down-left"></i>
                                {{ __('panel.save_data') }}
                            </button>

                            <a href="{{ route('admin.certificate_requests.index') }}" name="submit"
                                class=" btn btn-outline-danger">
                                <i class="icon-lg  me-2" data-feather="x"></i>
                                {{ __('panel.cancel') }}
                            </a>

                        </div>
                    </div>

                </div>

            </form>

        </div>

    </div>

@endsection

@section('script')
    <script src="{{ asset('backend/vendor/typeahead/bootstrap3-typeahead.min.js') }}"></script>


    <script>
        $(function() {

            $("#certificate_file").fileinput({
                theme: "fa5",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false
            })

            $("#identity_attachment").fileinput({
                theme: "fa5",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false
            })

            $(".typeahead").typeahead({
                autoSelect: true,
                minLength: 3,
                // delay: 400,
                delay: 200,
                displayText: function(item) {
                    return item.full_name + ' - ' + item.email;
                },
                source: function(query, process) {
                    return $.get("{{ route('admin.customers.get_customers') }}", {
                        'query': query
                    }, function(data) {
                        return process(data);
                    });
                },

                afterSelect: function(data) {
                    $('#user_id').val(data.id);
                    // Update full_name fields for each language
                    @foreach (config('locales.languages') as $key => $val)
                        $('#full_name\\[{{ $key }}\\]').val(data.full_name);
                    @endforeach
                }

            });



            $('#published_on').pickadate({
                format: 'yyyy-mm-dd',
                min: new Date(),
                selectMonths: true,
                selectYears: true,
                clear: 'Clear',
                close: 'OK',
                colseOnSelect: true
            });

            var publishedOn = $('#published_on').pickadate(
                'picker');

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
        });
    </script>

    <script>
        var toggler = document.getElementsByClassName("caret");
        var i;

        for (i = 0; i < toggler.length; i++) {
            toggler[i].addEventListener("click", function() {
                this.parentElement.querySelector(".nested").classList.toggle("active");
                this.classList.toggle("caret-down");
            });
        }
    </script>

    <script>
        $(function() {
            'use strict';

            const locale = "{{ app()->getLocale() }}";

            // datetime picker
            if ($('#flatpickr-datetime').length) {
                const defaultDate = "{{ old('published_on') }}" ?
                    "{{ old('published_on') }}" :
                    new Date(); // Set to now if no old date exists

                flatpickr("#flatpickr-datetime", {
                    enableTime: true,
                    wrap: true,
                    dateFormat: "Y/m/d h:i K",
                    minDate: "today", // Prevent dates before today
                    locale: typeof flatPickrLanguage !== 'undefined' ? flatPickrLanguage : 'en',
                    defaultDate: defaultDate,
                });
            }
            // datebirth picker
            if ($('#flatpickr-datebirth').length) {
                const defaultDate = "{{ old('date_of_birth') }}" ?
                    "{{ old('date_of_birth') }}" :
                    new Date(); // Set to now if no old date exists

                flatpickr("#flatpickr-datebirth", {
                    enableTime: false,
                    wrap: true,
                    dateFormat: "Y/m/d",
                    maxDate: "today", // Prevent dates before today
                    locale: typeof flatPickrLanguage !== 'undefined' ? flatPickrLanguage : 'en',
                    defaultDate: defaultDate,
                });
            }
            // identityExpirationDate picker
            if ($('#flatpickr-identityExpirationDate').length) {
                const defaultDate = "{{ old('identity_expiration_date') }}" ?
                    "{{ old('identity_expiration_date') }}" :
                    new Date(); // Set to now if no old date exists

                flatpickr("#flatpickr-identityExpirationDate", {
                    enableTime: false,
                    wrap: true,
                    dateFormat: "Y/m/d",
                    locale: typeof flatPickrLanguage !== 'undefined' ? flatPickrLanguage : 'en',
                    defaultDate: defaultDate,
                });
            }
            // certificateReleaseDate picker
            if ($('#flatpickr-certificateReleaseDate').length) {
                const defaultDate = "{{ old('certificate_release_date') }}" ?
                    "{{ old('certificate_release_date') }}" :
                    new Date(); // Set to now if no old date exists

                flatpickr("#flatpickr-certificateReleaseDate", {
                    enableTime: false,
                    wrap: true,
                    dateFormat: "Y/m/d",
                    minDate: "today", // Prevent dates before today
                    locale: typeof flatPickrLanguage !== 'undefined' ? flatPickrLanguage : 'en',
                    defaultDate: defaultDate,
                });
            }
        });
    </script>
@endsection
