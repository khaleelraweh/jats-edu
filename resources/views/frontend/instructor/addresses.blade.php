@extends('layouts.app-instructor')
@section('content')
    <section class="py-3 main-back-color custom--radius-heading">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h4 text-uppercase mb-0"> {{ __('panel.f_user_addresses') }} {{ auth()->user()->full_name }}
                    </h1>
                    <nav aria-label="breadcrumb ">
                        <ul class="breadcrumbs justify-content-lg-start mb-0 px-5 bg-transparent">
                            <li><a href="{{ route('frontend.index') }}">{{ __('panel.main') }}</a></li>
                            <li class="active"><span> {{ __('panel.f_addresses') }} <span></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-6 text-lg-end">
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="row m-0">

            <div class="col-lg-8 custom-white-spacing second-back-color">
                <div class="container">
                    <livewire:frontend.customer.addresses-component />
                </div>

            </div>


            {{-- SIDEBAR --}}
            <div class="col-lg-4">
                @include('partial.frontend.customer.sidebar')
            </div>
        </div>
    </section>
@endsection
