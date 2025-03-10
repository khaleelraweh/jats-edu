@extends('layouts.app')

@section('content')
    <?php
    // Increment views
    $post->increment('views');
    ?>

    <!-- BLOG-SINGLE -->
    <div class="container py-8 pt-lg-11">
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <h1 class="text-capitalize">
                    {{ $post->title }}
                </h1>

                <div class="d-md-flex align-items-center">
                    <div class="border rounded-circle d-inline-block mb-4 mb-md-0 me-4">
                        <div class="p-1">
                            @php
                                if ($post->users->first()->user_image != null) {
                                    $user_img = asset('assets/users/' . $post->users->first()->user_image);

                                    if (
                                        !file_exists(public_path('assets/users/' . $post->users->first()->user_image))
                                    ) {
                                        $user_img = asset('image/not_found/avator1.webp');
                                    }
                                } else {
                                    $user_img = asset('image/not_found/avator1.webp');
                                }
                            @endphp
                            <img src="{{ $user_img }}" alt="{{ $post->users->first()->full_name }}" class="rounded-circle"
                                width="52" height="52">
                        </div>
                    </div>

                    <div class="mb-4 mb-md-0">
                        <a href="#" class="d-block">
                            <h6 class="mb-0">{{ $post->users->first()->full_name }}</h6>
                        </a>
                        <span
                            class="font-size-sm">{{ $post->created_at ? \Carbon\Carbon::parse($post->created_at)->translatedFormat('d F Y') : null }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="mb-8 sk-thumbnail img-ratio-7"> --}}
    <div class="mb-8 ">
        @php
            if ($post->photos->last() != null && $post->photos->last()->file_name != null) {
                $post_img = asset('assets/posts/' . $post->photos->last()->file_name);

                if (!file_exists(public_path('assets/posts/' . $post->photos->last()->file_name))) {
                    $post_img = asset('image/not_found/placeholder.jpg');
                }
            } else {
                $post_img = asset('image/not_found/placeholder.jpg');
            }
        @endphp
        {{-- <img src="{{ $post_img }}" alt="..." class="img-fluid"> --}}
        <img src="{{ $post_img }}" alt="..." class="img-fluid d-block" style="margin: auto;">
    </div>

    <div class="container">
        <div class="row mb-8 mb-md-12">
            <div class="col-xl-8 mx-auto">
                <h3 class="">{{ __('transf.txt_content') }}</h3>
                <p class="mb-6 line-height-md">
                    {!! $post->description !!}
                </p>

                <div class="row mb-6 mb-md-10 align-items-center">
                    <div class="col-md-4 mb-5 mb-md-2">
                        <a href="{{ $whatsappShareUrl }}" target="_blank"
                            class="text-teal fw-medium d-flex align-items-center">
                            <!-- Icon -->
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16.0283 6.25C14.3059 6.25 12.9033 4.84833 12.9033 3.125C12.9033 1.40167 14.3059 0 16.0283 0C17.7509 0 19.1533 1.40167 19.1533 3.125C19.1533 4.84833 17.7509 6.25 16.0283 6.25ZM16.0283 1.25C14.995 1.25 14.1533 2.09076 14.1533 3.125C14.1533 4.15924 14.995 5 16.0283 5C17.0616 5 17.9033 4.15924 17.9033 3.125C17.9033 2.09076 17.0616 1.25 16.0283 1.25Z"
                                    fill="currentColor" />
                                <path
                                    d="M16.0283 20C14.3059 20 12.9033 18.5983 12.9033 16.875C12.9033 15.1517 14.3059 13.75 16.0283 13.75C17.7509 13.75 19.1533 15.1517 19.1533 16.875C19.1533 18.5983 17.7509 20 16.0283 20ZM16.0283 15C14.995 15 14.1533 15.8408 14.1533 16.875C14.1533 17.9092 14.995 18.75 16.0283 18.75C17.0616 18.75 17.9033 17.9092 17.9033 16.875C17.9033 15.8408 17.0616 15 16.0283 15Z"
                                    fill="currentColor" />
                                <path
                                    d="M3.94531 13.125C2.22275 13.125 0.820312 11.7233 0.820312 10C0.820312 8.27667 2.22275 6.875 3.94531 6.875C5.66788 6.875 7.07031 8.27667 7.07031 10C7.07031 11.7233 5.66788 13.125 3.94531 13.125ZM3.94531 8.125C2.91199 8.125 2.07031 8.96576 2.07031 10C2.07031 11.0342 2.91199 11.875 3.94531 11.875C4.97864 11.875 5.82031 11.0342 5.82031 10C5.82031 8.96576 4.97864 8.125 3.94531 8.125Z"
                                    fill="currentColor" />
                                <path
                                    d="M6.12066 9.39154C5.90307 9.39154 5.69143 9.27817 5.57729 9.0766C5.40639 8.77661 5.51061 8.39484 5.8106 8.22409L13.5431 3.81568C13.8422 3.64325 14.2247 3.74823 14.3947 4.04914C14.5656 4.34912 14.4614 4.73075 14.1614 4.90164L6.42888 9.30991C6.33138 9.36484 6.22564 9.39154 6.12066 9.39154Z"
                                    fill="currentColor" />
                                <path
                                    d="M13.8524 16.2665C13.7475 16.2665 13.6416 16.2398 13.5441 16.1841L5.81151 11.7757C5.51152 11.6049 5.40745 11.2231 5.5782 10.9232C5.74818 10.6224 6.12996 10.5182 6.42994 10.6899L14.1623 15.0981C14.4623 15.269 14.5665 15.6506 14.3958 15.9506C14.2807 16.1531 14.0691 16.2665 13.8524 16.2665Z"
                                    fill="currentColor" />
                            </svg>

                            <span class="ms-3">{{ __('transf.btn_share_this_post') }}</span>
                        </a>
                    </div>

                    <div class="col-md-8">
                        @foreach ($post->tags as $tag)
                            <a href="{{ route('frontend.blog_tag_list', $tag->slug) }}"
                                class="btn btn-sm btn-light text-gray-800 px-5 fw-normal me-1 mb-2">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                </div>

                {{-- blog reviews --}}
                @livewire('frontend.blogs.blog-review-component', ['postId' => $post->id])
            </div>
        </div>

        <div class="row align-items-end mb-4 mb-md-7">
            <div class="col-md mb-4 mb-md-0">
                <h1 class="mb-1">{{ __('transf.txt_latest_news') }}</h1>
                <p class="font-size-lg mb-0 text-capitalize">{{ __('transf.txt_latest_news_desc') }}</p>
            </div>
            <div class="col-md-auto">
                <a href="{{ route('frontend.blog_list') }}" class="d-flex align-items-center fw-medium">
                    {{ __('transf.browse_all') }}
                    <div class="ms-2 d-flex">
                        <!-- Icon -->
                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.7779 4.6098L3.32777 0.159755C3.22485 0.0567475 3.08745 0 2.94095 0C2.79445 0 2.65705 0.0567475 2.55412 0.159755L2.2264 0.487394C2.01315 0.700889 2.01315 1.04788 2.2264 1.26105L5.96328 4.99793L2.22225 8.73895C2.11933 8.84196 2.0625 8.97928 2.0625 9.1257C2.0625 9.27228 2.11933 9.4096 2.22225 9.51269L2.54998 9.84025C2.65298 9.94325 2.7903 10 2.9368 10C3.0833 10 3.2207 9.94325 3.32363 9.84025L7.7779 5.38614C7.88107 5.2828 7.93774 5.14484 7.93741 4.99817C7.93774 4.85094 7.88107 4.71305 7.7779 4.6098Z"
                                fill="currentColor" />
                        </svg>

                    </div>
                </a>
            </div>
        </div>

        <div class="row row-cols-md-2 row-cols-lg-3 mb-8 mb-md-11">
            @foreach ($latest_posts->take(3) as $latest_post)
                <div class="col-md mb-5 mb-lg-0">
                    <!-- Card -->
                    <div class="card border shadow p-2 lift sk-fade">
                        <!-- Image -->
                        <div class="card-zoom position-relative">
                            <a href="{{ route('frontend.blog_single', $latest_post->slug) }}"
                                class="card-img d-block sk-thumbnail img-ratio-3">
                                @php
                                    if (
                                        $latest_post->photos->first() != null &&
                                        $latest_post->photos->first()->file_name != null
                                    ) {
                                        $latest_post_img = asset(
                                            'assets/posts/' . $latest_post->photos->first()->file_name,
                                        );

                                        if (
                                            !file_exists(
                                                public_path('assets/posts/' . $latest_post->photos->first()->file_name),
                                            )
                                        ) {
                                            $latest_post_img = asset('image/not_found/placeholder.jpg');
                                        }
                                    } else {
                                        $latest_post_img = asset('image/not_found/placeholder.jpg');
                                    }
                                @endphp
                                <img class="rounded shadow-light-lg img-fluid" src="{{ $latest_post_img }}" alt="...">
                            </a>

                            <a href="{{ route('frontend.blog_list', $latest_post->courseCategory->slug) }}"
                                class="badge sk-fade-bottom badge-lg badge-purple badge-pill badge-float bottom-0 left-0 mb-4 ms-4 px-5 me-4">
                                <span
                                    class="text-white fw-normal font-size-sm">{{ $latest_post->courseCategory->title }}</span>
                            </a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-2 pb-0 pt-4">
                            <ul class="nav mx-n3 mb-3">
                                <li class="nav-item px-3">
                                    <a href="{{ route('frontend.instructors_single', $latest_post->users->first()->id) }}"
                                        class="d-flex align-items-center text-gray-800">
                                        <div class="me-3 d-flex">
                                            <!-- Icon -->
                                            <svg width="15" height="15" viewBox="0 0 15 15"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.8102 9.52183C13.313 9.08501 12.7102 8.70758 12.0181 8.40008C11.7223 8.2687 11.3761 8.40191 11.2447 8.69762C11.1134 8.99334 11.2466 9.33952 11.5423 9.47102C12.1258 9.73034 12.6287 10.0436 13.0367 10.4021C13.5396 10.8441 13.8281 11.484 13.8281 12.1582V13.2422C13.8281 13.5653 13.5653 13.8281 13.2422 13.8281H1.75781C1.43475 13.8281 1.17188 13.5653 1.17188 13.2422V12.1582C1.17188 11.484 1.46038 10.8441 1.96335 10.4021C2.55535 9.88186 4.2802 8.67188 7.5 8.67188C9.89079 8.67188 11.8359 6.72672 11.8359 4.33594C11.8359 1.94515 9.89079 0 7.5 0C5.10921 0 3.16406 1.94515 3.16406 4.33594C3.16406 5.7336 3.82896 6.97872 4.85893 7.77214C2.97432 8.18642 1.80199 8.98384 1.18984 9.52183C0.433731 10.1862 0 11.147 0 12.1582V13.2422C0 14.2115 0.788498 15 1.75781 15H13.2422C14.2115 15 15 14.2115 15 13.2422V12.1582C15 11.147 14.5663 10.1862 13.8102 9.52183ZM4.33594 4.33594C4.33594 2.59129 5.75535 1.17188 7.5 1.17188C9.24465 1.17188 10.6641 2.59129 10.6641 4.33594C10.6641 6.08059 9.24465 7.5 7.5 7.5C5.75535 7.5 4.33594 6.08059 4.33594 4.33594Z"
                                                    fill="currentColor" />
                                            </svg>

                                        </div>
                                        <div class="font-size-sm">{{ $latest_post->users->first()->full_name }}</div>
                                    </a>
                                </li>
                                <li class="nav-item px-3">
                                    <a href="{{ route('frontend.blog_single', $latest_post->slug) }}"
                                        class="d-flex align-items-center text-gray-800">
                                        <div class="me-2 d-flex">
                                            <!-- Icon -->
                                            <svg width="15" height="15" viewBox="0 0 15 15"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.0664 1.17188H11.7188V0.46875C11.7188 0.209883 11.5089 0 11.25 0C10.9911 0 10.7812 0.209883 10.7812 0.46875V1.17188H4.21875V0.46875C4.21875 0.209883 4.0089 0 3.75 0C3.4911 0 3.28125 0.209883 3.28125 0.46875V1.17188H1.93359C0.867393 1.17188 0 2.03927 0 3.10547V13.0664C0 14.1326 0.867393 15 1.93359 15H13.0664C14.1326 15 15 14.1326 15 13.0664V3.10547C15 2.03927 14.1326 1.17188 13.0664 1.17188ZM1.93359 2.10938H3.28125V2.57812C3.28125 2.83699 3.4911 3.04688 3.75 3.04688C4.0089 3.04688 4.21875 2.83699 4.21875 2.57812V2.10938H10.7812V2.57812C10.7812 2.83699 10.9911 3.04688 11.25 3.04688C11.5089 3.04688 11.7188 2.83699 11.7188 2.57812V2.10938H13.0664C13.6157 2.10938 14.0625 2.55621 14.0625 3.10547V4.21875H0.9375V3.10547C0.9375 2.55621 1.38434 2.10938 1.93359 2.10938ZM13.0664 14.0625H1.93359C1.38434 14.0625 0.9375 13.6157 0.9375 13.0664V5.15625H14.0625V13.0664C14.0625 13.6157 13.6157 14.0625 13.0664 14.0625Z"
                                                    fill="currentColor" />
                                            </svg>

                                        </div>
                                        <div class="font-size-sm">
                                            {{ $latest_post->created_at ? \Carbon\Carbon::parse($latest_post->created_at)->translatedFormat('d F Y') : null }}
                                        </div>
                                    </a>
                                </li>
                            </ul>

                            <!-- Heading -->
                            <a href="{{ route('frontend.blog_single', $latest_post->slug) }}" class="d-block">
                                <h5 class="line-clamp-2 h-48 h-lg-52">
                                    {{ $latest_post->title }}
                                </h5>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
