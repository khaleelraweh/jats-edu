@extends('layouts.app-instructor')
@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-sm-12">
                <h2>{{ __('transf.courses') }}</h2>
            </div>
        </div>

        {{-- <header class="navbar navbar-expand-xl navbar-light bg-white border-bottom py-1 py-xl-1 "> --}}
        <header class="navbar navbar-expand-xl navbar-light bg-transparent  py-1 py-xl-1 ">

            <div class="container-fluid">
                <!-- Brand -->
                <a class="navbar-brand me-0" href="{{ route('frontend.index') }}">
                    search and filter
                </a>

                <!-- Account modal  -->
                <ul class="navbar-nav flex-row ms-auto ms-xl-0 me-n2 me-md-n4">

                    <button class="btn text-white-all btn-coral btn-wide d-none d-lg-inline-block" data-aos-duration="200"
                        data-aos="fade-up" type="submit">
                        {{ __('transf.new_course') }}
                    </button>

                </ul>
            </div>
        </header>
    </div>
@endsection
