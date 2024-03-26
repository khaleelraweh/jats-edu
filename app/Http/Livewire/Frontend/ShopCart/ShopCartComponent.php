<?php

namespace App\Http\Livewire\Frontend\ShopCart;

use Gloudemans\Shoppingcart\Facades\Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ShopCartComponent extends Component
{

    use LivewireAlert;

    protected $listeners = [
        'updateCartCount' => 'render'
    ];

    public $cartItems;
    public $totalPrice;

    public function render()
    {
        $this->cartItems = Cart::instance('default')->content();
        $this->totalPrice = currency_converter(Cart::total());

        return view('livewire.frontend.shop-cart.shop-cart-component', [
            'cartItems' => $this->cartItems,
            'totalPrice'    =>  $this->totalPrice,
        ]);
    }

    public function removeFromCart($rowId)
    {

        $cart = Cart::content()->where('rowId', $rowId);
        if ($cart->isNotEmpty()) {
            Cart::remove($rowId);
        }
        // Cart::instance('default')->remove($rowId);
        $this->emit('updateCartCount');
        $this->alert('success', __('panel.f_m_item_removed_from_shop_cart'));
    }
}
