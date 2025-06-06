<div>
    @php
        $userId = auth()->id();
        $course = App\Models\Course::whereId($courseId)->firstOrFail();

        // Get all orders for this user and course (not just checking existence)
        $orders = App\Models\Order::where('user_id', $userId)
            ->whereHas('courses', function ($query) use ($courseId) {
                $query->where('course_id', $courseId);
            })
            ->get();


        $hasActiveEnrollment = $orders->contains('order_status', App\Models\Order::FINISHED); // 3
        $hasPendingEnrollment = $orders->contains(function ($order) {
            return in_array($order->order_status, [
                App\Models\Order::PAYMENT_COMPLETED, // 1
                App\Models\Order::UNDER_PROCESS // 2
            ]);
        });
        $hasRejectedEnrollment = $orders->contains(function ($order) {
            return in_array($order->order_status, [
                App\Models\Order::REJECTED, //4
                App\Models\Order::CANCELED,
                App\Models\Order::REFUNDED_REQUEST,
                App\Models\Order::RETURNED,
                App\Models\Order::REFUNDED
            ]);
        });
    @endphp


    @if ($course->isInstructor($userId))
        <a href="{{ route('instructor.courses.edit', $course->id) }}"
            class="btn btn-blue btn-block mb-6">{{ __('transf.btn_go_to_your_course_dashboard') }}</a>
    @else
        @if ($hasActiveEnrollment)
            {{-- User has active enrollment (status 3) --}}
            <a href="{{ route('customer.lesson_single', $course->slug) }}"
                class="btn btn-blue btn-block mb-6">{{ __('transf.btn_go_to_course') }}</a>
        @elseif ($hasPendingEnrollment)
            {{-- User has pending enrollment (status 1 or 2) --}}
            <a href="javascript::void()"
                class="btn btn-blue btn-block mb-3">{{ __('transf.btn_waiting_for_supervisor_check') }}</a>
            <div class="d-flex align-items-center text-alizarin mb-6">
                <!-- Icon -->
                <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M9.99974 3.0083C5.79444 3.0083 2.37305 6.42973 2.37305 10.635C2.37305 14.8405 5.79448 18.2619 9.99974 18.2619C14.2053 18.2619 17.6264 14.8405 17.6264 10.635C17.6264 6.42973 14.205 3.0083 9.99974 3.0083ZM9.99974 16.8797C6.55666 16.8797 3.7555 14.0783 3.7555 10.6353C3.7555 7.19219 6.55662 4.39103 9.99974 4.39103C13.4428 4.39103 16.244 7.19219 16.244 10.6353C16.244 14.0785 13.4428 16.8797 9.99974 16.8797Z"
                        fill="currentColor" />
                    <path
                        d="M12.1193 10.4048H10.2761V7.73202C10.2761 7.35022 9.9666 7.04077 9.5848 7.04077C9.20301 7.04077 8.89355 7.35022 8.89355 7.73202V11.0961C8.89355 11.4779 9.20301 11.7873 9.5848 11.7873H12.1194C12.5012 11.7873 12.8106 11.4779 12.8106 11.0961C12.8106 10.7143 12.5011 10.4048 12.1193 10.4048Z"
                        fill="currentColor" />
                    <path
                        d="M6.08489 15.5823C5.80102 15.3267 5.36391 15.35 5.10864 15.6336L3.0349 17.9378C2.77935 18.2214 2.80263 18.6585 3.08627 18.9138C3.2183 19.033 3.38372 19.0915 3.54849 19.0915C3.73767 19.0915 3.92614 19.0143 4.06255 18.8625L6.13629 16.5583C6.3918 16.2746 6.36852 15.8375 6.08489 15.5823Z"
                        fill="currentColor" />
                    <path
                        d="M16.9661 17.9381L14.8924 15.634C14.6375 15.3501 14.2002 15.327 13.9163 15.5826C13.6325 15.8379 13.6097 16.275 13.865 16.5586L15.9387 18.8628C16.0749 19.0144 16.2633 19.0916 16.4525 19.0916C16.6171 19.0916 16.7825 19.033 16.9147 18.9141C17.1986 18.6588 17.2214 18.2217 16.9661 17.9381Z"
                        fill="currentColor" />
                    <path
                        d="M5.96733 1.91597C4.59382 0.571053 2.3798 0.573123 1.03211 1.92105C0.361569 2.59132 -0.00479631 3.47819 4.74212e-05 4.41826C0.00512553 5.34705 0.373327 6.21665 1.03715 6.86689C1.17172 6.99845 1.34614 7.06411 1.52078 7.06411C1.69774 7.06411 1.87469 6.99638 2.00949 6.86181L5.9726 2.8987C6.10303 2.76808 6.17584 2.59085 6.17491 2.40632C6.17401 2.22171 6.09932 2.04523 5.96733 1.91597ZM1.5966 5.31939C1.45813 5.04037 1.38414 4.73162 1.38254 4.41088C1.37953 3.84315 1.60211 3.30581 2.00949 2.89843C2.41594 2.49222 2.95328 2.28921 3.49359 2.28921C3.80949 2.28921 4.12655 2.35855 4.4187 2.49726L1.5966 5.31939Z"
                        fill="currentColor" />
                    <path
                        d="M18.9673 1.92072C17.6194 0.573026 15.4053 0.570721 14.0318 1.91564C13.9 2.04489 13.8252 2.22142 13.8242 2.40595C13.8233 2.59052 13.8963 2.76794 14.0268 2.89833L17.9899 6.86144C18.1247 6.99648 18.3016 7.06398 18.4786 7.06398C18.6532 7.06398 18.8279 6.99831 18.9622 6.86628C19.6263 6.21628 19.9945 5.34672 19.9993 4.41789C20.0042 3.47809 19.6376 2.59122 18.9673 1.92072ZM18.4028 5.3193L15.5807 2.4972C16.3729 2.12114 17.3459 2.25458 17.9899 2.89856C18.3973 3.30594 18.6199 3.84301 18.6169 4.41102C18.6152 4.73152 18.5413 5.04051 18.4028 5.3193Z"
                        fill="currentColor" />
                </svg>

                <span class="ms-2"> {{ __('transf.This proccess may takes from 2 to 3 days !') }}</span>
            </div>
        @else


            {{-- User has no enrollment or has rejected enrollment (status 4-8) --}}
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

                <button wire:click.prevent="addToCart()" class="btn btn-primary btn-block mb-3" type="button"
                    name="button">
                    {{ __('transf.btn_add_to_cart') }}
                </button>

                {{-- Buy Now --}}
                <button wire:click.prevent="BuyNow()" class="btn btn-teal btn-block text-white mb-3" type="button"
                    name="button">
                    {{ __('transf.btn_buy_now') }}
                </button>
            @endif
        @endif
    @endif
</div>
