@extends('layouts.app')

@section('style')
    {{-- This is for master page  --}}
    <!--  Custom Scroll bar-->
    <link href="{{ URL::asset('frontend/assets/plugins/mscrollbar/jquery.mCustomScrollbar.css') }}" rel="stylesheet" />
    <!--  Sidebar css -->
    <link href="{{ URL::asset('frontend/assets/plugins/sidebar/sidebar.css') }}" rel="stylesheet">
    <!-- Sidemenu css -->
    <link rel="stylesheet" href="{{ URL::asset('frontend/assets/css-rtl/sidemenu.css') }}">
    @yield('css')
    <!--- Style css -->
    <link href="{{ URL::asset('frontend/assets/css-rtl/style.css') }}" rel="stylesheet">
    <!--- Dark-mode css -->
    <link href="{{ URL::asset('frontend/assets/css-rtl/style-dark.css') }}" rel="stylesheet">
    <!---Skinmodes css-->
    <link href="{{ URL::asset('frontend/assets/css-rtl/skin-modes.css') }}" rel="stylesheet">

    {{-- This is for this page  --}}
    <link href="{{ URL::asset('frontend/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">



    {{-- start for image upload --}}
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('frontend/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('frontend/assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet"
        type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('frontend/assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('frontend/assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('frontend/assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">

    {{-- end for image upload --}}


    <style>
        .dropify-wrapper {
            position: relative !important;
        }

        .dropify-wrapper .dropify-message {
            position: absolute !important;
            left: 88px !important;
            top: 40px !important;
            -webkit-transform: translateY(0) !important;
            transform: translateY(0) !important;
        }

        .dropify-wrapper .dropify-loader {
            position: absolute !important;
        }

        .dropify-wrapper {
            position: relative !important;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-2">
        <!-- row -->



        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                            {{ __('panel.application_form_to_apply_as_a_trainer') }}
                        </div>
                        <p class="mg-b-20">
                            {{ __('panel.application_form') }}
                        </p>
                        <form id="requestForm" action="{{ route('teach_requests.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div id="wizard1">
                                <h3>{{ __('panel.personal_data') }}</h3>
                                <section>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-8">
                                            <div class="row ">
                                                <div class="col-sm-12 col-md-12 pt-3">
                                                    <div class="control-group form-group">
                                                        <label class="form-label">
                                                            {{ __('panel.full_name') }} {{ __('panel.in') }}
                                                            {{ __('panel.ar') }}
                                                            <span class="required text-danger">*</span>
                                                        </label>
                                                        <input type="text" name="full_name[ar]"
                                                            class="form-control required"
                                                            value="{{ old('full_name.ar') }}">
                                                        @error('full_name.ar')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 pt-2">
                                                    <div class="control-group form-group ">
                                                        <label class="form-label">
                                                            {{ __('panel.full_name') }} {{ __('panel.in') }}
                                                            {{ __('panel.en') }}
                                                            <span class="required text-danger">*</span>
                                                        </label>
                                                        <input type="text" name="full_name[en]"
                                                            class="form-control required"
                                                            value="{{ old('full_name.en') }}">
                                                        @error('full_name.en')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-sm-12 col-md-6 pt-2">
                                                    <div class="control-group form-group">
                                                        <label class="form-label">
                                                            تاريخ الميلاد
                                                            <span class="required text-danger">*</span>

                                                        </label>
                                                        <div class="form-group">
                                                            <input type="text" name="date_of_birth"
                                                                class="form-control required flatpickr_date_of_birth"
                                                                value="{{ old('date_of_birth') }}">
                                                            @error('date_of_birth')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 pt-3">
                                                    <div class="control-group form-group">
                                                        <label for="place_of_birth">
                                                            <i class="fa fa-globe custom-color"></i>
                                                            {{ __('panel.place_of_birth') }}
                                                            <span class="required text-danger">*</span>
                                                        </label>
                                                        <select id="place_of_birth" name="place_of_birth"
                                                            class="form-control">
                                                            <option value="">---</option>
                                                            @foreach (getCountries() as $country)
                                                                <option value="{{ $country->name }}"
                                                                    {{ old('place_of_birth') == $country->name ? 'selected' : '' }}>
                                                                    {{ app()->getLocale() == 'ar' ? $country->translations['ar'] : $country->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('place_of_birth')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12 col-md-6 pt-2">
                                                    <div class="control-group form-group">
                                                        <label for="nationality">
                                                            <i class="fa fa-globe custom-color"></i>
                                                            {{ __('panel.nationality') }}
                                                            <span class="required text-danger">*</span>
                                                        </label>
                                                        <select id="nationality" name="nationality" class="form-control">
                                                            <option value="">---</option>
                                                            @foreach (getCountries() as $country)
                                                                <option value="{{ $country->name }}"
                                                                    {{ old('nationality') == $country->name ? 'selected' : '' }}>
                                                                    {{ app()->getLocale() == 'ar' ? $country->translations['ar'] : $country->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('nationality')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-6 pt-2">
                                                    <div class="control-group form-group">
                                                        <label for="residence_address">
                                                            <i class="fa fa-globe custom-color"></i>
                                                            {{ __('panel.address_of_residence') }}
                                                            <span class="required text-danger">*</span>
                                                        </label>
                                                        <select id="residence_address" name="residence_address"
                                                            class="form-control">
                                                            <option value="">---</option>
                                                            @foreach (getCountries() as $country)
                                                                <option value="{{ $country->name }}"
                                                                    {{ old('residence_address') == $country->name ? 'selected' : '' }}>
                                                                    {{ app()->getLocale() == 'ar' ? $country->translations['ar'] : $country->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('residence_address')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-sm-12 col-md-12">
                                                    <div class="control-group form-group">
                                                        <label for="phone">
                                                            <i class="fa fa-mobile custom-color"></i>
                                                            {{ __('panel.f_phone_number') }}
                                                            <span class="required text-danger">*</span>
                                                        </label>
                                                        <input type="text" name="phone" class="form-control"
                                                            value="{{ old('phone') }}">
                                                        @error('phone')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12 col-md-4">
                                                    <div class="control-group form-group ">
                                                        <label
                                                            class="form-label">{{ __('panel.academic_qualification') }}</label>

                                                        <select name="educational_qualification" class="form-control">
                                                            <option value="">---</option>
                                                            <option value="1"
                                                                {{ old('educational_qualification') == '1' ? 'selected' : null }}>
                                                                {{ __('transf.Diploma') }}
                                                            </option>
                                                            <option value="2"
                                                                {{ old('educational_qualification') == '2' ? 'selected' : null }}>
                                                                {{ __('transf.Higher Diploma') }}
                                                            </option>
                                                            <option value="3"
                                                                {{ old('educational_qualification') == '3' ? 'selected' : null }}>
                                                                {{ __('transf.Bachelor') }}
                                                            </option>
                                                            <option value="4"
                                                                {{ old('educational_qualification') == '4' ? 'selected' : null }}>
                                                                {{ __('transf.Master') }}
                                                            </option>
                                                            <option value="5"
                                                                {{ old('educational_qualification') == '5' ? 'selected' : null }}>
                                                                {{ __('transf.Ph_D') }}
                                                            </option>
                                                            <option value="6"
                                                                {{ old('educational_qualification') == '6' ? 'selected' : null }}>
                                                                {{ __('transf.Professor') }}
                                                            </option>
                                                        </select>
                                                        @error('educational_qualification')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4">
                                                    <div class="control-group form-group ">
                                                        <label class="form-label">{{ __('panel.specialization') }}</label>
                                                        <select name="specialization_id" class="form-control">
                                                            <option value="">---</option>
                                                            @foreach ($specializations as $specialization)
                                                                <option value="{{ $specialization->id }}"
                                                                    {{ old('specialization_id') == $specialization->id ? 'selected' : '' }}>
                                                                    {{ $specialization->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('specialization_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4">
                                                    <div class="control-group form-group mb-0">
                                                        <label
                                                            class="form-label">{{ __('panel.years_of_experience') }}</label>
                                                        <input type="number" min="0"
                                                            name="years_of_training_experience"
                                                            class="form-control required"
                                                            value="{{ old('years_of_training_experience') }}">
                                                        @error('years_of_training_experience')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- this is for image  --}}
                                        <div class="col-sm-12 col-md-4">
                                            <label class="form-label">
                                                {{ __('panel.attach_a_personal_photo') }}
                                                <span class="required text-danger">*</span>
                                            </label>
                                            <input type="file" name="user_image" class="dropify" data-height="200" />
                                        </div>
                                    </div>
                                </section>
                                <h3>{{ __('panel.attachments') }}</h3>


                                <section>
                                    <div class="control-group form-group">
                                        <label
                                            class="form-label">{{ __('panel.attach_a_copy_of_your_national_ID_or_passport') }}</label>
                                        <input type="file" name="identity" class="form-control required"
                                            accept=".jpg,.jpeg,.png,.pdf">
                                        @error('identity')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        (<small>{{ __('panel.The image must have one of the following extensions .jpg - .jpeg - .png, .pdf') }}</small>)
                                    </div>

                                    <div class="control-group form-group">
                                        <label class="form-label">{{ __('panel.the_biography') }}</label>
                                        <input type="file" name="biography" class="form-control required"
                                            accept=".jpg,.jpeg,.png,.pdf">
                                        @error('biography')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        (<small>{{ __('panel.The image must have one of the following extensions .jpg - .jpeg - .png, .pdf') }}</small>)
                                    </div>

                                    <div class="control-group form-group mb-0">
                                        <label class="form-label"> {{ __('panel.certificates') }} </label>
                                        <input type="file" name="Certificates" class="form-control required"
                                            accept=".jpg,.jpeg,.png,.pdf">
                                        @error('Certificates')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        (<small>
                                            {{ __('panel.certificate_message') }}
                                        </small>)
                                    </div>
                                </section>

                                <h3>{{ __('panel.motivation') }}</h3>
                                <section>
                                    <div class="form-group">
                                        <label class="form-label">
                                            {{ __('panel.why_do_you_want_to_join_our_training?') }}
                                        </label>
                                        <textarea class="form-control" name="motivation" id="" cols="30" rows="10">{{ old('motivation') }}</textarea>
                                        @error('motivation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <button type="submit" style="display: none;" id="hiddenSubmitButton"></button>

                                </section>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
@endsection

@section('script')
    {{-- start for image upload --}}

    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('frontend/assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('frontend/assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('frontend/assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('frontend/assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('frontend/assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('frontend/assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('frontend/assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('frontend/assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('frontend/assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('frontend/assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('frontend/assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('frontend/assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!-- Internal TelephoneInput js-->
    <script src="{{ URL::asset('frontend/assets/plugins/telephoneinput/telephoneinput.js') }}"></script>
    <script src="{{ URL::asset('frontend/assets/plugins/telephoneinput/inttelephoneinput.js') }}"></script>


    {{-- end for image upload --}}

    <!--Internal  Select2 js -->
    <script src="{{ URL::asset('frontend/assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.steps js -->
    <script src="{{ URL::asset('frontend/assets/plugins/jquery-steps/jquery.steps.min.js') }}"></script>
    <script src="{{ URL::asset('frontend/assets/plugins/parsleyjs/parsley.min.js') }}"></script>
    <!--Internal  Form-wizard js -->
    <script src="{{ URL::asset('frontend/assets/js/form-wizard.js') }}"></script>


    <script>
        $(function() {


            const locale = "{{ app()->getLocale() }}";

            if ($('.flatpickr_date_of_birth').length) {
                const defaultDate = "{{ old('date_of_birth') }}" ?
                    "{{ old('date_of_birth') }}" :
                    new Date(); // Set to now if no old date exists


                // for offer ends
                flatpickr('.flatpickr_date_of_birth', {
                    enableTime: false,
                    dateFormat: "Y-m-d",
                    minDate: "today", // Prevent dates before today
                    locale: typeof flatPickrLanguage !== 'undefined' ? flatPickrLanguage : 'en',
                    defaultDate: defaultDate,

                });

            }
            // Initialize Dropify
            function initializeDropify() {
                // $('.dropify').dropify();
                $('.dropify').dropify({
                    messages: {
                        'default': 'Image ',
                        'replace': '',
                        'remove': 'Remove',
                        'error': 'Ooops, something wrong happended.'
                    }
                });

            }

            // Initialize Dropify on document ready
            initializeDropify();



            // Replace the "Finish" link with a button after the wizard is initialized
            $('a[href="#finish"]').each(function() {


                $(this).on('click', function() {
                    $('#hiddenSubmitButton').click();

                });

            });



        });
    </script>
@endsection
