<div class="modal modal-sidebar left fade-left fade" id="accountModal">
    <div class="modal-dialog">
        <div class="modal-content">
            @guest

            <!-- Signin -->
            <div class="collapse show" id="collapseSignin" data-bs-parent="#accountModal">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('transf.txt_login_to_account') }}</h5>
                    <button type="button" class="close text-primary" data-bs-dismiss="modal" aria-label="Close">
                        <!-- Icon -->
                        <svg width="16" height="17" viewBox="0 0 16 17" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.142135 2.00015L1.55635 0.585938L15.6985 14.7281L14.2843 16.1423L0.142135 2.00015Z" fill="currentColor"></path>
                            <path d="M14.1421 1.0001L15.5563 2.41431L1.41421 16.5564L0 15.1422L14.1421 1.0001Z" fill="currentColor"></path>
                        </svg>

                    </button>
                </div>

                <div class="modal-body">
                    <!-- Form Signin -->
                    <form class="mb-5" method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- user name or email --}}
                        <div class="form-group mb-5">
                            <label for="modalSigninEmail">
                                {{ __('transf.lbl_username_or_email') }}
                            </label>
                            <input type="text" name="email" class="form-control  @if ($errors->has('email') || $errors->has('username')) has-error @endif" id="modalSigninEmail" placeholder="{{ __('transf.holder_your_name_or_email') }}" value="{{ old('email') }}">
                            @if ($errors->has('email') || $errors->has('username'))
                            <span class="help">{{ $errors->first('email') }}
                                {{ $errors->first('username') }}</span>
                            @endif
                        </div>

                        <!-- Password -->

                        <div class="form-group mb-5">
                            <label for="modalSigninPassword">
                                Password
                            </label>
                            <input type="password" name="password" required autocomplete="current-password" class="form-control" id="modalSigninPassword" placeholder="{{ __('transf.holder_stars') }}" />

                            @error('password')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>

                        <div class="d-flex align-items-center mb-5 font-size-sm">
                            <div class="form-check">
                                <input class="form-check-input text-gray-800" type="checkbox" id="autoSizingCheck">
                                <label class="form-check-label text-gray-800" for="autoSizingCheck">
                                    {{ __('transf.lbl_remember_me') }}
                                </label>
                            </div>

                            <div class="ms-auto">
                                <a class="text-gray-800" data-bs-toggle="collapse" href="#collapseForgotPassword" role="button" aria-expanded="false" aria-controls="collapseForgotPassword">
                                    {{ __('transf.lnk_forgot_password') }}
                                </a>
                            </div>
                        </div>

                        <!-- Submit -->
                        <button class="btn btn-block btn-primary" type="submit">
                            {{ __('transf.btn_login') }}
                        </button>
                    </form>

                    <!-- Text -->
                    <p class="mb-0 font-size-sm text-center">
                        {{ __('transf.txt_dont_have_an_account') }}
                        <a class="text-underline" data-bs-toggle="collapse" href="#collapseSignup" role="button" aria-expanded="false" aria-controls="collapseSignup">{{ __('transf.lnk_sign_up') }}</a>
                    </p>
                </div>
            </div>
            @else
            <!-- Signin -->
            <div class="collapse show" id="collapseSignin" data-bs-parent="#accountModal">
                <div class="modal-header mb-1 pb-1">
                    <button type="button" class="close text-primary" data-bs-dismiss="modal" aria-label="Close">
                        <!-- Icon -->
                        <svg width="16" height="17" viewBox="0 0 16 17" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.142135 2.00015L1.55635 0.585938L15.6985 14.7281L14.2843 16.1423L0.142135 2.00015Z" fill="currentColor"></path>
                            <path d="M14.1421 1.0001L15.5563 2.41431L1.41421 16.5564L0 15.1422L14.1421 1.0001Z" fill="currentColor"></path>
                        </svg>

                    </button>
                </div>

                <div class="modal-body">
                    <div class="modal-header-content mt-2">
                        <img src="{{ asset('assets/users/' . auth()->user()->user_image) }}" alt="">
                        <div class="mt-2 mt-md-auto">
                            <h6 class="mb-1">
                                <span>{{ __('panel.f_welcome') }} : </span>
                                @if (auth()->user()->full_name != null)
                                <span class="custom-color">{{ auth()->user()?->full_name }}</span>
                                @endif
                            </h6>
                            <h6 class="mb-1 text-muted"> {{ auth()->user()->email }}</h6>
                        </div>

                    </div>
                    @if (auth()->user()->email_verified_at == null)
                    <div class="mt-4">
                        <h5 class=" mb-3"> {{ __('panel.f_insure_user_email') }} </h5>

                        @if (session('resent'))
                        <div class="alert alert-success" role="alert" style="margin-bottom: 5px ; background-color:rgba(200 , 100 , 100,0.3) ; border-radius: 10px">
                            {{ __('panel.f_we_sent_link_insurent_to_your_email') }}
                        </div>
                        @endif

                        {{ __('panel.f_before_start_check_email_to_continue') }}
                        <br> <br>
                        {{ __('panel.f_if_you_didnt_receive_an_email') }},

                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 px-1 py-1 m-0 align-baseline" style="border-radius: 5px">
                                {{ __('panel.f_click_here_to_get_another') }}
                            </button>.
                        </form>
                    </div>
                    @endif


                    @if (auth()->user()->email_verified_at != null)
                    @if (auth()->user()->roles->first()->allowed_route != '')
                    <div class="hr"></div>
                    <ul>
                        <li>
                            <a href="{{ route('admin.index') }}">
                                {{ __('panel.f_control_panel') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.account_settings') }}">
                                {{ __('panel.f_user_profile') }}
                            </a>
                        </li>


                        <div class="hr"></div>

                        <li>
                            <a href="javascript:void(0);" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                {{ __('panel.f_logout') }}
                            </a>
                            <form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                    @else
                    <ul>
                        <div class="hr"></div>
                        <li>
                            <a href="{{ route('customer.profile') }}">
                                {{ __('panel.f_user_profile') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customer.addresses') }}">
                                {{ __('panel.f_user_addresses') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customer.orders') }}">
                                {{ __('panel.f_my_orders') }}
                            </a>
                        </li>
                        <div class="hr"></div>
                        <li>
                            <a href="javascript:void(0);" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                {{ __('panel.f_logout') }}
                            </a>
                            <form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                    @endif
                    @endif

                </div>


            </div>

            @endguest


            <!-- القائمة الجانبية إنشاء حساب جديد -->
            <div class="dropdn-content signup-drop " id="dropdnSignUp">
                <div class="dropdn-content-block">
                    <div class="dropdn-close"><span class="js-dropdn-close">{{ __('panel.close') }}</span></div>
                    <div id="js_signup_panel" class="dropdn-form-wrapper">
                        <div class="mb-4">
                            <img srcset="
                    {{ asset('frontend/images/games/logo-games.webp') }} 1x,
                    {{ asset('frontend/images/games/logo-games2x.webp') }} 2x " alt="{{ __('panel.f_center_pay') }}" width="200">
                        </div>
                        <h5><i class="fa fa-sign-in custom-color"></i> {{ __('panel.f_register') }} </h5>
                        <h6 class="small-body-subtitle"> {{ __('panel.f_do_you_have_an_account') }}
                            <a href="#" class="dropdn-link js-dropdn-link js-dropdn-link only-icon custom-color" data-panel="#dropdnAccount">
                                <span class="main-color"> {{ __('panel.f_login') }} </span>
                            </a>
                        </h6>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group js_login_fe">
                                <p class="form-row mb-3">

                                    <label for="first_name">
                                        <i class="fa fa-user custom-color"></i>
                                        {{ __('panel.first_name') }}
                                        <span class="required">*</span>
                                    </label>

                                    <input type="text" name="first_name" id="first_name" class="form-control form-control--sm rounded-pill" value="" placeholder="{{ __('panel.first_name') }}">

                                    @error('first_name')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </p>
                            </div>

                            <div class="form-group js_login_fe">
                                <p class="form-row mb-3">

                                    <label for="last_name">
                                        <i class="fa fa-user custom-color"></i>
                                        {{ __('panel.last_name') }}
                                        <span class="required">*</span>
                                    </label>

                                    <input type="text" name="last_name" id="last_name" class="form-control form-control--sm rounded-pill" value="" placeholder="{{ __('panel.last_name') }}">

                                    @error('last_name')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </p>
                            </div>

                            <div class="form-group js_login_fe">
                                <p class="form-row mb-3">

                                    <label for="username">
                                        <i class="fa fa-user custom-color"></i>
                                        {{ __('panel.user_name') }}
                                        <span class="required">*</span>
                                    </label>

                                    <input type="text" name="username" id="username" class="form-control form-control--sm rounded-pill" value="" placeholder="{{ __('panel.user_name') }}">

                                    @error('username')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </p>
                            </div>

                            <div class="form-group js_login_fe">
                                <p class="form-row mb-3">

                                    <label for="email">
                                        <i class="fa fa-envelope custom-color"></i>
                                        {{ __('panel.f_user_email') }} <span class="required">*</span>
                                    </label>

                                    <input type="email" name="email" id="email" class="form-control form-control--sm rounded-pill" value="" placeholder="your@email.com" autocomplete="email" autocapitalize="none">

                                    @error('email')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </p>
                            </div>

                            <div class="form-group js_login_fe">
                                <p class="form-row mb-3">
                                    <label for="CustomerCountry">
                                        <i class="fa fa-flag custom-color"></i>
                                        {{ __('panel.country') }}
                                        <span class="required">*</span>
                                    </label>
                                    <select class="select-wrapper rounded-pill" id="CustomerCountry" name="Country">
                                        <option value="8">+967 - اليمن</option>
                                        <option value="1">+966 - السعودية</option>
                                        <option value="2">+971 - الامارات</option>
                                        <option value="3">+965 - الكويت</option>
                                        <option value="4">+974 - قطر</option>
                                    </select>
                                </p>

                            </div>

                            <div class="form-group js_login_fe">
                                <p class="form-row mb-3">

                                    <label for="mobile">
                                        <i class="fa fa-mobile-phone custom-color"></i>
                                        {{ __('panel.f_phone_number') }}
                                        <span class="required">*</span>
                                    </label>

                                    <input type="text" name="mobile" id="mobile" class="form-control form-control--sm rounded-pill" value="" placeholder="{{ __('panel.f_phone_number') }}">
                                </p>
                            </div>

                            <div class="form-group js_login_fe">
                                <p class="form-row mb-3">

                                    <label for="password">
                                        <i class="fa fa-user custom-color"></i>
                                        {{ __('panel.f_user_password') }}
                                        <span class="required">*</span>
                                    </label>

                                    <input type="password" name="password" id="password" class="form-control form-control--sm rounded-pill" value="" placeholder="{{ __('panel.f_password') }}">

                                    @error('password')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </p>
                            </div>

                            <div class="form-group js_login_fe">
                                <p class="form-row mb-3">

                                    <label for="password_confirmation">
                                        <i class="fa fa-user custom-color"></i>
                                        {{ __('panel.f_confirm_password') }}
                                        <span class="required">*</span>
                                    </label>

                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control--sm rounded-pill" value="" placeholder="{{ __('panel.f_confirm_password') }}">

                                    @error('password_confirmation')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </p>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn mt-3 col-sm-12 rounded-pill js-signup-btn">
                                    {{ __('panel.f_register') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="drop-overlay js-dropdn-close"></div>
            </div>

            <!-- Signup -->
            <div class="collapse" id="collapseSignup" data-bs-parent="#accountModal">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('transf.txt_sign_up_and_start_learning') }}</h5>
                    <button type="button" class="close text-primary" data-bs-dismiss="modal" aria-label="Close">
                        <!-- Icon -->
                        <svg width="16" height="17" viewBox="0 0 16 17" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.142135 2.00015L1.55635 0.585938L15.6985 14.7281L14.2843 16.1423L0.142135 2.00015Z" fill="currentColor"></path>
                            <path d="M14.1421 1.0001L15.5563 2.41431L1.41421 16.5564L0 15.1422L14.1421 1.0001Z" fill="currentColor"></path>
                        </svg>

                    </button>
                </div>

                <div class="modal-body">
                    <!-- Form Signup -->
                    <form class="mb-5" method="POST" action="{{ route('register') }}">
                        @csrf
                        <!-- Username -->
                        <div class="form-group mb-5">
                            <label for="modalSignupUsername">
                                {{ __('transf.lbl_username') }}
                            </label>
                            <input type="text" name="username" class="form-control" id="modalSignupUsername" placeholder="{{ __('transf.holder_John') }}">
                            @error('username')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="form-group mb-5">
                            <label for="modalSignupEmail">
                                {{ __('transf.lbl_email') }}
                            </label>
                            <input type="email" name="email" class="form-control" id="modalSignupEmail" placeholder="{{ __('transf.holder_your_email') }}">
                            @error('email')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group mb-5">
                            <label for="modalSignupPassword">
                                {{ __('transf.lbl_password') }}
                            </label>
                            <input type="password" name="password" class="form-control" id="modalSignupPassword" placeholder="{{ __('transf.holder_stars') }}">
                            @error('password')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <button class="btn btn-block btn-primary" type="submit">
                            {{ __('transf.btn_sign_up') }}
                        </button>

                    </form>

                    <!-- Text -->
                    <p class="mb-0 font-size-sm text-center">
                        {{ __('transf.txt_already_have_an_account') }} <a class="text-underline" data-bs-toggle="collapse" href="#collapseSignin" role="button" aria-expanded="true" aria-controls="collapseSignin">{{ __('transf.lnk_login') }}</a>
                    </p>
                </div>
            </div>

            <!-- Forgot Password -->
            <div class="collapse" id="collapseForgotPassword" data-bs-parent="#accountModal">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('transf.txt_recover_password') }}</h5>
                    <button type="button" class="close text-primary" data-bs-dismiss="modal" aria-label="Close">
                        <!-- Icon -->
                        <svg width="16" height="17" viewBox="0 0 16 17" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.142135 2.00015L1.55635 0.585938L15.6985 14.7281L14.2843 16.1423L0.142135 2.00015Z" fill="currentColor"></path>
                            <path d="M14.1421 1.0001L15.5563 2.41431L1.41421 16.5564L0 15.1422L14.1421 1.0001Z" fill="currentColor"></path>
                        </svg>

                    </button>
                </div>

                <div class="modal-body">
                    <!-- Form Recover Password -->
                    <form class="mb-5">
                        <!-- Email -->
                        <div class="form-group">
                            <label for="modalForgotpasswordEmail">
                                {{ __('transf.lbl_email') }}
                            </label>
                            <input type="email" class="form-control" id="modalForgotpasswordEmail" placeholder="{{ __('transf.holder_your_email') }}">
                        </div>

                        <!-- Submit -->
                        <button class="btn btn-block btn-primary" type="submit">
                            {{ __('transf.btn_recover_password') }}
                        </button>
                    </form>

                    <!-- Text -->
                    <p class="mb-0 font-size-sm text-center">
                        {{ __('transf.txt_remember_your_password') }}
                        <a class="text-underline" data-bs-toggle="collapse" href="#collapseSignin" role="button" aria-expanded="false" aria-controls="collapseSignin">{{ __('transf.lnk_login') }}</a>
                    </p>
                </div>
            </div>

            {{-- fotgot password  --}}
            <div class="dropdn-content account-drop" id="dropdnForgotPassword">
                <div class="dropdn-content-block">
                    <div class="dropdn-close">
                        <span class="js-dropdn-close">{{ __('panel.f_close') }}</span>
                    </div>
                    <ul>
                        <li>
                            <div class="mb-4">
                                <img srcset="
                                {{ asset('frontend/images/games/logo-games.webp') }} 1x,
                                {{ asset('frontend/images/games/logo-games2x.webp') }} 2x " alt="{{ __('panel.f_center_pay') }}" width="200">
                            </div>
                        </li>
                        <li>
                            <h5>
                                <i class="icon-login custom-color"></i>
                                <span> {{ __('panel.f_reset_password') }} <span>
                            </h5>
                        </li>
                    </ul>
                    <div class="dropdn-form-wrapper">

                        <div class="row">
                            <div class="col-12">
                                @if (session('status'))
                                <div class="alert alert-success" style="margin-bottom: 5px ; background-color:rgba(200 , 100 , 100,0.3) ; border-radius: 10px" role="alert">
                                    <div class="d-none">{{ session('status') }}</div>
                                    {{ __('panel.f_we_have_sent_you_a_reset_link_to_your_email') }}
                                </div>
                                @endif
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="form-group js_login_fe">
                                        <p class="form-row mb-3">

                                            <label for="email">
                                                <i class="fa fa-envelope custom-color"></i>
                                                {{ __('panel.f_email') }}
                                                <span class="required">*</span>
                                            </label>

                                            <input type="email" name="email" id="email" class="form-control form-control--sm rounded-pill" value="" placeholder="your@email.com" autocomplete="email" autocapitalize="none">

                                            @error('email')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </p>
                                    </div>


                                    <div class="row mb-0">
                                        <div class="col-md-8 offset-md-2">
                                            <button type="submit" class="btn mt-3 col-sm-12 rounded-pill ">
                                                {{ __('panel.f_send_reset_link') }}
                                            </button>

                                        </div>
                                    </div>
                                </form>


                            </div>
                        </div>

                    </div>
                </div>
                <div class="drop-overlay js-dropdn-close"></div>
            </div>
        </div>
    </div>
</div>