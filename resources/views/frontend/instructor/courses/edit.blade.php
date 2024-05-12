@extends('layouts.app-instructor')
@section('style')
    <!-- twitter-bootstrap-wizard css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/libs/twitter-bootstrap-wizard/prettify.css') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('frontend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('frontend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('frontend/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />


    {{-- new links  --}}
    {{-- summernote for description field  --}}
    <link rel="stylesheet" href="{{ asset('backend/vendor/summernote/summernote-bs4.min.css') }}">

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
                min-width: 20%;
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
                                    <a href="#bank-detail" class="nav-link" data-toggle="tab">
                                        <span class="step-number">03</span>
                                        <span class="step-title">{{ __('transf.curriculum') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#confirm-detail" class="nav-link" data-toggle="tab">
                                        <span class="step-number">04</span>
                                        <span class="step-title">{{ __('transf.Pricing') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#confirm-detail2" class="nav-link" data-toggle="tab">
                                        <span class="step-number">05</span>
                                        <span class="step-title">{{ __('transf.Publish Data') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#confirm-detail3" class="nav-link" data-toggle="tab">
                                        <span class="step-number">06</span>
                                        <span class="step-title">Confirm Detail2</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content twitter-bs-wizard-tab-content">
                                <div class="tab-pane" id="seller-details">
                                    @livewire('frontend.instructors.course-landing-page', ['courseId' => $course->id])
                                </div>
                                <div class="tab-pane" id="company-document">
                                    <div>
                                        @livewire('frontend.instructors.intended-learners-component', ['courseId' => $course->id])
                                    </div>
                                </div>
                                <div class="tab-pane" id="bank-detail">
                                    <div>
                                        @livewire('frontend.instructors.lesson-component', ['courseId' => $course->id])
                                    </div>
                                </div>
                                <div class="tab-pane" id="confirm-detail">
                                    <div>
                                        @livewire('frontend.instructors.course-pricing-component', ['courseId' => $course->id])
                                    </div>
                                </div>
                                <div class="tab-pane" id="confirm-detail2">
                                    <div>
                                        <div>
                                            @livewire('frontend.instructors.course-publish-data-component', ['courseId' => $course->id])
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="confirm-detail3">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-6">
                                            <div class="text-center">
                                                <div class="mb-4">
                                                    <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                                                </div>
                                                <div>
                                                    <h5>Confirm Detail</h5>
                                                    <p class="text-muted">If several languages coalesce,
                                                        the grammar of the resulting</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

    {{-- pickadate calling js --}}
    <script src="{{ asset('backend/vendor/datepicker/picker.js') }}"></script>
    <script src="{{ asset('backend/vendor/datepicker/picker.date.js') }}"></script>
    <script src="{{ asset('backend/vendor/datepicker/picker.time.js') }}"></script>

    {{-- Call select2 plugin --}}
    <script src="{{ asset('backend/vendor/select2/js/select2.full.min.js') }}"></script>

    {{-- Calling fontawesome icon picker   --}}
    <script src="{{ asset('backend/vendor/fontawesomepicker/js/fontawesome-iconpicker.js') }}"></script>


    {{-- flat picker date --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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



            $('#published_on').pickadate({
                format: 'yyyy-mm-dd',
                min: new Date(),
                selectMonths: true, // Creates a dropdown to control month
                selectYears: true, // creates a dropdown to control years
                clear: 'Clear',
                close: 'OK',
                colseOnSelect: true // Close Upon Selecting a date
            });

            var publishedOn = $('#published_on').pickadate(
                'picker'); // set startdate in the picker to the start date in the #start_date elemet
            $('#published_on').change(function() {
                selected_ci_date = "";
                selected_ci_date = now() // make selected start date in picker = start_date value  

            });

            $('#published_on_time').pickatime({
                clear: ''
            });

            // deadline start 
            $('#deadline').pickadate({
                format: 'yyyy-mm-dd',
                min: new Date(),
                selectMonths: true, // Creates a dropdown to control month
                selectYears: true, // creates a dropdown to control years
                clear: 'Clear',
                close: 'OK',
                colseOnSelect: true // Close Upon Selecting a date
            });

            var deadline = $('#deadline').pickadate(
                'picker'); // set startdate in the picker to the start date in the #start_date elemet
            $('#deadline').change(function() {
                selected_ci_date = "";
                selected_ci_date = now() // make selected start date in picker = start_date value  

            });

            $('#offer_ends').pickadate({
                format: 'yyyy-mm-dd',
                min: new Date(),
                selectMonths: true, // Creates a dropdown to control month
                selectYears: true, // creates a dropdown to control years
                clear: 'Clear',
                close: 'OK',
                colseOnSelect: true // Close Upon Selecting a date
            });

            var publishedOn = $('#offer_ends').pickadate(
                'picker'); // set startdate in the picker to the start date in the #start_date elemet
            $('#offer_ends').change(function() {
                selected_ci_date = "";
                selected_ci_date = now() // make selected start date in picker = start_date value  

            });

            flatpickr('.flatpickr', {});



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


            //select2: code to search in data 
            function matchStart(params, data) {
                // If there are no search terms, return all of the data
                if ($.trim(params.term) === '') {
                    return data;
                }

                // Skip if there is no 'children' property
                if (typeof data.children === 'undefined') {
                    return null;
                }

                // `data.children` contains the actual options that we are matching against
                var filteredChildren = [];
                $.each(data.children, function(idx, child) {
                    if (child.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
                        filteredChildren.push(child);
                    }
                });

                // If we matched any of the timezone group's children, then set the matched children on the group
                // and return the group object
                if (filteredChildren.length) {
                    var modifiedData = $.extend({}, data, true);
                    modifiedData.children = filteredChildren;

                    // You can return modified objects from here
                    // This includes matching the `children` how you want in nested data sets
                    return modifiedData;
                }

                // Return `null` if the term should not be displayed
                return null;
            }

            // select2 : .select2 : is  identifier used with element to be effected
            $(".select2").select2({
                tags: true,
                colseOnSelect: false,
                minimumResultsForSearch: Infinity,
                matcher: matchStart
            });

        });
    </script>

    {{-- is related to select permision disable and enable by child class --}}
    <script language="javascript">
        var $cbox = $('.child').change(function() {
            if (this.checked) {
                $cbox.not(this).attr('disabled', 'disabled');
            } else {
                $cbox.removeAttr('disabled');
            }
        });

        var $cbox2 = $('.child2').change(function() {
            if (this.checked) {
                $cbox2.not(this).attr('disabled', 'disabled');
            } else {
                $cbox2.removeAttr('disabled');
            }
        });
    </script>
@endsection
