@extends('layouts.app-instructor')
@section('style')
    <!-- twitter-bootstrap-wizard css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/libs/twitter-bootstrap-wizard/prettify.css') }}">



    {{-- pickadate calling css --}}
    <link rel="stylesheet" href="{{ asset('backend/vendor/datepicker/themes/classic.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendor/datepicker/themes/classic.date.css') }}">

    {{-- Select2 labs  --}}
    <link rel="stylesheet" href="{{ asset('backend/vendor/select2/css/select2.min.css') }}">


    {{-- Responsive fileInput --}}
    <link rel="stylesheet" href="{{ asset('backend/vendor/bootstrap-fileinput/css/fileinput.min.css') }}">

    <link href="<?php echo asset('backend/css/bootstrap.min.css'); ?>" id="bootstrap-style" rel="stylesheet" type="text/css">

    <!-- Icons Css -->
    <link href="{{ asset('backend/css/icons.min.css') }}" rel="stylesheet" type="text/css">

    <link href="<?php echo asset('backend/css/app.min.css'); ?>" id="app-style" rel="stylesheet" type="text/css">

    <!-- Fontawesome icon -->
    <link href="{{ asset('backend/vendor/fontawesome/fontawesome.css') }}" rel="stylesheet" />

    <!-- fontawesome icon  picker  -->
    <link href="{{ asset('backend/vendor/fontawesomepicker/css/fontawesome-iconpicker.css') }}" rel="stylesheet">
    {{-- my custom css --}}
    <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">


    {{-- flat picker --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">



    <style>
        input,
        select {
            height: 45px !important;
        }

        /* Styles for small devices (up to 768px) */
        @media screen and (max-width: 768px) {
            .nav-item {
                width: 20px !important;
            }
        }


        /* Styles for medium devices (between 768px and 992px) */
        @media screen and (min-width: 768px) and (max-width: 992px) {}

        /* Styles for large devices (above 992px) */
        @media screen and (min-width: 992px) {
            #basic-pills-wizard {
                display: flex;
            }

            .twitter-bs-wizard-nav {
                display: flex;
                flex-direction: column;
                /* min-width: 20%; */
            }

            .tab-content.twitter-bs-wizard-tab-content {
                flex: 1;
                padding: 10px;
            }

            .twitter-bs-wizard .twitter-bs-wizard-nav::before {
                width: 0 !important;
            }

            .nav-item {
                text-align: start !important;
                flex-grow: 0 !important;
            }

            .step-title {
                display: inline !important;
            }

            .note-editor.note-frame.card {
                margin-bottom: 0 !important;
            }


        }
    </style>
@endsection

@section('content')
    <div class="container mt-3">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">{{ __('transf.course_generators') }}</h4>

                        <div id="basic-pills-wizard" class="twitter-bs-wizard">
                            <ul class="twitter-bs-wizard-nav">
                                {{-- <h6><strong>{{ __('transf.plan_your_course') }}</strong></h6> --}}
                                <li class="nav-item">
                                    <a href="#seller-details" class="nav-link" data-toggle="tab">
                                        <span class="step-number">01</span>
                                        <span class="step-title">{{ __('transf.Course Landing Page') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#company-document" class="nav-link" data-toggle="tab">
                                        <span class="step-number">02</span>
                                        <span class="step-title">{{ __('transf.intended_learners') }}</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#curriculum" class="nav-link" data-toggle="tab">
                                        <span class="step-number">03</span>
                                        <span class="step-title">{{ __('transf.curriculum') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    {{-- this is for evaluation --}}
                                    <a href="#evaluation" class="nav-link" data-toggle="tab">
                                        <span class="step-number">04</span>
                                        <span class="step-title">{{ __('transf.evaluation') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#Pricing" class="nav-link" data-toggle="tab">
                                        <span class="step-number">05</span>
                                        <span class="step-title">{{ __('transf.Pricing') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#publishData" class="nav-link" data-toggle="tab">
                                        <span class="step-number">06</span>
                                        <span class="step-title">{{ __('transf.Publish Data') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#Confirmation" class="nav-link" data-toggle="tab">
                                        <span class="step-number">07</span>
                                        <span class="step-title">{{ __('transf.Details Confirmation') }}</span>
                                    </a>
                                </li>

                            </ul>

                            <div class="tab-content twitter-bs-wizard-tab-content">
                                <div class="tab-pane" id="seller-details">
                                    @livewire('frontend.instructors.course-landing-page', ['courseId' => $course->id])
                                </div>
                                <div class="tab-pane" id="company-document">
                                    @livewire('frontend.instructors.intended-learners-component', ['courseId' => $course->id])
                                </div>
                                <div class="tab-pane" id="curriculum">
                                    @livewire('frontend.instructors.lesson-component', ['courseId' => $course->id])
                                </div>
                                {{-- for evaluation --}}
                                <div class="tab-pane" id="evaluation">
                                    @livewire('frontend.instructors.evaluation-component', ['courseId' => $course->id])
                                </div>
                                <div class="tab-pane" id="Pricing">
                                    @livewire('frontend.instructors.course-pricing-component', ['courseId' => $course->id])
                                </div>
                                <div class="tab-pane" id="publishData">
                                    @livewire('frontend.instructors.course-publish-data-component', ['courseId' => $course->id])
                                </div>
                                <div class="tab-pane" id="Confirmation">
                                    @livewire('frontend.instructors.course-details-confirmation-component', ['courseId' => $course->id])
                                </div>


                                <ul class="pager wizard twitter-bs-wizard-pager-link d-flex justify-content-between">
                                    <li class="previous"><a href="javascript: void(0);">{{ __('transf.previous') }}</a>
                                    </li>
                                    <li class="next"><a href="javascript: void(0);">{{ __('transf.next') }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
@endsection

@section('script')
    <!-- twitter-bootstrap-wizard js -->
    <script src="{{ asset('frontend/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/libs/twitter-bootstrap-wizard/prettify.js') }}"></script>
    <!-- form wizard init -->
    <script src="{{ asset('frontend/assets/js/form-wizard.init.js') }}"></script>



    {{-- new links  --}}

    <!-- Responsive fileInput js start -->
    <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/plugins/piexif.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap-fileinput/themes/fa5/theme.min.js') }}"></script>
    <!-- Responsive fileInput js end -->

    {{-- outer lab  --}}
    {{-- summernote for description note field --}}
    <script src="{{ asset('backend/vendor/summernote/summernote-bs4.min.js') }}"></script>


    {{-- Calling fontawesome icon picker   --}}
    <script src="{{ asset('backend/vendor/fontawesomepicker/js/fontawesome-iconpicker.js') }}"></script>




    <!-- Include the Flatpickr JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/{{ app()->getLocale() }}.js"></script>



    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

        $(function() {
            $('.icon-picker').iconpicker();
        });
    </script>




    <script>
        $(function() {

            // for offer ends
            flatpickr('.flatpickr', {

            });

            // for offer ends
            flatpickr('.flatpickr_publihsed_on', {
                enableTime: true,
                dateFormat: "Y-m-d H:i K",
                minDate: "today"

            });

            flatpickr('.flatpickr_deadLine', {
                enableTime: true,
                dateFormat: "Y-m-d h:i K", // Use 'h' for 12-hour format
                minDate: "today",
                time_24hr: false, // Set to false for 12-hour format
                locale: "{{ app()->getLocale() }}"

            });



            $('.summernote').summernote({
                tabSize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });


        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const courseTypeSelect = document.getElementById('course_type');
            const deadlineField = document.getElementById('deadline-field');

            // Function to toggle deadline field visibility
            function toggleDeadlineFieldVisibility() {
                if (courseTypeSelect.value === '1') {
                    deadlineField.style.display = 'block';
                } else {
                    deadlineField.style.display = 'none';
                }
            }

            // Initial call to toggle visibility based on initial select value
            toggleDeadlineFieldVisibility();

            // Add event listener to toggle visibility when course type changes
            courseTypeSelect.addEventListener('change', toggleDeadlineFieldVisibility);
        });
    </script>
@endsection
