<?php $main_views->increment('views'); ?>
<section class="mt-n12">
    {{-- {{ dd($instructors) }} --}}
    <div class="flickity-page-dots-vertical flickity-page-dots-md flickity-page-dots-white position-static"
        data-flickity='{"pageDots": true, "prevNextButtons": false, "cellAlign": "center", "wrapAround": true,"autoPlay":true, "imagesLoaded": true}'>

        @forelse ($main_sliders->where('section' ,1) as $main_slider)
            <div class="w-100">
                @php
                    if ($main_slider->firstMedia != null && $main_slider->firstMedia->file_name != null) {
                        $main_slider_img = asset('assets/main_sliders/' . $main_slider->firstMedia->file_name);

                        if (!file_exists(public_path('assets/main_sliders/' . $main_slider->firstMedia->file_name))) {
                            // $main_slider_img = asset('image/not_found/placeholder.jpg');
                            $main_slider_img = asset('image/not_found/placeholder.jpg');
                        }
                    } else {
                        // $main_slider_img = asset('image/not_found/placeholder.jpg');
                        $main_slider_img = asset('image/not_found/placeholder.jpg');
                    }
                @endphp
                <div class="vh-100 bg-cover position-relative overlay overlay-custom"
                    style="background-image: url({{ $main_slider_img }})">
                    <div class="container position-static pt-9 pt-md-12 pb-8 py-lg-0">
                        <div class="mx-lg-n5">
                            <div class="vh-100 row gx-0 mx-auto">
                                <div class="col-12 mt-12 mb-4 my-md-auto text-center" style="z-index:1;">
                                    <!-- Heading -->
                                    <h1 class="display-5 fw-medium text-white mb-2 text-uppercase" data-aos="fade-left"
                                        data-aos-duration="150">
                                        {{ $main_slider->title }}
                                    </h1>

                                    <!-- Text -->
                                    <p class="text-white-70 text-capitalize mb-5" data-aos="fade-up"
                                        data-aos-duration="200">
                                        {!! $main_slider->content !!}
                                    </p>

                                    <!-- Buttons -->
                                    @if ($main_slider->btn_one_show == 1)
                                        <a href="{{ url($main_slider->btn_one_url) }}"
                                            class="btn text-white-alone btn-slide slide-white btn-wide shadow mb-4 mb-md-0 me-md-5 text-uppercase"
                                            data-aos-duration="200" data-aos="fade-up">
                                            {{-- {{ __('transf.btn_get_started') }} --}}
                                            {{ $main_slider->btn_one_name }}
                                        </a>
                                    @endif

                                    @if ($main_slider->btn_two_show == 1)
                                        <a href="{{ url($main_slider->btn_two_url) }}"
                                            class="btn text-white-all btn-coral btn-wide d-none d-lg-inline-block"
                                            data-aos-duration="200" data-aos="fade-up">
                                            {{-- {{ __('transf.btn_view_courses') }} --}}
                                            {{ $main_slider->btn_two_name }}
                                        </a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @empty
        @endforelse

    </div>


    {{-- <div class="py-7 py-lg-0 mt-lg-n11 overlay-lg-none overlay overlay-primary overlay-90">
        <div class="container">
            <ul class="nav row justify-content-between">
                @foreach ($main_sliders->where('section', 2)->take(3) as $adv_slider)
                    <li class="col-lg-auto mb-5 mb-lg-0 nav-item">
                        <div class="d-flex align-items-center">
                            <div class="text-white icon-md">
                                <a href="{{ url($adv_slider->btn_one_url ?? '#') }}" style="color: white;">
                                    <i class="{{ $adv_slider->icon }}" style="font-size: 60px"></i>
                                </a>

                            </div>
                            <div class="media-body">
                                <a href="{{ url($adv_slider->btn_one_url ?? '#') }}">
                                    <h4 class="text-white mb-0 text-uppercase">{{ $adv_slider->title }}</h4>
                                    <p class="text-white mb-0">{!! $adv_slider->description !!} </p>
                                </a>
                            </div>

                        </div>
                    </li>
                @endforeach

            </ul>
        </div>
    </div> --}}

    <div class="py-7 py-lg-0 mt-lg-n11 overlay-lg-none overlay overlay-primary overlay-90">
        <div class="container">
            <!-- Use flex-nowrap on lg and md, flex-wrap on sm and below -->
            <ul class="nav row flex-xlg-nowrap  flex-wrap justify-content-between align-items-center">
                @foreach ($main_sliders->where('section', 2)->take(3) as $adv_slider)
                    <li class="col-lg-4 col-md-12 col-12 mb-5 mb-lg-0 nav-item">
                        <div class="d-flex align-items-center">
                            <div class="text-white icon-md">
                                <a href="{{ url($adv_slider->btn_one_url ?? '#') }}" style="color: white;">
                                    <i class="{{ $adv_slider->icon }}" style="font-size: 60px"></i>
                                </a>
                            </div>
                            <div class="media-body">
                                <a href="{{ url($adv_slider->btn_one_url ?? '#') }}">
                                    <h4 class="text-white mb-0 text-uppercase">{{ $adv_slider->title }}</h4>
                                    <p class="text-white mb-0">{!! $adv_slider->description !!}</p>
                                </a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
