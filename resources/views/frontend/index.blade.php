@extends('layouts.app')

@section('content')
    {{-- HERO --}}
    <section class="mt-n12">
        {{-- {{ dd($instructors) }} --}}
        <div class="flickity-page-dots-vertical flickity-page-dots-md flickity-page-dots-white position-static"
            data-flickity='{"pageDots": true, "prevNextButtons": false, "cellAlign": "center", "wrapAround": true, "imagesLoaded": true}'>

            @forelse ($main_sliders->where('section' ,1) as $main_slider)
                <div class="w-100">
                    <div class="vh-100 bg-cover position-relative overlay overlay-custom"
                        style="background-image: url({{ asset('assets/main_sliders/' . $main_slider->firstMedia?->file_name) }})">
                        <div class="container position-static pt-9 pt-md-12 pb-8 py-lg-0">
                            <div class="mx-lg-n5">
                                <div class="vh-100 row gx-0 mx-auto">
                                    <div class="col-12 mt-12 mb-4 my-md-auto text-center" style="z-index:1;">
                                        <!-- Heading -->
                                        <h1 class="display-5 fw-medium text-white mb-2 text-uppercase" data-aos="fade-left"
                                            data-aos-duration="150">
                                            {{ $main_slider->title }}
                                        </h1>

                                        <!-- Text -->
                                        <p class="text-white-70 text-capitalize mb-5" data-aos="fade-up"
                                            data-aos-duration="200">
                                            {!! $main_slider->content !!}
                                        </p>

                                        <!-- Buttons -->
                                        <a href="course-single-v1.html"
                                            class="btn text-white-alone btn-slide slide-white btn-wide shadow mb-4 mb-md-0 me-md-5 text-uppercase"
                                            data-aos-duration="200"
                                            data-aos="fade-up">{{ __('transf.btn_get_started') }}</a>
                                        <a href="course-single-v1.html"
                                            class="btn text-white-all btn-coral btn-wide d-none d-lg-inline-block"
                                            data-aos-duration="200"
                                            data-aos="fade-up">{{ __('transf.btn_view_courses') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @empty
            @endforelse

        </div>

        <div class="py-7 py-lg-0 mt-lg-n11 overlay-lg-none overlay overlay-primary overlay-90">
            <div class="container">
                <ul class="nav row justify-content-between">
                    @foreach ($main_sliders->where('section', 2)->take(3) as $adv_slider)
                        <li class="col-lg-auto mb-5 mb-lg-0 nav-item">
                            <div class="d-flex align-items-center">
                                <div class="me-4 text-white icon-md">

                                    <i class="{{ $adv_slider->icon }}" style="font-size: 60px"></i>

                                </div>
                                <div class="media-body">
                                    <h4 class="text-white mb-0 text-uppercase">{{ $adv_slider->title }}</h4>
                                    <p class="text-white mb-0">{{ $adv_slider->description }} </p>
                                </div>
                            </div>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </section>

    {{-- CATEGORIES --}}
    @livewire('frontend.home.trending-categories-component')

    {{--  FEATURED PRODUCT --}}
    @livewire('frontend.home.featured-courses-component')

    {{-- CALL ACTION --}}
    <section class="py-6 py-md-12 jarallax" data-jarallax data-speed=".8"
        style="background-image: url({{ asset('frontend/assets/img/covers/cover-5.jpg') }})">
        <div class="container text-center py-xl-9 text-capitalize" data-aos="fade-up">
            <h1 class="text-white text-uppercase">{{ __('transf.txt_enhance_your_skin') }}</h1>
            <div class="font-size-lg mb-md-6 mb-4 text-white">{{ __('transf.txt_enhance_your_skin_desc') }}</div>
            <div class="mx-auto">
                <a href="#"
                    class="btn btn-sienna btn-x-wide lift d-inline-block text-white">{{ __('transf.btn_get_started_now') }}</a>
            </div>
        </div>
    </section>

    {{-- TESTIMONIAL --}}
    <section class="py-8 py-md-11 pb-xl-12 bg-white">
        <div class="container px-xl-9">
            <div class="text-center mb-2">
                <h1 class="mb-1">{{ __('transf.txt_what_our_students_have_to_say') }}</h1>
                <p class="font-size-lg text-capitalize mb-0">{{ __('transf.txt_what_our_students_have_to_say_desc') }}</p>
            </div>

            <div class="mx-n4 flickity-viewport-visible flickity-hover-opacity"
                data-flickity='{"cellAlign": "left", "wrapAround": false, "imagesLoaded": true, "pageDots": true, "prevNextButtons": false, "contain": true}'>
                <div class="col-12 col-md-6 py-md-7 py-3" style="padding-right:15px;padding-left:15px;">
                    <!-- Card -->
                    <div class="card">
                        <div class="bg-catskill rounded px-6 py-7">
                            <div class="star-rating mb-3">
                                <div class="rating" style="width:100%;"></div>
                            </div>
                            <p class="font-size-lg text-gray-800 mb-0 text-capitalize">“ I believe in lifelong learning and
                                Skola is a great place to learn from experts. I've learned a lot and recommend it to all my
                                friends “</p>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-0 pb-0 pt-5">
                            <div class="row gx-0 align-items-center">
                                <div class="col-auto">
                                    <!-- Image -->
                                    <div class="avatar avatar-custom">
                                        <img src="{{ asset('frontend/assets/img/avatars/avatar-2.jpg') }}" alt="..."
                                            class="avatar-img rounded-circle img-fluid">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card-body p-0 ms-5">
                                        <h5 class="mb-0">Alison Dawn</h5>
                                        <span class="text-gray-800">WordPress Developer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 py-md-7 py-3" style="padding-right:15px;padding-left:15px;">
                    <!-- Card -->
                    <div class="card">
                        <div class="bg-catskill rounded px-6 py-7">
                            <div class="star-rating mb-3">
                                <div class="rating" style="width:100%;"></div>
                            </div>
                            <p class="font-size-lg text-gray-800 mb-0 text-capitalize">“ I believe in lifelong learning and
                                Skola is a great place to learn from experts. I've learned a lot and recommend it to all my
                                friends “</p>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-0 pb-0 pt-5">
                            <div class="row gx-0 align-items-center">
                                <div class="col-auto">
                                    <!-- Image -->
                                    <div class="avatar avatar-custom">
                                        <img src="{{ asset('frontend/assets/img/avatars/avatar-1.jpg') }}" alt="..."
                                            class="avatar-img rounded-circle img-fluid">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card-body p-0 ms-5">
                                        <h5 class="mb-0">Albert Cole</h5>
                                        <span class="text-gray-800">Designer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 py-md-7 py-3" style="padding-right:15px;padding-left:15px;">
                    <!-- Card -->
                    <div class="card">
                        <div class="bg-catskill rounded px-6 py-7">
                            <div class="star-rating mb-3">
                                <div class="rating" style="width:100%;"></div>
                            </div>
                            <p class="font-size-lg text-gray-800 mb-0 text-capitalize">“ I believe in lifelong learning and
                                Skola is a great place to learn from experts. I've learned a lot and recommend it to all my
                                friends “</p>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-0 pb-0 pt-5">
                            <div class="row gx-0 align-items-center">
                                <div class="col-auto">
                                    <!-- Image -->
                                    <div class="avatar avatar-custom">
                                        <img src="{{ asset('frontend/assets/img/avatars/avatar-3.jpg') }}" alt="..."
                                            class="avatar-img rounded-circle img-fluid">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card-body p-0 ms-5">
                                        <h5 class="mb-0">Daniel Parker</h5>
                                        <span class="text-gray-800">Front-end Developer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 py-md-7 py-3" style="padding-right:15px;padding-left:15px;">
                    <!-- Card -->
                    <div class="card">
                        <div class="bg-catskill rounded px-6 py-7">
                            <div class="star-rating mb-3">
                                <div class="rating" style="width:100%;"></div>
                            </div>
                            <p class="font-size-lg text-gray-800 mb-0 text-capitalize">“ I believe in lifelong learning and
                                Skola is a great place to learn from experts. I've learned a lot and recommend it to all my
                                friends “</p>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-0 pb-0 pt-5">
                            <div class="row gx-0 align-items-center">
                                <div class="col-auto">
                                    <!-- Image -->
                                    <div class="avatar avatar-custom">
                                        <img src="{{ asset('frontend/assets/img/avatars/avatar-4.jpg') }}" alt="..."
                                            class="avatar-img rounded-circle img-fluid">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card-body p-0 ms-5">
                                        <h5 class="mb-0">Albert Cole</h5>
                                        <span class="text-gray-800">Designer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- EVENTS --}}
    <section class="py-5 py-md-11 bg-catskill">
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
                                        $event_img = asset('assets/events/' . $event->photos->first()->file_name);

                                        if (
                                            !file_exists(
                                                public_path('assets/events/' . $event->photos->first()->file_name),
                                            )
                                        ) {
                                            $event_img = asset('image/not_found/item_image_not_found.webp');
                                        }
                                    } else {
                                        $event_img = asset('image/not_found/item_image_not_found.webp');
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

                                        <a href="{{ route('frontend.event_single', $event->slug) }}"
                                            class="d-block mb-2">
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

    {{-- BLOG --}}
    <section class="py-5 py-md-11 bg-white">
        <div class="container">
            <div class="text-center mb-4 mb-md-7" data-aos="fade-up">
                <h1 class="mb-1">{{ __('transf.txt_latest_news') }}</h1>
                <p class="font-size-lg mb-0 text-capitalize">{{ __('transf.txt_latest_news_desc') }}</p>
            </div>

            <div class="row align-items-end mb-4 mb-md-7">
                <div class="col-md mb-4 mb-md-0">
                </div>
                <div class="col-md-auto" data-aos="fade-start">
                    <a href="{{ route('frontend.blog_list') }}" class="d-flex align-items-center fw-medium">
                        {{ __('transf.browse_all') }}
                        <div class="ms-2 d-flex">
                            <!-- Icon -->
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.7779 4.6098L3.32777 0.159755C3.22485 0.0567475 3.08745 0 2.94095 0C2.79445 0 2.65705 0.0567475 2.55412 0.159755L2.2264 0.487394C2.01315 0.700889 2.01315 1.04788 2.2264 1.26105L5.96328 4.99793L2.22225 8.73895C2.11933 8.84196 2.0625 8.97928 2.0625 9.1257C2.0625 9.27228 2.11933 9.4096 2.22225 9.51269L2.54998 9.84025C2.65298 9.94325 2.7903 10 2.9368 10C3.0833 10 3.2207 9.94325 3.32363 9.84025L7.7779 5.38614C7.88107 5.2828 7.93774 5.14484 7.93741 4.99817C7.93774 4.85094 7.88107 4.71305 7.7779 4.6098Z"
                                    fill="currentColor" />
                            </svg>

                        </div>
                    </a>
                </div>
            </div>

            <div class="row row-cols-md-2 row-cols-lg-3">
                @foreach ($posts->take(3) as $post)
                    <div class="col-md mb-5 mb-lg-0">
                        <!-- Card -->
                        <div class="card border shadow p-2 lift sk-fade">
                            <!-- Image -->
                            <div class="card-zoom position-relative">
                                <a href="{{ route('frontend.blog_single', $post->slug) }}"
                                    class="card-img d-block sk-thumbnail img-ratio-3">
                                    @php
                                        if (
                                            $post->photos->first() != null &&
                                            $post->photos->first()->file_name != null
                                        ) {
                                            $post_img = asset('assets/posts/' . $post->photos->first()->file_name);

                                            if (
                                                !file_exists(
                                                    public_path('assets/posts/' . $post->photos->first()->file_name),
                                                )
                                            ) {
                                                $post_img = asset('image/not_found/item_image_not_found.webp');
                                            }
                                        } else {
                                            $post_img = asset('image/not_found/item_image_not_found.webp');
                                        }
                                    @endphp
                                    <img class="rounded shadow-light-lg img-fluid" src="{{ $post_img }}"
                                        alt="...">
                                </a>

                                <a href="{{ route('frontend.blog_list', $post->courseCategory->slug) }}"
                                    class="badge sk-fade-bottom badge-lg badge-purple badge-pill badge-float bottom-0 left-0 mb-4 ms-4 px-5 me-4">
                                    <span
                                        class="text-white fw-normal font-size-sm">{{ $post->courseCategory->title }}</span>
                                </a>
                            </div>

                            <!-- Footer -->
                            <div class="card-footer px-2 pb-0 pt-4">
                                <ul class="nav mx-n3 mb-3">
                                    <li class="nav-item px-3">
                                        <a href="{{ route('frontend.instructors_single', $post->users->first()->id) }}"
                                            class="d-flex align-items-center text-gray-800">
                                            <div class="me-3 d-flex">
                                                <!-- Icon -->
                                                <svg width="15" height="15" viewBox="0 0 15 15"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M13.8102 9.52183C13.313 9.08501 12.7102 8.70758 12.0181 8.40008C11.7223 8.2687 11.3761 8.40191 11.2447 8.69762C11.1134 8.99334 11.2466 9.33952 11.5423 9.47102C12.1258 9.73034 12.6287 10.0436 13.0367 10.4021C13.5396 10.8441 13.8281 11.484 13.8281 12.1582V13.2422C13.8281 13.5653 13.5653 13.8281 13.2422 13.8281H1.75781C1.43475 13.8281 1.17188 13.5653 1.17188 13.2422V12.1582C1.17188 11.484 1.46038 10.8441 1.96335 10.4021C2.55535 9.88186 4.2802 8.67188 7.5 8.67188C9.89079 8.67188 11.8359 6.72672 11.8359 4.33594C11.8359 1.94515 9.89079 0 7.5 0C5.10921 0 3.16406 1.94515 3.16406 4.33594C3.16406 5.7336 3.82896 6.97872 4.85893 7.77214C2.97432 8.18642 1.80199 8.98384 1.18984 9.52183C0.433731 10.1862 0 11.147 0 12.1582V13.2422C0 14.2115 0.788498 15 1.75781 15H13.2422C14.2115 15 15 14.2115 15 13.2422V12.1582C15 11.147 14.5663 10.1862 13.8102 9.52183ZM4.33594 4.33594C4.33594 2.59129 5.75535 1.17188 7.5 1.17188C9.24465 1.17188 10.6641 2.59129 10.6641 4.33594C10.6641 6.08059 9.24465 7.5 7.5 7.5C5.75535 7.5 4.33594 6.08059 4.33594 4.33594Z"
                                                        fill="currentColor" />
                                                </svg>

                                            </div>
                                            <div class="font-size-sm">{{ $post->users->first()->full_name }}</div>
                                        </a>
                                    </li>
                                    <li class="nav-item px-3">
                                        <a href="{{ route('frontend.blog_single', $post->slug) }}"
                                            class="d-flex align-items-center text-gray-800">
                                            <div class="me-2 d-flex">
                                                <!-- Icon -->
                                                <svg width="15" height="15" viewBox="0 0 15 15"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M13.0664 1.17188H11.7188V0.46875C11.7188 0.209883 11.5089 0 11.25 0C10.9911 0 10.7812 0.209883 10.7812 0.46875V1.17188H4.21875V0.46875C4.21875 0.209883 4.0089 0 3.75 0C3.4911 0 3.28125 0.209883 3.28125 0.46875V1.17188H1.93359C0.867393 1.17188 0 2.03927 0 3.10547V13.0664C0 14.1326 0.867393 15 1.93359 15H13.0664C14.1326 15 15 14.1326 15 13.0664V3.10547C15 2.03927 14.1326 1.17188 13.0664 1.17188ZM1.93359 2.10938H3.28125V2.57812C3.28125 2.83699 3.4911 3.04688 3.75 3.04688C4.0089 3.04688 4.21875 2.83699 4.21875 2.57812V2.10938H10.7812V2.57812C10.7812 2.83699 10.9911 3.04688 11.25 3.04688C11.5089 3.04688 11.7188 2.83699 11.7188 2.57812V2.10938H13.0664C13.6157 2.10938 14.0625 2.55621 14.0625 3.10547V4.21875H0.9375V3.10547C0.9375 2.55621 1.38434 2.10938 1.93359 2.10938ZM13.0664 14.0625H1.93359C1.38434 14.0625 0.9375 13.6157 0.9375 13.0664V5.15625H14.0625V13.0664C14.0625 13.6157 13.6157 14.0625 13.0664 14.0625Z"
                                                        fill="currentColor" />
                                                </svg>

                                            </div>
                                            <div class="font-size-sm">
                                                {{ $post->created_at ? \Carbon\Carbon::parse($post->created_at)->translatedFormat('d F Y') : null }}
                                            </div>
                                        </a>
                                    </li>
                                </ul>

                                <!-- Heading -->
                                <a href="{{ route('frontend.blog_single', $post->slug) }}" class="d-block">
                                    <h5 class="line-clamp-2 h-48 h-lg-52">
                                        {{ $post->title }}
                                    </h5>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- INSTRUCTORS --}}
    <section class="py-5 py-md-11 bg-catskill">
        <div class="container">
            <div class="text-center mb-4 mb-md-7" data-aos="fade-up">
                <h1 class="mb-1">{{ __('transf.txt_top_rating_instructuros') }}</h1>
                <p class="font-size-lg mb-0 text-capitalize">{{ __('transf.txt_top_rating_instructuros_desc') }}</p>
            </div>

            <div class="mx-n3 mx-md-n4"
                data-flickity='{"pageDots": false,"cellAlign": "left", "wrapAround": true, "imagesLoaded": true}'>
                @foreach ($instructors as $instructor)
                    <div class="col-6 col-md-4 col-lg-3 text-center py-5 text-md-left px-3 px-md-4" data-aos="fade-up"
                        data-aos-delay="{{ 50 * $loop->iteration }}">
                        <div class="card border shadow p-2 lift">
                            <!-- Image -->
                            <div class="card-zoom position-relative" style="max-width: 250px;">
                                <div class="card-float card-hover right-0 left-0 bottom-0 mb-4">
                                    <ul class="nav mx-n4 justify-content-center">
                                        @if ($instructor->facebook)
                                            <li class="nav-item px-4">
                                                <a href="{{ $instructor->facebook }}" class="d-block text-white">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($instructor->twitter)
                                            <li class="nav-item px-4">
                                                <a href="{{ $instructor->twitter }}" class="d-block text-white">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($instructor->instagram)
                                            <li class="nav-item px-4">
                                                <a href="{{ $instructor->instagram }}" class="d-block text-white">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($instructor->linkedin)
                                            <li class="nav-item px-4">
                                                <a href="{{ $instructor->linkedin }}" class="d-block text-white">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>

                                <a href="{{ route('frontend.instructors_single', $instructor->id) }}"
                                    class="card-img sk-thumbnail img-ratio-4 card-hover-overlay coral d-block">
                                    @php
                                        if ($instructor->user_image != null) {
                                            $instructor_img = asset('assets/instructors/' . $instructor->user_image);

                                            if (
                                                !file_exists(
                                                    public_path('assets/instructors/' . $instructor->user_image),
                                                )
                                            ) {
                                                $instructor_img = asset('assets/instructors/user_not_found.webp');
                                            }
                                        } else {
                                            $instructor_img = asset('assets/instructors/user_not_found.webp');
                                        }
                                    @endphp
                                    <img class="rounded shadow-light-lg img-fluid" src="{{ $instructor_img }}"
                                        alt="{{ $instructor->full_name }}">
                                </a>
                            </div>

                            <!-- Footer -->
                            <div class="card-footer px-3 pt-4 pb-1">
                                <a href="{{ route('frontend.instructors_single', $instructor->id) }}" class="d-block">
                                    <h5 class="mb-0">{{ $instructor->full_name }}</h5>
                                </a>
                                <span class="font-size-d-sm">
                                    @if (count($instructor->specializations) > 0)
                                        @foreach ($instructor->specializations->take(2) as $specialization)
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
        </div>
    </section>

    {{-- COUNTUP --}}
    <section class="py-5 py-md-12 jarallax" data-jarallax data-speed=".8"
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
                                <div class="h2 text-white mb-0"><span data-toggle="countup" data-from="0"
                                        data-to="40" data-aos data-aos-id="countup:in"></span></div>
                            </div>
                            <span class="h4 fw-medium text-white mb-0">{{ __('transf.txt_days') }}</span>
                        </div>

                        <div class="col-md-auto px-md-1 px-lg-5 mb-6 mb-md-0">
                            <div
                                class="mb-4 mx-auto border-white border-w-md border rounded-circle h-90p w-90p d-flex align-items-center justify-content-center flex-column">
                                <div class="h2 text-white mb-0"><span data-toggle="countup" data-from="0"
                                        data-to="59" data-aos data-aos-id="countup:in"></span></div>
                            </div>
                            <span class="h4 fw-medium text-white mb-0">{{ __('transf.txt_hours') }}</span>
                        </div>

                        <div class="col-md-auto px-md-1 px-lg-5 mb-6 mb-md-0">
                            <div
                                class="mb-4 mx-auto border-white border-w-md border rounded-circle h-90p w-90p d-flex align-items-center justify-content-center flex-column">
                                <div class="h2 text-white mb-0"><span data-toggle="countup" data-from="0"
                                        data-to="27" data-aos data-aos-id="countup:in"></span></div>
                            </div>
                            <span class="h4 fw-medium text-white mb-0">{{ __('transf.txt_minutes') }}</span>
                        </div>

                        <div class="col-md-auto px-md-1 px-lg-5 mb-6 mb-md-0">
                            <div
                                class="mb-4 mx-auto border-white border-w-md border rounded-circle h-90p w-90p d-flex align-items-center justify-content-center flex-column">
                                <div class="h2 text-white mb-0"><span data-toggle="countup" data-from="0"
                                        data-to="10" data-aos data-aos-id="countup:in"></span></div>
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

    {{-- NEWSLETTER --}}
    <section class="py-6 py-md-8 bg-coral">
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
@endsection
