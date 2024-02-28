@extends('layouts.admin')
@php
    use App\Models\SiteSetting;
@endphp

@section('content')
    {{-- main holder page  --}}
    <div class="card shadow mb-4">

        {{-- breadcrumb part  --}}
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="card-naving">
                <h3 class="font-weight-bold text-primary">
                    <i class="fa fa-folder"></i>
                    {{ __('panel.manage_site_settings') }}

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
                        {{ __('panel.show_site_information') }}
                    </li>
                </ul>
            </div>

            <div class="ml-auto d-none">
                @ability('admin', 'create_main_sliders')
                    <a href="{{ route('admin.main_sliders.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus-square"></i>
                        </span>
                        <span class="text">{{ __('panel.add_new_site_information') }}</span>
                    </a>
                @endability
            </div>

        </div>

        {{-- body part  --}}
        <div class="card-body">

            <form action="{{ route('admin.settings.site_main_infos.update', 1) }}" method="post"
                enctype="multipart/form-data">
                @csrf

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="content-tab" data-toggle="tab" href="#content" role="tab"
                            aria-controls="content" aria-selected="true"> {{ __('panel.content_tab') }} </a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade active show" id="content" role="tabpanel" aria-labelledby="content-tab">

                        <div class="row">

                            <div class="col-md-7 col-sm-12 ">

                                {{-- {{ dd($siteSettings['site_img']->status) }} --}}
                                {{-- {{ dd($siteSettings['site_name']->value) }} --}}

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 pt-3">
                                        <div class="form-group">
                                            <label for="{{ $siteSettings['site_name']->key }}"> {{ __('panel.site_name') }}
                                            </label>
                                            <input type="text" id="{{ $siteSettings['site_name']->key }}"
                                                name="{{ $siteSettings['site_name']->key }}"
                                                value="{{ old($siteSettings['site_name']->key, $siteSettings['site_name']->value) }}"
                                                class="form-control" placeholder="{{ $siteSettings['site_name']->key }}">
                                            @error($siteSettings['site_name']->key)
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 pt-3">
                                        <div class="form-group">
                                            <label for="{{ $siteSettings['site_short_name']->key }}">
                                                {{ __('panel.site_short_name') }} </label>
                                            <input type="text" id="{{ $siteSettings['site_short_name']->key }}"
                                                name="{{ $siteSettings['site_short_name']->key }}"
                                                value="{{ old($siteSettings['site_short_name']->key, $siteSettings['site_short_name']->value) }}"
                                                class="form-control"
                                                placeholder="{{ $siteSettings['site_short_name']->key }}">
                                            @error($siteSettings['site_short_name']->key)
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 pt-3">
                                        @php
                                            $site = SiteSetting::where('key', 'site_description')->get()->first();
                                        @endphp
                                        <div class="form-group">
                                            <label for="{{ $siteSettings['site_description']->key }}">
                                                {{ __('panel.site_description') }} </label>
                                            <input type="text" id="{{ $siteSettings['site_description']->key }}"
                                                name="{{ $siteSettings['site_description']->key }}"
                                                value="{{ old($siteSettings['site_description']->key, $siteSettings['site_description']->value) }}"
                                                class="form-control"
                                                placeholder="{{ $siteSettings['site_description']->key }}">
                                            @error($siteSettings['site_description']->key)
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 pt-3">
                                        <div class="form-group">
                                            <label for="{{ $siteSettings['site_link']->key }}">
                                                {{ __('panel.site_link') }} </label>
                                            <input type="text" id="{{ $siteSettings['site_link']->key }}"
                                                name="{{ $siteSettings['site_link']->key }}"
                                                value="{{ old($siteSettings['site_link']->key, $siteSettings['site_link']->value) }}"
                                                class="form-control" placeholder="{{ $siteSettings['site_link']->key }}">
                                            @error($siteSettings['site_link']->key)
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="col-md-5 col-sm-12">

                                <div class="row pt-4">
                                    <div class="col-12">
                                        <label for="{{ $siteSettings['site_img']->key }}"> {{ __('panel.site_img') }}
                                        </label>
                                        <br>
                                        <div class="file-loading">
                                            <input type="file" name="{{ $siteSettings['site_img']->key }}"
                                                id="customer_image" class="file-input-overview ">
                                            <span class="form-text text-muted">Image width should be 500px x 500px </span>
                                            @error($siteSettings['site_img']->key)
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>


                </div>

                @ability('admin', 'update_site_infos')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group pt-3 mx-3">
                                <button type="submit" name="submit" class="btn btn-primary"> {{ __('panel.update_data') }}
                                </button>
                            </div>
                        </div>
                    </div>
                @endability

            </form>

        </div>

    </div>
@endsection


@section('script')
    <script>
        $(function() {

            $("#customer_image").fileinput({
                theme: "fa5",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                initialPreview: [
                    @if ($siteSettings['site_img']->value != null)
                        "{{ asset('assets/site_settings/' . $siteSettings['site_img']->value) }}",
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                    @if ($siteSettings['site_img']->value != null)
                        {
                            caption: "{{ $siteSettings['site_img']->value }}",
                            size: '1111',
                            width: "120px",
                            url: "{{ route('admin.site_infos.remove_image', ['site_info_id' => $siteSettings['site_img']->id, '_token' => csrf_token()]) }}",
                            key: {{ $siteSettings['site_img']->id }}
                        }
                    @endif
                ]
            });



        });
    </script>
@endsection
