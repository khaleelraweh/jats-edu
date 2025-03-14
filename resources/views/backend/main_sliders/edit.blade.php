@extends('layouts.admin')

@section('content')

    {{-- main holder page  --}}
    <div class="card shadow mb-4">

        {{-- breadcrumb part  --}}
        <div class="card-header py-3 d-flex justify-content-between">

            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-edit"></i>
                    {{ __('panel.edit_existing_slider') }}
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
                        <a href="{{ route('admin.main_sliders.index') }}">
                            {{ __('panel.show_main_slider') }}
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
            <form action="{{ route('admin.main_sliders.update', $mainSlider->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')

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

                                {{-- البيانات الاساسية --}}
                                <div class=" {{ $loop->index == 0 ? 'col-md-7' : '' }} col-sm-12 ">

                                    {{-- slider title field --}}
                                    <div class="row ">
                                        <div class="col-sm-12 pt-3">
                                            <div class="form-group">
                                                <label for="title[{{ $key }}]">
                                                    {{ __('panel.title') }}
                                                    {{ __('panel.in') }} {{ __('panel.' . $key) }}
                                                </label>
                                                <input type="text" name="title[{{ $key }}]"
                                                    id="title[{{ $key }}]"
                                                    value="{{ old('title.' . $key, $mainSlider->getTranslation('title', $key)) }}"
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
                                            {!! old('description.' . $key, $mainSlider->getTranslation('description', $key)) !!}
                                        </textarea>
                                        </div>
                                    </div>
                                </div>

                                {{-- مرفق الصور  --}}
                                <div class=" {{ $loop->index == 0 ? 'col-md-5' : 'd-none' }}  col-sm-12 ">

                                    <div class="row pt-4">
                                        <div class="col-12">
                                            <label for="images">{{ __('panel.image') }}/
                                                {{ __('panel.images') }}
                                                <span><small> ( {{ __('panel.best_size') }}: 1920 * 960 )</small></span>

                                            </label>

                                            <br>
                                            <div class="file-loading">
                                                <input type="file" name="images[]" id="slider_images"
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
                    @endforeach

                    {{-- url Tab --}}
                    <div class="tab-pane fade" id="url" role="tabpanel" aria-labelledby="url-tab">

                        {{-- <div class="row">
                            <div class="col-md-12 col-sm-12 pt-4">
                                <label for="url">{{ __('panel.url_link') }}</label>
                                <input type="text" name="url" id="url"
                                    value="{{ old('url', $mainSlider->url) }}" class="form-control"
                                    placeholder="http://youtlinks.com ">
                                @error('url')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-12 pt-4 pt-4">
                                <label for="target">{{ __('panel.url_target') }} </label>
                                <select name="target" class="form-control">
                                    <option value="_self"
                                        {{ old('target', $mainSlider->target) == '_self' ? 'selected' : null }}>
                                        {{ __('panel.in_the_same_tab') }}
                                    </option>
                                    <option value="_blank"
                                        {{ old('target', $mainSlider->target) == '_blank' ? 'selected' : null }}>
                                        {{ __('panel.in_new_tab') }}
                                    </option>
                                </select>
                                @error('target')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> --}}


                        {{-- slider btn_one name field --}}
                        @foreach (config('locales.languages') as $key => $val)
                            <div class="row ">
                                <div class="col-sm-12 pt-3">
                                    <div class="form-group">
                                        <label for="btn_one_name[{{ $key }}]">
                                            {{ __('panel.btn_one_name') }}
                                            {{ __('panel.in') }} {{ __('panel.' . $key) }}
                                        </label>
                                        <input type="text" name="btn_one_name[{{ $key }}]"
                                            id="btn_one_name[{{ $key }}]"
                                            value="{{ old('btn_one_name.' . $key, $mainSlider->getTranslation('btn_one_name', $key)) }}"
                                            class="form-control">
                                        @error('btn_one_name.' . $key)
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- Button One URL --}}
                        <div class="row">
                            <div class="col-md-12 col-sm-12 pt-4">
                                <label for="btn_one_url">{{ __('panel.btn_one_url') }}</label>
                                <input type="text" name="btn_one_url" id="btn_one_url"
                                    value="{{ old('btn_one_url', $mainSlider->btn_one_url ?? '') }}" class="form-control"
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
                                        {{ old('btn_one_target', $mainSlider->btn_one_target ?? '_self') == '_self' ? 'selected' : null }}>
                                        {{ __('panel.in_the_same_tab') }}
                                    </option>
                                    <option value="_blank"
                                        {{ old('btn_one_target', $mainSlider->btn_one_target ?? '_self') == '_blank' ? 'selected' : null }}>
                                        {{ __('panel.in_new_tab') }}
                                    </option>
                                </select>
                                @error('btn_one_target')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Button One Show --}}
                        <div class="row">
                            <div class="col-sm-12 col-md-12 pt-4">
                                <label for="btn_one_show">{{ __('panel.btn_one_show') }}</label>
                                <select name="btn_one_show" class="form-control">
                                    <option value="1"
                                        {{ old('btn_one_show', $mainSlider->btn_one_show ?? 1) == 1 ? 'selected' : null }}>
                                        {{ __('panel.show') }}
                                    </option>
                                    <option value="0"
                                        {{ old('btn_one_show', $mainSlider->btn_one_show ?? 1) == 0 ? 'selected' : null }}>
                                        {{ __('panel.hide') }}
                                    </option>
                                </select>
                                @error('btn_one_show')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        {{-- Button Two Name (JSON Field) --}}
                        @foreach (config('locales.languages') as $key => $val)
                            <div class="row ">
                                <div class="col-sm-12 pt-3">
                                    <div class="form-group">
                                        <label for="btn_two_name[{{ $key }}]">
                                            {{ __('panel.btn_two_name') }}
                                            {{ __('panel.in') }} {{ __('panel.' . $key) }}
                                        </label>
                                        <input type="text" name="btn_two_name[{{ $key }}]"
                                            id="btn_two_name[{{ $key }}]"
                                            value="{{ old('btn_two_name.' . $key, $mainSlider->getTranslation('btn_two_name', $key)) }}"
                                            class="form-control">
                                        @error('btn_two_name.' . $key)
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- Button Two URL --}}
                        <div class="row">
                            <div class="col-md-12 col-sm-12 pt-4">
                                <label for="btn_two_url">{{ __('panel.btn_two_url') }}</label>
                                <input type="text" name="btn_two_url" id="btn_two_url"
                                    value="{{ old('btn_two_url', $mainSlider->btn_two_url ?? '') }}" class="form-control"
                                    placeholder="http://example.com">
                                @error('btn_two_url')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Button Two Target --}}
                        <div class="row">
                            <div class="col-sm-12 col-md-12 pt-4">
                                <label for="btn_two_target">{{ __('panel.btn_two_target') }}</label>
                                <select name="btn_two_target" class="form-control">
                                    <option value="_self"
                                        {{ old('btn_two_target', $mainSlider->btn_two_target ?? '_self') == '_self' ? 'selected' : null }}>
                                        {{ __('panel.in_the_same_tab') }}
                                    </option>
                                    <option value="_blank"
                                        {{ old('btn_two_target', $mainSlider->btn_two_target ?? '_self') == '_blank' ? 'selected' : null }}>
                                        {{ __('panel.in_new_tab') }}
                                    </option>
                                </select>
                                @error('btn_two_target')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Button Two Show --}}
                        <div class="row">
                            <div class="col-sm-12 col-md-12 pt-4">
                                <label for="btn_two_show">{{ __('panel.btn_two_show') }}</label>
                                <select name="btn_two_show" class="form-control">
                                    <option value="1"
                                        {{ old('btn_two_show', $mainSlider->btn_two_show ?? 1) == 1 ? 'selected' : null }}>
                                        {{ __('panel.show') }}
                                    </option>
                                    <option value="0"
                                        {{ old('btn_two_show', $mainSlider->btn_two_show ?? 1) == 0 ? 'selected' : null }}>
                                        {{ __('panel.hide') }}
                                    </option>
                                </select>
                                @error('btn_two_show')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
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
                                        value="{{ old('published_on', \Carbon\Carbon::parse($mainSlider->published_on)->Format('Y-m-d')) }}"
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
                                        value="{{ old('published_on_time', \Carbon\Carbon::parse($mainSlider->published_on)->Format('h:i A')) }}"
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
                                        {{ old('status', $mainSlider->status) == '1' ? 'selected' : null }}>
                                        {{ __('panel.status_active') }}
                                    </option>
                                    <option value="0"
                                        {{ old('status', $mainSlider->status) == '0' ? 'selected' : null }}>
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
                                    <option value="1"
                                        {{ old('showInfo', $mainSlider->showInfo) == '1' ? 'selected' : null }}>
                                        {{ __('panel.yes') }}
                                    </option>
                                    <option value="0"
                                        {{ old('showInfo', $mainSlider->showInfo) == '0' ? 'selected' : null }}>
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
                            {{ __('panel.update_data') }}
                        </button>
                    </div>
                </div>

            </form>
        </div>

    </div>

@endsection

@section('script')
    <script>
        $(function() {

            $("#slider_images").fileinput({
                theme: "fa5",
                maxFileCount: 5,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                // اضافات للتعامل مع الصورة عند التعديل علي احد اقسام المنتجات
                // delete images from photos and assets/sliders 
                // because there are maybe more than one image we will go for each image and show them in the edit page 
                initialPreview: [
                    @if ($mainSlider->photos()->count() > 0)
                        @foreach ($mainSlider->photos as $media)
                            "{{ asset('assets/main_sliders/' . $media->file_name) }}",
                        @endforeach
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                    @if ($mainSlider->photos()->count() > 0)
                        @foreach ($mainSlider->photos as $media)
                            {
                                caption: "{{ $media->file_name }}",
                                size: '{{ $media->file_size }}',
                                width: "120px",
                                // url : الراوت المستخدم لحذف الصورة
                                url: "{{ route('admin.main_sliders.remove_image', ['image_id' => $media->id, 'slider_id' => $mainSlider->id, '_token' => csrf_token()]) }}",
                                key: {{ $media->id }}
                            },
                        @endforeach
                    @endif

                ]
            }).on('filesorted', function(event, params) {
                console.log(params.previewId, params.oldIndex, params.newIndex, params.stack);
            });

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
            $('#published_on').change(function() {
                selected_ci_date = "";
                selected_ci_date = now() // make selected start date in picker = start_date value  

            });

            $('#published_on_time').pickatime({
                clear: ''
            });

            // ======= End pickadate codeing for publish start and end date  ===========



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
