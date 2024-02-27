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
                        {{ __('panel.show_site_socail') }}
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

            <form action="{{ route('admin.site_socials.update', 3) }}" method="post">
                @csrf

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="content-tab" data-toggle="tab" href="#content" role="tab"
                            aria-controls="content" aria-selected="true">بيانات المحتوي</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade active show" id="content" role="tabpanel" aria-labelledby="content-tab">

                        <div class="row">
                            <div class="col-md-12 col-sm-12 pt-3">
                                @php
                                    $site = SiteSetting::where('name', 'site_facebook')
                                        ->get()
                                        ->first();
                                @endphp
                                <div class="form-group">
                                    <label for="{{ $site->name }}">
                                        facebook <i class="fab fa-facebook"></i>
                                        :
                                    </label>
                                    <input type="text" id="{{ $site->name }}" name="{{ $site->name }}"
                                        value="{{ old($site->name, $site->value) }}" class="form-control"
                                        placeholder="{{ $site->name }}">
                                    @error('{{ $site->name }}')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-12 col-sm-12 pt-3">
                                @php
                                    $site = SiteSetting::where('name', 'site_twitter')
                                        ->get()
                                        ->first();
                                @endphp
                                <div class="form-group">
                                    <label for="{{ $site->name }}">
                                        twitter <i class="fab fa-twitter"></i>
                                        :</label>
                                    <input type="text" id="{{ $site->name }}" name="{{ $site->name }}"
                                        value="{{ old($site->name, $site->value) }}" class="form-control"
                                        placeholder="{{ $site->name }}">
                                    @error('{{ $site->name }}')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                        </div>


                        <div class="row">

                            <div class="col-md-12 col-sm-12 pt-3">
                                @php
                                    $site = SiteSetting::where('name', 'site_youtube')
                                        ->get()
                                        ->first();
                                @endphp
                                <div class="form-group">
                                    <label for="{{ $site->name }}">
                                        youtube <i class="fab fa-youtube"></i>
                                        :</label>
                                    <input type="text" id="{{ $site->name }}" name="{{ $site->name }}"
                                        value="{{ old($site->name, $site->value) }}" class="form-control"
                                        placeholder="{{ $site->name }}">
                                    @error('{{ $site->name }}')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                        </div>


                        <div class="row">

                            <div class="col-md-12 col-sm-12 pt-3">
                                @php
                                    $site = SiteSetting::where('name', 'site_snapchat')
                                        ->get()
                                        ->first();
                                @endphp
                                <div class="form-group">
                                    <label for="{{ $site->name }}">
                                        snapchat <i class="fab fa-snapchat"></i>
                                        :</label>
                                    <input type="text" id="{{ $site->name }}" name="{{ $site->name }}"
                                        value="{{ old($site->name, $site->value) }}" class="form-control"
                                        placeholder="{{ $site->name }}">
                                    @error('{{ $site->name }}')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                        </div>


                        <div class="row">

                            <div class="col-md-12 col-sm-12 pt-3">
                                @php
                                    $site = SiteSetting::where('name', 'site_instagram')
                                        ->get()
                                        ->first();
                                @endphp
                                <div class="form-group">
                                    <label for="{{ $site->name }}">
                                        instagram <i class="fab fa-instagram"></i>
                                        :</label>
                                    <input type="text" id="{{ $site->name }}" name="{{ $site->name }}"
                                        value="{{ old($site->name, $site->value) }}" class="form-control"
                                        placeholder="{{ $site->name }}">
                                    @error('{{ $site->name }}')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-12 col-sm-12 pt-3">
                                @php
                                    $site = SiteSetting::where('name', 'site_google')
                                        ->get()
                                        ->first();
                                @endphp
                                <div class="form-group">
                                    <label for="{{ $site->name }}">
                                        google <i class="fab fa-google"></i>
                                        :</label>
                                    <input type="text" id="{{ $site->name }}" name="{{ $site->name }}"
                                        value="{{ old($site->name, $site->value) }}" class="form-control"
                                        placeholder="{{ $site->name }}">
                                    @error('{{ $site->name }}')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 pt-3">
                                @php
                                    $site = SiteSetting::where('name', 'site_vimeo')
                                        ->get()
                                        ->first();
                                @endphp
                                <div class="form-group">
                                    <label for="{{ $site->name }}">
                                        vimeo <i class="fab fa-vimeo"></i>
                                        :</label>
                                    <input type="text" id="{{ $site->name }}" name="{{ $site->name }}"
                                        value="{{ old($site->name, $site->value) }}" class="form-control"
                                        placeholder="{{ $site->name }}">
                                    @error('{{ $site->name }}')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-12 col-sm-12 pt-3">
                                @php
                                    $site = SiteSetting::where('name', 'site_pinterest')
                                        ->get()
                                        ->first();
                                @endphp
                                <div class="form-group">
                                    <label for="{{ $site->name }}">
                                        pinterest <i class="fab fa-pinterest"></i>
                                        :</label>
                                    <input type="text" id="{{ $site->name }}" name="{{ $site->name }}"
                                        value="{{ old($site->name, $site->value) }}" class="form-control"
                                        placeholder="{{ $site->name }}">
                                    @error('{{ $site->name }}')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                        </div>

                    </div>


                </div>

                @ability('admin', 'update_site_socials')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group pt-3 mx-3">
                                <button type="submit" name="submit" class="btn btn-primary">تعديل البيانات</button>
                            </div>
                        </div>
                    </div>
                @endability

            </form>

        </div>

    </div>
@endsection
