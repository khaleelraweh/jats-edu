<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderTransaction;
use App\Models\Product;
use App\Models\User;
use App\Services\OrderService;
use App\Services\PaypalService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Paytabscom\Laravel_paytabs\Facades\paypage;

class PaymentController extends Controller
{
    public function checkout()
    {

        return view('frontend.checkout');
    }

    // paypal pay 
    public function checkout_now(Request $request)
    {
        if ($request->paymentMethod == 'paypal') {

            $order = (new OrderService)->createOrder($request->except(['_token', 'submit']));

            $paypal = new PaypalService('PayPal_Rest');
            $response = $paypal->purchase([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => $paypal->getReturnUrl($order->id),
                    "cancel_url" => $paypal->getCancelUrl($order->id)
                ],
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => $order->total
                        ]
                    ]
                ]
            ]);

            if (isset($response['id']) && $response['id'] != null) {
                foreach ($response['links'] as $link) {
                    if ($link['rel'] === 'approve') {
                        return redirect()->away($link['href']);
                    }
                }
            } else {

                return redirect()->route('checkout.cancel', $order->id);
            }
        } elseif ($request->paymentMethod == 'creditDebit') {

            $order = (new OrderService)->createOrder($request->except(['_token', 'submit']));
            // dd($order);

            $pay = paypage::sendPaymentCode('all')
                ->sendTransaction('sale', 'ecom')
                ->sendCart($order->id, $order->total, 'Course for Sale')
                ->sendCustomerDetails("name", "email", '772036131', "40 st", "Rayidh", "Rayidh", "ASU", "12284", "0000")
                ->sendShippingDetails('', $name = null, $email = null, $phone = null, $street1 = null, $city = null, $state = null, $country = null, $zip = null, $ip = null)
                ->sendHideShipping($on = false)
                ->sendURLs('', '')
                ->sendLanguage('en')
                ->sendFramed($on = false)
                ->create_pay_page(); // to initiate payment page

            return $pay;
        }
    }



    // inner
    public function checkout_in(Request $request)
    {
        if ($request->payType == 1) {

            $order = Order::create([
                'ref_id'                => 'ORD-' . Str::random(15),
                'user_id'               => auth()->id(),
                'payment_method_id'     => $request['payment_method_id'],
                'subtotal'              => getNumbers()->get('subtotal'),
                'discount_code'         => session()->has('coupon') ? session()->get('coupon')['code'] : null,
                'discount'              => getNumbers()->get('discount'),
                'tax'                   => getNumbers()->get('productTaxes'),
                'total'                 => getNumbers()->get('total'),
                'currency'              => 'USD',
                'order_status'          => 0,

                'bankAccNumber' => $request->bankAccNumber,
                'bankReceipt'   => $request->bankReceipt,
            ]);

            foreach (Cart::content() as $item) {

                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item->model->id,
                    'quantity' => $item->qty,
                ]);

                $product = Product::find($item->model->id);
                $product->update(['quantity' => $product->quantity - $item->qty]);
            }


            $order->transactions()->create(
                ['transaction' => OrderTransaction::NEW_ORDER]
            );

            Cart::instance('default')->destroy();
            session()->forget([
                'coupon',
                'saved_customer_address_id',
                'saved_shipping_company_id',
                'saved_payment_method_id',
                'shipping',
            ]);

            $order->update(['order_status' => Order::PAYMENT_COMPLETED]);
            $order->transactions()->create([
                'transaction' => OrderTransaction::PAYMENT_COMPLETED,
                // 'transaction_number' => $response->getTransactionReference(),
                'transaction_number' => $order->ref_id,
                'payment_result' => 'success',
            ]);


            toast(__('panel.f_reservesion_proccess_completed'), 'success');

            return redirect()->route('frontend.index');
        }
    }



    public function completed(Request $request, $order_id)
    {

        $order = Order::find($order_id);

        $paypal = new PaypalService('PayPal_Rest');
        $response = $paypal->complete($request->token);


        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $order->update(['order_status' => Order::PAYMENT_COMPLETED]);
            $order->transactions()->create([
                'transaction' => OrderTransaction::PAYMENT_COMPLETED,
                // 'transaction_number' => $response->getTransactionReference(),
                'transaction_number' => $response['id'],
                'payment_result' => 'success',
            ]);

            if (session()->has('coupon')) {
                $coupon = Coupon::where('code->' . app()->getLocale(), session()->get('coupon')['code'])->first();
                $coupon->increment('used_times');
            }

            Cart::instance('default')->destroy();
            session()->forget([
                'coupon',
                'saved_customer_address_id',
                'saved_shipping_company_id',
                'saved_payment_method_id',
                'shipping',
            ]);


            toast(__('panel.f_your_recent_payment_successful_with_refrence_code') . $response['id'], 'success');

            return redirect()->route('frontend.index');
        } else {
            return redirect()->route('checkout.cancel', $order->id);
        }
    }

    public function cancelled($order_id)
    {
        $order = Order::find($order_id);
        $order->update([
            'order_status' => Order::CANCELED
        ]);

        $order->products()->each(function ($order_product) {
            $product = Product::whereId($order_product->pivot->product_id)->first();
            $product->update([
                'quantity' => $product->quantity + $order_product->quantity
            ]);
        });

        toast(__('panel.f_you_have_cancelled_your_order_payment'), 'error'); //using realrashed sweet alert lab

        return redirect()->route('frontend.index');
    }

    public function webhook($order, $env)
    {
        //
    }
}