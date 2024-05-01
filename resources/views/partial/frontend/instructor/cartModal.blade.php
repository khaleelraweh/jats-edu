<div class="modal modal-sidebar left fade-left fade" id="cartModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header mb-4">
                <h5 class="modal-title">{{ __('transf.txt_your_shopping_cart') }}</h5>
                <button type="button" class="close text-primary" data-bs-dismiss="modal" aria-label="Close">
                    <!-- Icon -->
                    <svg width="16" height="17" viewBox="0 0 16 17" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.142135 2.00015L1.55635 0.585938L15.6985 14.7281L14.2843 16.1423L0.142135 2.00015Z"
                            fill="currentColor"></path>
                        <path d="M14.1421 1.0001L15.5563 2.41431L1.41421 16.5564L0 15.1422L14.1421 1.0001Z"
                            fill="currentColor"></path>
                    </svg>

                </button>
            </div>

            <div class="modal-body">

                {{-- cart modal item and totals --}}
                @livewire('frontend.modals.cart-modal-component')

                <div class="d-md-flex justify-content-between">
                    <a href="{{ route('frontend.shop_cart') }}"
                        class="d-block d-md-inline-block mb-4 mb-md-0 btn btn-primary btn-sm-wide">
                        {{ __('transf.btn_view_cart') }}
                    </a>
                    <a href="{{ route('frontend.shop_checkout') }}"
                        class="d-block d-md-inline-block btn btn-teal btn-sm-wide text-white">{{ __('transf.btn_checkout') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
