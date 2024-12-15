@extends('layouts.app')

@section('content')
    <?php $news_tag_list_views->increment('views'); ?>

    <!-- PAGE TITLE -->
    <header class="py-8 py-md-11" style="background-image: none;">
        <div class="container text-center py-xl-2">
            <h1 class="display-4 fw-semi-bold mb-0">{{ __('transf.blog_list') }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-scroll justify-content-center">
                    <li class="breadcrumb-item">
                        <a class="text-gray-800" href="{{ route('frontend.index') }}">
                            {{ __('transf.home') }}
                        </a>
                    </li>
                    <li class="breadcrumb-item text-gray-800 active" aria-current="page">
                        {{ __('transf.blog_list') }}
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Img -->
        <img class="d-none img-fluid" src="...html" alt="...">
    </header>
    @livewire('frontend.blogs.blog-tag-list-component', ['slug' => $slug])
@endsection
