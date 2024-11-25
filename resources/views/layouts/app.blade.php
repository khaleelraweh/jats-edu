<?php $rtl = config('locales.languages')[app()->getLocale()]['rtl_support'] == 'rtl' ? 'rtl' : ''; ?>
<?php $dark = Cookie::get('theme') !== null ? (Cookie::get('theme') == 'dark' ? 'dark' : '') : 'dark'; ?>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $rtl == 'rtl' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="معهد خطوة شباب للتدريب واللغات">
    <meta name="robots" content="all,follow">
    <meta name="author" content="معهد خطوة شباب للتدريب واللغات" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'معهد خطوة شباب للتدريب واللغات') }}</title>


    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend/favicon.png') }}">


    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Fredoka+One&amp;family=Lora:wght@400;700&amp;family=Montserrat:wght@400;500;600;700&amp;family=Nunito:wght@400;700&amp;display=swap"
        rel="stylesheet">

    <!-- Libs CSS -->

    <link rel="stylesheet" href="{{ asset('frontend/assets/fonts/fontawesome/fontawesome.css') }}">

    <link rel="stylesheet"
        href="{{ asset('frontend/assets/libs/%40fancyapps/fancybox/dist/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/libs/aos/dist/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/libs/choices.js/public/assets/styles/choices.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/libs/flickity-fade/flickity-fade.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/libs/flickity/dist/flickity.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/libs/highlightjs/styles/vs2015.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/libs/jarallax/dist/jarallax.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/libs/quill/dist/quill.core.css') }}" />

    {{-- owl-carousel --}}
    <link rel="stylesheet" href="{{ asset('frontend/assets/plugins/owl-carousel/owl.carousel.css') }}" />


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@24.6.0/build/css/intlTelInput.css">

    <link rel="stylesheet"
        href="{{ $rtl == 'rtl' ? asset('frontend/assets/css/theme-rtl.css') : asset('frontend/assets/css/theme.css') }}">

    <link rel="stylesheet"
        href="{{ $rtl == 'rtl' ? asset('frontend/assets/css/custom-rtl.css') : asset('frontend/assets/css/custom.css') }}">

    <link href="{{ asset('backend/css/icons.min.css') }}" rel="stylesheet" type="text/css">

    @livewireStyles

    @yield('style')
</head>

@php
    $bbg = '';
    if (request()->routeIs('frontend.index')) {
        $bbg = '';
    } elseif (request()->routeIs('customer.lesson_single')) {
        $bbg = 'bg-dark';
    } elseif (request()->routeIs('frontend.course_single') || request()->routeIs('frontend.event_single')) {
        $bbg = 'bg-white';
    } else {
        $bbg = '';
    }
@endphp

{{-- <body
    class="{{ request()->routeIs('frontend.index') ? '' : (request()->routeIs('customer.lesson_single') ? 'bg-dark' : 'bg-light') }}">
     --}}

<body class="{{ $bbg }}">

    <div id="app">

        @if (!request()->routeIs('customer.lesson_single'))
            <!-- MODALS
        ================================================== -->
            <!-- Modal Sidebar account -->
            @include('partial.frontend.modalExample')

            @include('partial.frontend.accountModal')

            <!-- Modal Sidebar cart -->
            @include('partial.frontend.cartModal')

            <!-- NAVBAR
        ================================================== -->
            @include('partial.frontend.header')
        @endif

        @yield('content')

        <!-- FOOTER
        ================================================== -->

        @if (!request()->routeIs('customer.lesson_single'))
            @include('partial.frontend.footer')
        @endif




    </div>


    <!-- JAVASCRIPT
    ================================================== -->
    <!-- Libs JS -->
    <script src="{{ asset('frontend/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/%40fancyapps/fancybox/dist/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/aos/dist/aos.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/countup.js/dist/countUp.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/dropzone/dist/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/flickity/dist/flickity.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/flickity-fade/flickity-fade.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/highlightjs/highlight.pack.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/isotope-layout/dist/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/jarallax/dist/jarallax.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/jarallax/dist/jarallax-video.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/jarallax/dist/jarallax-element.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/parallax-js/dist/parallax.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/quill/dist/quill.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/smooth-scroll/dist/smooth-scroll.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/typed.js/lib/typed.min.js') }}"></script>

    <!-- Theme JS -->
    <script src="{{ asset('frontend/assets/js/theme.min.js') }}"></script>



    <!-- Plugin js for Tinymce -->
    <script src="{{ asset('backend/vendor/tinymce/tinymce.min.js') }}"></script>
    <!-- End plugin js for Tinymce -->

    <script>
        var tinymceLanguage = '{{ app()->getLocale() }}'; // Get the current locale from Laravel config
        var flatPickrLanguage = '{{ app()->getLocale() }}';
    </script>

    <!-- Custom js for the Tinymce -->
    <script src="{{ asset('backend/js/tinymce.js') }}"></script>
    <!-- End custom js for Tinymce -->






    {{-- owl-carousel --}}
    <script src="{{ asset('frontend/assets/plugins/owl-carousel/owl-main.js') }}"></script>
    <script src="{{ asset('frontend/assets/plugins/owl-carousel/owl.carousel.js') }}"></script>











    @yield('script')

    @livewireScripts

    {{-- livewire alert  --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />

    {{-- alpinejs --}}
    <script src="//unpkg.com/alpinejs" defer></script>

    {{-- RealRashed sweat alert  using toast --}}
    @include('sweetalert::alert')
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])

</body>

</html>
