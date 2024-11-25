<section class="py-5 py-md-11 bg-white">
    <div class="container">
        <div class="text-center mb-8 pb-2">
            <h1 class="mb-1">{{ __('transf.txt_upcomming_events') }}</h1>
            <p class="font-size-lg text-capitalize mb-0">{{ __('transf.txt_upcomming_events_desc') }}</p>
        </div>


        <div class="row">

            @foreach ($events->take(6) as $event)
                <div class="col-xl-6 mb-5 mb-md-6">
                    <!-- Card -->
                    <div class="card border shadow p-2 lift">
                        <div class="row gx-0">
                            <!-- Image -->
                            @php
                                if ($event->photos->first() != null && $event->photos->first()->file_name != null) {
                                    $event_img = asset('assets/courses/' . $event->photos->first()->file_name);

                                    if (
                                        !file_exists(
                                            public_path('assets/courses/' . $event->photos->first()->file_name),
                                        )
                                    ) {
                                        $event_img = asset('image/not_found/placeholder.jpg');
                                    }
                                } else {
                                    $event_img = asset('image/not_found/placeholder.jpg');
                                }
                            @endphp
                            <!-- Image -->
                            <a href="{{ route('frontend.event_single', $event->slug) }}"
                                class="col-auto d-block mw-md-152" style="max-width: 120px;">
                                <img class="img-fluid rounded shadow-light-lg h-100 o-f-c" src="{{ $event_img }}"
                                    alt="...">
                            </a>

                            <!-- Body -->
                            <div class="col">
                                <div class="card-body py-0 px-md-5 px-3">
                                    <div class="badge badge-lg badge-orange badge-pill mb-3 mt-1 px-5 py-2">
                                        <span
                                            class="text-white font-size-sm fw-normal">{{ $event->start_date ? \Carbon\Carbon::parse($event->start_date)->translatedFormat('d F Y') : null }}</span>
                                    </div>

                                    <a href="{{ route('frontend.event_single', $event->slug) }}" class="d-block mb-2">
                                        <h5 class="line-clamp-2 h-xl-52 mb-2">
                                            {{ $event->title }}
                                        </h5>
                                    </a>

                                    <ul class="nav mx-n3 d-block d-md-flex">
                                        <li class="nav-item px-3 mb-3 mb-md-0">
                                            <div class="d-flex align-items-center">
                                                <div class="me-2 d-flex text-secondary icon-uxs">
                                                    <!-- Icon -->
                                                    <svg width="16" height="16" viewBox="0 0 16 16"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M14.3164 4.20996C13.985 4.37028 13.8464 4.76904 14.0067 5.10026C14.4447 6.00505 14.6667 6.98031 14.6667 8C14.6667 11.6759 11.6759 14.6667 8 14.6667C4.32406 14.6667 1.33333 11.6759 1.33333 8C1.33333 4.32406 4.32406 1.33333 8 1.33333C9.52328 1.33333 10.9543 1.83073 12.1387 2.77165C12.4259 3.00098 12.846 2.95296 13.0754 2.66471C13.3047 2.37663 13.2567 1.95703 12.9683 1.72803C11.5661 0.613607 9.8016 0 8 0C3.58903 0 0 3.58903 0 8C0 12.411 3.58903 16 8 16C12.411 16 16 12.411 16 8C16 6.77767 15.7331 5.60628 15.2067 4.51969C15.0467 4.18766 14.6466 4.04932 14.3164 4.20996Z"
                                                            fill="currentColor" />
                                                        <path
                                                            d="M7.99967 2.66663C7.63167 2.66663 7.33301 2.96529 7.33301 3.33329V7.99996C7.33301 8.36796 7.63167 8.66663 7.99967 8.66663H11.333C11.701 8.66663 11.9997 8.36796 11.9997 7.99996C11.9997 7.63196 11.701 7.33329 11.333 7.33329H8.66634V3.33329C8.66634 2.96529 8.36768 2.66663 7.99967 2.66663Z"
                                                            fill="currentColor" />
                                                    </svg>

                                                </div>
                                                <div class="font-size-sm">
                                                    {{ $event->start_time ? \Carbon\Carbon::parse($event->start_time)->translatedFormat('h:i A') : null }}
                                                    -
                                                    {{ $event->end_time ? \Carbon\Carbon::parse($event->end_time)->translatedFormat('h:i A') : null }}
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nav-item px-3 mb-3 mb-md-0">
                                            <div class="d-flex align-items-center">
                                                <div class="me-2 d-flex text-secondary icon-uxs">
                                                    <!-- Icon -->
                                                    <svg width="18" height="18" viewBox="0 0 18 18"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M14.9748 3.12964C13.6007 1.14086 11.4229 0 9.0002 0C6.57754 0 4.39972 1.14086 3.02557 3.12964C1.65816 5.10838 1.34243 7.61351 2.17929 9.82677C2.40313 10.4312 2.75894 11.0184 3.23433 11.5687L8.52105 17.7784C8.64062 17.919 8.8158 18 9.0002 18C9.18459 18 9.35978 17.919 9.47934 17.7784L14.7646 11.5703C15.2421 11.0169 15.5974 10.4303 15.8194 9.83078C16.658 7.61351 16.3422 5.10838 14.9748 3.12964ZM14.6408 9.38999C14.4697 9.85257 14.1902 10.3099 13.8107 10.7498C13.8096 10.7509 13.8086 10.7519 13.8077 10.7532L9.0002 16.3999L4.1897 10.7497C3.8104 10.3101 3.53094 9.85282 3.35808 9.38581C2.66599 7.55539 2.92864 5.48413 4.06088 3.84546C5.19668 2.20155 6.9971 1.25873 9.0002 1.25873C11.0033 1.25873 12.8035 2.20152 13.9393 3.84546C15.0718 5.48413 15.3346 7.55539 14.6408 9.38999Z"
                                                            fill="currentColor" />
                                                        <path
                                                            d="M9.00019 3.73438C7.0569 3.73438 5.47571 5.31535 5.47571 7.25886C5.47571 9.20237 7.05668 10.7833 9.00019 10.7833C10.9437 10.7833 12.5247 9.20237 12.5247 7.25886C12.5247 5.31556 10.9435 3.73438 9.00019 3.73438ZM9.00019 9.52457C7.75088 9.52457 6.73444 8.50814 6.73444 7.25882C6.73444 6.00951 7.75088 4.99307 9.00019 4.99307C10.2495 4.99307 11.2659 6.00951 11.2659 7.25882C11.2659 8.50814 10.2495 9.52457 9.00019 9.52457Z"
                                                            fill="currentColor" />
                                                    </svg>

                                                </div>
                                                <div class="font-size-sm">{{ $event->address }}</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="text-center mt-4">
            <a href="{{ route('frontend.event_list') }}"
                class="btn btn-coral btn-wide lift text-white-all">{{ __('transf.btn_view_all') }}</a>
        </div>
    </div>
</section>
