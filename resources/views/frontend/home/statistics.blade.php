<section class="py-5 py-md-12 jarallax d-none" data-jarallax data-speed=".8"
    style="background-image: url({{ asset('frontend/assets/img/covers/cover-6.jpg') }})">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7">
                <h2 class="mb-1 text-white">{{ __('transf.txt_regester_now_and_get_a_50_discount') }}</h2>
                <p class="text-coral text-capitalize font-size-lg mb-5">
                    {{ __('transf.txt_get_100_online_courses_for_free') }}</p>
                <div class="row text-center mx-md-n1 mx-lg-n5">
                    <div class="col-md-auto px-md-1 px-lg-5 mb-6 mb-md-0">
                        <div
                            class="mb-4 mx-auto border-white border-w-md border rounded-circle h-90p w-90p d-flex align-items-center justify-content-center flex-column">
                            <div class="h2 text-white mb-0"><span data-toggle="countup" data-from="0" data-to="40"
                                    data-aos data-aos-id="countup:in"></span></div>
                        </div>
                        <span class="h4 fw-medium text-white mb-0">{{ __('transf.txt_days') }}</span>
                    </div>

                    <div class="col-md-auto px-md-1 px-lg-5 mb-6 mb-md-0">
                        <div
                            class="mb-4 mx-auto border-white border-w-md border rounded-circle h-90p w-90p d-flex align-items-center justify-content-center flex-column">
                            <div class="h2 text-white mb-0"><span data-toggle="countup" data-from="0" data-to="59"
                                    data-aos data-aos-id="countup:in"></span></div>
                        </div>
                        <span class="h4 fw-medium text-white mb-0">{{ __('transf.txt_hours') }}</span>
                    </div>

                    <div class="col-md-auto px-md-1 px-lg-5 mb-6 mb-md-0">
                        <div
                            class="mb-4 mx-auto border-white border-w-md border rounded-circle h-90p w-90p d-flex align-items-center justify-content-center flex-column">
                            <div class="h2 text-white mb-0"><span data-toggle="countup" data-from="0" data-to="27"
                                    data-aos data-aos-id="countup:in"></span></div>
                        </div>
                        <span class="h4 fw-medium text-white mb-0">{{ __('transf.txt_minutes') }}</span>
                    </div>

                    <div class="col-md-auto px-md-1 px-lg-5 mb-6 mb-md-0">
                        <div
                            class="mb-4 mx-auto border-white border-w-md border rounded-circle h-90p w-90p d-flex align-items-center justify-content-center flex-column">
                            <div class="h2 text-white mb-0"><span data-toggle="countup" data-from="0" data-to="10"
                                    data-aos data-aos-id="countup:in"></span></div>
                        </div>
                        <span class="h4 fw-medium text-white mb-0">{{ __('transf.txt_seconds') }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="text-center">
                    <p class="text-coral text-capitalize font-size-lg mb-2">
                        {{ __('transf.txt_create_free_account_to_get') }}</p>
                    <h3 class="text-uppercase text-white mb-6">
                        {{ __('transf.txt_the_complete_web_developer_course') }}</h3>
                </div>

                <div class="bg-white p-5 p-lg-7 rounded-lg">
                    <form class="mb-2">
                        <div class="form-group mb-6">
                            <input type="text" class="form-control form-control-sm placeholder-1" id="cardName"
                                placeholder="{{ __('transf.holder_your_name') }}">
                            <label class="sr-only" for="cardName">Name</label>
                        </div>
                        <div class="form-group mb-6">
                            <input type="email" class="form-control form-control-sm placeholder-1" id="cardEmail"
                                placeholder="{{ __('transf.holder_email') }}">
                            <label class="sr-only" for="cardEmail">Email</label>
                        </div>
                        <div class="form-group mb-6">
                            <input type="number" class="form-control form-control-sm placeholder-1" id="cardPhone"
                                placeholder="{{ __('transf.holder_phone') }}">
                            <label class="sr-only" for="cardPhone">Password</label>
                        </div>
                        <div class="mt-6">
                            <button class="btn btn-block btn-bossanova lift" type="submit">
                                {{ __('transf.btn_get_it_now') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
