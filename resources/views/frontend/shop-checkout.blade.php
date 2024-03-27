@extends('layouts.app')

@section('content')
    <!-- PAGE TITLE -->
    <header class="py-8 py-md-10" style="background-image: none;">
        <div class="container text-center py-xl-2">
            <h1 class="display-4 fw-semi-bold mb-0">Shop Checkout</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-scroll justify-content-center">
                    <li class="breadcrumb-item">
                        <a class="text-gray-800" href="#">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item text-gray-800 active" aria-current="page">
                        Shop Checkout
                    </li>
                </ol>
            </nav>
        </div>
        <!-- Img -->
        <img class="d-none img-fluid" src="...html" alt="...">
    </header>


    <!-- SHOP CHECKOUT -->
    <div class="container pb-6 pb-xl-10">
        <form name="checkout" method="post" class="checkout woocommerce-checkout"
            action="https://transvelo.github.io/skola-html/5.1/..." novalidate="">

            <div class="col2-set" id="customer_details">
                <div class="col-1">
                    <div class="woocommerce-billing-fields">
                        <h3>Billing details</h3>



                        {{-- <div id="accordionCurriculum">
                            <div class="border rounded shadow mb-6 overflow-hidden">
                                <div class="d-flex align-items-center" id="curriculumheadingOne">
                                    <h5 class="mb-0 w-100">
                                        <button
                                            class="d-flex align-items-center p-5 min-height-80 text-dark fw-medium collapse-accordion-toggle line-height-one collapsed"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#CurriculumcollapseOne"
                                            aria-expanded="false" aria-controls="CurriculumcollapseOne">
                                            <span class="me-4 text-dark d-flex">
                                                <!-- Icon -->
                                                <svg width="15" height="2" viewBox="0 0 15 2" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="15" height="2" fill="currentColor"></rect>
                                                </svg>

                                                <svg width="15" height="16" viewBox="0 0 15 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0 7H15V9H0V7Z" fill="currentColor"></path>
                                                    <path d="M6 16L6 8.74228e-08L8 0L8 16H6Z" fill="currentColor"></path>
                                                </svg>

                                            </span>

                                            Introduction
                                        </button>
                                    </h5>
                                </div>

                                <div id="CurriculumcollapseOne" class="collapse" aria-labelledby="curriculumheadingOne"
                                    data-parent="#accordionCurriculum" style="">
                                    <div class="border-top px-5 py-4 min-height-70 d-md-flex align-items-center">
                                        <div class="d-flex align-items-center me-auto mb-4 mb-md-0">

                                            <div class="ms-4">
                                                Introduction to the course
                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>

                            <div class="border rounded shadow mb-6 overflow-hidden">
                                <div class="d-flex align-items-center" id="curriculumheadingTwo">
                                    <h5 class="mb-0 w-100">
                                        <button
                                            class="d-flex align-items-center p-5 min-height-80 text-dark fw-medium collapse-accordion-toggle line-height-one"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#CurriculumcollapseTwo"
                                            aria-expanded="true" aria-controls="CurriculumcollapseTwo">
                                            <span class="me-4 text-dark d-flex">
                                                <!-- Icon -->
                                                <svg width="15" height="2" viewBox="0 0 15 2" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="15" height="2" fill="currentColor"></rect>
                                                </svg>

                                                <svg width="15" height="16" viewBox="0 0 15 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0 7H15V9H0V7Z" fill="currentColor"></path>
                                                    <path d="M6 16L6 8.74228e-08L8 0L8 16H6Z" fill="currentColor"></path>
                                                </svg>

                                            </span>

                                            Design Basics
                                        </button>
                                    </h5>
                                </div>

                                <div id="CurriculumcollapseTwo" class="collapse show" aria-labelledby="curriculumheadingTwo"
                                    data-parent="#accordionCurriculum">
                                    <div class="border-top px-5 py-4 min-height-70 d-md-flex align-items-center">
                                        <div class="d-flex align-items-center me-auto mb-4 mb-md-0">


                                            <div class="ms-4">
                                                Intro to Design Basics
                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>
                        </div> --}}


                        <div id="accordionCurriculum">
                            <div class="border rounded mb-1 overflow-hidden">
                                <div class="d-flex align-items-center" id="curriculumheadingOne">
                                    <h5 class="mb-0 w-100">
                                        <button
                                            class="d-flex align-items-center p-5 min-height-80 text-dark fw-medium collapse-accordion-toggle line-height-one"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#CurriculumcollapseOne"
                                            aria-expanded="false" aria-controls="CurriculumcollapseOne">
                                            <span class="me-4 text-dark d-flex">
                                                <!-- Icon -->
                                                <svg width="15" height="2" viewBox="0 0 15 2" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="15" height="2" fill="currentColor"></rect>
                                                </svg>
                                                <svg width="15" height="16" viewBox="0 0 15 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0 7H15V9H0V7Z" fill="currentColor"></path>
                                                    <path d="M6 16L6 8.74228e-08L8 0L8 16H6Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                            Paypal
                                        </button>
                                    </h5>
                                </div>
                                <div id="CurriculumcollapseOne" class="collapse" aria-labelledby="curriculumheadingOne"
                                    data-bs-parent="#accordionCurriculum">
                                    <div class="border-top px-5 py-4 min-height-70 d-md-flex align-items-center">
                                        <div class="d-flex align-items-center me-auto mb-4 mb-md-0">
                                            <div class="ms-4">
                                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a
                                                    PayPal
                                                    account.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border rounded shadow mb-6 overflow-hidden">
                                <div class="d-flex align-items-center" id="curriculumheadingTwo">
                                    <h5 class="mb-0 w-100">
                                        <button
                                            class="d-flex align-items-center p-5 min-height-80 text-dark fw-medium collapse-accordion-toggle line-height-one"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#CurriculumcollapseTwo"
                                            aria-expanded="false" aria-controls="CurriculumcollapseTwo">
                                            <span class="me-4 text-dark d-flex">
                                                <!-- Icon -->
                                                <svg width="15" height="2" viewBox="0 0 15 2" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="15" height="2" fill="currentColor"></rect>
                                                </svg>
                                                <svg width="15" height="16" viewBox="0 0 15 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0 7H15V9H0V7Z" fill="currentColor"></path>
                                                    <path d="M6 16L6 8.74228e-08L8 0L8 16H6Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                            Credit/Depit Card
                                        </button>
                                    </h5>
                                </div>
                                <div id="CurriculumcollapseTwo" class="collapse" aria-labelledby="curriculumheadingTwo"
                                    data-bs-parent="#accordionCurriculum">
                                    <div class="border-top px-5 py-4 min-height-70 d-md-flex align-items-center">
                                        <div class="d-flex align-items-center me-auto mb-4 mb-md-0">
                                            <div class="ms-4">
                                                <div class="woocommerce-billing-fields__field-wrapper">
                                                    <p class="form-row form-row-last validate-required validate-email"
                                                        id="billing_email_field" data-priority="110">
                                                        <label for="billing_name" class="">Name on Card <abbr
                                                                class="required" title="required">*</abbr></label>
                                                        <input type="text" class="input-text " name="billing_name"
                                                            id="billing_name" placeholder="Name on Card" value=""
                                                            autocomplete="name">
                                                    </p>
                                                    <p class="form-row form-row-last validate-required validate-email"
                                                        id="billing_email_field" data-priority="110">
                                                        <label for="billing_number" class="">Card Number <abbr
                                                                class="required" title="required">*</abbr></label>
                                                        <input type="text" class="input-text " name="billing_number"
                                                            id="billing_number" placeholder="1234 5678 9012 3456"
                                                            value="" autocomplete="number">
                                                    </p>

                                                    <p class="form-row form-row-first validate-required woocommerce-invalid woocommerce-invalid-required-field"
                                                        id="billing_first_name_field" data-priority="10">
                                                        <label for="billing_expiry_date" class="">Expiry date <abbr
                                                                class="required" title="required">*</abbr></label>
                                                        <input type="text" class="input-text "
                                                            name="billing_expiry_date" id="billing_expiry_date"
                                                            placeholder="MM/YY" value="" autocomplete="expiry_date"
                                                            autofocus="autofocus">
                                                    </p>
                                                    <p class="form-row form-row-last validate-required"
                                                        id="billing_last_name_field" data-priority="20">
                                                        <label for="billing_cvc" class="">CVC/CVV<abbr
                                                                class="required" title="required">*</abbr></label>
                                                        <input type="text" class="input-text " name="billing_cvc"
                                                            id="billing_cvc" placeholder="CVC" value=""
                                                            autocomplete="CVC">
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- checkout payment method using radio  --}}
                        <div class="using_radio d-none">
                            <div class="d-block w-100 ">
                                <input id="payment_method_paypal" type="radio" class="input-radio"
                                    name="payment_method" value="paypal" checked="checked"
                                    onclick="showPayPalMessage()">
                                <label for="payment_method_paypal">PayPal</label>
                            </div>

                            <div id="paypal_message" class="payment_box payment_method_paypal" style="display: block;">
                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal
                                    account.
                                </p>
                            </div>

                            <div class="d-block w-100 ">
                                <input id="payment_method_credit_card" type="radio" class="input-radio"
                                    name="payment_method" value="credit_card" onclick="showCreditCardForm()">
                                <label for="payment_method_credit_card">Credit Card</label>
                            </div>

                            <div id="credit_card_form" class="woocommerce-billing-fields__field-wrapper"
                                style="display: none;">
                                <p class="form-row form-row-last validate-required validate-email"
                                    id="billing_email_field" data-priority="110">
                                    <label for="billing_name" class="">Name on Card <abbr class="required"
                                            title="required">*</abbr></label>
                                    <input type="text" class="input-text " name="billing_name" id="billing_name"
                                        placeholder="Name on Card" value="" autocomplete="name">
                                </p>
                                <p class="form-row form-row-last validate-required validate-email"
                                    id="billing_email_field" data-priority="110">
                                    <label for="billing_number" class="">Card Number <abbr class="required"
                                            title="required">*</abbr></label>
                                    <input type="text" class="input-text " name="billing_number" id="billing_number"
                                        placeholder="1234 5678 9012 3456" value="" autocomplete="number">
                                </p>

                                <p class="form-row form-row-first validate-required woocommerce-invalid woocommerce-invalid-required-field"
                                    id="billing_first_name_field" data-priority="10">
                                    <label for="billing_expiry_date" class="">Expiry date <abbr class="required"
                                            title="required">*</abbr></label>
                                    <input type="text" class="input-text " name="billing_expiry_date"
                                        id="billing_expiry_date" placeholder="MM/YY" value=""
                                        autocomplete="expiry_date" autofocus="autofocus">
                                </p>
                                <p class="form-row form-row-last validate-required" id="billing_last_name_field"
                                    data-priority="20">
                                    <label for="billing_cvc" class="">CVC/CVV<abbr class="required"
                                            title="required">*</abbr></label>
                                    <input type="text" class="input-text " name="billing_cvc" id="billing_cvc"
                                        placeholder="CVC" value="" autocomplete="CVC">
                                </p>



                            </div>
                        </div>

                    </div>
                </div>


            </div>

            <div id="order_review" class="woocommerce-checkout-review-order">
                <div class="woocommerce-checkout-review-order-inner">
                    <h3 id="order_review_heading">Your order</h3>
                    <table class="shop_table woocommerce-checkout-review-order-table">
                        <thead>
                            <tr>
                                <th class="product-name">Product</th>
                                <th class="product-total">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="cart_item">
                                <td class="product-name">
                                    Hoodie
                                    <strong class="product-quantity">× 2</strong>
                                </td>
                                <td class="product-total">
                                    <span class="woocommerce-Price-amount amount">
                                        <span class="woocommerce-Price-currencySymbol">$</span>
                                        59.00
                                    </span>
                                </td>
                            </tr>
                            <tr class="cart_item">
                                <td class="product-name">
                                    Seo Books
                                    <strong class="product-quantity">× 1</strong>
                                </td>
                                <td class="product-total">
                                    <span class="woocommerce-Price-amount amount">
                                        <span class="woocommerce-Price-currencySymbol">$</span>
                                        67.00
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="cart-subtotal">
                                <th>Subtotal</th>
                                <td><span class="woocommerce-Price-amount amount"><span
                                            class="woocommerce-Price-currencySymbol">$</span>109.95</span></td>
                            </tr>

                            <tr class="order-total">
                                <th>Total</th>
                                <td><strong><span class="woocommerce-Price-amount amount"><span
                                                class="woocommerce-Price-currencySymbol">$</span>109.95</span></strong>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div id="payment" class="woocommerce-checkout-payment">
                    <ul class="wc_payment_methods payment_methods methods">
                        <li class="wc_payment_method payment_method_bacs">
                            <input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method"
                                value="bacs" data-order_button_text="">

                            <label for="payment_method_bacs">Direct bank transfer </label>
                            <div class="payment_box payment_method_bacs" style="display: block;">
                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment
                                    reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                            </div>
                        </li>

                        <li class="wc_payment_method payment_method_cheque">
                            <input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method"
                                value="cheque" data-order_button_text="">

                            <label for="payment_method_cheque">Check payments </label>
                            <div class="payment_box payment_method_cheque d-none" style="display: block;">
                                <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store
                                    Postcode.</p>
                            </div>
                        </li>

                        <li class="wc_payment_method payment_method_cod">
                            <input id="payment_method_cod" type="radio" class="input-radio" name="payment_method"
                                value="cod" checked="checked" data-order_button_text="">

                            <label for="payment_method_cod">Cash on delivery </label>
                            <div class="payment_box payment_method_cod d-none" style="display: block;">
                                <p>Pay with cash upon delivery.</p>
                            </div>
                        </li>

                        <li class="wc_payment_method payment_method_paypal">
                            <input id="payment_method_paypal" type="radio" class="input-radio" name="payment_method"
                                value="paypal" data-order_button_text="Proceed to PayPal">

                            <label for="payment_method_paypal">PayPal
                                <img src="../../../www.paypalobjects.com/webstatic/mktg/Logo/AM_mc_vs_ms_ae_UK.png"
                                    alt="PayPal acceptance mark">
                                <a href="https://www.paypal.com/gb/webapps/mpp/paypal-popup" class="about_paypal">What
                                    is
                                    PayPal?</a>
                            </label>

                            <div class="payment_box payment_method_paypal d-none" style="display: block;">
                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                            </div>
                        </li>
                    </ul>
                    <div class="form-row place-order">
                        <a href="shop-order-completed.html" class="btn btn-primary btn-block">
                            PLACE ORDER
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <!-- CALL ACTION -->
    <section class="py-6 py-md-11 border-top border-bottom" data-jarallax data-speed=".8"
        style="background-image: url(assets/img/illustrations/illustration-1.jpg)">
        <div class="container text-center py-xl-4" data-aos="fade-up">
            <div class="row">
                <div class="col-xl-7 mx-auto">
                    <h1 class="text-capitalize">Subscribe our newsletter</h1>
                    <p class="text-capitalize font-size-lg mb-md-6 mb-4">Your download should start automatically, if not
                        Click here. Should I give up, huh?.</p>
                    <div class="mx-md-8">
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Enter your email"
                                    aria-label="Enter your email" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary btn-sm-wide" type="button"
                                        id="button-addon2">Subscribe</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    {{-- using Accordions --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var radios = document.querySelectorAll('.accordion-radio');
            radios.forEach(function(radio) {
                radio.addEventListener('change', function() {
                    var target = this.getAttribute('id').replace('accordionRadio',
                        'Curriculumcollapse');
                    var collapse = document.getElementById(target);
                    var bsCollapse = new bootstrap.Collapse(collapse);
                    bsCollapse.toggle();
                });
            });
        });
    </script>
    {{-- using raido inputs --}}
    <script>
        function showPayPalMessage() {
            document.getElementById("paypal_message").style.display = "flex";
            document.getElementById("credit_card_form").style.display = "none";
        }

        function showCreditCardForm() {
            document.getElementById("credit_card_form").style.display = "flex";
            document.getElementById("paypal_message").style.display = "none";
        }
    </script>
@endsection
