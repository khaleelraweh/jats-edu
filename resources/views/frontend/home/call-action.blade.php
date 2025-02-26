<div class="mx-n4 bg-is-selected"
    data-flickity='{"pageDots": true, "prevNextButtons": false, "cellAlign": "center", "wrapAround": true, "imagesLoaded": true , "autoPlay": true, "pauseAutoPlayOnHover": false, "adaptiveHeight": true}'>

    @foreach ($callActions as $index => $callAction)
        @php
            if ($callAction->photos->first() != null && $callAction->photos->first()->file_name != null) {
                $callAction_img = asset('assets/call_actions/' . $callAction->photos->first()->file_name);

                if (!file_exists(public_path('assets/call_actions/' . $callAction->photos->first()->file_name))) {
                    $callAction_img = asset('image/not_found/placeholder.jpg');
                }
            } else {
                $callAction_img = asset('image/not_found/placeholder.jpg');
            }
        @endphp

        <div class="col-md-12 py-6 py-md-12 jarallax" data-jarallax data-speed=".8"
            style="background-image: url({{ $callAction_img }})" data-aos="fade-up"
            data-aos-delay="{{ ($index + 1) * 50 }}">
            <div class="container text-center py-xl-9 text-capitalize" data-aos="fade-up">
                <h1 class="text-white text-uppercase">{{ $callAction->title }}</h1>
                <div class="font-size-lg mb-md-6 mb-4 text-white">{!! $callAction->description !!}</div>
                <div class="mx-auto">
                    <a href="{{ url($callAction->btn_link) }}"
                        class="btn btn-sienna btn-x-wide lift d-inline-block text-white">{{ $callAction->btn_name }}</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
