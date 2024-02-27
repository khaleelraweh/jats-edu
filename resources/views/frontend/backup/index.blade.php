@extends('layouts.app')


@section('content')

    {{-- {{ dd($getCurrencies) }} --}}
    {{-- Main slider part  --}}
    @if (count($main_sliders) > 0)
        <div class="page-content">
            <div class="holder fullwidth fullwidth full-nopad mt-0 ">
                <div class="container">
                    <div class="bnslider-wrapper">

                        <div class="bnslider bnslider--lg keep-scale" id="bnslider-001"
                            data-slick='{"arrows": true, "dots": true}' data-autoplay="true" data-speed="5000"
                            data-start-width="1920" data-start-height="750" data-start-mwidth="1550"
                            data-start-mheight="1000">


                            {{-- {{ array_key_exists('site_twitter', $site_setting) ? $site_setting['site_twitter'] : '' }} --}}
                            @forelse ($main_sliders as $main_slider)
                                <div class="bnslider-slide">
                                    <div class="bnslider-image-mobile lazyload"
                                        data-bgset="{{ asset('assets/main_sliders/' . $main_slider->firstMedia?->file_name) }}">
                                    </div>

                                    <div class="bnslider-image lazyload"
                                        data-bgset="{{ asset('assets/main_sliders/' . $main_slider->firstMedia?->file_name) }}">
                                    </div>

                                    @if ($main_slider->showInfo == true)
                                        <div class="bnslider-text-wrap bnslider-overlay">
                                            <div class="bnslider-text-content txt-middle txt-center">
                                                <div class="bnslider-text-content-flex">
                                                    <div class="bnslider-vert w-s-60 w-ms-100">
                                                        <div class="bnslider-text order-1 mt-sm bnslider-text--xl text-center heading-font"
                                                            data-animation="fadeInUp" data-animation-delay="500"
                                                            data-fontcolor="#fff" data-fontweight="900">
                                                            {{ $main_slider->title }}
                                                        </div>
                                                        <div class="bnslider-text order-2 mt-sm bnslider-text--sm text-center heading-font"
                                                            data-animation="fadeInUp" data-animation-delay="1000"
                                                            data-fontcolor="#fff" data-fontweight="900">
                                                            {!! $main_slider->content !!}
                                                        </div>
                                                        <div class="btn-wrap text-center order-3 mt-lg"
                                                            data-animation="fadeIn" data-animation-delay="2000"
                                                            style="opacity: 1">
                                                            <a href="{{ $main_slider->url != null ? url($main_slider->url) : '#' }}"
                                                                class="btn btn--invert btn--lg"
                                                                target="{{ $main_slider->target }}">
                                                                {{ __('panel.f_shop_now') }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>

                                {{-- @endif --}}

                            @empty
                            @endforelse


                        </div>

                        <div class="bnslider-arrows container-fluid">
                            <div></div>
                        </div>
                        <div class="bnslider-dots container-fluid"></div>

                    </div>


                </div>

            </div>
        </div>
    @endif


    {{-- Advertisor menu --}}
    {{-- <div class="holder mt-0"> --}}
    @if (count($adv_sliders) > 0)
        <div class="page-content">
            <div class="holder mt-3">

                {{-- <div class="container-fluid px-0"> --}}

                {{-- <div class="row bnr-grid no-gutters"> --}}
                {{-- <div class="prd-grid prd-promo-carousel  data-to-show-3   js-prd-promo-carousel"> --}}

                <div class="prd-grid no-gutters prd-promo-carousel  js-prd-promo-carousel  data-to-show-3 data-to-show-md-3 data-to-show-sm-3 data-to-show-xs-2"
                    data-slick='{"slidesToShow": 3, "slidesToScroll": 2, "responsive": [{"breakpoint": 992,"settings": {"slidesToShow": 3, "slidesToScroll": 1}},{"breakpoint": 768,"settings": {"slidesToShow": 2, "slidesToScroll": 1}},{"breakpoint": 480,"settings": {"slidesToShow": 1, "slidesToScroll": 1}}]}'>

                    @forelse ($adv_sliders as $adv_slider)
                        {{-- <div class="col-12 col-sm-4"> --}}
                        {{-- <div class="prod-promo prd-promo--lg prd-has-loader "> --}}
                        <div class="prd prd--style2 prd-labels--max prd-labels-shadow " data-start-height="10"
                            data-start-mheight="10">

                            {{-- <div class="bnr-wrap d-flex align-items-center h-100 bnr-1586628920521-0 "> --}}
                            <div class="bnr-wrap d-flex align-items-center h-100 bnr-1586628920521-0 ">
                                <div class="bnr custom-caption  image-hover-scale image-hover-scale--slow bnr--middle bnr--center my_adv_custom_style"
                                    data-fontratio="5.9">
                                    <div class="bnr-img image-container" style="padding-bottom: 38.933%">
                                        <img data
                                            srcset="{{ asset('assets/advertisor_sliders/' . $adv_slider->firstMedia?->file_name) }}"
                                            class="lazyload fade-up" alt="" />
                                    </div>

                                    @if ($adv_slider->showInfo == true)
                                        <div class="bnr-caption" style="padding: 4% 4%; width: 100%">
                                            <div class="bnr-text3 mt-0 order-1"
                                                style="
                                            font-size: 0.20em;
                                            font-weight: 700;
                                            line-height: 1em;
                                            letter-spacing: 3px;
                                        ">

                                                {{ $adv_slider->published_on->format('Y') }}
                                            </div>
                                            <div class="bnr-text3 mt-xs order-2"
                                                style="
                                                font-size: 0.4em;
                                                font-weight: 800;
                                                line-height: 1em;
                                        ">
                                                {{ $adv_slider->title }}
                                            </div>

                                            <div class="bnr-text3 mt-xs order-2"
                                                style="
                                                font-size: 0.2em;
                                                font-weight: 500;
                                                line-height: 1em;
                                        ">
                                                {!! $adv_slider->content !!}
                                            </div>

                                        </div>
                                    @endif


                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>

            </div>
        </div>
    @endif

    {{-- featured cards livewire component --}}
    <livewire:frontend.home.featured-card-component />


    {{-- card categories with slider  --}}
    {{-- @if (count($card_categories) > 0)
        <div class="holder global_width">
            <div class="container">
                <div class="title-wrap text-center">
                    <h3 class="h2-style testimonials-carousel-simple-name">بطاقاتنا</h3>
                    <h2 class="h1-style">اختر البطاقة المناسبة لك</h2>
                </div>
                <div class="prd-grid prd-promo-carousel data-to-show-4 js-prd-promo-carousel">

                    @forelse ($card_categories as $card_category)
                        <div class="prd-promo prd-promo--lg prd-has-loader">
                            <div class="prd-inside">
                                <div class="prd-img-area">
                                    <a href="{{ route('frontend.card_category', $card_category->slug) }}"
                                        class="image-hover-scale">
                                        <img src="{{ asset('assets/card_categories/' . $card_category->firstMedia?->file_name) }}"
                                            alt="{{ $card_category->name }}" class="js-prd-img" />

                                    </a>
                                </div>
                                <div class="prd-info text-center">
                                    <h2 class="prd-title"><a
                                            href="{{ route('frontend.card_category', $card_category->slug) }}">{{ $card_category->name }}</a>
                                    </h2>
                                    <div class="prd-hover">
                                        <div class="prd-action">
                                            <a href="{{ route('frontend.card_category', $card_category->slug) }}"
                                                class="btn js-prd-addtocart">
                                                عرض الباقات
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse

                </div>
            </div>
        </div>
    @endif --}}

    {{-- card categories without slider  --}}
    @if (count($card_categories) > 0)
        <div class="holder global_width">
            <div class="container">
                <div class="title-wrap text-center">
                    <h3 class="h2-style testimonials-carousel-simple-name main-color"> {{ __('panel.f_our_categories') }}
                    </h3>
                    <h2 class="h1-style"> {{ __('panel.f_choose_your_favorite_category') }} </h2>
                </div>
                <div class="prd-grid product-listing data-to-show-5 data-to-show-md-3 data-to-show-sm-2 ">


                    @forelse ($card_categories as $card_category)
                        <div class="prd  prd--style2 prd-labels--max prd-labels-shadow prd-w-xxs">
                            <div class="">
                                <div class="">
                                    <a href="{{ route('frontend.card_category', $card_category->slug) }}"
                                        class="image-hover-scale">
                                        <img src="{{ asset('assets/card_categories/' . $card_category->firstMedia?->file_name) }}"
                                            alt="{{ $card_category->category_name }}" class="js-prd-img" />
                                    </a>
                                </div>
                                <div class="prd-info text-center">
                                    <h2 class="prd-title"><a
                                            href="{{ route('frontend.card_category', $card_category->slug) }}">{{ $card_category->category_name }}</a>
                                    </h2>
                                    <div class="prd-hover">
                                        <div class="mt-2">

                                            <a href="{{ route('frontend.card_category', $card_category->slug) }}"
                                                class="btn js-prd-addtocart">
                                                {{ __('panel.f_view_category') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse

                </div>
            </div>
        </div>
    @endif

    {{-- random cards --}}
    <livewire:frontend.home.random-card-component :random_cards="$random_cards" />

    {{--  cards blog --}}
    @if (count($blog) > 0)
        <div class="holder holder-mt-medium blog">
            <div class="container">
                <div class="title-wrap text-center">
                    <a href="{{ route('frontend.blog') }}" class="h1-style">
                        <i class="fas fa-blog custom-header-color main-color"></i>
                        {{ __('panel.f_blog') }}
                    </a>
                    <div class="carousel-arrows"></div>
                </div>
                <div class="post-prws post-prws-carousel post-prws-carousel--single js-post-prws-carousel"
                    data-slick='{"slidesToShow": 2, "responsive": [{"breakpoint": 1200,"settings": {"slidesToShow": 2}},{"breakpoint": 768,"settings": {"slidesToShow": 1}},{"breakpoint": 480,"settings": {"slidesToShow": 1}}]}'>

                    @forelse ($blog as $post)
                        <div class="post-prw">
                            <div class="row vert-margin-middle d-flex -align-items-strech">

                                <div class="post-prw-img col-sm-6">
                                    <a href="{{ route('frontend.blog.post', $post->slug) }}"
                                        class="d-block image-container" style="padding-bottom: 88.92%;height: 100%">
                                        <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                            data-src="{{ asset('assets/news/' . $post->firstMedia?->file_name) }}"
                                            class="lazyload fade-up" alt="Blog Title" />
                                    </a>
                                </div>

                                <div class="post-prw-text col-sm-6">
                                    <h4 class="post-prw-title">
                                        <a href="{{ route('frontend.blog.post', $post->slug) }}"> {{ $post->title }}
                                        </a>
                                    </h4>
                                    <div class="post-prw-links">
                                        <div class="post-prw-date">
                                            <i class="icon-calendar1"></i><span>{{ $post->published_on }}</span>
                                        </div>
                                    </div>
                                    <div class="post-prw-teaser">
                                        {{-- {!! $post->description !!} --}}

                                        {!! Str::limit($post->description, 90, ' ...') !!}
                                    </div>
                                    <div class="post-prw-btn">
                                        <a href="{{ route('frontend.blog.post', $post->slug) }}" class="btn btn--md">
                                            {{ __('panel.f_read_more') }}
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @empty
                    @endforelse

                </div>
            </div>
        </div>
    @endif

    {{-- common question --}}
    @if (count($common_questions) > 0)
        <div class="holder holder-subscribe-full mt-0 common-question" id="questions"
            style="background-color: transparent">
            <div class="container">
                <div class="title-wrap text-center">
                    <h3 class="h2-style testimonials-carousel-simple-name">{{ __('panel.f_Inquiries') }}</h3>
                    <h2 class="h1-style"> {{ __('panel.f_common_questions') }} </h2>
                </div>
                <div class="row p-5">
                    <div class="col-md-12">
                        <div class="wrapper center-block">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                                @forelse ($common_questions as $question)
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="{{ $question->id }}">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse"
                                                    data-parent="#accordion" href="#collapse{{ $question->id }}"
                                                    aria-expanded="false" aria-controls="collapse{{ $question->id }}">
                                                    {{ $question->title }}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse{{ $question->id }}" class="panel-collapse collapse"
                                            role="tabpanel" aria-labelledby="{{ $question->id }}">
                                            <div class="panel-body">
                                                {!! $question->description !!}
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    {{-- get discount by create account --}}
    {{-- <div class="holder holder-subscribe-full mt-0" style="background-color: transparent">
        <div class="container">
            <div class="row">
                <div class="col-auto">
                    <div class="subscribe-form-title-md">
                        احصل على <span class="custom-color">20%</span> تخفيض
                    </div>
                    <div class="subscribe-form-title-sm">اشترك الآن!</div>
                </div>
                <div class="col">
                    <div class="subscribe-form">
                        <form action="#">
                            <div class="form-inline">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" placeholder="ادخل الايميل..." />
                                    <svg preserveAspectRatio="none">
                                        <rect x="2" y="2" rx="6" height="100%" width="100%"></rect>
                                    </svg>
                                    <span class="bottom"></span>
                                </div>
                                <button type="submit" class="btn btn--lg">اشترك</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- info --}}
    {{-- <div class="holder mt-0">
        <div class="container">
            <div class="text-icn-blocks-row text-icn-blocks-row--nodivider justify-content-center">
                <div class="text-icn-block-hor">
                    <div class="icn" style="color: #63555e">
                        <i class="icon-speech-bubble"></i>
                    </div>
                    <div class="text">
                        <h4>We HAVE A CHAT!</h4>
                        <p>
                            +8 800 555 35 35<br />
                            +8 800 555 35 35
                        </p>
                    </div>
                </div>
                <div class="text-icn-block-hor">
                    <div class="icn" style="color: #63555e">
                        <i class="icon-location"></i>
                    </div>
                    <div class="text">
                        <h4>OUR LOCATION</h4>
                        <p>
                            181 Arple Rd E, St Albans<br />
                            Swites 3021, USA
                        </p>
                    </div>
                </div>
                <div class="text-icn-block-hor">
                    <div class="icn" style="color: #63555e">
                        <i class="icon-watch"></i>
                    </div>
                    <div class="text">
                        <h4>TIME WORK</h4>
                        <p>
                            5 Days a week<br />
                            from 08 AM to 8 PM
                        </p>
                    </div>
                </div>
                <div class="text-icn-block-hor">
                    <div class="icn" style="color: #63555e">
                        <i class="icon-credit-card-1"></i>
                    </div>
                    <div class="text">
                        <h4>100%% SECURE</h4>
                        <p>Faster & More Secure Online Gaming Payments</p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}



@endsection
