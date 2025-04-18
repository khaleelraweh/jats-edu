@extends('layouts.admin')

@section('style')
    <style>
        ul,
        #myUL {
            list-style-type: none;
        }

        #myUL {
            margin: 0;
            padding: 0;
        }

        .caret {
            cursor: pointer;
            -webkit-user-select: none;
            /* Safari 3.1+ */
            -moz-user-select: none;
            /* Firefox 2+ */
            -ms-user-select: none;
            /* IE 10+ */
            user-select: none;
        }

        .caret::before {
            content: "\25B6";
            color: black;
            display: inline-block;
            margin-right: 6px;
        }

        .caret-down::before {
            -ms-transform: rotate(90deg);
            /* IE 9 */
            -webkit-transform: rotate(90deg);
            /* Safari */
            '
     transform: rotate(90deg);
        }

        .nested {
            display: none;
        }

        .active {
            display: block;
        }
    </style>
@endsection

@section('content')

    {{-- main holder sponsor  --}}
    <div class="card shadow mb-4">

        {{-- breadcrumb part  --}}
        <div class="card-header py-3 d-flex justify-content-between">

            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-plus-square"></i>
                    {{ __('panel.add_new_sponsor') }}
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
                        <a href="{{ route('admin.sponsors.index') }}">
                            {{ __('panel.show_sponsors') }}
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


            <form action="{{ route('admin.sponsors.store') }}" method="post" enctype="multipart/form-data">
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

                        @foreach (config('locales.languages') as $key => $val)
                            <div class="row ">
                                <div class="col-sm-12 col-md-2 pt-3">
                                    <label for="name[{{ $key }}]">
                                        {{ __('panel.sponsor_name') }}
                                        {{ __('panel.in') }} ({{ __('panel.' . $key) }})
                                    </label>
                                </div>
                                <div class="col-sm-12 col-md-10 pt-3">
                                    <input type="text" name="name[{{ $key }}]" id="name[{{ $key }}]"
                                        value="{{ old('name.' . $key) }}" class="form-control">
                                    @error('name.' . $key)
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                        @endforeach

                        <hr>

                        @foreach (config('locales.languages') as $key => $val)
                            <div class="row ">
                                <div class="col-sm-12 col-md-2 pt-3">
                                    <label for="address[{{ $key }}]">
                                        {{ __('panel.sponsor_address') }}
                                        {{ __('panel.in') }} ({{ __('panel.' . $key) }})
                                    </label>
                                </div>
                                <div class="col-sm-12 col-md-10 pt-3">
                                    <input type="text" name="address[{{ $key }}]"
                                        id="address[{{ $key }}]" value="{{ old('address.' . $key) }}"
                                        class="form-control">
                                    @error('address.' . $key)
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                        @endforeach

                        <hr>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="phone"> {{ __('panel.phone_number') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                    class="form-control">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="email"> {{ __('panel.email_address') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    class="form-control">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="pox"> {{ __('panel.pox') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" id="pox" name="pox" value="{{ old('pox') }}"
                                    class="form-control">
                                @error('pox')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="website"> {{ __('panel.website') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" id="website" name="website" value="{{ old('website') }}"
                                    class="form-control">
                                @error('website')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <hr>
                        <div class="row ">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="logo"> {{ __('panel.sponsor_logo') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <div class="file-loading">
                                    <input type="file" name="logo" id="logo" value="{{ old('logo') }}"
                                        class="file-input-overview ">
                                    @error('logo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>

                        @foreach (config('locales.languages') as $key => $val)
                            <div class="row ">
                                <div class="col-sm-12 col-md-2 pt-3">
                                    <label for="coordinator_name[{{ $key }}]">
                                        {{ __('panel.coordinator_name') }}
                                        {{ __('panel.in') }} ({{ __('panel.' . $key) }})
                                    </label>
                                </div>
                                <div class="col-sm-12 col-md-10 pt-3">
                                    <input type="text" name="coordinator_name[{{ $key }}]"
                                        id="coordinator_name[{{ $key }}]"
                                        value="{{ old('coordinator_name.' . $key) }}" class="form-control">
                                    @error('coordinator_name.' . $key)
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                        @endforeach

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="coordinator_phone"> {{ __('panel.coordinator_phone') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" id="coordinator_phone" name="coordinator_phone"
                                    value="{{ old('coordinator_phone') }}" class="form-control">
                                @error('coordinator_phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-2 pt-3">
                                <label for="coordinator_email"> {{ __('panel.coordinator_email') }}</label>
                            </div>
                            <div class="col-sm-12 col-md-10 pt-3">
                                <input type="text" id="coordinator_email" name="coordinator_email"
                                    value="{{ old('coordinator_email') }}" class="form-control">
                                @error('coordinator_email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <hr>


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

                        <hr>

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
    <script>
        $(function() {
            $("#logo").fileinput({
                theme: "fa5",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false
            })

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
