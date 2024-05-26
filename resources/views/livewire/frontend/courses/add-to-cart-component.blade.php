<div>

    @php
        $userId = auth()->id();

        $course = App\Models\Course::whereId($courseId)->firstOrFail();

        // Check if the user is already enrolled in the course
        $isEnrolled = App\Models\Order::where('user_id', $userId)
            ->whereHas('courses', function ($query) use ($courseId) {
                $query->where('course_id', $courseId);
            })
            ->exists();

    @endphp

    @if ($isEnrolled)
        {{-- to check if the order is finished or not  --}}

        @php
            // Check if the user is already enrolled in the course
            $isOrderFinished = App\Models\Order::where('user_id', $userId)
                ->whereHas('courses', function ($query) use ($courseId) {
                    $query->where('course_id', $courseId);
                })
                ->where('order_status', 3)
                ->exists();
        @endphp

        @if ($isOrderFinished)
            <a href="{{ route('customer.lesson_single', $course->slug) }}"
                class="btn btn-blue btn-block mb-6">{{ __('transf.btn_go_to_course') }}</a>
        @else
            <a href="javascript::void()"
                class="btn btn-blue btn-block mb-6">{{ __('transf.btn_waiting_for_supervisor_check') }}</a>
        @endif
    @else
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

    @endif








</div>
