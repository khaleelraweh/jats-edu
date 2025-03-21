<style>
    .iti {
        width: 100%;
    }
</style>
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
                                <path
                                    d="M0.142135 2.00015L1.55635 0.585938L15.6985 14.7281L14.2843 16.1423L0.142135 2.00015Z"
                                    fill="currentColor"></path>
                                <path d="M14.1421 1.0001L15.5563 2.41431L1.41421 16.5564L0 15.1422L14.1421 1.0001Z"
                                    fill="currentColor"></path>
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
                                <input type="text" name="email"
                                    class="form-control  @if ($errors->has('email') || $errors->has('username')) has-error @endif"
                                    id="modalSigninEmail" placeholder="{{ __('transf.holder_your_name_or_email') }}"
                                    value="{{ old('email') }}">
                                @if ($errors->has('email') || $errors->has('username'))
                                    <span class="help">{{ $errors->first('email') }}
                                        {{ $errors->first('username') }}</span>
                                @endif
                            </div>

                            <!-- Password -->

                            <div class="form-group mb-5">
                                <label for="modalSigninPassword">
                                    {{ __('transf.lbl_password') }}
                                </label>
                                <input type="password" name="password" required autocomplete="current-password"
                                    class="form-control" id="modalSigninPassword"
                                    placeholder="{{ __('transf.holder_stars') }}" />

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
                                    <a class="text-gray-800" data-bs-toggle="collapse" href="#collapseForgotPassword"
                                        role="button" aria-expanded="false" aria-controls="collapseForgotPassword">
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
                            {{-- <a class="text-underline" data-bs-toggle="collapse" href="#collapseSignup" role="button"
                                aria-expanded="false" aria-controls="collapseSignup">
                                {{ __('transf.lnk_sign_up') }}
                            </a> --}}
                            <a class="text-underline" href="{{route('register')}}">
                                {{ __('transf.lnk_sign_up') }}
                            </a>
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
                                <path
                                    d="M0.142135 2.00015L1.55635 0.585938L15.6985 14.7281L14.2843 16.1423L0.142135 2.00015Z"
                                    fill="currentColor"></path>
                                <path d="M14.1421 1.0001L15.5563 2.41431L1.41421 16.5564L0 15.1422L14.1421 1.0001Z"
                                    fill="currentColor"></path>
                            </svg>

                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="modal-header-content mt-2">



                            @php
                                if (auth()->user()->user_image != null) {
                                    $user_img = asset('assets/users/' . auth()->user()->user_image);

                                    if (!file_exists(public_path('assets/users/' . auth()->user()->user_image))) {
                                        $user_img = asset('image/not_found/avator2.webp');
                                    }
                                } else {
                                    $user_img = asset('image/not_found/avator2.webp');
                                }
                            @endphp

                            <img src="{{ $user_img }}" alt="{{ auth()->user()->full_name }}"
                                class="img-thumbnail rounded-pill">

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

                        <div class="hr"></div>

                        @if (auth()->user()->email_verified_at == null)
                            <div class="mt-4">
                                <h5 class=" mb-3"> {{ __('panel.f_insure_user_email') }} </h5>

                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert"
                                        style="margin-bottom: 5px ; background-color:rgba(200 , 100 , 100,0.3) ; border-radius: 10px">
                                        {{ __('panel.f_we_sent_link_insurent_to_your_email') }}
                                    </div>
                                @endif

                                {{ __('panel.f_before_start_check_email_to_continue') }}
                                <br> <br>
                                {{ __('panel.f_if_you_didnt_receive_an_email') }},

                                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0 px-1 py-1 m-0 align-baseline"
                                        style="border-radius: 5px">
                                        {{ __('panel.f_click_here_to_get_another') }}
                                    </button>.
                                </form>

                                <div class="hr"></div>

                                <a href="javascript:void(0);"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    {{ __('panel.f_logout') }}
                                </a>
                                <form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        @endif


                        @if (auth()->user()->email_verified_at != null)
                            @if (auth()->user()->roles->first()->allowed_route != '')
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

                                    @if (auth()->user()->hasRole('instructor'))
                                        <li>
                                            <a href="{{ route('instructor.dashboard') }}">
                                                {{ __('panel.f_instructor_dashboard') }}
                                            </a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ route('teach_requests.create') }}">
                                                {{ __('panel.f_youth_step') }}
                                            </a>
                                        </li>
                                    @endif


                                    <div class="hr"></div>

                                    <li>
                                        <a href="javascript:void(0);"
                                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            {{ __('panel.f_logout') }}
                                        </a>
                                        <form action="{{ route('logout') }}" method="POST" id="logout-form"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            @else
                                <ul>
                                    <li>
                                        <a href="{{ route('customer.profile') }}">
                                            {{ __('panel.f_user_profile') }}
                                        </a>
                                    </li>
                                    <li class="d-none">
                                        <a href="{{ route('customer.addresses') }}">
                                            {{ __('panel.f_user_addresses') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('customer.orders') }}">
                                            {{ __('panel.f_my_orders') }}
                                        </a>
                                    </li>
                                    @if (auth()->user()->hasRole('instructor'))
                                        <li>
                                            <a href="{{ route('instructor.dashboard') }}">
                                                {{ __('panel.f_instructor_dashboard') }}
                                            </a>
                                        </li>
                                    @elseif (auth()->user()->hasTeachRequests())
                                        @php
                                            $teachRequestStatus = auth()->user()->latestTeachRequestStatus();
                                        @endphp
                                        @if (is_null($teachRequestStatus))
                                            <li>
                                                <a href="{{ route('teach_requests.create') }}">
                                                    {{ __('panel.f_youth_step') }}
                                                </a>
                                            </li>
                                        @else
                                            @if ($teachRequestStatus == \App\Models\TeachRequest::NEW_REQUEST)
                                                <li>
                                                    <a
                                                        href="{{ route('teach_requests.show', auth()->user()->requestToTeaches()->latest()->first()->id) }}">
                                                        {{ __('panel.You_have_successfully_sent_a_new_teaching_request') }}
                                                    </a>
                                                </li>
                                            @elseif ($teachRequestStatus == \App\Models\TeachRequest::UNDER_PROCESS)
                                                <li>
                                                    <a
                                                        href="{{ route('teach_requests.show', auth()->user()->requestToTeaches()->latest()->first()->id) }}">
                                                        {{ __('panel.your_application_for_teaching') }}
                                                        ({{ __('panel.teach_request_under_proccess') }})
                                                    </a>
                                                </li>
                                            @elseif ($teachRequestStatus == \App\Models\TeachRequest::ACCEPTED)
                                                <li>
                                                    <a href="{{ route('instructor.dashboard') }}">
                                                        {{ __('panel.f_instructor_dashboard') }}
                                                    </a>
                                                </li>
                                            @elseif ($teachRequestStatus == \App\Models\TeachRequest::REJECTED)
                                                <li>
                                                    <a href="{{ route('teach_requests.create') }}">
                                                        {{ __('panel.your_request_has_been_rejected_You_can_do_something_else!!') }}
                                                    </a>
                                                </li>
                                            @endif
                                        @endif
                                    @else
                                        <li>
                                            <a href="{{ route('teach_requests.create') }}">
                                                {{ __('panel.f_youth_step') }}
                                            </a>
                                        </li>
                                    @endif


                                    <div class="hr"></div>

                                    <li>
                                        <a href="{{ route('frontend.shop_cart') }}">
                                            {{ __('transf.lnk_my_cart') }}
                                        </a>
                                    </li>

                                    {{-- It stoped  --}}
                                    <li class="d-none">
                                        <a href="{{ route('frontend.shop_cart') }}">
                                            {{ __('transf.lnk_my_wishlist') }}
                                        </a>
                                    </li>
                                    <div class="hr"></div>
                                    <li>
                                        <a href="{{ route('customer.courses') }}">
                                            {{ __('transf.lnk_my_learning') }}
                                        </a>
                                    </li>
                                    <div class="hr"></div>

                                    <li>
                                        <a href="javascript:void(0);"
                                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            {{ __('panel.f_logout') }}
                                        </a>
                                        <form action="{{ route('logout') }}" method="POST" id="logout-form"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            @endif
                        @endif

                    </div>


                </div>

            @endguest

            <!-- Signup -->
            <div class="collapse" id="collapseSignup" data-bs-parent="#accountModal">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('transf.txt_sign_up_and_start_learning') }}</h5>
                    <button type="button" class="close text-primary" data-bs-dismiss="modal" aria-label="Close">
                        <!-- Icon -->
                        <svg width="16" height="17" viewBox="0 0 16 17" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M0.142135 2.00015L1.55635 0.585938L15.6985 14.7281L14.2843 16.1423L0.142135 2.00015Z"
                                fill="currentColor"></path>
                            <path d="M14.1421 1.0001L15.5563 2.41431L1.41421 16.5564L0 15.1422L14.1421 1.0001Z"
                                fill="currentColor"></path>
                        </svg>

                    </button>
                </div>

                <div class="modal-body">
                    <!-- Form Register -->
                    <form class="mb-5" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group mb-5">
                            <label for="first_name">
                                <i class="fa fa-user custom-color"></i>
                                {{ __('panel.first_name') }}
                                <span class="required">*</span>
                            </label>
                            <input type="text" name="first_name" id="first_name" class="form-control  "
                                value="" placeholder="{{ __('panel.first_name') }}">

                            @error('first_name')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-5">
                            <label for="last_name">
                                <i class="fa fa-user custom-color"></i>
                                {{ __('panel.last_name') }}
                                <span class="required">*</span>
                            </label>
                            <input type="text" name="last_name" id="last_name" class="form-control "
                                value="" placeholder="{{ __('panel.last_name') }}">
                            @error('last_name')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-group mb-5">
                            <label for="username">
                                <i class="fa fa-user custom-color"></i>
                                {{ __('panel.user_name') }}
                                <span class="required">*</span>
                            </label>
                            <input type="text" name="username" id="username" class="form-control  "
                                value="" placeholder="{{ __('panel.user_name') }}">
                            @error('username')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-group mb-5">
                            <label for="email">
                                <i class="fa fa-envelope custom-color"></i>
                                {{ __('panel.f_user_email') }} <span class="required">*</span>
                            </label>
                            <input type="email" name="email" id="email" class="form-control "
                                value="" placeholder="your@email.com" autocomplete="email"
                                autocapitalize="none">
                            @error('email')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>


                        {{-- <div class="form-group mb-5">
                            <label for="country_name">
                                <i class="fa fa-globe custom-color"></i>
                                {{ __('panel.f_select_country') }}
                                <span class="required">*</span>
                            </label>
                            <select id="country_name" name="country_name" class="form-control">
                                @foreach (getCountries() as $country)
                                    <option value="{{ $country->name }}"
                                        data-phone-code="{{ $country->phone_code }}"
                                        data-emoji="{{ $country->emoji }}">
                                        {{ $country->name }} {{ $country->emoji }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-5">
                            <label for="mobile">
                                <i class="fa fa-mobile-phone custom-color"></i>
                                {{ __('panel.f_phone_number') }}
                                <span class="required">*</span>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="selected_phone_code">+</span>
                                </div>
                                <input type="hidden" name="country_code" id="country_code">
                                <input type="text" name="mobile" id="mobile" class="form-control"
                                    placeholder="{{ __('panel.f_phone_number') }}">
                            </div>
                        </div> --}}


                        <div class="form-group mb-5">

                            <label for="mobile">
                                <i class="fa fa-phone custom-color"></i>
                                {{ __('panel.f_phone_number') }}
                                <span class="required">*</span>
                            </label>


                            <input id="output" type="hidden" name="full_mobile_number">
                            <input id="phone" type="text" name="mobile" class="form-control">



                        </div>




                        <div class="form-group mb-5">
                            <label for="password">
                                <i class="fa fa-user custom-color"></i>
                                {{ __('panel.f_user_password') }}
                                <span class="required">*</span>
                            </label>

                            <input type="password" name="password" id="password" class="form-control "
                                value="" placeholder="{{ __('panel.f_password') }}">

                            @error('password')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-group mb-5">
                            <label for="password_confirmation">
                                <i class="fa fa-user custom-color"></i>
                                {{ __('panel.f_confirm_password') }}
                                <span class="required">*</span>
                            </label>

                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control " value=""
                                placeholder="{{ __('panel.f_confirm_password') }}">

                            @error('password_confirmation')
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
                        {{ __('transf.txt_already_have_an_account') }} <a class="text-underline"
                            data-bs-toggle="collapse" href="#collapseSignin" role="button" aria-expanded="true"
                            aria-controls="collapseSignin">{{ __('transf.lnk_login') }}</a>
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
                            <path
                                d="M0.142135 2.00015L1.55635 0.585938L15.6985 14.7281L14.2843 16.1423L0.142135 2.00015Z"
                                fill="currentColor"></path>
                            <path d="M14.1421 1.0001L15.5563 2.41431L1.41421 16.5564L0 15.1422L14.1421 1.0001Z"
                                fill="currentColor"></path>
                        </svg>

                    </button>
                </div>

                <div class="modal-body">
                    @if (session('status'))
                        <div class="alert alert-success"
                            style="margin-bottom: 5px ; background-color:rgba(200 , 100 , 100,0.3) ; border-radius: 10px"
                            role="alert">
                            <div class="d-none">{{ session('status') }}</div>
                            {{ __('panel.f_we_have_sent_you_a_reset_link_to_your_email') }}
                        </div>
                    @endif
                    <!-- Form Recover Password -->
                    <form class="mb-5" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <!-- Email -->
                        <div class="form-group">
                            <label for="modalForgotpasswordEmail">
                                {{ __('transf.lbl_email') }}
                            </label>
                            <input type="email" name="email" class="form-control" id="modalForgotpasswordEmail"
                                placeholder="{{ __('transf.holder_your_email') }}">
                            @error('email')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <button class="btn btn-block btn-primary mt-4" type="submit">
                            {{ __('transf.btn_recover_password') }}
                        </button>
                    </form>

                    <!-- Text -->
                    <p class="mb-0 font-size-sm text-center">
                        {{ __('transf.txt_remember_your_password') }}
                        <a class="text-underline" data-bs-toggle="collapse" href="#collapseSignin" role="button"
                            aria-expanded="false" aria-controls="collapseSignin">{{ __('transf.lnk_login') }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    document.getElementById('country_name').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var phoneCode = selectedOption.getAttribute('data-phone-code');
        document.getElementById('selected_phone_code').innerText = '+' + phoneCode;
        document.getElementById('country_code').value = phoneCode;
    });
</script>
