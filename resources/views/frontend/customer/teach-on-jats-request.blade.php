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
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        Basic Content Wizard
                    </div>
                    <p class="mg-b-20">It is Very Easy to Customize and it uses in your website apllication.</p>
                    <div id="wizard1">
                        <h3>Personal Information</h3>
                        <section>
                            <div class="control-group form-group">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control required" placeholder="Name">
                            </div>
                            <div class="control-group form-group">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control required" placeholder="Email Address">
                            </div>
                            <div class="control-group form-group">
                                <label class="form-label">Phone Number</label>
                                <input type="number" class="form-control required" placeholder="Number">
                            </div>
                            <div class="control-group form-group mb-0">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control required" placeholder="Address">
                            </div>
                        </section>
                        <h3>Billing Information</h3>
                        <section>
                            <div class="table-responsive mg-t-20">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Cart Subtotal</td>
                                            <td class="text-right">$792.00</td>
                                        </tr>
                                        <tr>
                                            <td><span>Totals</span></td>
                                            <td class="text-right text-muted"><span>$792.00</span></td>
                                        </tr>
                                        <tr>
                                            <td><span>Order Total</span></td>
                                            <td>
                                                <h2 class="price text-right mb-0">$792.00</h2>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </section>
                        <h3>Payment Details</h3>
                        <section>
                            <div class="form-group">
                                <label class="form-label">CardHolder Name</label>
                                <input type="text" class="form-control" id="name1" placeholder="First Name">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Card number</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-append">
                                        <button class="btn btn-info" type="button"><i class="fab fa-cc-visa"></i> &nbsp;
                                            <i class="fab fa-cc-amex"></i> &nbsp;
                                            <i class="fab fa-cc-mastercard"></i></button>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group mb-sm-0">
                                        <label class="form-label">Expiration</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" placeholder="MM" name="expiremonth">
                                            <input type="number" class="form-control" placeholder="YY" name="expireyear">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 ">
                                    <div class="form-group mb-0">
                                        <label class="form-label">CVV <i class="fa fa-question-circle"></i></label>
                                        <input type="number" class="form-control" required="">
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /row -->
@endsection

@section('script')
    <!--Internal  Select2 js -->
    <script src="{{ URL::asset('frontend/assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.steps js -->
    <script src="{{ URL::asset('frontend/assets/plugins/jquery-steps/jquery.steps.min.js') }}"></script>
    <script src="{{ URL::asset('frontend/assets/plugins/parsleyjs/parsley.min.js') }}"></script>
    <!--Internal  Form-wizard js -->
    <script src="{{ URL::asset('frontend/assets/js/form-wizard.js') }}"></script>
@endsection
