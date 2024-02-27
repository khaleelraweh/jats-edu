<?php

use App\Models\Currency;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

function getParentShowOf($param)
{
    $route = str_replace('admin.', '', $param); // احذف كلمة admin. واستبدل بدالها بالفراغ من الراوت المرسل كبرامتر 
    $permission = collect(Cache::get('admin_side_menu')->pluck('children')->flatten())->where('as', $route)->flatten()->first();
    return $permission ? $permission['parent_show'] : null;
}

function getParentOf($param)
{
    $route = str_replace('admin.', '', $param);
    $permission = collect(Cache::get('admin_side_menu')->pluck('children')->flatten())->where('as', $route)->flatten()->first();
    return $permission ? $permission['parent'] : null;
}

function getParentIdOf($param)
{
    $route = str_replace('admin.', '', $param);
    $permission = collect(Cache::get('admin_side_menu')->pluck('children')->flatten())->where('as', $route)->flatten()->first();
    return $permission ? $permission['id'] : null;
}

function getNumbers()
{

    $subtotal = Cart::instance('default')->subtotal();

    $discount = session()->has('coupon') ? session()->get('coupon')['discount'] : 0.00;

    $discount_code = session()->has('coupon') ? session()->get('coupon')['code'] : null;

    $admin_discount = session()->has('offer_discount') ? session()->get('offer_discount') : 0.00;

    $subtotal_after_discount = $subtotal - $discount - $admin_discount;

    $tax = config('cart.tax') / 100;

    $taxText = config('cart.tax') . '%';

    $productTaxes = round($subtotal_after_discount * $tax, 2);

    $newSubTotal = $subtotal_after_discount + $productTaxes;

    $shipping = session()->has('shipping') ? session()->get('shipping')['cost'] : 0.00;
    $shipping_code = session()->has('shipping') ? session()->get('shipping')['code'] : null;

    $total = ($newSubTotal + $shipping) > 0 ? round($newSubTotal + $shipping, 2) : 0.00;

    return collect([
        'subtotal' => $subtotal,
        'tax'   => $tax,
        'taxText' => $taxText,
        'productTaxes' => (float) $productTaxes,
        'newSubTotal' => (float) $newSubTotal,
        'discount' => (float) $discount,
        'discount_code' => $discount_code, // came from session 
        'shipping' => (float) $shipping,
        'shipping_code' =>    $shipping_code,
        'total' => (float) $total,
        'admin_discount'    =>  $admin_discount,
    ]);
}


function currency_load()
{
    if (session()->has('system_default_currency_info') == false) {
        session()->put('system_default_currency_info', Currency::find(1));
    }
}

function currency_converter($amount)
{
    // return convert_price($amount);

    return format_price(convert_price($amount));
}


function convert_price($price)
{
    currency_load();

    $system_default_currency_info = session('system_default_currency_info');

    $price = floatval($price) / floatval($system_default_currency_info->exchange_rate);

    if (Session()->has('currency_exchange_rate')) {
        $exchange = session('currency_exchange_rate');
    } else {
        $exchange = $system_default_currency_info->exchange_rate;
    }

    $price = floatval($price)  * floatval($exchange);

    return $price;
}


//currency symbol 
function currency_symbol()
{
    currency_load();
    if (session()->has('currency_symbol')) {
        $symbol = session('currency_symbol');
    } else {
        $system_default_currency_info = session('system_default_currency_info');
        $symbol = $system_default_currency_info->currency_symbol;
    }

    return $symbol;
}


//format price 
function format_price($price)
{
    // return currency_symbol() . " " . number_format($price, 2);
    return  number_format($price, 2) . " " . currency_symbol();
}
