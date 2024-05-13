<?php $rtl = config('locales.languages')[app()->getLocale()]['rtl_support'] == 'rtl' ? 'rtl' : ''; ?>
<?php $dark = Cookie::get('theme') !== null ? (Cookie::get('theme') == 'dark' ? 'dark' : '') : 'dark'; ?>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $rtl == 'rtl' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Ecommerce project">
    <meta name="robots" content="all,follow">
    <meta name="author" content="" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Skola') }}</title>


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


    {{-- Select2 labs  --}}
    <link rel="stylesheet" href="{{ asset('backend/vendor/select2/css/select2.min.css') }}">

    <link rel="stylesheet"
        href="{{ $rtl == 'rtl' ? asset('frontend/assets/css/theme-rtl.min.css') : asset('frontend/assets/css/theme.min.css') }}">

    <link rel="stylesheet"
        href="{{ $rtl == 'rtl' ? asset('frontend/assets/css/custom-rtl.css') : asset('frontend/assets/css/custom.css') }}">

    @livewireStyles

    @yield('style')
</head>



<body class="{{ request()->routeIs('frontend.index') ? '' : 'bg-light' }}">

    <div id="app">

        <!-- MODALS
        ================================================== -->
        <!-- Modal Sidebar account -->
        {{-- @include('partial.frontend.instructor.modalExample') --}}

        @include('partial.frontend.instructor.accountModal')

        <!-- Modal Sidebar cart -->
        {{-- @include('partial.frontend.instructor.cartModal') --}}

        <!-- NAVBAR
        ================================================== -->
        @include('partial.frontend.instructor.header')

        @yield('content')


        <!-- FOOTER
        ================================================== -->

        @if (!request()->routeIs('customer.lesson_single'))
            @include('partial.frontend.instructor.footer')
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

    {{-- Call select2 plugin --}}
    <script src="{{ asset('backend/vendor/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

    <!-- Theme JS -->
    <script src="{{ asset('frontend/assets/js/theme.min.js') }}"></script>



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
