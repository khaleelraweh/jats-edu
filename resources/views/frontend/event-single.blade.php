@extends('layouts.app')

@section('content')
    <!-- EVENT SINGLE -->

    @php
        if ($event->photos->first() != null && $event->photos->first()->file_name != null) {
            $event_img = asset('assets/events/' . $event->photos->first()->file_name);

            if (!file_exists(public_path('assets/events/' . $event->photos->first()->file_name))) {
                $event_img = asset('image/not_found/item_image_not_found.webp');
            }
        } else {
            $event_img = asset('image/not_found/item_image_not_found.webp');
        }
    @endphp
    <div class="sk-thumbnail img-ratio-7">
        <img src="{{ $event_img }}" alt="..." class="img-fluid">
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xl-10 mx-xl-auto mt-md-n10 mt-xl-n13 mb-8">
                <div class="rounded bg-white p-5 p-lg-8">
                    <ul class="nav mx-n3 d-block d-md-flex justify-content-center mb-5 align-items-center">
                        <li class="nav-item px-3 mb-3 mb-md-0">
                            <span class="badge badge-lg badge-orange badge-pill px-5">
                                <span
                                    class="text-white fw-normal font-size-sm">{{ $event->start_date ? \Carbon\Carbon::parse($event->start_date)->translatedFormat('d F Y') : null }}
                                </span>
                            </span>
                        </li>

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

                    <h1 class="text-center mb-5">{{ $event->title }}</h1>

                    @if ($event->start_date && $event->start_date > now())
                        <div class="row w-xl-65 mx-xl-auto text-center">
                            <div class="col-6 col-md-3 mb-6 mb-md-0">
                                <div class="h1 text-blue mb-2"><span id="days" data-aos
                                        data-aos-id="countup:in"></span></div>
                                <p class="h5 mb-0">DAYS</p>
                            </div>

                            <div class="col-6 col-md-3 mb-6 mb-md-0">
                                <div class="h1 text-blue mb-2"><span id="hours" data-aos
                                        data-aos-id="countup:in"></span></div>
                                <p class="h5 mb-0">HOURS</p>
                            </div>

                            <div class="col-6 col-md-3 mb-6 mb-md-0">
                                <div class="h1 text-blue mb-2"><span id="minutes" data-aos
                                        data-aos-id="countup:in"></span></div>
                                <p class="h5 mb-0">MINUTES</p>
                            </div>

                            <div class="col-6 col-md-3 mb-6 mb-md-0">
                                <div class="h1 text-blue mb-2"><span id="seconds" data-aos
                                        data-aos-id="countup:in"></span></div>
                                <p class="h5 mb-0">SECONDS</p>
                            </div>
                        </div>


                        <script>
                            var eventDate = new Date("{{ $event->start_date }}");

                            function updateCountdown() {
                                var now = new Date().getTime();
                                var timeLeft = eventDate - now;

                                var days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                                var hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                var minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                                var seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                                document.getElementById("days").innerText = days;
                                document.getElementById("hours").innerText = hours;
                                document.getElementById("minutes").innerText = minutes;
                                document.getElementById("seconds").innerText = seconds;
                            }

                            setInterval(updateCountdown, 1000);
                            updateCountdown();
                        </script>
                    @endif
                </div>
            </div>
        </div>

        <div class="row mb-11">
            <div class="col-lg-8 mb-6 mb-lg-0">
                <h3 class="">Event Description</h3>
                <p class="mb-6 line-height-md">
                    {!! $event->motavation !!}
                </p>
                <p class="mb-6 line-height-md">
                    {!! $exposedText !!}
                </p>
                <p class="collapse mb-6 line-height-md" id="readcollapseExample">
                    {!! $hiddenText !!}
                </p>
                @if (strlen($hiddenText) > 0)
                    <a class="text-teal read-more h6 d-inline-block mb-8" data-bs-toggle="collapse"
                        href="#readcollapseExample" role="button" aria-expanded="false"
                        aria-controls="readcollapseExample">
                        <span class="d-inline-flex align-items-center more">
                            Read More
                            <span
                                class="d-flex align-items-center justify-content-center bg-teal rounded-circle ms-2 p-2 w-26p">
                                <i class="fas fa-plus font-size-10 text-white"></i>
                            </span>
                        </span>
                        <span class="d-inline-flex align-items-center less">
                            Read Less
                            <span
                                class="d-flex align-items-center justify-content-center bg-teal rounded-circle ms-2 p-2 w-26p">
                                <i class="fas fa-minus font-size-10 text-white"></i>
                            </span>
                        </span>
                    </a>
                @endif

                <h3 class="mb-5">{{ __('transf.txt_what_you_will_learn') }}</h3>
                <div class="row row-cols-lg-2 mb-8 list-style-v1 list-unstyled ">
                    @foreach ($event->topics as $topic)
                        <li class="col-sm-6">{{ $topic->title }}</li>
                    @endforeach
                </div>


                {{-- </div> --}}

                <h3 class="mb-5">{{ __('transf.txt_requirements') }}</h3>
                <ul class="list-style-v2 list-unstyled">
                    @foreach ($event->requirements as $requirement)
                        <li>{{ $requirement->title }}</li>
                    @endforeach

                </ul>


                {{-- {{ dd($event) }} --}}
                <h3 class="mb-5">Our Speakers</h3>
                <div class="row row-cols-md-2 row-cols-xl-4 mb-9">
                    @foreach ($event->users as $instructor)
                        <div class="col-md mb-5 mb-xl-0">
                            <div class="card">
                                <!-- Image -->
                                <div class="card-zoom position-relative d-flex justify-content-center">
                                    <div class="card-float card-hover center">
                                        <ul class="nav mx-n1 justify-content-center">
                                            @if ($instructor->facebook)
                                                <li class="nav-item px-1">
                                                    <a href="{{ $instructor->facebook }}" class="d-block text-white">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                </li>
                                            @endif
                                            @if ($instructor->twitter)
                                                <li class="nav-item px-1">
                                                    <a href="{{ $instructor->twitter }}" class="d-block text-white">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                </li>
                                            @endif
                                            @if ($instructor->instagram)
                                                <li class="nav-item px-1">
                                                    <a href="{{ $instructor->instagram }}" class="d-block text-white">
                                                        <i class="fab fa-instagram"></i>
                                                    </a>
                                                </li>
                                            @endif
                                            @if ($instructor->linkedin)
                                                <li class="nav-item px-1">
                                                    <a href="{{ $instructor->linkedin }}" class="d-block text-white">
                                                        <i class="fab fa-linkedin-in"></i>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>

                                    <a href="#"
                                        class="rounded-circle overflow-hidden card-hover-overlay position-relative d-block"
                                        style="max-width: 150px;">
                                        @php
                                            if ($instructor->user_image != null) {
                                                $instructor_img = asset(
                                                    'assets/instructors/' . $instructor->user_image,
                                                );

                                                if (
                                                    !file_exists(
                                                        public_path('assets/instructors/' . $instructor->user_image),
                                                    )
                                                ) {
                                                    $instructor_img = asset('image/not_found/avator1.webp');
                                                }
                                            } else {
                                                $instructor_img = asset('image/not_found/avator1.webp');
                                            }
                                        @endphp
                                        <img class="rounded-circle mx-auto shadow-light-lg img-fluid"
                                            src="{{ $instructor_img }}" alt="...">
                                    </a>
                                </div>

                                <!-- Footer -->
                                <div class="card-footer px-0 text-center pt-4 pb-0">
                                    <a href="#" class="d-block">
                                        <h5 class="mb-0">{{ $instructor->first_name }} {{ $instructor->last_name }}
                                        </h5>
                                    </a>
                                    <span class="font-size-d-sm">
                                        @if (count($instructor->specializations) > 0)
                                            @foreach ($instructor->specializations as $specialization)
                                                {{ $specialization->name }}

                                                @if (!$loop->last)
                                                    &
                                                @endif
                                            @endforeach
                                        @else
                                            specification did not set yet
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>

                <div class="row mb-6 mb-md-10 align-items-center">
                    <div class="col-md-4 mb-5 mb-md-2">
                        <a href="{{ $whatsappShareUrl }}" target="_blank"
                            class="text-teal fw-medium d-flex align-items-center">
                            <!-- Icon -->
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16.0283 6.25C14.3059 6.25 12.9033 4.84833 12.9033 3.125C12.9033 1.40167 14.3059 0 16.0283 0C17.7509 0 19.1533 1.40167 19.1533 3.125C19.1533 4.84833 17.7509 6.25 16.0283 6.25ZM16.0283 1.25C14.995 1.25 14.1533 2.09076 14.1533 3.125C14.1533 4.15924 14.995 5 16.0283 5C17.0616 5 17.9033 4.15924 17.9033 3.125C17.9033 2.09076 17.0616 1.25 16.0283 1.25Z"
                                    fill="currentColor" />
                                <path
                                    d="M16.0283 20C14.3059 20 12.9033 18.5983 12.9033 16.875C12.9033 15.1517 14.3059 13.75 16.0283 13.75C17.7509 13.75 19.1533 15.1517 19.1533 16.875C19.1533 18.5983 17.7509 20 16.0283 20ZM16.0283 15C14.995 15 14.1533 15.8408 14.1533 16.875C14.1533 17.9092 14.995 18.75 16.0283 18.75C17.0616 18.75 17.9033 17.9092 17.9033 16.875C17.9033 15.8408 17.0616 15 16.0283 15Z"
                                    fill="currentColor" />
                                <path
                                    d="M3.94531 13.125C2.22275 13.125 0.820312 11.7233 0.820312 10C0.820312 8.27667 2.22275 6.875 3.94531 6.875C5.66788 6.875 7.07031 8.27667 7.07031 10C7.07031 11.7233 5.66788 13.125 3.94531 13.125ZM3.94531 8.125C2.91199 8.125 2.07031 8.96576 2.07031 10C2.07031 11.0342 2.91199 11.875 3.94531 11.875C4.97864 11.875 5.82031 11.0342 5.82031 10C5.82031 8.96576 4.97864 8.125 3.94531 8.125Z"
                                    fill="currentColor" />
                                <path
                                    d="M6.12066 9.39154C5.90307 9.39154 5.69143 9.27817 5.57729 9.0766C5.40639 8.77661 5.51061 8.39484 5.8106 8.22409L13.5431 3.81568C13.8422 3.64325 14.2247 3.74823 14.3947 4.04914C14.5656 4.34912 14.4614 4.73075 14.1614 4.90164L6.42888 9.30991C6.33138 9.36484 6.22564 9.39154 6.12066 9.39154Z"
                                    fill="currentColor" />
                                <path
                                    d="M13.8524 16.2665C13.7475 16.2665 13.6416 16.2398 13.5441 16.1841L5.81151 11.7757C5.51152 11.6049 5.40745 11.2231 5.5782 10.9232C5.74818 10.6224 6.12996 10.5182 6.42994 10.6899L14.1623 15.0981C14.4623 15.269 14.5665 15.6506 14.3958 15.9506C14.2807 16.1531 14.0691 16.2665 13.8524 16.2665Z"
                                    fill="currentColor" />
                            </svg>

                            <span class="ms-3">Share This Event</span>
                        </a>
                    </div>

                    <div class="col-md-8">
                        <a href="#" class="btn btn-sm btn-light text-gray-800 px-5 fw-normal me-1 mb-2">Course</a>
                        <a href="#" class="btn btn-sm btn-light text-gray-800 px-5 fw-normal me-1 mb-2">Timeline</a>
                        <a href="#" class="btn btn-sm btn-light text-gray-800 px-5 fw-normal me-1 mb-2">Moodle</a>
                        <a href="#" class="btn btn-sm btn-light text-gray-800 px-5 fw-normal me-1 mb-2">Best</a>
                        <a href="#" class="btn btn-sm btn-light text-gray-800 px-5 fw-normal me-1 mb-2">Info</a>
                    </div>
                </div>

                {{-- event reviews --}}
                @livewire('frontend.event-list.event-review-component', ['eventId' => $event->id])


            </div>

            <div class="col-lg-4">
                <!-- SIDEBAR -->
                <div class="rounded border p-2 shadow mb-6">
                    <div class="pt-5 pb-4 px-5 px-lg-3 px-xl-5">
                        <div class="d-flex align-items-center mb-2">
                            <ins class="h2 mb-0">$89.99</ins>
                            <del class="ms-3">339.99</del>
                            <div class="badge badge-lg badge-purple text-white ms-auto fw-normal">91% Off</div>
                        </div>

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

                            <span class="ms-2">2 days left at this price!</span>
                        </div>

                        <ul class="list-group list-group-flush mb-6">
                            <li class="list-group-item d-flex align-items-center py-3">
                                <div class="text-secondary d-flex">
                                    <!-- Icon -->
                                    <svg width="15" height="15" viewBox="0 0 15 15"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M13.8102 9.52183C13.313 9.08501 12.7102 8.70758 12.0181 8.40008C11.7223 8.2687 11.3761 8.40191 11.2447 8.69762C11.1134 8.99334 11.2466 9.33952 11.5423 9.47102C12.1258 9.73034 12.6287 10.0436 13.0367 10.4021C13.5396 10.8441 13.8281 11.484 13.8281 12.1582V13.2422C13.8281 13.5653 13.5653 13.8281 13.2422 13.8281H1.75781C1.43475 13.8281 1.17188 13.5653 1.17188 13.2422V12.1582C1.17188 11.484 1.46038 10.8441 1.96335 10.4021C2.55535 9.88186 4.2802 8.67188 7.5 8.67188C9.89079 8.67188 11.8359 6.72672 11.8359 4.33594C11.8359 1.94515 9.89079 0 7.5 0C5.10921 0 3.16406 1.94515 3.16406 4.33594C3.16406 5.7336 3.82896 6.97872 4.85893 7.77214C2.97432 8.18642 1.80199 8.98384 1.18984 9.52183C0.433731 10.1862 0 11.147 0 12.1582V13.2422C0 14.2115 0.788498 15 1.75781 15H13.2422C14.2115 15 15 14.2115 15 13.2422V12.1582C15 11.147 14.5663 10.1862 13.8102 9.52183ZM4.33594 4.33594C4.33594 2.59129 5.75535 1.17188 7.5 1.17188C9.24465 1.17188 10.6641 2.59129 10.6641 4.33594C10.6641 6.08059 9.24465 7.5 7.5 7.5C5.75535 7.5 4.33594 6.08059 4.33594 4.33594Z"
                                            fill="currentColor" />
                                    </svg>

                                </div>
                                <h6 class="mb-0 ms-3 me-auto">Total Slot</h6>
                                <span>240</span>
                            </li>
                            <li class="list-group-item d-flex align-items-center py-3">
                                <div class="text-secondary d-flex">
                                    <!-- Icon -->
                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15.625 7.34375H7.3423V4.13164C7.3423 2.715 8.53391 1.5625 9.99855 1.5625C11.4632 1.5625 12.6548 2.715 12.6548 4.13164V5.625H14.2173V4.13164C14.2173 1.85344 12.3248 0 9.99855 0C7.67234 0 5.7798 1.85344 5.7798 4.13164V7.34375H4.375C3.08266 7.34375 2.03125 8.39516 2.03125 9.6875V17.6562C2.03125 18.9486 3.08266 20 4.375 20H15.625C16.9173 20 17.9688 18.9486 17.9688 17.6562V9.6875C17.9688 8.39516 16.9173 7.34375 15.625 7.34375ZM16.4062 17.6562C16.4062 18.087 16.0558 18.4375 15.625 18.4375H4.375C3.94422 18.4375 3.59375 18.087 3.59375 17.6562V9.6875C3.59375 9.25672 3.94422 8.90625 4.375 8.90625H15.625C16.0558 8.90625 16.4062 9.25672 16.4062 9.6875V17.6562Z"
                                            fill="currentColor" />
                                        <path
                                            d="M10 11.1719C9.20176 11.1719 8.55469 11.8189 8.55469 12.6172C8.55469 13.1269 8.81875 13.5746 9.2173 13.832V15.5469C9.2173 15.9783 9.56707 16.3281 9.99855 16.3281C10.43 16.3281 10.7798 15.9783 10.7798 15.5469V13.8338C11.18 13.5768 11.4453 13.1281 11.4453 12.6172C11.4453 11.8189 10.7982 11.1719 10 11.1719Z"
                                            fill="currentColor" />
                                    </svg>

                                </div>
                                <h6 class="mb-0 ms-3 me-auto">Booked Slot</h6>
                                <span>20</span>
                            </li>
                        </ul>

                        <button class="btn btn-primary btn-block mb-3" type="button" name="button">BOOK NOW</button>

                        <div class="text-center">
                            <a href="{{ $whatsappShareUrl }}" target="_blank"
                                class="mx-auto text-teal fw-medium d-inline-flex align-items-center mt-2">
                                <!-- Icon -->
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16.0283 6.25C14.3059 6.25 12.9033 4.84833 12.9033 3.125C12.9033 1.40167 14.3059 0 16.0283 0C17.7509 0 19.1533 1.40167 19.1533 3.125C19.1533 4.84833 17.7509 6.25 16.0283 6.25ZM16.0283 1.25C14.995 1.25 14.1533 2.09076 14.1533 3.125C14.1533 4.15924 14.995 5 16.0283 5C17.0616 5 17.9033 4.15924 17.9033 3.125C17.9033 2.09076 17.0616 1.25 16.0283 1.25Z"
                                        fill="currentColor" />
                                    <path
                                        d="M16.0283 20C14.3059 20 12.9033 18.5983 12.9033 16.875C12.9033 15.1517 14.3059 13.75 16.0283 13.75C17.7509 13.75 19.1533 15.1517 19.1533 16.875C19.1533 18.5983 17.7509 20 16.0283 20ZM16.0283 15C14.995 15 14.1533 15.8408 14.1533 16.875C14.1533 17.9092 14.995 18.75 16.0283 18.75C17.0616 18.75 17.9033 17.9092 17.9033 16.875C17.9033 15.8408 17.0616 15 16.0283 15Z"
                                        fill="currentColor" />
                                    <path
                                        d="M3.94531 13.125C2.22275 13.125 0.820312 11.7233 0.820312 10C0.820312 8.27667 2.22275 6.875 3.94531 6.875C5.66788 6.875 7.07031 8.27667 7.07031 10C7.07031 11.7233 5.66788 13.125 3.94531 13.125ZM3.94531 8.125C2.91199 8.125 2.07031 8.96576 2.07031 10C2.07031 11.0342 2.91199 11.875 3.94531 11.875C4.97864 11.875 5.82031 11.0342 5.82031 10C5.82031 8.96576 4.97864 8.125 3.94531 8.125Z"
                                        fill="currentColor" />
                                    <path
                                        d="M6.12066 9.39154C5.90307 9.39154 5.69143 9.27817 5.57729 9.0766C5.40639 8.77661 5.51061 8.39484 5.8106 8.22409L13.5431 3.81568C13.8422 3.64325 14.2247 3.74823 14.3947 4.04914C14.5656 4.34912 14.4614 4.73075 14.1614 4.90164L6.42888 9.30991C6.33138 9.36484 6.22564 9.39154 6.12066 9.39154Z"
                                        fill="currentColor" />
                                    <path
                                        d="M13.8524 16.2665C13.7475 16.2665 13.6416 16.2398 13.5441 16.1841L5.81151 11.7757C5.51152 11.6049 5.40745 11.2231 5.5782 10.9232C5.74818 10.6224 6.12996 10.5182 6.42994 10.6899L14.1623 15.0981C14.4623 15.269 14.5665 15.6506 14.3958 15.9506C14.2807 16.1531 14.0691 16.2665 13.8524 16.2665Z"
                                        fill="currentColor" />
                                </svg>

                                <span class="ms-3">Share this course</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
