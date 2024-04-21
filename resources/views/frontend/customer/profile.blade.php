@extends('layouts.app')
@section('content')
    <header class="bg-white py-5 py-lg-5 position-relative mb-5" style="background-image: none;">
        <div class="container text-center py-xl-5">
            <h1 class="display-4 fw-semi-bold mb-0">
                <a href="{{ route('customer.profile') }}">
                    {{ __('transf.txt_profile') }}
                </a>
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-scroll justify-content-center">
                    <li class="breadcrumb-item">
                        <a class="text-gray-800" href="{{ route('frontend.index') }}">
                            {{ __('transf.lnk_home') }}
                        </a>
                    </li>
                    <li class="breadcrumb-item text-gray-800 active" aria-current="page">
                        <a href="{{ route('customer.profile') }}">
                            {{ __('transf.txt_profile') }}
                        </a>

                    </li>
                </ol>
            </nav>
        </div>
        <!-- Img -->

        <img class="position-absolute position-center-y right-0 mw-300p mw-xl-450p me-md-6 d-none d-lg-block img-fluid"
            src="{{ asset('assets/courses/il1.png') }}" alt="...">
    </header>

    <section class="py-5">
        <div class="row m-0">

            <div class="col-lg-12 ">
                <div class="container">
                    {{-- <h2 class="h5 text-uppercase mb-4">General Information</h2> --}}
                    <form class="pref" action="{{ route('customer.update_profile') }}" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-lg-12 text-center mb-4">
                                @if (auth()->user()->user_image != '')
                                    <img src="{{ asset('assets/users/' . auth()->user()->user_image) }}"
                                        alt="{{ auth()->user()->full_name }}" class="img-thumbnail rounded-pill"
                                        width="120">

                                    <div class="mt-2">
                                        <a href="{{ route('customer.remove_profile_image') }}"
                                            class="btn btn-sm btn-outline-danger bg-danger  btn-slide slide-white btn-wide shadow mb-4 mb-md-0 me-md-5 text-uppercase">{{ __('panel.f_delete_image') }}</a>
                                    </div>
                                @else
                                    <img src="{{ asset('assets/users/avatar.svg') }}"
                                        alt="{{ auth()->user()->full_name }}" class="img-thumbnail" width="120">
                                @endif
                            </div>

                            <div class="col-lg-6 form-group pt-2">
                                <label class="text-small text-uppercase" for="first_name">
                                    {{ __('panel.first_name') }}
                                </label>
                                <input class="form-control form-control-lg" name="first_name" type="text"
                                    value="{{ old('first_name', auth()->user()->first_name) }}">
                                @error('first_name')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 form-group pt-2">
                                <label class="text-small text-uppercase" for="last_name"> {{ __('panel.last_name') }}
                                </label>
                                <input class="form-control form-control-lg" name="last_name" type="text"
                                    value="{{ old('last_name', auth()->user()->last_name) }}">
                                @error('last_name')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 form-group pt-2">
                                <label class="text-small text-uppercase" for="email">{{ __('panel.f_email') }}</label>
                                <input class="form-control form-control-lg" name="email" type="text"
                                    value="{{ old('email', auth()->user()->email) }}">
                                @error('email')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 form-group pt-2">
                                <label class="text-small text-uppercase" for="mobile"> {{ __('panel.f_phone_number') }}
                                </label>
                                <input class="form-control form-control-lg" name="mobile" type="text"
                                    value="{{ old('mobile', auth()->user()->mobile) }}">
                                @error('mobile')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 form-group pt-2">
                                <label class="text-small text-uppercase" for="password"> {{ __('panel.f_password') }}
                                    <small class="ml-auto text-danger">(Optional)</small></label>
                                <input class="form-control form-control-lg" name="password" type="text"
                                    value="{{ old('password') }}">
                                @error('password')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-6 form-group pt-2">
                                <label class="text-small text-uppercase" for="password_confirmation">
                                    {{ __('panel.f_confirm_password') }}
                                    <small class="ml-auto text-danger">({{ __('panel.optional') }})</small> </label>
                                <input class="form-control form-control-lg" name="password_confirmation" type="text"
                                    value="{{ old('password_confirmation') }}">
                                @error('password_confirmation')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-12 form-group pt-2">
                                <label class="text-small text-uppercase" for="user_image">{{ __('panel.image') }}</label>
                                <input class="form-control form-control-lg" name="user_image" type="file"
                                    value="{{ old('user_image') }}">
                                @error('user_image')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-12 form-group pt-3">
                                <button class="btn  pref-link" type="submit"> {{ __('panel.update') }}
                                    {{ __('panel.f_profile') }} </button>
                            </div>

                        </div>
                    </form>

                </div>

            </div>


            {{-- SIDEBAR --}}
            {{-- <div class="col-lg-4">
                @include('partial.frontend.customer.sidebar')
            </div> --}}
        </div>
    </section>
@endsection
