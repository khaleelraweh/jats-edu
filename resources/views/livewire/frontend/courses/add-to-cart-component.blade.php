<div>

    @php
        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($courseId) {
            return $cartItem->id === $courseId;
        });
    @endphp

    @if ($duplicates->isNotEmpty())
        <a href="{{ route('frontend.shop_cart') }}" class="btn btn-primary btn-block mb-3">
            {{ __('transf.btn_go_to_cart') }}
        </a>
        <a href="{{ route('frontend.shop_checkout') }}"
            class=" btn btn-teal btn-block text-white mb-3">{{ __('transf.btn_buy_now') }}</a>
    @else
        {{-- Add to cart --}}
        <button wire:click.prevent="addToCart()" class="btn btn-primary btn-block mb-3" type="button" name="button">
            {{ __('transf.btn_add_to_cart') }}
        </button>

        {{-- Buy Now --}}
        <button wire:click.prevent="BuyNow()" class="btn btn-teal btn-block text-white mb-3" type="button"
            name="button">
            {{ __('transf.btn_buy_now') }}
        </button>
    @endif





</div>
