@extends('layouts.admin')

@section('content')
    {{-- main holder page  --}}
    <div class="card shadow mb-4">

        {{-- breadcrumb part  --}}
        <div class="card-header py-3 d-flex justify-content-between">

            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-edit"></i>
                    {{ __('panel.edit_existing_page') }}
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
                        <a href="{{ route('admin.pages.index') }}">
                            {{ __('panel.show_pages') }}
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

            <form action="{{ route('admin.pages.update', $page->id) }}" method="post">
                @csrf
                @method('PATCH')

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

                    <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="content-tab">

                        <div class="row ">

                            <div class="col-sm-12 col-md-12 pt-3">
                                <label for="parent_id" class="control-label">
                                    {{ __('panel.category_menu') }}
                                </label>
                                <select name="parent_id" class="form-control">
                                    <option value="">{{ __('panel.main_category') }} __</option>

                                    {{-- @foreach ($main_menus->where('section', 1) as $main_menu) --}}
                                    @foreach ($main_menus as $main_menu)
                                        @if (count($main_menu->appearedChildren) == false)
                                            <option style="color: black;font-weight: bold;font-size:18px;"
                                                value="{{ $main_menu->id }}"
                                                {{ old('parent_id', $page->web_menu_id) == $main_menu->id ? 'selected' : null }}>
                                                {{ $main_menu->title }}
                                            </option>
                                        @else
                                            <option style="color: black;font-weight: bold;font-size:18px;"
                                                value="{{ $main_menu->id }}"
                                                {{ old('parent_id', $page->web_menu_id) == $main_menu->id ? 'selected' : null }}>
                                                {{ $main_menu->title }}
                                            </option>
                                            @if ($main_menu->appearedChildren !== null && count($main_menu->appearedChildren) > 0)
                                                @foreach ($main_menu->appearedChildren as $sub_menu)
                                                    @if (count($sub_menu->appearedChildren) == false)
                                                        <option style="color:blue;font-weight:bold;font-size:15px;"
                                                            value="{{ $sub_menu->id }}"
                                                            {{ old('parent_id', $page->web_menu_id) == $sub_menu->id ? 'selected' : null }}>
                                                            &nbsp; &nbsp; &nbsp;{{ $sub_menu->title }}
                                                        </option>
                                                    @else
                                                        <option style="color:blue;font-weight:bold;font-size:15px;"
                                                            value="{{ $sub_menu->id }}"
                                                            {{ old('parent_id', $page->web_menu_id) == $sub_menu->id ? 'selected' : null }}>
                                                            &nbsp; &nbsp; &nbsp;{{ $sub_menu->title }}
                                                        </option>
                                                        @if ($sub_menu->appearedChildren !== null && count($sub_menu->appearedChildren) > 0)
                                                            @foreach ($sub_menu->appearedChildren as $sub_menu_2)
                                                                <option style="font-size: 14px;"
                                                                    value="{{ $sub_menu_2->id }}"
                                                                    {{ old('parent_id', $page->web_menu_id) == $sub_menu_2->id ? 'selected' : null }}>
                                                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                                    &nbsp;{{ $sub_menu_2->title }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endif
                                            </li>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <div class="row ">
                            @foreach (config('locales.languages') as $key => $val)
                                <div class="col-sm-12 col-md-6 pt-3">
                                    <div class="form-group">
                                        <label for="title[{{ $key }}]">
                                            {{ __('panel.title') }}
                                            {{ __('panel.in') }}
                                            ({{ __('panel.' . $key) }})
                                        </label>
                                        <input type="text" name="title[{{ $key }}]"
                                            id="title[{{ $key }}]"
                                            value="{{ old('title.' . $key, $page->getTranslation('title', $key)) }}"
                                            class="form-control">
                                        @error('title.' . $key)
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="row ">
                            @foreach (config('locales.languages') as $key => $val)
                                <div class="col-sm-12 col-md-6 pt-3">
                                    <div class="form-group">
                                        <label for="content[{{ $key }}]">
                                            {{ __('panel.f_content') }}
                                            {{ __('panel.in') }}
                                            ({{ __('panel.' . $key) }})
                                        </label>
                                        <textarea id="elm1" name="content[{{ $key }}]" rows="10" class="form-control ">{!! old('content.' . $key, $page->getTranslation('content', $key)) !!}</textarea>

                                        {{-- <textarea id="elm1"  name="area"></textarea> --}}


                                        @error('content.' . $key)
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <div class="tab-pane fade" id="published" role="tabpanel" aria-labelledby="published-tab">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 pt-3">
                                <div class="form-group">
                                    <label for="published_on"> {{ __('panel.published_date') }}</label>
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
                                    <label for="published_on_time"> {{ __('panel.published_time') }}</label>
                                    <input type="text" id="published_on_time" name="published_on_time"
                                        value="{{ old('published_on_time', now()->format('h:m A')) }}"
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
    <script>
        $(function() {
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

        });
    </script>
@endsection