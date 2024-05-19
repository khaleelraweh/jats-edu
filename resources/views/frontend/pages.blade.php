@extends('layouts.app')

@section('content')
    <!-- PAGE TITLE  -->
    <header class="py-6 py-md-6" style="background-image: none;">
        <div class="container text-center py-xl-2">
            <h1 class="display-4 fw-semi-bold mb-0">{{ $page->title }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-scroll justify-content-center">
                    <li class="breadcrumb-item">
                        <a class="text-gray-800" href="#">
                            {{ __('transf.home') }}
                        </a>
                    </li>
                    <li class="breadcrumb-item text-gray-800 active" aria-current="page">
                        {{ $page->title }}
                    </li>
                </ol>
            </nav>
        </div>
        <!-- Img -->
        <img class="d-none img-fluid" src="...html" alt="...">
    </header>



    <!-- ABOUT V1 -->
    <div class="container pb-4 pb-xl-7">
        <div class="text-center mb-md-6 mb-4">

            <p class="w-xl-80 mx-auto line-height-md">
                {!! $page->content !!}
            </p>
        </div>



    </div>
@endsection
