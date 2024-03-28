<?php

namespace App\Http\Livewire\Frontend\ShopCart;

use App\Models\Course;
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
    public $wishlistItems;
    public $subTotal;
    public $total;


    public function render()
    {

        $this->cartItems = getNumbers()->get('cartItems');
        $this->wishlistItems = Cart::instance('wishlist')->content();

        $this->subTotal = currency_converter(getNumbers()->get('subtotal'));
        $this->total = currency_converter(getNumbers()->get('total'));

        return view('livewire.frontend.shop-cart.shop-cart-component', [
            'cartItems'             => $this->cartItems,
            'subTotal'         => $this->subTotal,
            'total'            => $this->total,
            'wishlistItems'         => $this->wishlistItems,
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


    public function removeFromWishlist($rowId)
    {
        $wishlist = Cart::instance('wishlist')->content()->where('rowId', $rowId);
        if ($wishlist->isNotEmpty()) {
            Cart::instance('wishlist')->remove($rowId);
        }
        $this->emit('updateCartCount');
        $this->alert('success', __('panel.f_m_item_removed_from_wishlist_cart'));
    }

    public function moveToCart($rowId)
    {
        $item = Cart::instance('wishlist')->get($rowId);

        $duplicates = Cart::instance('default')->search(function ($cartItem, $rId) use ($rowId) {
            return $rId === $rowId;
        });

        if ($duplicates->isNotEmpty()) {

            Cart::instance('wishlist')->remove($rowId);
            $this->alert('error', __('panel.f_m_item_already_exist_in_shop_cart'));
        } else {
            Cart::instance('default')->add($item->id, $item->name, 1, $item->price)->associate(Course::class);
            Cart::instance('wishlist')->remove($rowId);
            $this->emit('updateCartCount');

            $this->alert('success', __('panel.f_m_item_add_to_shop_cart'));
        }
    }
    public function moveToWishlist($rowId)
    {
        $item = Cart::instance('default')->get($rowId);

        $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rId) use ($rowId) {
            return $rId === $rowId;
        });

        if ($duplicates->isNotEmpty()) {

            Cart::instance('default')->remove($rowId);
            $this->alert('error', __('panel.f_m_item_already_exist_in_wishlist_cart'));
        } else {
            Cart::instance('wishlist')->add($item->id, $item->name, 1, $item->price)->associate(Course::class);
            Cart::instance('default')->remove($rowId);
            $this->emit('updateCartCount');

            $this->alert('success', __('panel.f_m_item_add_to_wishlist_cart'));
        }
    }
}
