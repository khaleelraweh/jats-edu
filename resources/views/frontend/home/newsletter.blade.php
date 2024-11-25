<section class="py-6 py-md-8 bg-coral d-none">
    <div class="container">
        <div class="row align-items-center py-2">
            <div class="col-xl-6 mb-4 mb-xl-0">
                <h1 class="text-white mb-1">{{ __('transf.txt_subscribe_our_newsletter') }}</h1>
                <p class="font-size-lg text-white mb-0 text-capitalize">
                    {{ __('transf.txt_subscrive_our_newsletter_desc') }}</p>
            </div>

            <div class="col-xl-6">
                <form class="ms-xl-5">
                    <div class="input-group d-block d-md-flex bg-white p-1 rounded">
                        <input type="text"
                            class="form-control w-100 w-md-auto form-control-sm rounded border-0 placeholder-1"
                            placeholder="{{ __('transf.holder_enter_your_email') }}" aria-label="Enter your email"
                            aria-describedby="button-addon2">
                        <div class="input-group-append ms-0">
                            <button class="btn btn-sm btn-bossanova w-100 w-md-auto btn-wide rounded border-0"
                                type="button" id="button-addon2">{{ __('transf.btn_subscribe') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
