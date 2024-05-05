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

    <style>
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
        }

        .step-title {
            display: inline !important;
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
                                <h6><strong>{{ __('transf.plan_your_course') }}</strong></h6>
                                <li class="nav-item">
                                    <a href="#seller-details" class="nav-link" data-toggle="tab">
                                        <span class="step-number">01</span>
                                        <span class="step-title">{{ __('transf.intended_learners') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#company-document" class="nav-link" data-toggle="tab">
                                        <span class="step-number">02</span>
                                        <span class="step-title">Company Document</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#bank-detail" class="nav-link" data-toggle="tab">
                                        <span class="step-number">03</span>
                                        <span class="step-title">Bank Details</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#confirm-detail" class="nav-link" data-toggle="tab">
                                        <span class="step-number">04</span>
                                        <span class="step-title">Confirm Detail</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#confirm-detail2" class="nav-link" data-toggle="tab">
                                        <span class="step-number">05</span>
                                        <span class="step-title">Confirm Detail2</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content twitter-bs-wizard-tab-content">
                                <div class="tab-pane" id="seller-details">
                                    @livewire('frontend.instructors.intended-learners-component', ['courseId' => $course->id])

                                </div>
                                <div class="tab-pane" id="company-document">
                                    <div>
                                        <form>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basicpill-pancard-input">PAN
                                                            Card</label>
                                                        <input type="text" class="form-control"
                                                            id="basicpill-pancard-input">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basicpill-vatno-input">VAT/TIN
                                                            No.</label>
                                                        <input type="text" class="form-control"
                                                            id="basicpill-vatno-input">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basicpill-cstno-input">CST
                                                            No.</label>
                                                        <input type="text" class="form-control"
                                                            id="basicpill-cstno-input">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basicpill-servicetax-input">Service
                                                            Tax
                                                            No.</label>
                                                        <input type="text" class="form-control"
                                                            id="basicpill-servicetax-input">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basicpill-companyuin-input">Company
                                                            UIN</label>
                                                        <input type="text" class="form-control"
                                                            id="basicpill-companyuin-input">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                            for="basicpill-declaration-input">Declaration</label>
                                                        <input type="text" class="form-control"
                                                            id="basicpill-declaration-input">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane" id="bank-detail">
                                    <div>
                                        <form>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basicpill-namecard-input">Name
                                                            on
                                                            Card</label>
                                                        <input type="text" class="form-control"
                                                            id="basicpill-namecard-input">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label>Credit Card Type</label>
                                                        <select class="form-select">
                                                            <option selected>Select Card Type</option>
                                                            <option value="AE">American Express
                                                            </option>
                                                            <option value="VI">Visa</option>
                                                            <option value="MC">MasterCard</option>
                                                            <option value="DI">Discover</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basicpill-cardno-input">Credit
                                                            Card
                                                            Number</label>
                                                        <input type="text" class="form-control"
                                                            id="basicpill-cardno-input">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                            for="basicpill-card-verification-input">Card
                                                            Verification Number</label>
                                                        <input type="text" class="form-control"
                                                            id="basicpill-card-verification-input">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                            for="basicpill-expiration-input">Expiration
                                                            Date</label>
                                                        <input type="text" class="form-control"
                                                            id="basicpill-expiration-input">
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane" id="confirm-detail">
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
                                <div class="tab-pane" id="confirm-detail2">
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
                                    <li class="previous"><a href="javascript: void(0);">Previous</a></li>
                                    <li class="next"><a href="javascript: void(0);">Next</a></li>
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
@endsection
