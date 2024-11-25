<section class="py-5 py-md-11 bg-catskill">
    <div class="container">
        <div class="text-center mb-4 mb-md-7" data-aos="fade-up">
            <h1 class="mb-1">{{ __('transf.txt_top_rating_instructuros') }}</h1>
            {{-- <p class="font-size-lg mb-0 text-capitalize">{{ __('transf.txt_top_rating_instructuros_desc') }}</p> --}}
        </div>

        <div class="mx-n3 mx-md-n4"
            data-flickity='{"pageDots": false,"cellAlign": "left", "wrapAround": true, "imagesLoaded": true}'>
            @foreach ($instructors as $instructor)
                <div class="col-6 col-md-4 col-lg-3 text-center py-5 text-md-left px-3 px-md-4" data-aos="fade-up"
                    data-aos-delay="{{ 50 * $loop->iteration }}">
                    <div class="card border shadow p-2 lift">
                        <!-- Image -->
                        <div class="card-zoom position-relative" style="max-width: 250px;">
                            <div class="card-float card-hover right-0 left-0 bottom-0 mb-4">
                                <ul class="nav mx-n4 justify-content-center">
                                    @if ($instructor->facebook)
                                        <li class="nav-item px-4">
                                            <a href="{{ $instructor->facebook }}" class="d-block text-white">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($instructor->twitter)
                                        <li class="nav-item px-4">
                                            <a href="{{ $instructor->twitter }}" class="d-block text-white">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($instructor->instagram)
                                        <li class="nav-item px-4">
                                            <a href="{{ $instructor->instagram }}" class="d-block text-white">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($instructor->linkedin)
                                        <li class="nav-item px-4">
                                            <a href="{{ $instructor->linkedin }}" class="d-block text-white">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>

                            <a href="{{ route('frontend.instructors_single', $instructor->id) }}"
                                class="card-img sk-thumbnail img-ratio-4 card-hover-overlay coral d-block">
                                @php
                                    if ($instructor->user_image != null) {
                                        $instructor_img = asset('assets/users/' . $instructor->user_image);

                                        if (!file_exists(public_path('assets/users/' . $instructor->user_image))) {
                                            $instructor_img = asset('image/not_found/avator2.webp');
                                        }
                                    } else {
                                        $instructor_img = asset('image/not_found/avator2.webp');
                                    }
                                @endphp
                                <img class="rounded shadow-light-lg img-fluid" src="{{ $instructor_img }}"
                                    alt="{{ $instructor->full_name }}">
                            </a>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer px-3 pt-4 pb-1">
                            <a href="{{ route('frontend.instructors_single', $instructor->id) }}" class="d-block">
                                <h5 class="mb-0">{{ $instructor->full_name }}</h5>
                            </a>
                            <span class="font-size-d-sm">
                                @if (count($instructor->specializations) > 0)
                                    @foreach ($instructor->specializations->take(2) as $specialization)
                                        {{ $specialization->name }}

                                        @if (!$loop->last)
                                            &
                                        @endif
                                    @endforeach
                                @else
                                    specification did not set yet
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
</section>
