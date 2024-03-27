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
                        <div class="woocommerce-billing-fields__field-wrapper">
                            <p class="form-row form-row-first validate-required woocommerce-invalid woocommerce-invalid-required-field"
                                id="billing_first_name_field" data-priority="10">
                                <label for="billing_first_name" class="">First name <abbr class="required"
                                        title="required">*</abbr></label>
                                <input type="text" class="input-text " name="billing_first_name" id="billing_first_name"
                                    placeholder="" value="" autocomplete="given-name" autofocus="autofocus">
                            </p>
                            <p class="form-row form-row-last validate-required" id="billing_last_name_field"
                                data-priority="20">
                                <label for="billing_last_name" class="">Last name <abbr class="required"
                                        title="required">*</abbr></label>
                                <input type="text" class="input-text " name="billing_last_name" id="billing_last_name"
                                    placeholder="" value="" autocomplete="family-name">
                            </p>
                            <p class="form-row form-row-wide" id="billing_company_field" data-priority="30">
                                <label for="billing_company" class="">Company name</label>
                                <input type="text" class="input-text " name="billing_company" id="billing_company"
                                    placeholder="" value="" autocomplete="organization">
                            </p>


                            <p class="form-row form-row-wide address-field validate-required" id="billing_address_1_field"
                                data-priority="50">
                                <label for="billing_address_1" class="">Street address <abbr class="required"
                                        title="required">*</abbr></label>
                                <input type="text" class="input-text " name="billing_address_1" id="billing_address_1"
                                    placeholder="House number and street name" value="" autocomplete="address-line1">
                            </p>
                            <p class="form-row form-row-wide address-field" id="billing_address_2_field" data-priority="60">
                                <input type="text" class="input-text " name="billing_address_2" id="billing_address_2"
                                    placeholder="Apartment, suite, unit etc. (optional)" value=""
                                    autocomplete="address-line2">
                            </p>
                            <p class="form-row form-row-wide address-field validate-required" id="billing_city_field"
                                data-priority="70" data-o_class="form-row form-row-wide address-field validate-required">
                                <label for="billing_city" class="">Town / City <abbr class="required"
                                        title="required">*</abbr></label>
                                <input type="text" class="input-text " name="billing_city" id="billing_city"
                                    placeholder="" value="" autocomplete="address-level2">
                            </p>
                            <p class="form-row form-row-wide address-field validate-state" id="billing_state_field"
                                data-priority="80" data-o_class="form-row form-row-wide address-field validate-state">
                                <label for="billing_state" class="">County</label>
                                <input type="text" class="input-text " value="" placeholder=""
                                    name="billing_state" id="billing_state" autocomplete="address-level1">
                            </p>
                            <p class="form-row form-row-wide address-field validate-postcode validate-required"
                                id="billing_postcode_field" data-priority="90"
                                data-o_class="form-row form-row-wide address-field validate-required validate-postcode">
                                <label for="billing_postcode" class="">Postcode <abbr class="required"
                                        title="required">*</abbr></label>
                                <input type="text" class="input-text " name="billing_postcode" id="billing_postcode"
                                    placeholder="" value="" autocomplete="postal-code">
                            </p>
                            <p class="form-row form-row-first validate-required validate-phone" id="billing_phone_field"
                                data-priority="100">
                                <label for="billing_phone" class="">Phone <abbr class="required"
                                        title="required">*</abbr></label>
                                <input type="tel" class="input-text " name="billing_phone" id="billing_phone"
                                    placeholder="" value="" autocomplete="tel">
                            </p>
                            <p class="form-row form-row-last validate-required validate-email" id="billing_email_field"
                                data-priority="110">
                                <label for="billing_email" class="">Email address <abbr class="required"
                                        title="required">*</abbr></label>
                                <input type="email" class="input-text " name="billing_email" id="billing_email"
                                    placeholder="" value="" autocomplete="email">
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-2">
                    <div class="woocommerce-shipping-fields"></div>
                    <div class="woocommerce-additional-fields">
                        <h3>Additional information</h3>
                        <div class="woocommerce-additional-fields__field-wrapper">
                            <p class="form-row notes" id="order_comments_field" data-priority=""><label
                                    for="order_comments" class="">Order notes</label>
                                <textarea name="order_comments" class="input-text " id="order_comments"
                                    placeholder="Notes about your order, e.g. special notes for delivery." rows="7" cols="5"></textarea>
                            </p>
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

    <div class="container pb-6 pb-xl-10">
        <form name="checkout" method="post" class="checkout woocommerce-checkout" action="" novalidate="">
            <!-- Billing Details Section -->
            <!-- Billing details fields here -->

            <!-- Additional Information Section -->
            <!-- Additional information fields here -->

            <!-- Order Summary Section -->
            <!-- Order summary table here -->

            <!-- Payment Methods Section -->
            <div class="woocommerce-checkout-payment">
                <h3>Payment Method</h3>
                <ul class="wc_payment_methods payment_methods methods">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <!-- PayPal Option -->
                                <li class="wc_payment_method payment_method_paypal">
                                    <div class="d-block w-100">
                                        <input id="payment_method_paypal" type="radio" class="input-radio"
                                            name="payment_method" value="paypal" checked="checked"
                                            onclick="showPayPalMessage()">
                                        <label for="payment_method_paypal">PayPal</label>
                                    </div>
                                    <div id="paypal_message" class="payment_box payment_method_paypal"
                                        style="display: block;">
                                        <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal
                                            account.
                                        </p>
                                    </div>
                                </li>
                                <!-- Credit Card Option -->

                                <li class="wc_payment_method payment_method_credit_card">
                                    <div class="d-block w-100">
                                        <input id="payment_method_credit_card" type="radio" class="input-radio"
                                            name="payment_method" value="credit_card" onclick="showCreditCardForm()">
                                        <label for="payment_method_credit_card">Credit Card</label>
                                    </div>
                                    <div id="credit_card_form" class="payment_box payment_method_credit_card"
                                        style="display: none;">
                                        <div class="col2-set" id="customer_details">
                                            <div class="col-1">
                                                <div class="woocommerce-billing-fields">
                                                    <h3>Billing details</h3>
                                                    <div class="woocommerce-billing-fields__field-wrapper">
                                                        <p class="form-row form-row-first validate-required woocommerce-invalid woocommerce-invalid-required-field"
                                                            id="billing_first_name_field" data-priority="10">
                                                            <label for="billing_first_name" class="">First name
                                                                <abbr class="required" title="required">*</abbr></label>
                                                            <input type="text" class="input-text "
                                                                name="billing_first_name" id="billing_first_name"
                                                                placeholder="" value="" autocomplete="given-name"
                                                                autofocus="autofocus">
                                                        </p>
                                                        <p class="form-row form-row-last validate-required"
                                                            id="billing_last_name_field" data-priority="20">
                                                            <label for="billing_last_name" class="">Last name <abbr
                                                                    class="required" title="required">*</abbr></label>
                                                            <input type="text" class="input-text "
                                                                name="billing_last_name" id="billing_last_name"
                                                                placeholder="" value="" autocomplete="family-name">
                                                        </p>
                                                        <p class="form-row form-row-wide" id="billing_company_field"
                                                            data-priority="30">
                                                            <label for="billing_company" class="">Company
                                                                name</label>
                                                            <input type="text" class="input-text "
                                                                name="billing_company" id="billing_company"
                                                                placeholder="" value=""
                                                                autocomplete="organization">
                                                        </p>


                                                        <p class="form-row form-row-wide address-field validate-required"
                                                            id="billing_address_1_field" data-priority="50">
                                                            <label for="billing_address_1" class="">Street address
                                                                <abbr class="required" title="required">*</abbr></label>
                                                            <input type="text" class="input-text "
                                                                name="billing_address_1" id="billing_address_1"
                                                                placeholder="House number and street name" value=""
                                                                autocomplete="address-line1">
                                                        </p>
                                                        <p class="form-row form-row-wide address-field"
                                                            id="billing_address_2_field" data-priority="60">
                                                            <input type="text" class="input-text "
                                                                name="billing_address_2" id="billing_address_2"
                                                                placeholder="Apartment, suite, unit etc. (optional)"
                                                                value="" autocomplete="address-line2">
                                                        </p>
                                                        <p class="form-row form-row-wide address-field validate-required"
                                                            id="billing_city_field" data-priority="70"
                                                            data-o_class="form-row form-row-wide address-field validate-required">
                                                            <label for="billing_city" class="">Town / City <abbr
                                                                    class="required" title="required">*</abbr></label>
                                                            <input type="text" class="input-text " name="billing_city"
                                                                id="billing_city" placeholder="" value=""
                                                                autocomplete="address-level2">
                                                        </p>
                                                        <p class="form-row form-row-wide address-field validate-state"
                                                            id="billing_state_field" data-priority="80"
                                                            data-o_class="form-row form-row-wide address-field validate-state">
                                                            <label for="billing_state" class="">County</label>
                                                            <input type="text" class="input-text " value=""
                                                                placeholder="" name="billing_state" id="billing_state"
                                                                autocomplete="address-level1">
                                                        </p>
                                                        <p class="form-row form-row-wide address-field validate-postcode validate-required"
                                                            id="billing_postcode_field" data-priority="90"
                                                            data-o_class="form-row form-row-wide address-field validate-required validate-postcode">
                                                            <label for="billing_postcode" class="">Postcode <abbr
                                                                    class="required" title="required">*</abbr></label>
                                                            <input type="text" class="input-text "
                                                                name="billing_postcode" id="billing_postcode"
                                                                placeholder="" value="" autocomplete="postal-code">
                                                        </p>
                                                        <p class="form-row form-row-first validate-required validate-phone"
                                                            id="billing_phone_field" data-priority="100">
                                                            <label for="billing_phone" class="">Phone <abbr
                                                                    class="required" title="required">*</abbr></label>
                                                            <input type="tel" class="input-text "
                                                                name="billing_phone" id="billing_phone" placeholder=""
                                                                value="" autocomplete="tel">
                                                        </p>
                                                        <p class="form-row form-row-last validate-required validate-email"
                                                            id="billing_email_field" data-priority="110">
                                                            <label for="billing_email" class="">Email address <abbr
                                                                    class="required" title="required">*</abbr></label>
                                                            <input type="email" class="input-text "
                                                                name="billing_email" id="billing_email" placeholder=""
                                                                value="" autocomplete="email">
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-2">
                                                <div class="woocommerce-shipping-fields"></div>
                                                <div class="woocommerce-additional-fields">
                                                    <h3>Additional information</h3>
                                                    <div class="woocommerce-additional-fields__field-wrapper">
                                                        <p class="form-row notes" id="order_comments_field"
                                                            data-priority="">
                                                            <label for="order_comments" class="">Order notes</label>
                                                            <textarea name="order_comments" class="input-text " id="order_comments"
                                                                placeholder="Notes about your order, e.g. special notes for delivery." rows="7" cols="5"></textarea>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </div>
                        </div>
                    </div>
                </ul>
            </div>

        </form>
    </div>

    <script>
        function showPayPalMessage() {
            document.getElementById("paypal_message").style.display = "block";
            document.getElementById("credit_card_form").style.display = "none";
        }

        function showCreditCardForm() {
            document.getElementById("credit_card_form").style.display = "block";
            document.getElementById("paypal_message").style.display = "none";
        }
    </script>




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
