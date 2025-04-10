@extends('layouts.app')

@section('style')
    <style>
        .flick-item {
            width {}
        }


        @media(max-width:768px) {
            .navbar-dark .navbar-nav .nav-link {
                color: black;
                padding-right: 6px;
                padding-left: 6px;
                padding-top: 3px;
                padding-bottom: 3px;
            }
        }

        @media(max-width:768px) {}
    </style>
@endsection

@section('content')
    @include('frontend.home.main-slider')

    @include('frontend.home.partners')

    @livewire('frontend.home.trending-categories-component')

    @livewire('frontend.home.featured-courses-component')

    @include('frontend.home.call-action')

    {{--  d-none --}}
    @include('frontend.home.testimonial')

    @include('frontend.home.events') <!-- البرامج التدريبية -->

    @include('frontend.home.blog') <!-- الاخبار -->


    @include('frontend.home.instructors')

    {{-- d-none --}}
    @include('frontend.home.statistics')

    {{-- d-none --}}
    @include('frontend.home.newsletter')
@endsection
