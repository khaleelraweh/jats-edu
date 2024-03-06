@extends('layouts.app')

@section('content')
    <!-- PAGE TITLE
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ================================================== -->
    {{-- <header class="bg-white py-8 py-lg-12 position-relative mb-8" style="background-image: none;"> --}}
    <header class="bg-white py-3 py-lg-3 position-relative mb-3" style="background-image: none;">
        <div class="container text-center py-xl-5">
            <h1 class="display-4 fw-semi-bold mb-0">
                <a href="{{ route('frontend.courses') }}">
                    {{ __('transf.txt_all_courses') }}
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
                        <a href="{{ route('frontend.courses') }}">
                            {{ __('transf.courses') }}
                        </a>

                    </li>
                </ol>
            </nav>
        </div>
        <!-- Img -->
        <img class="position-absolute position-center-y right-0 mw-300p mw-xl-450p me-md-6 d-none d-lg-block img-fluid"
            src="assets/img/illustrations/illustration-1.png" alt="...">
    </header>

    @livewire('frontend.courses.course-list-component', ['slug' => $slug])
@endsection
