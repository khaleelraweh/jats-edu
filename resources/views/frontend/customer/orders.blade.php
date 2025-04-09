@extends('layouts.app')
@section('style')
    <style>
        .table .total-group {
            background-color: #f8f9fa;
            border-top: 2px solid #dee2e6;
        }

        .table .total-group td {
            padding: 0.75rem;
            font-weight: bold;
        }

        .table .total-amount {
            background-color: #e9ecef;
            border-top: 3px solid #ced4da;
        }

        .table .total-amount td {
            font-size: 1.1rem;
            color: #343a40;
        }

        .table .text-end {
            text-align: right;
        }
    </style>
@endsection
@section('content')
    <!-- PAGE TITLE -->
    <header class="py-6 py-md-8" style="background-image: none;">
        <div class="container text-center py-xl-2">
            <h1 class="display-4 fw-semi-bold mb-0">
                {{ __('transf.txt_my_orders') }}
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-scroll justify-content-center">
                    <li class="breadcrumb-item">
                        <a class="text-gray-800" href="#">
                            <a class="text-gray-800" href="{{ route('frontend.index') }}">
                                {{ __('transf.lnk_home') }}
                            </a>
                        </a>
                    </li>
                    <li class="breadcrumb-item text-gray-800 active" aria-current="page">
                        {{ __('transf.txt_orders') }}
                    </li>
                </ol>
            </nav>
        </div>
        <!-- Img -->
        <img class="d-none img-fluid" src="...html" alt="...">
    </header>



    <section class="py-5">
        <div class="row m-0">

            <div class="col-lg-12">
                <div class="container">
                    <livewire:frontend.customer.orders-component />
                </div>
            </div>


            {{-- SIDEBAR --}}
            {{-- <div class="col-lg-4">
                @include('partial.frontend.customer.sidebar')
            </div> --}}
        </div>
    </section>
@endsection
