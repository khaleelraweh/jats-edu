<?php

namespace App\Http\Livewire\Frontend\Modals;

use Gloudemans\Shoppingcart\Facades\Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CartModalComponent extends Component
{
    use LivewireAlert;

    protected $listeners = [
        'updateCartCount' => 'render'
    ];

    public $cartItems;
    public $oldTotalPrice;
    public $totalPrice;

    public function render()
    {
        $this->cartItems = getNumbers()->get('cartItems');
        $this->oldTotalPrice = currency_converter(getNumbers()->get('subtotal'));
        $this->totalPrice = currency_converter(getNumbers()->get('total'));



        return view('livewire.frontend.modals.cart-modal-component', [
            'cartItems'             => $this->cartItems,
            'totalPrice'            =>  $this->totalPrice,
            'oldTotalPrice'         =>  $this->oldTotalPrice
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
