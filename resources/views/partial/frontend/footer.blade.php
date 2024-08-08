{{-- <footer class="pt-8 pt-md-11 {{ request()->routeIs('frontend.index') ? 'bg-white' : 'bg-gray-100' }} "> --}}


@php
    $bbg = '';
    if (request()->routeIs('frontend.index')) {
        $bbg = 'bg-white';
    } elseif (request()->routeIs('frontend.course_single') || request()->routeIs('frontend.event_single')) {
        $bbg = 'bg-gray-100';
    } else {
        $bbg = '';
    }
@endphp

<footer class="pt-8 pt-md-11 {{ $bbg }} ">

    <style>
        .my-wrapper {
            position: fixed;
            width: 400px;
            bottom: 0;
            left: 60px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
            z-index: 100;
            margin: 0;
            background-color: green;
            color: white;
            cursor: pointer;
            border: 0;
            outline: 0;

        }
    </style>


    <div class="alert alert-primary alert-dismissible fade show my-wrapper" role="alert">

        <a href="https://api.whatsapp.com" class="d-block text-white">
            <div class="alert-body d-flex justify-content-between align-items-center">

                <div class="part1">
                    <span style="font-size: 12px;">
                        للتسجيل او الإستفسار يمكنك التواصل معنا عن
                        طريق
                    </span>
                    <br>الواتس اب:
                    <span class="ltr">00967777282953</span>
                </div>
                <div class="part2">
                    <i class="fab fa-whatsapp fa-2x bi flex-shrink-0 me-2" width="30" height="30" role="img"
                        aria-label="Info:"></i>
                </div>
            </div>
        </a>

        <button type="button" class="btn-close" style="color: white;" data-bs-dismiss="alert"
            aria-label="Close"></button>

    </div>


    <div class="container">
        <div class="row" id="accordionFooter">
            <div class="col-12 col-md-4 col-lg-4">

                <!-- Brand -->
                <img src="{{ asset('frontend/assets/img/brand-coral.svg') }}" alt="..."
                    class="footer-brand img-fluid mb-4 h-60p">

                <!-- Text -->
                <p class="text-gray-800 mb-4 font-size-sm-alone">
                    {{ $siteSettings['site_address']->value ?? '' }}
                </p>

                <div class="mb-4">
                    <a href="tel:1234567890"
                        class="text-gray-800 font-size-sm-alone">{{ $siteSettings['site_phone']->value ?? '' }}</a>
                </div>

                <div class="mb-4">
                    <a href="mailto:support@skola.com"
                        class="text-gray-800 font-size-sm-alone">{{ $siteSettings['site_email1']->value ?? '' }}</a>
                </div>

                <!-- Social -->
                <ul class="list-unstyled list-inline list-social mb-4 mb-md-0 mx-n2">
                    @if ($siteSettings['site_facebook']->value)
                        <li class="list-inline-item list-social-item">
                            <a href="{{ $siteSettings['site_facebook']->value }}"
                                class="text-secondary font-size-sm w-36 h-36 shadow-dark-hover d-flex align-items-center justify-content-center rounded-circle border-hover">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                    @endif
                    @if ($siteSettings['site_twitter']->value)
                        <li class="list-inline-item list-social-item">
                            <a href="{{ $siteSettings['site_twitter']->value }}"
                                class="text-secondary font-size-sm w-36 h-36 shadow-dark-hover d-flex align-items-center justify-content-center rounded-circle border-hover">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                    @endif

                    @if ($siteSettings['site_instagram']->value)
                        <li class="list-inline-item list-social-item">
                            <a href="{{ $siteSettings['site_instagram']->value }}"
                                class="text-secondary font-size-sm w-36 h-36 shadow-dark-hover d-flex align-items-center justify-content-center rounded-circle border-hover">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                    @endif
                    @if ($siteSettings['site_linkedin']->value)
                        <li class="list-inline-item list-social-item">
                            <a href="{{ $siteSettings['site_linkedin']->value }}"
                                class="text-secondary font-size-sm w-36 h-36 shadow-dark-hover d-flex align-items-center justify-content-center rounded-circle border-hover">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="col-12 col-md-4 col-lg-2">
                <div class="mb-5 mb-xl-0 footer-accordion">

                    <!-- Heading -->
                    <div id="widgetOne">
                        <h5 class="mb-5">
                            <button class="text-dark fw-medium footer-accordion-toggle d-flex align-items-center"
                                type="button" data-bs-toggle="collapse" data-bs-target="#widgetcollapseOne"
                                aria-expanded="true" aria-controls="widgetcollapseOne">
                                {{ __('transf.txt_our_company') }}
                                <span class="ms-auto text-dark">
                                    <!-- Icon -->
                                    <svg width="15" height="2" viewBox="0 0 15 2" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="15" height="2" fill="currentColor" />
                                    </svg>

                                    <svg width="15" height="16" viewBox="0 0 15 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 7H15V9H0V7Z" fill="currentColor" />
                                        <path d="M6 16L6 8.74228e-08L8 0L8 16H6Z" fill="currentColor" />
                                    </svg>

                                </span>
                            </button>
                        </h5>
                    </div>

                    <div id="widgetcollapseOne" class="collapse show" aria-labelledby="widgetOne"
                        data-parent="#accordionFooter">
                        <!-- List -->
                        <ul class="list-unstyled text-gray-800 font-size-sm-alone mb-6 mb-md-8 mb-lg-0">
                            @forelse ($web_menus->where('section',2) as $menu_item)
                                <li class="mb-3">
                                    <a href="{{ $menu_item->link != null ? url($menu_item->link) : '#' }}"
                                        class="text-reset">
                                        {{ $menu_item->title }}
                                    </a>
                                </li>
                            @empty
                            @endforelse




                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4 col-lg-2">
                <div class="mb-5 mb-xl-0 ms-xl-6 footer-accordion">

                    <!-- Heading -->
                    <div id="widgetTwo">
                        <h5 class="mb-5">
                            <button class="text-dark fw-medium footer-accordion-toggle d-flex align-items-center"
                                type="button" data-bs-toggle="collapse" data-bs-target="#widgetcollapseTwo"
                                aria-expanded="false" aria-controls="widgetcollapseTwo">
                                {{ __('transf.txt_topics') }}
                                <span class="ms-auto text-dark">
                                    <!-- Icon -->
                                    <svg width="15" height="2" viewBox="0 0 15 2" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="15" height="2" fill="currentColor" />
                                    </svg>

                                    <svg width="15" height="16" viewBox="0 0 15 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 7H15V9H0V7Z" fill="currentColor" />
                                        <path d="M6 16L6 8.74228e-08L8 0L8 16H6Z" fill="currentColor" />
                                    </svg>

                                </span>
                            </button>
                        </h5>
                    </div>

                    <div id="widgetcollapseTwo" class="collapse" aria-labelledby="widgetTwo"
                        data-parent="#accordionFooter">
                        <!-- List -->
                        <ul class="list-unstyled text-gray-800 font-size-sm-alone mb-6 mb-md-8 mb-lg-0">
                            @forelse ($web_menus->where('section',3) as $menu_item)
                                <li class="mb-3">
                                    <a href="{{ $menu_item->link != null ? url($menu_item->link) : '#' }}"
                                        class="text-reset">
                                        {{ $menu_item->title }}
                                    </a>
                                </li>
                            @empty
                            @endforelse



                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4 offset-md-4 col-lg-2 offset-lg-0">
                <div class="mb-5 mb-xl-0 ms-xl-6 footer-accordion">

                    <!-- Heading -->
                    <div id="widgetThree">
                        <h5 class="mb-5">
                            <button class="text-dark fw-medium footer-accordion-toggle d-flex align-items-center"
                                type="button" data-bs-toggle="collapse" data-bs-target="#widgetcollapseThree"
                                aria-expanded="false" aria-controls="widgetcollapseThree">
                                {{ __('transf.txt_tracks') }}
                                <span class="ms-auto text-dark">
                                    <!-- Icon -->
                                    <svg width="15" height="2" viewBox="0 0 15 2" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="15" height="2" fill="currentColor" />
                                    </svg>

                                    <svg width="15" height="16" viewBox="0 0 15 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 7H15V9H0V7Z" fill="currentColor" />
                                        <path d="M6 16L6 8.74228e-08L8 0L8 16H6Z" fill="currentColor" />
                                    </svg>

                                </span>
                            </button>
                        </h5>
                    </div>

                    <div id="widgetcollapseThree" class="collapse" aria-labelledby="widgetThree"
                        data-parent="#accordionFooter">
                        <!-- List -->
                        <ul class="list-unstyled text-gray-800 font-size-sm-alone mb-0">
                            @forelse ($web_menus->where('section',4) as $menu_item)
                                <li class="mb-3">
                                    <a href="{{ $menu_item->link != null ? url($menu_item->link) : '#' }}"
                                        class="text-reset">
                                        {{ $menu_item->title }}
                                    </a>
                                </li>
                            @empty
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4 col-lg-2 d-xl-flex">
                <div class="mb-5 mb-xl-0 ms-xl-auto footer-accordion">

                    <!-- Heading -->
                    <div id="widgetFour">
                        <h5 class="mb-5">
                            <button class="text-dark fw-medium footer-accordion-toggle d-flex align-items-center"
                                type="button" data-bs-toggle="collapse" data-bs-target="#widgetcollapseFour"
                                aria-expanded="false" aria-controls="widgetcollapseFour">
                                {{ __('transf.txt_support') }}
                                <span class="ms-auto text-dark">
                                    <!-- Icon -->
                                    <svg width="15" height="2" viewBox="0 0 15 2" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="15" height="2" fill="currentColor" />
                                    </svg>

                                    <svg width="15" height="16" viewBox="0 0 15 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 7H15V9H0V7Z" fill="currentColor" />
                                        <path d="M6 16L6 8.74228e-08L8 0L8 16H6Z" fill="currentColor" />
                                    </svg>

                                </span>
                            </button>
                        </h5>
                    </div>

                    <div id="widgetcollapseFour" class="collapse" aria-labelledby="widgetFour"
                        data-parent="#accordionFooter">
                        <!-- List -->
                        <ul class="list-unstyled text-gray-800 font-size-sm-alone mb-0">
                            @forelse ($web_menus->where('section',5) as $menu_item)
                                <li class="mb-3">
                                    <a href="{{ $menu_item->link ? url($menu_item->link) : '#' }}"
                                        class="text-reset">
                                        {{ $menu_item->title }}
                                    </a>
                                </li>
                            @empty
                            @endforelse


                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-md-5">
                <div
                    class="border-top pb-5 pt-6 py-md-4 text-center text-xl-start d-flex flex-column d-md-block d-xl-flex flex-xl-row align-items-center">
                    <p
                        class="text-gray-800 font-size-sm-alone d-block mb-0 mb-md-2 mb-xl-0 order-1 order-md-0 px-9 px-md-0">
                        {{ __('transf.txt_copyright') }} © {{ now()->year }} {{ __('transf.txt_CreativeLayers') }}
                        {{ __('transf.txt_all_right_reserved') }}</p>

                    <div
                        class="ms-xl-auto d-flex flex-column flex-md-row align-items-stretch align-items-md-center justify-content-center">
                        <ul
                            class="navbar-nav flex-row flex-wrap font-size-sm-alone mb-3 mb-md-0 mx-n4 me-md-5 justify-content-center justify-content-lg-start order-1 order-md-0">
                            <li class="nav-item py-2 py-md-0 px-0 border-top-0">
                                <a href="index.html"
                                    class="nav-link px-4 fw-normal text-gray-800">{{ __('transf.lnk_home') }}</a>
                            </li>
                            <li class="nav-item py-2 py-md-0 px-0 border-top-0">
                                <a href="terms-of-service.html"
                                    class="nav-link px-4 fw-normal text-gray-800">{{ __('transf.lnk_site_map') }}</a>
                            </li>
                            <li class="nav-item py-2 py-md-0 px-0 border-top-0">
                                <a href="terms-of-service.html" class="nav-link px-4 fw-normal text-gray-800">
                                    {{ __('transf.lnk_privacy_policy') }}</a>
                            </li>
                            <li class=" d-none d-xl-flex nav-item py-2 py-md-0 px-0 border-top-0">
                                <a href="terms-of-service.html" class="nav-link px-4 fw-normal text-gray-800">
                                    {{ __('transf.lnk_web_use_policy') }}
                                </a>
                            </li>

                        </ul>

                        <div class="dropdown me-2">
                            <button type="button"
                                class=" form-select form-select-sm font-size-sm-alone shadow min-width-140  p-2 mb-4 mb-md-0"
                                data-bs-toggle="dropdown">
                                <img class=""
                                    src="{{ asset('frontend/assets/img/flags/' . app()->getLocale() . '.webp') }}"
                                    alt="{{ __('transf.lang_' . config('locales.languages')[app()->getLocale()]['lang']) }}"
                                    height="16"
                                    title="{{ __('transf.lang_' . config('locales.languages')[app()->getLocale()]['lang']) }}">
                                <span>{{ __('transf.lang_' . config('locales.languages')[app()->getLocale()]['lang']) }}</span>
                            </button>

                            <ul class="dropdown-menu">
                                @foreach (config('locales.languages') as $key => $val)
                                    @if ($key != app()->getLocale())
                                        <li>
                                            <a class="dropdown-item" href="{{ route('change.language', $key) }}">
                                                <img src="{{ asset('frontend/assets/img/flags/' . $key . '.webp') }}"
                                                    alt="{{ __('transf.lang_' . config('locales.languages')[app()->getLocale()]['lang']) }}"
                                                    class="me-1 " height="12">
                                                <span class="align-middle">
                                                    {{ __('transf.lang_' . $val['lang']) }}
                                                </span>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach

                            </ul>
                        </div>

                        <div class="dropdown">
                            <button type="button"
                                class=" form-select form-select-sm font-size-sm-alone shadow min-width-140 p-2 mb-4 mb-md-0"
                                data-bs-toggle="dropdown">
                                @php
                                    $currency_code = session('currency_code');
                                    $currency_symbol = session('currency_symbol');
                                    $currency_name = session('currency_name');
                                @endphp
                                {{ Str::title($currency_name) }}
                            </button>

                            <ul class="dropdown-menu">
                                @forelse (\App\Models\Currency::where('status',1)->get() as $currency)
                                    @if ($currency['currency_code'] != $currency_code)
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('change.currency', $currency['currency_code']) }}">

                                                <span class="align-middle">
                                                    {{ Str::title($currency->currency_name) }}
                                                </span>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach

                            </ul>
                        </div>

                        {{-- <div class="hdr-links-wrap col-auto ml-auto">
                            <div class="hdr-group-link hide-mobile">
                                <div class="hdr-inline-link">
                                    <div class="dropdn_currency">
                                        <div class="dropdn dropdn_caret">

                                            @php
                                                $currency_code = session('currency_code');
                                                $currency_symbol = session('currency_symbol');
                                                $currency_name = session('currency_name');
                                            @endphp
                                            <a href="#" class="dropdn-link js-dropdn-link">
                                                {{ Str::title($currency_name) }}
                                                <i class="icon-angle-down"></i>
                                            </a>

                                            <div class="dropdn-content">
                                                <ul>
                                                    @forelse (\App\Models\Currency::where('status',1)->get() as $currency)
                                                        @if ($currency['currency_code'] != $currency_code)
                                                            <li
                                                                class="{{ $currency['currency_code'] == $currency_code ? 'active' : '' }}">
                                                                <a href="javascript:;"
                                                                    onclick="currency_change('{{ $currency['currency_code'] }}');">
                                                                    <span style="font-size: 12px">
                                                                        {{ Str::title($currency->currency_name) }}
                                                                    </span>
                                                                </a>
                                                            </li>
                                                        @endif

                                                    @empty
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> --}}

                    </div>
                </div>
            </div>
        </div> <!-- / .row -->
    </div> <!-- / .container -->
</footer>
