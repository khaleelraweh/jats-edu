<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderCourse;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductCoupon;
use App\Models\OrderTransaction;
use Gloudemans\Shoppingcart\Facades\Cart;
use illuminate\Support\Str;

class OrderService
{
    public $payment_method;

    public function createOrder($request)
    {

        if ($request['payment_method'] == 'paypal') {
            $this->payment_method = 1;
        }


        $order = Order::create([
            'ref_id'                => 'ORD-' . Str::random(15),
            'user_id'               => auth()->id(),
            'payment_method_id'     => $this->payment_method,
            'subtotal'              => getNumbers()->get('subtotal'),
            'discount_code'         => session()->has('coupon') ? session()->get('coupon')['code'] : null,
            'discount'              => getNumbers()->get('discount_coupon'),
            'shipping'              => getNumbers()->get('shipping'),
            'tax'                   => getNumbers()->get('courseTaxes'),
            'total'                 => getNumbers()->get('total'),
            'currency'              => 'USD',
            'order_status'          => 0
        ]);

        foreach (Cart::content() as $item) {

            OrderCourse::create([
                'order_id' => $order->id,
                'course_id' => $item->model->id,
                'quantity' => $item->qty
            ]);
        }


        $order->transactions()->create(
            ['transaction' => OrderTransaction::NEW_ORDER]
        );

        return $order;
    }
}
