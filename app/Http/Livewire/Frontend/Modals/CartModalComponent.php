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
    public $totalPrice;

    public function render()
    {
        $this->cartItems = Cart::instance('default')->content();
        $this->totalPrice = currency_converter(Cart::total());

        return view('livewire.frontend.modals.cart-modal-component', [
            'cartItems' => $this->cartItems,
        ]);
    }
}
