<div class="modal modal-sidebar left fade-left fade" id="accountModal">
    <div class="modal-dialog">
        <div class="modal-content">
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
                    <form class="mb-5">

                        <!-- Email -->
                        <div class="form-group mb-5">
                            <label for="modalSigninEmail">
                                {{ __('transf.lbl_username_or_email') }}
                            </label>
                            <input type="email" class="form-control" id="modalSigninEmail"
                                placeholder="{{ __('transf.holder_your_name_or_email') }}">
                        </div>

                        <!-- Password -->
                        <div class="form-group mb-5">
                            <label for="modalSigninPassword">
                                Password
                            </label>
                            <input type="password" class="form-control" id="modalSigninPassword"
                                placeholder="{{ __('transf.holder_stars') }}">
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
                        <a class="text-underline" data-bs-toggle="collapse" href="#collapseSignup" role="button"
                            aria-expanded="false" aria-controls="collapseSignup">{{ __('transf.lnk_sign_up') }}</a>
                    </p>
                </div>
            </div>

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
                    <!-- Form Signup -->
                    <form class="mb-5">

                        <!-- Username -->
                        <div class="form-group mb-5">
                            <label for="modalSignupUsername">
                                {{ __('transf.lbl_username') }}
                            </label>
                            <input type="text" class="form-control" id="modalSignupUsername"
                                placeholder="{{ __('transf.holder_John') }}">
                        </div>

                        <!-- Email -->
                        <div class="form-group mb-5">
                            <label for="modalSignupEmail">
                                {{ __('transf.lbl_email') }}
                            </label>
                            <input type="email" class="form-control" id="modalSignupEmail"
                                placeholder="{{ __('transf.holder_your_email') }}">
                        </div>

                        <!-- Password -->
                        <div class="form-group mb-5">
                            <label for="modalSignupPassword">
                                {{ __('transf.lbl_password') }}
                            </label>
                            <input type="password" class="form-control" id="modalSignupPassword"
                                placeholder="{{ __('transf.holder_stars') }}">
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
                    <!-- Form Recover Password -->
                    <form class="mb-5">
                        <!-- Email -->
                        <div class="form-group">
                            <label for="modalForgotpasswordEmail">
                                {{ __('transf.lbl_email') }}
                            </label>
                            <input type="email" class="form-control" id="modalForgotpasswordEmail"
                                placeholder="{{ __('transf.holder_your_email') }}">
                        </div>

                        <!-- Submit -->
                        <button class="btn btn-block btn-primary" type="submit">
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
