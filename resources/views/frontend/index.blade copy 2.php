@extends('layouts.app')

@section('content')
    <!-- HERO
                                                                                                                                                                                                                                                                                                ================================================== -->
    <section class="mt-n12">
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
                    {{-- @foreach ($main_sliders->where('section', 2) as $adv_slider)
                        <li class="col-lg-auto mb-5 mb-lg-0 nav-item">
                            <div class="d-flex align-items-center">
                                <div class="me-4 text-white icon-md">
                                    
                                    <i class="{{ $adv_slider->icon }}"></i>

                                </div>
                                <div class="media-body">
                                    <h4 class="text-white mb-0 text-uppercase">{{ $adv_slider->title }}</h4>
                                    <p class="text-white mb-0">{{ $adv_slider->description }} </p>
                                </div>
                            </div>
                        </li>
                    @endforeach --}}

                    <li class="col-lg-auto mb-5 mb-lg-0 nav-item">
                        <div class="d-flex align-items-center">
                            <div class="me-4 text-white icon-md">
                                <!-- Icon -->
                                <svg width="60" height="61" viewBox="0 0 60 61" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M55.1953 31.7109C57.8842 31.4375 60 28.8389 60 25.6822V6.84812C60 3.51005 57.6343 0.794312 54.7266 0.794312H37.2656C34.3579 0.794312 31.9922 3.51005 31.9922 6.84812V14.7853H10.0781C7.17035 14.7853 4.80469 17.5011 4.80469 20.8392V45.0544C4.80469 45.7618 4.91191 46.4407 5.10703 47.0723H3.16406C1.41938 47.0723 0 48.7018 0 50.7046C0 56.2681 3.94277 60.7943 8.78906 60.7943H51.2109C56.0572 60.7943 60 56.2681 60 50.7046C60 48.7018 58.5806 47.0723 56.8359 47.0723H54.893C55.0881 46.4407 55.1953 45.7618 55.1953 45.0544V31.7109ZM35.5078 6.84812C35.5078 5.73543 36.2964 4.83019 37.2656 4.83019H54.7266C55.6958 4.83019 56.4844 5.73543 56.4844 6.84812V25.6822C56.4844 26.7949 55.6958 27.7001 54.7266 27.7001H38.4375C38.108 27.7001 37.7852 27.8064 37.5059 28.0069L33.9616 30.5499L35.4338 24.9167C35.4829 24.7287 35.5078 24.5333 35.5078 24.3369V6.84812ZM51.2109 56.7584H8.78906C5.99941 56.7584 3.70887 54.2588 3.52723 51.1082H56.4728C56.2911 54.2588 54.0006 56.7584 51.2109 56.7584ZM16.7578 31.8705C16.7578 30.6095 17.6515 29.5835 18.75 29.5835C19.8485 29.5835 20.7422 30.6095 20.7422 31.8705C20.7422 33.1316 19.8485 34.1575 18.75 34.1575C17.6515 34.1575 16.7578 33.1316 16.7578 31.8705ZM15.8203 40.4804C15.8203 39.2621 17.1893 38.1934 18.75 38.1934C19.587 38.1934 20.3933 38.4931 20.9624 39.0158C21.2304 39.2618 21.6797 39.7792 21.6797 40.4804V47.0723H15.8203V40.4804ZM25.1953 47.0723V40.4804C25.1953 38.7356 24.453 37.053 23.1586 35.8643C23.1295 35.8375 23.0992 35.8125 23.0696 35.7864C23.8126 34.7086 24.2578 33.3485 24.2578 31.8705C24.2578 28.3841 21.787 25.5477 18.75 25.5477C15.713 25.5477 13.2422 28.3841 13.2422 31.8705C13.2422 33.3502 13.6884 34.7115 14.4328 35.7899C13.1269 36.9478 12.3047 38.6216 12.3047 40.4804V47.0723H10.0781C9.10887 47.0723 8.32031 46.1671 8.32031 45.0544V20.8392C8.32031 19.7265 9.10887 18.8212 10.0781 18.8212H31.9922V24.0408L30.5943 29.3901C30.1697 31.0147 30.6543 32.7294 31.8288 33.7583C32.4615 34.3125 33.2084 34.5926 33.9587 34.5926C34.6014 34.5926 35.2467 34.387 35.8247 33.9723L38.9416 31.736H51.6797V45.0544C51.6797 46.1671 50.8911 47.0723 49.9219 47.0723H25.1953Z"
                                        fill="currentColor" />
                                    <path
                                        d="M47.8125 19.0903H44.0625C43.0917 19.0903 42.3047 19.9936 42.3047 21.1078C42.3047 22.222 43.0917 23.1253 44.0625 23.1253H47.8125C48.7833 23.1253 49.5703 22.222 49.5703 21.1078C49.5703 19.9936 48.7833 19.0903 47.8125 19.0903Z"
                                        fill="currentColor" />
                                    <path
                                        d="M41.25 13.4403H50.625C51.5958 13.4403 52.3828 12.5367 52.3828 11.4223C52.3828 10.3078 51.5958 9.4043 50.625 9.4043H41.25C40.2792 9.4043 39.4922 10.3078 39.4922 11.4223C39.4922 12.5367 40.2792 13.4403 41.25 13.4403Z"
                                        fill="currentColor" />
                                </svg>

                            </div>
                            <div class="media-body">
                                <h4 class="text-white mb-0 text-uppercase">{{ __('transf.txt_online_courses_100,000') }}
                                </h4>
                                <p class="text-white mb-0">{{ __('transf.txt_explore_a_variety_of_fresh_topics') }}</p>
                            </div>
                        </div>
                    </li>
                    <li class="col-lg-auto mb-5 mb-lg-0 nav-item">
                        <div class="d-flex align-items-center">
                            <div class="me-4 text-white icon-md">
                                <!-- Icon -->
                                <svg width="60" height="61" viewBox="0 0 60 61" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M58.2422 56.9639H50.5078V39.7373C50.5078 37.7988 48.9307 36.2217 46.9922 36.2217H44.3787C43.69 33.2171 42.319 30.6373 40.3639 28.6993C39.1335 27.4795 37.7029 26.5474 36.1162 25.9203C39.5169 22.9862 41.7363 17.9138 41.7363 13.331C41.7363 9.17223 40.5795 5.9082 38.2979 3.62996C36.2341 1.56887 33.3648 0.479492 30 0.479492C26.6353 0.479492 23.7659 1.56887 21.702 3.62996C19.4204 5.9082 18.2636 9.17223 18.2636 13.331C18.2636 17.9137 20.483 22.9862 23.8836 25.9203C22.2971 26.5474 20.8665 27.4795 19.6361 28.6993C17.681 30.6373 16.31 33.2172 15.6214 36.2217H13.0078C11.0693 36.2217 9.49219 37.7988 9.49219 39.7373V56.9639H1.75781C0.787031 56.9639 0 57.7509 0 58.7217C0 59.6925 0.787031 60.4795 1.75781 60.4795H58.2422C59.213 60.4795 60 59.6925 60 58.7217C60 57.7509 59.213 56.9639 58.2422 56.9639ZM30 3.99512C32.5816 3.99512 36.6335 4.85328 37.8581 9.95539C36.0666 9.72758 35.0435 9.22145 34.2428 8.82523C33.4579 8.43688 32.5682 7.9966 31.4824 8.24551C30.6011 8.44754 29.9709 8.94477 29.3617 9.4257C28.2513 10.3021 26.6303 11.5788 21.8426 11.8373C22.4387 5.05648 27.1288 3.99512 30 3.99512ZM21.9562 15.3515C27.9266 15.0371 30.1566 13.2773 31.54 12.1852C31.7402 12.027 31.998 11.8237 32.1577 11.7263C32.2987 11.7859 32.507 11.8889 32.6837 11.9763C33.7166 12.4873 35.3384 13.2894 38.2163 13.5247C38.1703 16.113 37.2081 18.9837 35.6179 21.2456C33.995 23.5539 31.9473 24.8779 30 24.8779C28.0527 24.8779 26.005 23.5539 24.382 21.2456C23.1592 19.5062 22.3061 17.4061 21.9562 15.3515ZM29.0625 28.4873H30.9375C35.8158 28.4873 39.3743 31.3396 40.755 36.2217H19.245C20.6257 31.3396 24.1842 28.4873 29.0625 28.4873ZM13.0078 56.9639V39.7373H46.9922V56.9639H13.0078Z"
                                        fill="currentColor" />
                                    <path
                                        d="M30 49.1115C30.9708 49.1115 31.7578 48.3246 31.7578 47.3539C31.7578 46.3832 30.9708 45.5963 30 45.5963C29.0292 45.5963 28.2422 46.3832 28.2422 47.3539C28.2422 48.3246 29.0292 49.1115 30 49.1115Z"
                                        fill="currentColor" />
                                </svg>

                            </div>
                            <div class="media-body">
                                <h4 class="text-white mb-0 text-uppercase">{{ __('transf.txt_expert_instruction') }}
                                </h4>
                                <p class="text-white mb-0">{{ __('transf.txt_find_the_right_instructor_for_you') }}</p>
                            </div>
                        </div>
                    </li>
                    <li class="col-lg-auto mb-5 mb-lg-0 nav-item">
                        <div class="d-flex align-items-center">
                            <div class="me-4 text-white icon-md">
                                <!-- Icon -->
                                <svg width="50" height="50" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M21.6643 41.0672C11.7065 40.6467 3.90624 32.4903 3.90624 22.4984C3.90624 12.2503 12.2299 3.91276 22.4609 3.91276C31.088 3.91276 38.7056 10.0254 40.5738 18.447C40.8077 19.5018 41.8507 20.1668 42.904 19.9325C43.957 19.6981 44.621 18.6531 44.387 17.5983C43.2962 12.6814 40.5339 8.21543 36.6088 5.0234C32.6254 1.78402 27.6009 0 22.4609 0C16.4613 0 10.821 2.34022 6.5786 6.58958C2.33632 10.839 0 16.4888 0 22.4984C0 28.34 2.225 33.8761 6.26493 38.0866C10.2931 42.2848 15.7036 44.7317 21.4998 44.9765C21.5278 44.9777 21.5556 44.9783 21.5835 44.9783C22.6243 44.9783 23.4892 44.1557 23.5335 43.1042C23.579 42.0247 22.742 41.1126 21.6643 41.0672Z"
                                        fill="currentColor" />
                                    <path
                                        d="M22.461 7.84009C21.3823 7.84009 20.5079 8.71596 20.5079 9.79647V21.6882L14.1981 28.0086C13.4353 28.7726 13.4353 30.0112 14.1981 30.7753C14.5794 31.1573 15.0792 31.3483 15.5791 31.3483C16.079 31.3483 16.5788 31.1573 16.9602 30.7753L23.8421 23.8819C24.2084 23.5151 24.4142 23.0174 24.4142 22.4986V9.79647C24.4142 8.71596 23.5398 7.84009 22.461 7.84009Z"
                                        fill="currentColor" />
                                    <path
                                        d="M45.9818 24.2931C43.9454 23.4605 41.28 23.002 38.4766 23.002C35.6731 23.002 33.0077 23.4605 30.9713 24.2931C27.4752 25.7224 26.9531 27.7749 26.9531 28.8711V44.1309C26.9531 45.2271 27.4752 47.2795 30.9713 48.7089C33.0077 49.5414 35.6731 50 38.4766 50C41.28 50 43.9454 49.5414 45.9818 48.7089C49.4779 47.2795 50 45.227 50 44.1309V28.8711C50 27.7748 49.4779 25.7224 45.9818 24.2931ZM46.0937 44.0688C45.7711 44.6703 43.1452 46.0872 38.4766 46.0872C33.8079 46.0872 31.182 44.6704 30.8594 44.0688V40.9335C30.897 40.9494 30.9329 40.9654 30.9713 40.9812C33.0077 41.8137 35.6731 42.2723 38.4766 42.2723C39.1527 42.2723 39.8296 42.2455 40.4883 42.1926C41.5635 42.1062 42.3652 41.163 42.2789 40.0859C42.1926 39.0089 41.2523 38.2063 40.1758 38.2923C39.6206 38.3369 39.0489 38.3596 38.4766 38.3596C33.8066 38.3596 31.1809 36.9422 30.8594 36.3409V33.4017C30.897 33.4175 30.9329 33.4336 30.9713 33.4493C33.0077 34.2819 35.6731 34.7404 38.4766 34.7404C39.1527 34.7404 39.8296 34.7136 40.4883 34.6607C41.5635 34.5743 42.3652 33.6312 42.2789 32.5541C42.1926 31.477 41.2523 30.6743 40.1758 30.7605C39.6206 30.8051 39.0489 30.8278 38.4766 30.8278C33.9607 30.8278 31.3567 29.5024 30.899 28.8713C31.3574 28.24 33.9615 26.915 38.4766 26.915C43.1452 26.915 45.7711 28.3318 46.0937 28.9334V44.0688Z"
                                        fill="currentColor" />
                                </svg>

                            </div>
                            <div class="media-body">
                                <h4 class="text-white mb-0 text-uppercase">{{ __('transf.txt_lifetime_access') }}</h4>
                                <p class="text-white mb-0">{{ __('transf.txt_learn_on_your_schedule') }} </p>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </section>

    <!-- CATEGORIES
                                                                                                                                                                                                                                                                            ================================================== -->
    @livewire('frontend.home.trending-categories-component')

    <!-- FEATURED PRODUCT
                                                                                                                                                                                                                                                                            ================================================== -->
    @livewire('frontend.home.featured-courses-component')

    <!-- CALL ACTION
                                                                                                                                                                                                                                                                            ================================================== -->
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

    <!-- TESTIMONIAL
                                                                                                                                                                                                                                                                            ================================================== -->
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

    <!-- EVENTS
                                                                                                                                                                                                                                                                                                                                                                                                                                        ================================================== -->
    <section class="py-5 py-md-11 bg-catskill">
        <div class="container">
            <div class="text-center mb-8 pb-2">
                <h1 class="mb-1">{{ __('transf.txt_upcomming_events') }}</h1>
                <p class="font-size-lg text-capitalize mb-0">{{ __('transf.txt_upcomming_events_desc') }}</p>
            </div>

            <div class="row">
                <div class="col-xl-6 mb-5 mb-md-6">
                    <!-- Card -->
                    <div class="card border shadow p-2 lift">
                        <div class="row gx-0">
                            <!-- Image -->
                            <a href="event-single.html"
                                class="col-auto d-flex rounded-lg w-md-152 bg-bossanova place-center h-md-140p"
                                style="width: 120px;">
                                <div class="w-100 text-center">
                                    <h3 class="text-white mb-0 fw-semi-bold font-size-xxl">06</h3>
                                    <span class="h4 mb-0 text-white fw-normal">April</span>
                                </div>
                            </a>

                            <!-- Body -->
                            <div class="col">
                                <div class="card-body py-0 px-md-5 px-3">
                                    <div class="badge badge-lg badge-orange badge-pill mb-3 mt-1 px-5 py-2">
                                        <span class="text-white font-size-sm fw-normal">06 Aprıl</span>
                                    </div>

                                    <a href="event-single.html" class="d-block mb-2">
                                        <h5 class="line-clamp-2 h-xl-52 mb-2">Elegant Light Box Paper Cut Dioramas New
                                            Design Conference</h5>
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
                                                <div class="font-size-sm">8:00 am - 5:00 pm</div>
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
                                                <div class="font-size-sm">London, UK</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 mb-5 mb-md-6">
                    <!-- Card -->
                    <div class="card border shadow p-2 lift">
                        <div class="row gx-0">
                            <!-- Image -->
                            <a href="event-single.html"
                                class="col-auto d-flex rounded-lg w-md-152 bg-bossanova place-center h-md-140p"
                                style="width: 120px;">
                                <div class="w-100 text-center">
                                    <h3 class="text-white mb-0 fw-semi-bold font-size-xxl">06</h3>
                                    <span class="h4 mb-0 text-white fw-normal">April</span>
                                </div>
                            </a>

                            <!-- Body -->
                            <div class="col">
                                <div class="card-body py-0 px-md-5 px-3">
                                    <div class="badge badge-lg badge-orange badge-pill mb-3 mt-1 px-5 py-2">
                                        <span class="text-white font-size-sm fw-normal">06 Aprıl</span>
                                    </div>

                                    <a href="event-single.html" class="d-block mb-2">
                                        <h5 class="line-clamp-2 h-xl-52 mb-2">Lambeth Safeguarding: Understanding
                                            Contextual Harm</h5>
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
                                                <div class="font-size-sm">8:00 am - 5:00 pm</div>
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
                                                <div class="font-size-sm">London, UK</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 mb-5 mb-md-6">
                    <!-- Card -->
                    <div class="card border shadow p-2 lift">
                        <div class="row gx-0">
                            <!-- Image -->
                            <a href="event-single.html"
                                class="col-auto d-flex rounded-lg w-md-152 bg-bossanova place-center h-md-140p"
                                style="width: 120px;">
                                <div class="w-100 text-center">
                                    <h3 class="text-white mb-0 fw-semi-bold font-size-xxl">06</h3>
                                    <span class="h4 mb-0 text-white fw-normal">April</span>
                                </div>
                            </a>

                            <!-- Body -->
                            <div class="col">
                                <div class="card-body py-0 px-md-5 px-3">
                                    <div class="badge badge-lg badge-orange badge-pill mb-3 mt-1 px-5 py-2">
                                        <span class="text-white font-size-sm fw-normal">06 Aprıl</span>
                                    </div>

                                    <a href="event-single.html" class="d-block mb-2">
                                        <h5 class="line-clamp-2 h-xl-52 mb-2">Discover Law - Get into the best UK law
                                            schools</h5>
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
                                                <div class="font-size-sm">8:00 am - 5:00 pm</div>
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
                                                <div class="font-size-sm">London, UK</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 mb-5 mb-md-6">
                    <!-- Card -->
                    <div class="card border shadow p-2 lift">
                        <div class="row gx-0">
                            <!-- Image -->
                            <a href="event-single.html"
                                class="col-auto d-flex rounded-lg w-md-152 bg-bossanova place-center h-md-140p"
                                style="width: 120px;">
                                <div class="w-100 text-center">
                                    <h3 class="text-white mb-0 fw-semi-bold font-size-xxl">06</h3>
                                    <span class="h4 mb-0 text-white fw-normal">April</span>
                                </div>
                            </a>

                            <!-- Body -->
                            <div class="col">
                                <div class="card-body py-0 px-md-5 px-3">
                                    <div class="badge badge-lg badge-orange badge-pill mb-3 mt-1 px-5 py-2">
                                        <span class="text-white font-size-sm fw-normal">06 Aprıl</span>
                                    </div>

                                    <a href="event-single.html" class="d-block mb-2">
                                        <h5 class="line-clamp-2 h-xl-52 mb-2">Undergraduate Open Day – Holloway Campus - 3
                                            July 2020</h5>
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
                                                <div class="font-size-sm">8:00 am - 5:00 pm</div>
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
                                                <div class="font-size-sm">London, UK</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 mb-5 mb-md-6">
                    <!-- Card -->
                    <div class="card border shadow p-2 lift">
                        <div class="row gx-0">
                            <!-- Image -->
                            <a href="event-single.html"
                                class="col-auto d-flex rounded-lg w-md-152 bg-bossanova place-center h-md-140p"
                                style="width: 120px;">
                                <div class="w-100 text-center">
                                    <h3 class="text-white mb-0 fw-semi-bold font-size-xxl">06</h3>
                                    <span class="h4 mb-0 text-white fw-normal">April</span>
                                </div>
                            </a>

                            <!-- Body -->
                            <div class="col">
                                <div class="card-body py-0 px-md-5 px-3">
                                    <div class="badge badge-lg badge-orange badge-pill mb-3 mt-1 px-5 py-2">
                                        <span class="text-white font-size-sm fw-normal">06 Aprıl</span>
                                    </div>

                                    <a href="event-single.html" class="d-block mb-2">
                                        <h5 class="line-clamp-2 h-xl-52 mb-2">"Introduction to Law" Open Day with Bristows
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
                                                <div class="font-size-sm">8:00 am - 5:00 pm</div>
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
                                                <div class="font-size-sm">London, UK</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 mb-5 mb-md-6">
                    <!-- Card -->
                    <div class="card border shadow p-2 lift">
                        <div class="row gx-0">
                            <!-- Image -->
                            <a href="event-single.html"
                                class="col-auto d-flex rounded-lg w-md-152 bg-bossanova place-center h-md-140p"
                                style="width: 120px;">
                                <div class="w-100 text-center">
                                    <h3 class="text-white mb-0 fw-semi-bold font-size-xxl">06</h3>
                                    <span class="h4 mb-0 text-white fw-normal">April</span>
                                </div>
                            </a>

                            <!-- Body -->
                            <div class="col">
                                <div class="card-body py-0 px-md-5 px-3">
                                    <div class="badge badge-lg badge-orange badge-pill mb-3 mt-1 px-5 py-2">
                                        <span class="text-white font-size-sm fw-normal">06 Aprıl</span>
                                    </div>

                                    <a href="event-single.html" class="d-block mb-2">
                                        <h5 class="line-clamp-2 h-xl-52 mb-2">Kingston College undergraduate Open Events
                                            2019-20</h5>
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
                                                <div class="font-size-sm">8:00 am - 5:00 pm</div>
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
                                                <div class="font-size-sm">London, UK</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="#" class="btn btn-coral btn-wide lift text-white-all">{{ __('transf.btn_view_all') }}</a>
            </div>
        </div>
    </section>

    <!-- BLOG
                                                                                                                                                                                                                                                                                                                                                                                                                                        ================================================== -->
    <section class="py-5 py-md-11 bg-white">
        <div class="container">
            <div class="text-center mb-4 mb-md-7" data-aos="fade-up">
                <h1 class="mb-1">{{ __('transf.txt_latest_news') }}</h1>
                <p class="font-size-lg mb-0 text-capitalize">{{ __('transf.txt_latest_news_desc') }}</p>
            </div>

            <div class="row row-cols-md-2 row-cols-lg-3">
                <div class="col-md mb-5 mb-lg-0">
                    <!-- Card -->
                    <div class="card border shadow p-2 lift sk-fade">
                        <!-- Image -->
                        <div class="card-zoom position-relative">
                            <a href="blog-single.html" class="card-img d-block sk-thumbnail img-ratio-3"><img
                                    class="rounded shadow-light-lg img-fluid"
                                    src="{{ asset('frontend/assets/img/post/post-1.jpg') }}" alt="..."></a>

                            <a href="blog-single.html"
                                class="badge sk-fade-bottom badge-lg badge-purple badge-pill badge-float bottom-0 left-0 mb-4 ms-4 px-5 me-4">
                                <span class="text-white fw-normal font-size-sm">Figma</span>
                            </a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-2 pb-0 pt-4">
                            <ul class="nav mx-n3 mb-3">
                                <li class="nav-item px-3">
                                    <a href="blog-single.html" class="d-flex align-items-center text-gray-800">
                                        <div class="me-3 d-flex">
                                            <!-- Icon -->
                                            <svg width="15" height="15" viewBox="0 0 15 15"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.8102 9.52183C13.313 9.08501 12.7102 8.70758 12.0181 8.40008C11.7223 8.2687 11.3761 8.40191 11.2447 8.69762C11.1134 8.99334 11.2466 9.33952 11.5423 9.47102C12.1258 9.73034 12.6287 10.0436 13.0367 10.4021C13.5396 10.8441 13.8281 11.484 13.8281 12.1582V13.2422C13.8281 13.5653 13.5653 13.8281 13.2422 13.8281H1.75781C1.43475 13.8281 1.17188 13.5653 1.17188 13.2422V12.1582C1.17188 11.484 1.46038 10.8441 1.96335 10.4021C2.55535 9.88186 4.2802 8.67188 7.5 8.67188C9.89079 8.67188 11.8359 6.72672 11.8359 4.33594C11.8359 1.94515 9.89079 0 7.5 0C5.10921 0 3.16406 1.94515 3.16406 4.33594C3.16406 5.7336 3.82896 6.97872 4.85893 7.77214C2.97432 8.18642 1.80199 8.98384 1.18984 9.52183C0.433731 10.1862 0 11.147 0 12.1582V13.2422C0 14.2115 0.788498 15 1.75781 15H13.2422C14.2115 15 15 14.2115 15 13.2422V12.1582C15 11.147 14.5663 10.1862 13.8102 9.52183ZM4.33594 4.33594C4.33594 2.59129 5.75535 1.17188 7.5 1.17188C9.24465 1.17188 10.6641 2.59129 10.6641 4.33594C10.6641 6.08059 9.24465 7.5 7.5 7.5C5.75535 7.5 4.33594 6.08059 4.33594 4.33594Z"
                                                    fill="currentColor" />
                                            </svg>

                                        </div>
                                        <div class="font-size-sm">Jack Wilson</div>
                                    </a>
                                </li>
                                <li class="nav-item px-3">
                                    <a href="blog-single.html" class="d-flex align-items-center text-gray-800">
                                        <div class="me-2 d-flex">
                                            <!-- Icon -->
                                            <svg width="15" height="15" viewBox="0 0 15 15"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.0664 1.17188H11.7188V0.46875C11.7188 0.209883 11.5089 0 11.25 0C10.9911 0 10.7812 0.209883 10.7812 0.46875V1.17188H4.21875V0.46875C4.21875 0.209883 4.0089 0 3.75 0C3.4911 0 3.28125 0.209883 3.28125 0.46875V1.17188H1.93359C0.867393 1.17188 0 2.03927 0 3.10547V13.0664C0 14.1326 0.867393 15 1.93359 15H13.0664C14.1326 15 15 14.1326 15 13.0664V3.10547C15 2.03927 14.1326 1.17188 13.0664 1.17188ZM1.93359 2.10938H3.28125V2.57812C3.28125 2.83699 3.4911 3.04688 3.75 3.04688C4.0089 3.04688 4.21875 2.83699 4.21875 2.57812V2.10938H10.7812V2.57812C10.7812 2.83699 10.9911 3.04688 11.25 3.04688C11.5089 3.04688 11.7188 2.83699 11.7188 2.57812V2.10938H13.0664C13.6157 2.10938 14.0625 2.55621 14.0625 3.10547V4.21875H0.9375V3.10547C0.9375 2.55621 1.38434 2.10938 1.93359 2.10938ZM13.0664 14.0625H1.93359C1.38434 14.0625 0.9375 13.6157 0.9375 13.0664V5.15625H14.0625V13.0664C14.0625 13.6157 13.6157 14.0625 13.0664 14.0625Z"
                                                    fill="currentColor" />
                                            </svg>

                                        </div>
                                        <div class="font-size-sm">06 April, 2020</div>
                                    </a>
                                </li>
                            </ul>

                            <!-- Heading -->
                            <a href="blog-single.html" class="d-block">
                                <h5 class="line-clamp-2 h-48 h-lg-52">The Best Destinations to Begin Your Round the World
                                    Trip</h5>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md mb-5 mb-lg-0">
                    <!-- Card -->
                    <div class="card border shadow p-2 lift sk-fade">
                        <!-- Image -->
                        <div class="card-zoom position-relative">
                            <a href="blog-single.html" class="card-img d-block sk-thumbnail img-ratio-3"><img
                                    class="rounded shadow-light-lg img-fluid"
                                    src="{{ asset('frontend/assets/img/post/post-2.jpg') }}" alt="..."></a>

                            <a href="blog-single.html"
                                class="badge sk-fade-bottom badge-lg badge-purple badge-pill badge-float bottom-0 left-0 mb-4 ms-4 px-5 me-4">
                                <span class="text-white fw-normal font-size-sm">Adobe XD</span>
                            </a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-2 pb-0 pt-4">
                            <ul class="nav mx-n3 mb-3">
                                <li class="nav-item px-3">
                                    <a href="blog-single.html" class="d-flex align-items-center text-gray-800">
                                        <div class="me-3 d-flex">
                                            <!-- Icon -->
                                            <svg width="15" height="15" viewBox="0 0 15 15"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.8102 9.52183C13.313 9.08501 12.7102 8.70758 12.0181 8.40008C11.7223 8.2687 11.3761 8.40191 11.2447 8.69762C11.1134 8.99334 11.2466 9.33952 11.5423 9.47102C12.1258 9.73034 12.6287 10.0436 13.0367 10.4021C13.5396 10.8441 13.8281 11.484 13.8281 12.1582V13.2422C13.8281 13.5653 13.5653 13.8281 13.2422 13.8281H1.75781C1.43475 13.8281 1.17188 13.5653 1.17188 13.2422V12.1582C1.17188 11.484 1.46038 10.8441 1.96335 10.4021C2.55535 9.88186 4.2802 8.67188 7.5 8.67188C9.89079 8.67188 11.8359 6.72672 11.8359 4.33594C11.8359 1.94515 9.89079 0 7.5 0C5.10921 0 3.16406 1.94515 3.16406 4.33594C3.16406 5.7336 3.82896 6.97872 4.85893 7.77214C2.97432 8.18642 1.80199 8.98384 1.18984 9.52183C0.433731 10.1862 0 11.147 0 12.1582V13.2422C0 14.2115 0.788498 15 1.75781 15H13.2422C14.2115 15 15 14.2115 15 13.2422V12.1582C15 11.147 14.5663 10.1862 13.8102 9.52183ZM4.33594 4.33594C4.33594 2.59129 5.75535 1.17188 7.5 1.17188C9.24465 1.17188 10.6641 2.59129 10.6641 4.33594C10.6641 6.08059 9.24465 7.5 7.5 7.5C5.75535 7.5 4.33594 6.08059 4.33594 4.33594Z"
                                                    fill="currentColor" />
                                            </svg>

                                        </div>
                                        <div class="font-size-sm">Jack Wilson</div>
                                    </a>
                                </li>
                                <li class="nav-item px-3">
                                    <a href="blog-single.html" class="d-flex align-items-center text-gray-800">
                                        <div class="me-2 d-flex">
                                            <!-- Icon -->
                                            <svg width="15" height="15" viewBox="0 0 15 15"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.0664 1.17188H11.7188V0.46875C11.7188 0.209883 11.5089 0 11.25 0C10.9911 0 10.7812 0.209883 10.7812 0.46875V1.17188H4.21875V0.46875C4.21875 0.209883 4.0089 0 3.75 0C3.4911 0 3.28125 0.209883 3.28125 0.46875V1.17188H1.93359C0.867393 1.17188 0 2.03927 0 3.10547V13.0664C0 14.1326 0.867393 15 1.93359 15H13.0664C14.1326 15 15 14.1326 15 13.0664V3.10547C15 2.03927 14.1326 1.17188 13.0664 1.17188ZM1.93359 2.10938H3.28125V2.57812C3.28125 2.83699 3.4911 3.04688 3.75 3.04688C4.0089 3.04688 4.21875 2.83699 4.21875 2.57812V2.10938H10.7812V2.57812C10.7812 2.83699 10.9911 3.04688 11.25 3.04688C11.5089 3.04688 11.7188 2.83699 11.7188 2.57812V2.10938H13.0664C13.6157 2.10938 14.0625 2.55621 14.0625 3.10547V4.21875H0.9375V3.10547C0.9375 2.55621 1.38434 2.10938 1.93359 2.10938ZM13.0664 14.0625H1.93359C1.38434 14.0625 0.9375 13.6157 0.9375 13.0664V5.15625H14.0625V13.0664C14.0625 13.6157 13.6157 14.0625 13.0664 14.0625Z"
                                                    fill="currentColor" />
                                            </svg>

                                        </div>
                                        <div class="font-size-sm">06 April, 2020</div>
                                    </a>
                                </li>
                            </ul>

                            <!-- Heading -->
                            <a href="blog-single.html" class="d-block">
                                <h5 class="line-clamp-2 h-48 h-lg-52">An Indigenous Anatolian Syllabic Script From 3500
                                    Years Ago</h5>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md mb-5 mb-lg-0">
                    <!-- Card -->
                    <div class="card border shadow p-2 lift sk-fade">
                        <!-- Image -->
                        <div class="card-zoom position-relative">
                            <a href="blog-single.html" class="card-img d-block sk-thumbnail img-ratio-3"><img
                                    class="rounded shadow-light-lg img-fluid"
                                    src="{{ asset('frontend/assets/img/post/post-3.jpg') }}" alt="..."></a>

                            <a href="blog-single.html"
                                class="badge badge-lg sk-fade-bottom badge-purple badge-pill badge-float bottom-0 left-0 mb-4 ms-4 px-5 me-4">
                                <span class="text-white fw-normal font-size-sm">Photoshop</span>
                            </a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-2 pb-0 pt-4">
                            <ul class="nav mx-n3 mb-3">
                                <li class="nav-item px-3">
                                    <a href="blog-single.html" class="d-flex align-items-center text-gray-800">
                                        <div class="me-3 d-flex">
                                            <!-- Icon -->
                                            <svg width="15" height="15" viewBox="0 0 15 15"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.8102 9.52183C13.313 9.08501 12.7102 8.70758 12.0181 8.40008C11.7223 8.2687 11.3761 8.40191 11.2447 8.69762C11.1134 8.99334 11.2466 9.33952 11.5423 9.47102C12.1258 9.73034 12.6287 10.0436 13.0367 10.4021C13.5396 10.8441 13.8281 11.484 13.8281 12.1582V13.2422C13.8281 13.5653 13.5653 13.8281 13.2422 13.8281H1.75781C1.43475 13.8281 1.17188 13.5653 1.17188 13.2422V12.1582C1.17188 11.484 1.46038 10.8441 1.96335 10.4021C2.55535 9.88186 4.2802 8.67188 7.5 8.67188C9.89079 8.67188 11.8359 6.72672 11.8359 4.33594C11.8359 1.94515 9.89079 0 7.5 0C5.10921 0 3.16406 1.94515 3.16406 4.33594C3.16406 5.7336 3.82896 6.97872 4.85893 7.77214C2.97432 8.18642 1.80199 8.98384 1.18984 9.52183C0.433731 10.1862 0 11.147 0 12.1582V13.2422C0 14.2115 0.788498 15 1.75781 15H13.2422C14.2115 15 15 14.2115 15 13.2422V12.1582C15 11.147 14.5663 10.1862 13.8102 9.52183ZM4.33594 4.33594C4.33594 2.59129 5.75535 1.17188 7.5 1.17188C9.24465 1.17188 10.6641 2.59129 10.6641 4.33594C10.6641 6.08059 9.24465 7.5 7.5 7.5C5.75535 7.5 4.33594 6.08059 4.33594 4.33594Z"
                                                    fill="currentColor" />
                                            </svg>

                                        </div>
                                        <div class="font-size-sm">Jack Wilson</div>
                                    </a>
                                </li>
                                <li class="nav-item px-3">
                                    <a href="blog-single.html" class="d-flex align-items-center text-gray-800">
                                        <div class="me-2 d-flex">
                                            <!-- Icon -->
                                            <svg width="15" height="15" viewBox="0 0 15 15"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.0664 1.17188H11.7188V0.46875C11.7188 0.209883 11.5089 0 11.25 0C10.9911 0 10.7812 0.209883 10.7812 0.46875V1.17188H4.21875V0.46875C4.21875 0.209883 4.0089 0 3.75 0C3.4911 0 3.28125 0.209883 3.28125 0.46875V1.17188H1.93359C0.867393 1.17188 0 2.03927 0 3.10547V13.0664C0 14.1326 0.867393 15 1.93359 15H13.0664C14.1326 15 15 14.1326 15 13.0664V3.10547C15 2.03927 14.1326 1.17188 13.0664 1.17188ZM1.93359 2.10938H3.28125V2.57812C3.28125 2.83699 3.4911 3.04688 3.75 3.04688C4.0089 3.04688 4.21875 2.83699 4.21875 2.57812V2.10938H10.7812V2.57812C10.7812 2.83699 10.9911 3.04688 11.25 3.04688C11.5089 3.04688 11.7188 2.83699 11.7188 2.57812V2.10938H13.0664C13.6157 2.10938 14.0625 2.55621 14.0625 3.10547V4.21875H0.9375V3.10547C0.9375 2.55621 1.38434 2.10938 1.93359 2.10938ZM13.0664 14.0625H1.93359C1.38434 14.0625 0.9375 13.6157 0.9375 13.0664V5.15625H14.0625V13.0664C14.0625 13.6157 13.6157 14.0625 13.0664 14.0625Z"
                                                    fill="currentColor" />
                                            </svg>

                                        </div>
                                        <div class="font-size-sm">06 April, 2020</div>
                                    </a>
                                </li>
                            </ul>

                            <!-- Heading -->
                            <a href="blog-single.html" class="d-block">
                                <h5 class="line-clamp-2 h-48 h-lg-52">10 Best Countries to Visit for Beginner Travelers
                                </h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- INSTRUCTORS
                                                                                                                                                                                                                                                                                                                                                                                                                                        ================================================== -->
    <section class="py-5 py-md-11 bg-catskill">
        <div class="container">
            <div class="text-center mb-4 mb-md-7" data-aos="fade-up">
                <h1 class="mb-1">{{ __('transf.txt_top_rating_instructuros') }}</h1>
                <p class="font-size-lg mb-0 text-capitalize">{{ __('transf.txt_top_rating_instructuros_desc') }}</p>
            </div>

            <div class="mx-n3 mx-md-n4"
                data-flickity='{"pageDots": false,"cellAlign": "left", "wrapAround": true, "imagesLoaded": true}'>
                <div class="col-6 col-md-4 col-lg-3 text-center py-5 text-md-left px-3 px-md-4" data-aos="fade-up"
                    data-aos-delay="50">
                    <div class="card border shadow p-2 lift">
                        <!-- Image -->
                        <div class="card-zoom position-relative" style="max-width: 250px;">
                            <div class="card-float card-hover right-0 left-0 bottom-0 mb-4">
                                <ul class="nav mx-n4 justify-content-center">
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <a href="instructors-single.html"
                                class="card-img sk-thumbnail img-ratio-4 card-hover-overlay coral d-block"><img
                                    class="rounded shadow-light-lg img-fluid"
                                    src="{{ asset('frontend/assets/img/instructors/instructor-1.jpg') }}"
                                    alt="..."></a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-3 pt-4 pb-1">
                            <a href="instructors-single.html" class="d-block">
                                <h5 class="mb-0">Jack Wilson</h5>
                            </a>
                            <span class="font-size-d-sm">Developer</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3 text-center py-5 text-md-left px-3 px-md-4" data-aos="fade-up"
                    data-aos-delay="100">
                    <div class="card border shadow p-2 lift">
                        <!-- Image -->
                        <div class="card-zoom position-relative" style="max-width: 250px;">
                            <div class="card-float card-hover right-0 left-0 bottom-0 mb-4">
                                <ul class="nav mx-n4 justify-content-center">
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <a href="instructors-single.html"
                                class="card-img sk-thumbnail img-ratio-4 card-hover-overlay coral d-block"><img
                                    class="rounded shadow-light-lg img-fluid"
                                    src="{{ asset('frontend/assets/img/instructors/instructor-2.jpg') }}"
                                    alt="..."></a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-3 pt-4 pb-1">
                            <a href="instructors-single.html" class="d-block">
                                <h5 class="mb-0">Anna Richard</h5>
                            </a>
                            <span class="font-size-d-sm">Travel Bloger</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3 text-center py-5 text-md-left px-3 px-md-4" data-aos="fade-up"
                    data-aos-delay="150">
                    <div class="card border shadow p-2 lift">
                        <!-- Image -->
                        <div class="card-zoom position-relative" style="max-width: 250px;">
                            <div class="card-float card-hover right-0 left-0 bottom-0 mb-4">
                                <ul class="nav mx-n4 justify-content-center">
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <a href="instructors-single.html"
                                class="card-img sk-thumbnail img-ratio-4 card-hover-overlay coral d-block"><img
                                    class="rounded shadow-light-lg img-fluid"
                                    src="{{ asset('frontend/assets/img/instructors/instructor-3.jpg') }}"
                                    alt="..."></a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-3 pt-4 pb-1">
                            <a href="instructors-single.html" class="d-block">
                                <h5 class="mb-0">Kathelen Monero</h5>
                            </a>
                            <span class="font-size-d-sm">Designer</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3 text-center py-5 text-md-left px-3 px-md-4" data-aos="fade-up"
                    data-aos-delay="200">
                    <div class="card border shadow p-2 lift">
                        <!-- Image -->
                        <div class="card-zoom position-relative" style="max-width: 250px;">
                            <div class="card-float card-hover right-0 left-0 bottom-0 mb-4">
                                <ul class="nav mx-n4 justify-content-center">
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <a href="instructors-single.html"
                                class="card-img sk-thumbnail img-ratio-4 card-hover-overlay coral d-block"><img
                                    class="rounded shadow-light-lg img-fluid"
                                    src="{{ asset('frontend/assets/img/instructors/instructor-4.jpg') }}"
                                    alt="..."></a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-3 pt-4 pb-1">
                            <a href="instructors-single.html" class="d-block">
                                <h5 class="mb-0">Kristen Pala</h5>
                            </a>
                            <span class="font-size-d-sm">User Experience Design</span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3 text-center py-5 text-md-left px-3 px-md-4" data-aos="fade-up"
                    data-aos-delay="250">
                    <div class="card border shadow p-2 lift">
                        <!-- Image -->
                        <div class="card-zoom position-relative" style="max-width: 250px;">
                            <div class="card-float card-hover right-0 left-0 bottom-0 mb-4">
                                <ul class="nav mx-n4 justify-content-center">
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item px-4">
                                        <a href="#" class="d-block text-white">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <a href="instructors-single.html"
                                class="card-img sk-thumbnail img-ratio-4 card-hover-overlay coral d-block"><img
                                    class="rounded shadow-light-lg img-fluid"
                                    src="{{ asset('frontend/assets/img/instructors/instructor-2.jpg') }}"
                                    alt="..."></a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-3 pt-4 pb-1">
                            <a href="instructors-single.html" class="d-block">
                                <h5 class="mb-0">Anna Richard</h5>
                            </a>
                            <span class="font-size-d-sm">Travel Bloger</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- COUNTUP
                                                                                                                                                                                                                                                                                                                                                                                                                                        ================================================== -->
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

    <!-- NEWSLETTER
                                                                                                                                                                                                                                                                                                                                                                                                                                        ================================================== -->
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
