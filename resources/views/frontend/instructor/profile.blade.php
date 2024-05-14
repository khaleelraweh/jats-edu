@extends('layouts.app-instructor')
@section('content')
    <header class="py-6 py-md-8" style="background-image: none;">
        <div class="container text-center py-xl-2">
            <h1 class="display-4 fw-semi-bold mb-0">
                {{ __('transf.txt_profile') }}
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
                        {{ __('transf.txt_profile') }}
                    </li>
                </ol>
            </nav>
        </div>
        <!-- Img -->
        <img class="d-none img-fluid" src="...html" alt="...">
    </header>

    <section class="py-5">
        <div class="row m-0">

            <div class="col-lg-12 ">
                <div class="container">
                    {{-- <h2 class="h5 text-uppercase mb-4">General Information</h2> --}}
                    <form class="pref" action="{{ route('instructor.update_profile') }}" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @method('patch')

                        {{-- links of tabs --}}
                        <ul class="nav nav-tabs" id="myTab" role="tablist">


                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="instructor_profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#instructor_profile" type="button" role="tab"
                                    aria-controls="instructor_profile"
                                    aria-selected="true">{{ __('transf.instructor_profile_tab') }}
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="social-tab" data-bs-toggle="tab" data-bs-target="#social"
                                    type="button" role="tab" aria-controls="social"
                                    aria-selected="true">{{ __('transf.social_tab') }}
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="course_topics-tab" data-bs-toggle="tab"
                                    data-bs-target="#course_topics" type="button" role="tab"
                                    aria-controls="course_topics" aria-selected="true">{{ __('panel.course_topics_tab') }}
                                </button>
                            </li>




                        </ul>


                        <div class="tab-content" id="myTabContent">
                            {{-- Course info --}}
                            <div class="tab-pane fade show active" id="instructor_profile" role="tabpanel"
                                aria-labelledby="instructor_profile-tab">

                                <div class="row">
                                    <div class="col-lg-12 text-center mb-4 pt-3">
                                        @if (auth()->user()->user_image != '')
                                            <img src="{{ asset('assets/users/' . auth()->user()->user_image) }}"
                                                alt="{{ auth()->user()->full_name }}" class="img-thumbnail rounded-pill"
                                                width="120">

                                            <div class="mt-2">
                                                <a href="{{ route('customer.remove_profile_image') }}"
                                                    class="btn btn-sm btn-outline-danger bg-danger  btn-slide slide-white btn-wide shadow mb-4 mb-md-0 me-md-5 text-uppercase">{{ __('panel.f_delete_image') }}</a>
                                            </div>
                                        @else
                                            <img src="{{ asset('image/not_found/avator2.webp') }}"
                                                alt="{{ auth()->user()->full_name }}" class="img-thumbnail rounded-pill"
                                                width="120">
                                        @endif
                                    </div>

                                    <div class="col-lg-6 form-group pt-3">
                                        <label class="text-small text-uppercase" for="first_name">
                                            {{ __('panel.first_name') }}
                                        </label>
                                        <input class="form-control form-control-lg" name="first_name" type="text"
                                            value="{{ old('first_name', auth()->user()->first_name) }}">
                                        @error('first_name')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 form-group pt-3">
                                        <label class="text-small text-uppercase" for="last_name">
                                            {{ __('panel.last_name') }}
                                        </label>
                                        <input class="form-control form-control-lg" name="last_name" type="text"
                                            value="{{ old('last_name', auth()->user()->last_name) }}">
                                        @error('last_name')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 form-group pt-3">
                                        <label class="text-small text-uppercase"
                                            for="email">{{ __('panel.f_email') }}</label>
                                        <input class="form-control form-control-lg" name="email" type="text"
                                            value="{{ old('email', auth()->user()->email) }}">
                                        @error('email')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 form-group pt-3">
                                        <label class="text-small text-uppercase" for="mobile">
                                            {{ __('panel.f_phone_number') }}
                                        </label>
                                        <input class="form-control form-control-lg" name="mobile" type="text"
                                            value="{{ old('mobile', auth()->user()->mobile) }}">
                                        @error('mobile')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 form-group pt-3">
                                        <label class="text-small text-uppercase" for="password">
                                            {{ __('panel.f_password') }}
                                            <small class="ml-auto text-danger">(Optional)</small></label>
                                        <input class="form-control form-control-lg" name="password" type="text"
                                            value="{{ old('password') }}">
                                        @error('password')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 form-group pt-3">
                                        <label class="text-small text-uppercase" for="password_confirmation">
                                            {{ __('panel.f_confirm_password') }}
                                            <small class="ml-auto text-danger">({{ __('panel.optional') }})</small>
                                        </label>
                                        <input class="form-control form-control-lg" name="password_confirmation"
                                            type="text" value="{{ old('password_confirmation') }}">
                                        @error('password_confirmation')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-12 form-group pt-3">
                                        <label class="text-small text-uppercase"
                                            for="user_image">{{ __('panel.image') }}</label>
                                        <input class="form-control form-control-lg" name="user_image" type="file"
                                            value="{{ old('user_image') }}">
                                        @error('user_image')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-12 form-group pt-3">
                                        <label
                                            for="specializations">{{ __('panel.specializations_you_are_working_with') }}</label>
                                        <select name="specializations[]"
                                            class=" form-control form-control-lg select2 child" multiple="multiple">
                                            @forelse ($specializations as $specialization)
                                                <option value="{{ $specialization->id }}"
                                                    {{ in_array($specialization->id, old('specializations', $instructorSpecializations)) ? 'selected' : null }}>
                                                    {{ $specialization->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>

                                    </div>

                                </div>
                            </div>

                            <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">

                                <div class="row">

                                    {{-- facebook --}}
                                    <div class="col-lg-6 form-group pt-3">
                                        <label class="text-small text-uppercase" for="facebook">
                                            {{ __('panel.facebook') }}
                                        </label>

                                        {{-- for large device  --}}
                                        <div class="input-group d-none d-lg-flex">
                                            <div class="input-group-append">
                                                <label for="facebook"
                                                    class="d-block mb-0  border-radius-none btn btn-secondary text-white">
                                                    http://www.facebook.com/
                                                </label>
                                            </div>
                                            <input class="form-control form-control-lg" id="facebook" name="facebook"
                                                type="text" value="{{ old('facebook', auth()->user()->facebook) }}"
                                                placeholder="{{ __('transf.Username') }}">
                                        </div>

                                        {{-- for small device  --}}
                                        <div class="d-block d-lg-none">
                                            <div class="input-group-append">
                                                <label for="facebook-sm"
                                                    class="d-block mb-0 w-100  border-radius-none btn btn-secondary text-white">
                                                    http://www.facebook.com/
                                                </label>
                                            </div>
                                            <input class="form-control form-control-lg text-center" id="facebook-sm"
                                                name="facebook" type="text"
                                                value="{{ old('facebook', auth()->user()->facebook) }}"
                                                placeholder="{{ __('transf.Username') }}">
                                        </div>
                                        @error('facebook')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror

                                    </div>

                                    {{-- twitter  --}}
                                    <div class="col-lg-6 form-group pt-3">
                                        <label class="text-small text-uppercase" for="twitter">
                                            {{ __('panel.twitter') }}
                                        </label>

                                        {{-- for large device  --}}
                                        <div class="input-group d-none d-lg-flex">
                                            <div class="input-group-append">
                                                <label for="twitter"
                                                    class="d-block mb-0  border-radius-none btn btn-secondary text-white">
                                                    http://www.twitter.com/
                                                </label>
                                            </div>
                                            <input class="form-control form-control-lg" id="twitter" name="twitter"
                                                type="text" value="{{ old('twitter', auth()->user()->twitter) }}"
                                                placeholder="{{ __('transf.Username') }}">
                                        </div>

                                        {{-- for small device  --}}
                                        <div class="d-block d-lg-none">
                                            <div class="input-group-append">
                                                <label for="twitter-sm"
                                                    class="d-block mb-0 w-100  border-radius-none btn btn-secondary text-white">
                                                    http://www.twitter.com/
                                                </label>
                                            </div>
                                            <input class="form-control form-control-lg text-center" id="twitter-sm"
                                                name="twitter" type="text"
                                                value="{{ old('twitter', auth()->user()->twitter) }}"
                                                placeholder="{{ __('transf.Username') }}">
                                        </div>
                                        @error('twitter')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- instagram --}}
                                    <div class="col-lg-6 form-group pt-3">
                                        <label class="text-small text-uppercase" for="instagram">
                                            {{ __('panel.instagram') }}
                                        </label>

                                        {{-- for large device --}}
                                        <div class="input-group d-none d-lg-flex">
                                            <div class="input-group-append">
                                                <label for="instagram"
                                                    class="d-block mb-0  border-radius-none btn btn-secondary text-white">
                                                    http://www.instagram.com/
                                                </label>
                                            </div>
                                            <input class="form-control form-control-lg" id="instagram" name="instagram"
                                                type="text" value="{{ old('instagram', auth()->user()->instagram) }}"
                                                placeholder="{{ __('transf.Username') }}">
                                        </div>

                                        {{-- for small device --}}
                                        <div class="d-block d-lg-none">
                                            <div class="input-group-append">
                                                <label for="instagram-sm"
                                                    class="d-block mb-0 w-100 border-radius-none btn btn-secondary text-white">
                                                    http://www.instagram.com/
                                                </label>
                                            </div>
                                            <input class="form-control form-control-lg text-center" id="instagram-sm"
                                                name="instagram" type="text"
                                                value="{{ old('instagram', auth()->user()->instagram) }}"
                                                placeholder="{{ __('transf.Username') }}">
                                        </div>
                                        @error('instagram')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- linked In --}}
                                    <div class="col-lg-6 form-group pt-3">
                                        <label class="text-small text-uppercase" for="linkedin">
                                            {{ __('panel.linkedin') }}
                                        </label>

                                        {{-- for large device --}}
                                        <div class="input-group d-none d-lg-flex">
                                            <div class="input-group-append">
                                                <label for="linkedin"
                                                    class="d-block mb-0 border-radius-none btn btn-secondary text-white">
                                                    http://www.linkedin.com/
                                                </label>
                                            </div>
                                            <input class="form-control form-control-lg" id="linkedin" name="linkedin"
                                                type="text" value="{{ old('linkedin', auth()->user()->linkedin) }}"
                                                placeholder="{{ __('transf.Resource ID') }}">
                                        </div>

                                        {{-- for small device --}}
                                        <div class="d-block d-lg-none">
                                            <div class="input-group-append">
                                                <label for="linkedin-sm"
                                                    class="d-block mb-0 w-100 border-radius-none btn btn-secondary text-white">
                                                    http://www.linkedin.com/
                                                </label>
                                            </div>
                                            <input class="form-control form-control-lg text-center" id="linkedin-sm"
                                                name="linkedin" type="text"
                                                value="{{ old('linkedin', auth()->user()->linkedin) }}"
                                                placeholder="{{ __('transf.Resource ID') }}">
                                        </div>
                                        @error('linkedin')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- youtube --}}
                                    <div class="col-lg-6 form-group pt-3">
                                        <label class="text-small text-uppercase" for="youtube">
                                            {{ __('panel.youtube') }}
                                        </label>

                                        {{-- for large device --}}
                                        <div class="input-group d-none d-lg-flex">
                                            <div class="input-group-append">
                                                <label for="youtube"
                                                    class="d-block mb-0  border-radius-none btn btn-secondary text-white">
                                                    http://www.youtube.com/
                                                </label>
                                            </div>
                                            <input class="form-control form-control-lg" id="youtube" name="youtube"
                                                type="text" value="{{ old('youtube', auth()->user()->youtube) }}"
                                                placeholder="{{ __('transf.Username') }}">
                                        </div>
                                        {{-- for small device --}}
                                        <div class="d-block d-lg-none">
                                            <div class="input-group-append ">
                                                <label for="youtube-sm"
                                                    class="d-block mb-0  w-100 border-radius-none btn btn-secondary text-white">
                                                    http://www.youtube.com/
                                                </label>
                                            </div>
                                            <input class="form-control form-control-lg text-center" id="youtube-sm"
                                                name="youtube" type="text"
                                                value="{{ old('youtube', auth()->user()->youtube) }}"
                                                placeholder="{{ __('transf.Username') }}">
                                        </div>
                                        @error('youtube')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 form-group pt-3">
                                        <label class="text-small text-uppercase" for="website">
                                            {{ __('panel.website') }}
                                        </label>
                                        <input class="form-control form-control-lg" name="website" type="text"
                                            value="{{ old('website', auth()->user()->website) }}"
                                            placeholder="{{ __('transf.Url') }}">
                                        @error('website')
                                            <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-12 form-group pt-4">
                                {{-- <button class="btn text-white-all btn-coral btn-wide d-none d-lg-inline-block" --}}
                                <button class="btn text-white-all btn-coral btn-wide d-lg-inline-block" type="submit">
                                    {{ __('panel.update') }}
                                    {{ __('panel.f_profile') }} </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>


            {{-- SIDEBAR --}}
            {{-- <div class="col-lg-4">
                @include('partial.frontend.customer.sidebar')
            </div> --}}
        </div>
    </section>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get all input fields for large devices
            const largeInputs = document.querySelectorAll('.d-lg-flex input');

            // Add event listener for each input field
            largeInputs.forEach(function(input) {
                input.addEventListener('input', function() {
                    // Get the corresponding small device input field
                    const smallInput = document.querySelector(`#${input.id}-sm`);

                    // Copy the value from large device input to small device input
                    smallInput.value = input.value;
                });
            });

            // to make the opisite change 

            // Get all input fields for small devices
            const smallInputs = document.querySelectorAll('.d-lg-none  input');

            // Add event listener for each input field
            smallInputs.forEach(function(input) {
                input.addEventListener('input', function() {
                    // Get the corresponding large device input field
                    const largeInput = document.querySelector(`#${input.id.replace('-sm', '')}`);

                    // Copy the value from small device input to large device input
                    largeInput.value = input.value;
                });
            });

        });
    </script>

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
          
        });
    </script> --}}
@endsection
