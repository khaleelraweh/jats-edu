<div>
    <div class="container pb-6 pb-xl-10">
        <div class="row">
            <div class="col-sm-12 col-md-8">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main ">
                        <div class="page type-page status-publish hentry mb-10">
                            <!-- .entry-header -->
                            <div class="entry-content">
                                <div class="woocommerce">
                                    <form class="woocommerce-cart-form table-responsive" action="#" method="post">
                                        <table
                                            class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                                            <thead>
                                                <tr>
                                                    <th class="product-name">Courses in Cart</th>
                                                    <th class="product-subtotal">Price</th>
                                                    <th class="product-remove">&nbsp;</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($cartItems as $item)
                                                    <tr class="woocommerce-cart-form__cart-item cart_item">
                                                        <td class="product-name" data-title="Product">
                                                            <div class="d-flex align-items-center">
                                                                <a
                                                                    href="{{ route('frontend.course_single', $item->model->slug) }}">
                                                                    @php
                                                                        if (
                                                                            $item->model->photos->first() != null &&
                                                                            $item->model->photos->first()->file_name !=
                                                                                null
                                                                        ) {
                                                                            $item_model_img = asset(
                                                                                'assets/courses/' .
                                                                                    $item->model->photos->first()
                                                                                        ->file_name,
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
                                                                        class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image"
                                                                        alt="{{ $item->model->title }}">
                                                                </a>
                                                                <div class="ms-6">
                                                                    <a
                                                                        href="{{ route('frontend.course_single', $item->model->slug) }}">{{ $item->model->title }}</a>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td class="product-subtotal" data-title="Total">
                                                            <span class="woocommerce-Price-amount amount"><span
                                                                    class="woocommerce-Price-currencySymbol"></span>{{ currency_converter($item->price) }}</span>
                                                        </td>
                                                        <td class="product-remove">
                                                            <a href="#"
                                                                wire:click.prevent="removeFromCart('{{ $item->rowId }}')"
                                                                class="remove" aria-label="Remove this item">
                                                                <i
                                                                    class="far fa-trash-alt text-secondary font-size-sm"></i>
                                                                Remove
                                                            </a> <br>
                                                            <a href="#"
                                                                wire:click.prevent="moveToWishlist('{{ $item->rowId }}')"
                                                                class="remove" aria-label="Remove this item">
                                                                <i
                                                                    class="fas fa-sort-amount-down text-secondary font-size-sm"></i>
                                                                Move to Wishlist
                                                            </a>
                                                        </td>

                                                    </tr>
                                                @endforeach

                                                <tr class="d-none">
                                                    <td colspan="5" class="actions">
                                                        <div class="coupon">
                                                            <label for="coupon_code">Coupon:</label>
                                                            <input type="text" name="coupon_code" class="input-text"
                                                                id="coupon_code" value=""
                                                                placeholder="Coupon code" autocomplete="off"> <input
                                                                type="submit" class="button" name="apply_coupon"
                                                                value="Apply coupon">
                                                        </div>

                                                        <input type="submit" class="button" name="update_cart"
                                                            value="Update cart">
                                                    </td>
                                                </tr>


                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                            <!-- .entry-content -->
                        </div>

                        <div class="page type-page status-publish hentry">
                            <!-- .entry-header -->
                            <div class="entry-content">
                                <div class="woocommerce">
                                    <form class="woocommerce-cart-form table-responsive" action="#" method="post">
                                        <table
                                            class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                                            <thead>
                                                <tr>
                                                    <th class="product-name">Courses in wishlist</th>
                                                    <th class="product-subtotal">Price</th>
                                                    <th class="product-remove">&nbsp;</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($wishlistItems as $item)
                                                    <tr class="woocommerce-cart-form__cart-item cart_item">
                                                        <td class="product-name" data-title="Product">
                                                            <div class="d-flex align-items-center">
                                                                <a
                                                                    href="{{ route('frontend.course_single', $item->model->slug) }}">
                                                                    @php
                                                                        if (
                                                                            $item->model->photos->first() != null &&
                                                                            $item->model->photos->first()->file_name !=
                                                                                null
                                                                        ) {
                                                                            $item_model_img = asset(
                                                                                'assets/courses/' .
                                                                                    $item->model->photos->first()
                                                                                        ->file_name,
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
                                                                        class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image"
                                                                        alt="{{ $item->model->title }}">
                                                                </a>
                                                                <div class="ms-6">
                                                                    <a
                                                                        href="{{ route('frontend.course_single', $item->model->slug) }}">{{ $item->model->title }}</a>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td class="product-subtotal" data-title="Total">
                                                            <span class="woocommerce-Price-amount amount"><span
                                                                    class="woocommerce-Price-currencySymbol"></span>{{ currency_converter($item->price) }}</span>
                                                        </td>
                                                        <td class="product-remove">
                                                            <a href="#"
                                                                wire:click.prevent="removeFromWishlist('{{ $item->rowId }}')"
                                                                class="remove" aria-label="Remove this item">
                                                                <i
                                                                    class="far fa-trash-alt text-secondary font-size-sm"></i>
                                                                Remove
                                                            </a> <br>
                                                            <a href="#"
                                                                wire:click.prevent="moveToCart('{{ $item->rowId }}')"
                                                                class="remove" aria-label="Remove this item">
                                                                <i
                                                                    class="fas fa-sort-amount-up text-secondary font-size-sm"></i>
                                                                Move to Cart
                                                            </a>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                            <!-- .entry-content -->
                        </div>
                    </main>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div id="secondary" class="sidebar" role="complementary">
                    <div class="cart-collaterals">
                        <div class="cart_totals">
                            <h2>Cart totals</h2>

                            <table class="shop_table shop_table_responsive">
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Subtotal</th>
                                        <td data-title="Subtotal"><span class="woocommerce-Price-amount amount"><span
                                                    class="woocommerce-Price-currencySymbol"></span>{{ $totalPrice }}</span>
                                        </td>
                                    </tr>

                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td data-title="Total"><strong><span
                                                    class="woocommerce-Price-amount amount"><span
                                                        class="woocommerce-Price-currencySymbol"></span>{{ $totalPrice }}</span></strong>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>

                            <div class="wc-proceed-to-checkout">
                                <a href="{{ route('frontend.shop_checkout') }}"
                                    class="checkout-button button alt wc-forward">
                                    {{-- Proceed to checkout --}}
                                    checkout
                                </a>
                            </div>

                            <hr class="mb-2">
                            <h6 class="mt-0">Promotions</h6>
                            <div class="">
                                <form>
                                    <div class="input-group">
                                        <input type="text" name="coupon_code" class="form-control"
                                            placeholder="Enter Coupon" aria-label="Enter Coupon"
                                            aria-describedby="button-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary " type="button"
                                                id="button-addon2">Apply</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
