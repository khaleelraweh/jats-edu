{{-- <section class="py-5 py-md-11 bg-catskill"> --}}
<section class="py-5 py-md-7 bg-catskill">
    <div class="container">
        <div class="text-center mb-4 mb-md-7" data-aos="fade-up">
            <h1 class="mb-1">{{ __('panel.our_partners') }}</h1>
            {{-- <p class="font-size-lg mb-0 text-capitalize">شركائنا</p> --}}
        </div>

        <div class="mx-n3 mx-md-n4"
            data-flickity='{"pageDots": false,"cellAlign": "left", "wrapAround": true, "imagesLoaded": true , "autoPlay": true}'>
            @foreach ($partners as $partner)
                <div class="col-12 col-md-2 px-1  ">
                    @php
                        if ($partner->partner_image != null) {
                            $partner_img = asset('assets/partners/' . $partner->partner_image);

                            if (!file_exists(public_path('assets/partners/' . $partner->partner_image))) {
                                $partner_img = asset('image/not_found/avator2.webp');
                            }
                        } else {
                            $partner_img = asset('image/not_found/avator2.webp');
                        }
                    @endphp
                    {{-- <div class="flick-item" style="width:190px !important;height: 190px !important;"> --}}
                        <div class="flick-item m-8 m-sm-1 ">
                        <a href="{{ $partner->partner_link }}">
                            <img class="partner-img" src="{{ $partner_img }}"
                                style="width:100%;height:100%;border-radius:50%;" class="img-fluid"
                                alt="{{ $partner->name }}">
                        </a>

                    </div>

                </div>
            @endforeach
        </div>
    </div>
</section>
