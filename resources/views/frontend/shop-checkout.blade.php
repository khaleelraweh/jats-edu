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

                        <div id="accordionCurriculum">
                            <!-- Accordion panel 1 -->
                            <div class="border rounded mb-1 overflow-hidden">
                                <!-- Accordion heading as radio button -->
                                <div class="d-flex align-items-center" id="curriculumheadingOne">
                                    <h5 class="mb-0 w-100">
                                        <label
                                            class="d-flex align-items-center p-5 min-height-80 text-dark fw-medium collapse-accordion-toggle line-height-one"
                                            style="font-size: 1.5rem;">
                                            <input type="radio" class="accordion-radio me-4 text-dark d-flex"
                                                name="paymentMethod" value="paypal" data-bs-toggle="collapse"
                                                data-bs-target="#CurriculumcollapseOne" aria-expanded="false"
                                                aria-controls="CurriculumcollapseOne">

                                            <i class="fab fa-paypal mx-2"></i>
                                            Paypal
                                        </label>
                                    </h5>
                                </div>
                                <!-- Accordion content -->
                                <div id="CurriculumcollapseOne" class="collapse" aria-labelledby="curriculumheadingOne"
                                    data-bs-parent="#accordionCurriculum">
                                    <!-- Content for PayPal -->
                                    <div class="border-top px-5 py-4 min-height-70 d-md-flex align-items-center">
                                        <div class="d-flex align-items-center me-auto mb-4 mb-md-0">
                                            <div class="ms-4">
                                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a
                                                    PayPal account.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Accordion panel 2 -->
                            <div class="border rounded shadow mb-6 overflow-hidden">
                                <!-- Accordion heading as radio button -->
                                <div class="d-flex align-items-center" id="curriculumheadingTwo">
                                    <h5 class="mb-0 w-100">

                                        <label
                                            class="d-flex align-items-center justify-content-between p-5 min-height-80 text-dark fw-medium collapse-accordion-toggle line-height-one"
                                            style="font-size: 1.5rem;">

                                            <label class="d-flex">
                                                <input type="radio" class="accordion-radio me-4 text-dark d-flex"
                                                    name="paymentMethod" value="creditDebit" data-bs-toggle="collapse"
                                                    data-bs-target="#CurriculumcollapseTwo" aria-expanded="false"
                                                    aria-controls="CurriculumcollapseTwo">
                                                <i class="fas fa-credit-card mx-2"></i>
                                                Credit/Debit Card
                                            </label>


                                            <label>
                                                <i class="fab fa-cc-visa"></i>
                                                <i class="fab fa-cc-mastercard"></i>
                                                <i class="fab fa-cc-amex"></i>
                                                <i class="fab fa-cc-discover"></i>
                                            </label>

                                        </label>



                                    </h5>
                                </div>
                                <!-- Accordion content -->
                                <div id="CurriculumcollapseTwo" class="collapse" aria-labelledby="curriculumheadingTwo"
                                    data-bs-parent="#accordionCurriculum">
                                    <!-- Content for Credit/Debit Card -->
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

                        {{-- order view --}}
                        <div id="order_reviews" class="woocommerce-checkout-review-order">
                            <div class="woocommerce-checkout-review-order-inner">
                                <h3 id="order_review_heading">Order details</h3>
                                <table class="shop_table woocommerce-checkout-review-order-table">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Courses</th>
                                            <th class="product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="check-product-list">
                                        @foreach (Cart::instance('default')->content() as $item)
                                            <tr class="woocommerce-cart-form__cart-item cart_item">
                                                <td style="border-bottom: 1px solid #e7e7ec;" class="product-name"
                                                    data-title="Product">
                                                    <div class="d-flex align-items-center">
                                                        <a
                                                            href="{{ route('frontend.course_single', $item->model->slug) }}">
                                                            @php
                                                                if (
                                                                    $item->model->photos->first() != null &&
                                                                    $item->model->photos->first()->file_name != null
                                                                ) {
                                                                    $item_model_img = asset(
                                                                        'assets/courses/' .
                                                                            $item->model->photos->first()->file_name,
                                                                    );

                                                                    if (
                                                                        !file_exists(
                                                                            public_path(
                                                                                'assets/courses/' .
                                                                                    $item->model->photos->first()
                                                                                        ->file_name,
                                                                            ),
                                                                        )
                                                                    ) {
                                                                        $item_model_img = asset(
                                                                            'assets/courses/no_image_found.webp',
                                                                        );
                                                                    }
                                                                } else {
                                                                    $item_model_img = asset(
                                                                        'assets/courses/no_image_found.webp',
                                                                    );
                                                                }
                                                            @endphp

                                                            <img src="{{ $item_model_img }}"
                                                                class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image "
                                                                alt="{{ $item->model->title }}"
                                                                style="border: 1px solid #e7e7ec;border-radius: .25rem;box-shadow: 0 .5rem .937rem rgba(140,152,164,.1);max-width: 100px;height:50px; width:70px; ">
                                                        </a>
                                                        <div class="ms-3 ms-md-6">
                                                            <a
                                                                href="{{ route('frontend.course_single', $item->model->slug) }}">{{ $item->model->title }}</a>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td style="border-bottom: 1px solid #e7e7ec;" class="product-subtotal"
                                                    data-title="Total">
                                                    <span class="woocommerce-Price-amount amount"><span
                                                            class="woocommerce-Price-currencySymbol"></span>{{ currency_converter($item->price) }}</span>
                                                </td>


                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>
                            </div>

                        </div>

                    </div>
                </div>


            </div>
            {{-- checkout summary --}}
            <div id="order_review" class="woocommerce-checkout-review-order">
                <div class="woocommerce-checkout-review-order-inner">
                    <h3 id="order_review_heading">Summary</h3>
                    <table class="shop_table woocommerce-checkout-review-order-table">

                        <tbody>
                            <tr class="cart_item">
                                <td class="product-name">
                                    Original Price:
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
                                    Discounts:
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
                            </tr>

                            <tr class="order-total">
                                <th>Total</th>
                                <td><strong><span class="woocommerce-Price-amount amount"><span
                                                class="woocommerce-Price-currencySymbol">$</span>109.95</span></strong>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="form-row place-order">
                        <a href="shop-order-completed.html" class="btn btn-primary btn-block">
                            proccess
                        </a>
                    </div>
                </div>
                <div class="form-row place-order d-none">
                    <a href="shop-order-completed.html" class="btn btn-primary btn-block">
                        proccess
                    </a>
                </div>
            </div>
        </form>




        <!-- CALL ACTION -->
        <section class="py-6 py-md-11 border-top border-bottom" data-jarallax data-speed=".8"
            style="background-image: url(assets/img/illustrations/illustration-1.jpg)">
            <div class="container text-center py-xl-4" data-aos="fade-up">
                <div class="row">
                    <div class="col-xl-7 mx-auto">
                        <h1 class="text-capitalize">Subscribe our newsletter</h1>
                        <p class="text-capitalize font-size-lg mb-md-6 mb-4">Your download should start automatically, if
                            not
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
        <!-- Script to toggle accordion panels based on radio button change -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var radios = document.querySelectorAll('.accordion-radio');
                radios.forEach(function(radio) {
                    radio.addEventListener('change', function() {
                        var target = this.getAttribute('data-bs-target');
                        var collapse = document.querySelector(target);
                        var bsCollapse = new bootstrap.Collapse(collapse);
                        bsCollapse.toggle();
                    });
                });
            });
        </script>
    @endsection
