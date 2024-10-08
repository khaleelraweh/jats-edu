@extends('layouts.app-instructor')
@section('content')
    <div class="container">


        {{-- <header class="navbar navbar-expand-xl navbar-light bg-white border-bottom py-1 py-xl-1 "> --}}
        <header class="navbar navbar-expand-xl navbar-light bg-transparent  py-1 py-xl-1 my-3">

            <div class="container-fluid">
                <!-- Brand -->
                <a class="navbar-brand me-0" href="{{ route('frontend.index') }}">
                    <h2>{{ __('transf.courses') }}</h2>
                </a>

                <!-- Account modal  -->
                <ul class="navbar-nav flex-row ms-auto ms-xl-0 me-n2 me-md-n4">

                    <a href="{{ route('instructor.courses.create') }}"
                        class="btn text-white-all btn-coral btn-wide d-none d-lg-inline-block" data-aos-duration="200"
                        data-aos="fade-up" type="submit">
                        {{ __('transf.new_course') }}
                    </a>

                </ul>
            </div>
        </header>

        @livewire('frontend.instructors.instructor-courses-component')
    </div>
@endsection
