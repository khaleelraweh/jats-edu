@extends('layouts.admin')

@section('content')
    {{-- main holder page  --}}
    <div class="card shadow mb-4">

        {{-- breadcrumb part  --}}
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-plus-square"></i>
                    {{ __('panel.add_new_slider') }}
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
                        <a href="{{ route('admin.advertisor_sliders.index') }}">
                            {{ __('panel.show_adv_slider') }}
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

            <form action="{{ route('admin.advertisor_sliders.store') }}" method="post" enctype="multipart/form-data">
                @csrf

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
                        <button class="nav-link" id="url-tab" data-bs-toggle="tab" data-bs-target="#url" type="button"
                            role="tab" aria-controls="url" aria-selected="true">{{ __('panel.url_tab') }}
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
                    {{-- Content Tab --}}

                    @foreach (config('locales.languages') as $key => $val)
                        <div class="tab-pane fade {{ $loop->index == 0 ? 'show active' : '' }}" id="{{ $key }}"
                            role="tabpanel" aria-labelledby="{{ $key }}">
                            <div class="row">

                                {{--  Icons --}}

                                @if ($loop->first)
                                    <div class="row ">
                                        <div class="col-sm-12 pt-3">
                                            <div class="form-group">
                                                <label for="icon"> {{ __('panel.choose_icon') }} </label>

                                                <div class="input-group iconpicker-container ">
                                                    <input data-placement="bottomRight"
                                                        class="form-control icp icp-auto iconpicker-element iconpicker-input icon-picker form-control"
                                                        value="fas fa-archive" type="text" name="icon">
                                                    <span class="input-group-addon btn btn-primary">
                                                        <i class="fas fa-archive"></i>
                                                    </span>
                                                </div>

                                                @error('icon')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- slider title field --}}
                                <div class="row ">
                                    <div class="col-sm-12 pt-3">
                                        <div class="form-group">
                                            <label for="title[{{ $key }}]">
                                                {{ __('panel.title') }}
                                                {{ __('panel.in') }} {{ __('panel.' . $key) }}
                                            </label>
                                            <input type="text" name="title[{{ $key }}]"
                                                id="title[{{ $key }}]" value="{{ old('title.' . $key) }}"
                                                class="form-control">
                                            @error('title.' . $key)
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
                                        <textarea name="description[{{ $key }}]" rows="10" class="form-control" id="tinymceExample">
                                            {!! old('description.' . $key) !!}
                                        </textarea>
                                    </div>
                                </div>



                            </div>
                        </div>
                    @endforeach

                    {{-- url Tab --}}
                    <div class="tab-pane fade" id="url" role="tabpanel" aria-labelledby="url-tab">


                        {{-- Button One URL --}}
                        <div class="row">
                            <div class="col-md-12 col-sm-12 pt-4">
                                <label for="btn_one_url">{{ __('panel.btn_one_url_adv') }}</label>
                                <input type="text" name="btn_one_url" id="btn_one_url"
                                    value="{{ old('btn_one_url', $data->btn_one_url ?? '') }}" class="form-control"
                                    placeholder="http://example.com">
                                @error('btn_one_url')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Button One Target --}}
                        <div class="row">
                            <div class="col-sm-12 col-md-12 pt-4">
                                <label for="btn_one_target">{{ __('panel.btn_one_target') }}</label>
                                <select name="btn_one_target" class="form-control">
                                    <option value="_self"
                                        {{ old('btn_one_target', $data->btn_one_target ?? '_self') == '_self' ? 'selected' : null }}>
                                        {{ __('panel.in_the_same_tab') }}
                                    </option>
                                    <option value="_blank"
                                        {{ old('btn_one_target', $data->btn_one_target ?? '_self') == '_blank' ? 'selected' : null }}>
                                        {{ __('panel.in_new_tab') }}
                                    </option>
                                </select>
                                @error('btn_one_target')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                    </div>


                    {{-- Published Tab --}}
                    <div class="tab-pane fade" id="published" role="tabpanel" aria-labelledby="published-tab">

                        {{-- publish_start publish time field --}}
                        <div class="row">
                            <div class="col-sm-12 col-md-12 pt-4">
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
                            <div class="col-sm-12 col-md-12 pt-4">
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
                            <div class="col-sm-12 col-md-12 pt-4">
                                <label for="status">{{ __('panel.status') }}</label>
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

                        {{-- show info field --}}
                        <div class="row">
                            <div class="col-sm-12 col-md-12 pt-4">
                                <label for="showInfo">{{ __('panel.show_slider_info') }}</label>
                                <select name="showInfo" class="form-control">
                                    <option value="1" {{ old('showInfo') == '1' ? 'selected' : null }}>
                                        {{ __('panel.yes') }}
                                    </option>
                                    <option value="0" {{ old('showInfo') == '0' ? 'selected' : null }}>
                                        {{ __('panel.no') }}
                                    </option>
                                </select>
                                @error('showInfo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>


                    <div class="form-group pt-4">
                        <button type="submit" name="submit" class="btn btn-primary">
                            {{ __('panel.save_data') }}</button>
                    </div>
                </div>

            </form>
        </div>

    </div>

@endsection

@section('script')
    <script>
        $(function() {


            // ======= start pickadate codeing ===========
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
            // ======= End pickadate codeing ===========

            $('.summernote').summernote({
                tabSize: 2,
                height: 120,
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
