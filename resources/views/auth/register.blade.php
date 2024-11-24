@extends('layouts.app')

@section('style')
    <style>
        .iti {
            width: 100%;
        }

        /* Custom style for error messages */
        .invalid-feedback {
            font-size: 0.875rem;
            /* Adjust font size for better responsiveness */
        }
    </style>
@endsection

@section('content')
    <section class="py-3 pref">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">{{ __('transf.txt_sign_up_and_start_learning') }}</h1>
                </div>
                <div class="col-lg-6 text-lg-end">
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 ">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="h5 text-uppercase mb-3">{{ __('transf.Create a new account') }}</h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group mb-5">
                        <label for="first_name">
                            <i class="fa fa-user custom-color"></i>
                            {{ __('panel.first_name') }}
                            <span class="required">*</span>
                        </label>
                        <input type="text" name="first_name" id="first_name" class="form-control"
                            value="{{ old('first_name') }}" placeholder="{{ __('panel.first_name') }}">

                        @error('first_name')
                            <div class="invalid-feedback d-block">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="last_name">
                            <i class="fa fa-user custom-color"></i>
                            {{ __('panel.last_name') }}
                            <span class="required">*</span>
                        </label>
                        <input type="text" name="last_name" id="last_name" class="form-control"
                            value="{{ old('last_name') }}" placeholder="{{ __('panel.last_name') }}">

                        @error('last_name')
                            <div class="invalid-feedback d-block">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="username">
                            <i class="fa fa-user custom-color"></i>
                            {{ __('panel.user_name') }}
                            <span class="required">*</span>
                        </label>
                        <input type="text" name="username" id="username" class="form-control"
                            value="{{ old('username') }}" placeholder="{{ __('panel.user_name') }}">

                        @error('username')
                            <div class="invalid-feedback d-block">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="email">
                            <i class="fa fa-envelope custom-color"></i>
                            {{ __('panel.f_user_email') }} <span class="required">*</span>
                        </label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{ old('email') }}" placeholder="your@email.com" autocomplete="email"
                            autocapitalize="none">

                        @error('email')
                            <div class="invalid-feedback d-block">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="mobile">
                            <i class="fa fa-phone custom-color"></i>
                            {{ __('panel.f_phone_number') }}
                            <span class="required">*</span>
                        </label>

                        <input id="full_mobile_number" type="hidden" name="full_mobile_number"
                            value="{{ old('full_mobile_number') }}">
                        <input id="mobile" type="text" name="mobile" class="form-control"
                            value="{{ old('mobile') }}">

                        @error('full_mobile_number')
                            <div class="invalid-feedback d-block">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="password">
                            <i class="fa fa-user custom-color"></i>
                            {{ __('panel.f_user_password') }}
                            <span class="required">*</span>
                        </label>
                        <input type="password" name="password" id="password" class="form-control" value=""
                            placeholder="{{ __('panel.f_password') }}">

                        @error('password')
                            <div class="invalid-feedback d-block">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="password_confirmation">
                            <i class="fa fa-user custom-color"></i>
                            {{ __('panel.f_confirm_password') }}
                            <span class="required">*</span>
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                            value="" placeholder="{{ __('panel.f_confirm_password') }}">

                        @error('password_confirmation')
                            <div class="invalid-feedback d-block">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button class="btn btn-block btn-primary" type="submit">
                            {{ __('transf.btn_sign_up') }}
                        </button>
                    </div>
                    <div class="mt-3"></div>
                    <h6 class="small-body-subtitle">
                        {{ __('transf.Do you have an account ?') }}
                        <a href="{{ route('login') }}">
                            <span> {{ __('transf.lnk_login') }}</span>
                        </a>
                    </h6>
                </form>
            </div>
        </div>
    </section>
@endsection


@section('script')
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@24.6.0/build/js/intlTelInput.min.js"></script>
    <script>
        // For the account modal
        const inputModal = document.querySelector("#phone");
        const hiddenInputModal = document.querySelector("#output");

        const itiModal = window.intlTelInput(inputModal, {
            initialCountry: "us",
            nationalMode: false,
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@24.6.0/build/js/utils.js"
        });

        const handleChangeModal = () => {
            if (inputModal.value && itiModal.isValidNumber()) {
                const fullNumberModal = itiModal.getNumber();
                hiddenInputModal.value = fullNumberModal;
            } else {
                hiddenInputModal.value = '';
            }
        };

        inputModal.addEventListener('change', handleChangeModal);
        inputModal.addEventListener('keyup', handleChangeModal);



        const inputRegister = document.querySelector("#mobile");
        const hiddenInputRegister = document.querySelector("#full_mobile_number");

        const itiRegister = window.intlTelInput(inputRegister, {
            initialCountry: "us",
            nationalMode: false,
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@24.6.0/build/js/utils.js"
        });

        const handleChangeRegister = () => {
            if (inputRegister.value && itiRegister.isValidNumber()) {
                const fullNumberRegister = itiRegister.getNumber();
                hiddenInputRegister.value = fullNumberRegister;
            } else {
                hiddenInputRegister.value = '';
            }
        };

        inputRegister.addEventListener('change', handleChangeRegister);
        inputRegister.addEventListener('keyup', handleChangeRegister);
    </script>
@endsection
