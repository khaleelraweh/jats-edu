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

    {{-- main holder certificate  --}}
    <div class="card shadow mb-4">

        {{-- breadcrumb part  --}}
        <div class="card-header py-3 d-flex justify-content-between">

            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-plus-square"></i>
                    {{ __('panel.add_new_certificate') }}
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
                        <a href="{{ route('admin.certificates.index') }}">
                            {{ __('panel.show_certificates') }}
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


            <form action="{{ route('admin.certificates.store') }}" method="post">
                @csrf

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="content-tab" data-bs-toggle="tab" data-bs-target="#content"
                            type="button" role="tab" aria-controls="content"
                            aria-selected="true">{{ __('panel.content_tab') }}
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="published-tab" data-bs-toggle="tab" data-bs-target="#published"
                            type="button" role="tab" aria-controls="published"
                            aria-selected="false">{{ __('panel.published_tab') }}
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

                        <hr>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="course_id">{{ __('panel.courses') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" class="form-control typeahead2" name="course_name" id="course_name"
                                    value="{{ old('course_name', request()->input('course_name')) }}"
                                    placeholder="{{ __('panel.type_student_name_or_email') }}">
                                <input type="hidden" class="form-control" name="course_id" id="course_id"
                                    value="{{ old('course_id', request()->input('course_id')) }}" readonly>
                                @error('course_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="published" role="tabpanel" aria-labelledby="published-tab">

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="published_on"> {{ __('panel.published_date') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" id="published_on" name="published_on"
                                    value="{{ old('published_on', now()->format('Y-m-d')) }}" class="form-control">
                                @error('published_on')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="published_on_time"> {{ __('panel.published_time') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" id="published_on_time" name="published_on_time"
                                    value="{{ old('published_on_time', now()->format('h:m A')) }}" class="form-control">
                                @error('published_on_time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="status"> {{ __('panel.status') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
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

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group pt-3 ">
                                <button type="submit" name="submit" class="btn btn-primary">
                                    {{ __('panel.save_data') }}
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
    <script src="{{ asset('backend/vendor/typeahead/bootstrap3-typeahead.min.js') }}"></script>


    <script>
        $(function() {

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

            $(".typeahead2").typeahead({
                autoSelect: true,
                minLength: 3,
                // delay: 400,
                delay: 200,
                displayText: function(item) {
                    return item.full_name + ' - ' + item.email;
                },
                source: function(query, process) {
                    return $.get("{{ route('admin.courses.get_courses') }}", {
                        'query': query
                    }, function(data) {
                        return process(data);
                    });
                },

                afterSelect: function(data) {
                    $('#course_id').val(data.id);

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
@endsection
