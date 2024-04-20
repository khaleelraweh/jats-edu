@extends('layouts.app')
@section('content')
    <header class="bg-white py-3 py-lg-3 position-relative mb-2" style="background-image: none;">
        <div class="container text-center py-xl-2">
            <h1 class="display-4 fw-semi-bold mb-0">
                <a href="{{ route('customer.orders') }}">
                    {{ __('transf.txt_my_orders') }}
                </a>
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-scroll justify-content-center">
                    <li class="breadcrumb-item">
                        <a class="text-gray-800" href="{{ route('frontend.index') }}">
                            {{ __('transf.lnk_home') }}
                        </a>
                    </li>
                    <li class="breadcrumb-item text-gray-800 active" aria-current="page">
                        <a href="{{ route('customer.orders') }}">
                            {{ __('transf.txt_orders') }}
                        </a>

                    </li>
                </ol>
            </nav>
        </div>
        <!-- Img -->



        <img class="position-absolute position-center-y right-0 mw-300p mw-xl-450p me-md-6 d-none d-lg-block img-fluid"
            src="{{ asset('assets/courses/il1.png') }}" alt="...">
    </header>

    <section class="py-5">
        <div class="row m-0">

            <div class="col-lg-8 custom-white-spacing second-back-color">
                <div class="container">

                    <livewire:frontend.customer.orders-component />
                </div>
            </div>


            {{-- SIDEBAR --}}
            <div class="col-lg-4">
                @include('partial.frontend.customer.sidebar')
            </div>
        </div>
    </section>
@endsection
