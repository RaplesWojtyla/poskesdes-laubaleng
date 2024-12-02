<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Carts;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;

#[Title('Keranjang - Poskesdes Laubaleng')]
class CartPage extends Component
{
    use LivewireAlert;

    public $id_customer;
    public $cartItems = [];
    public $totalPrice = 0;

    public function mount()
    {
        $this->id_customer = auth()->user()->customer->id_customer;
        $this->cartItems = CartManagement::getCartItems($this->id_customer);
        $this->totalPrice = CartManagement::calcTotalPriceAllCartItems($this->cartItems);
    }

    public function increaseQuantity($id_product)
    {
        $this->cartItems = CartManagement::increaseQuantity($this->id_customer, $id_product);
        $this->totalPrice = CartManagement::calcTotalPriceAllCartItems($this->cartItems);
    }

    public function decreaseQuantity($id_product)
    {
        $this->cartItems = CartManagement::decreaseQuantity($this->id_customer, $id_product);
        $this->totalPrice = CartManagement::calcTotalPriceAllCartItems($this->cartItems);
        
        $this->dispatch('updateCartCount', count($this->cartItems))->to(Navbar::class);
    }
    
    public function removeItem($id_product)
    {
        $this->cartItems = CartManagement::removeItemsFromCart($this->id_customer, $id_product);
        $this->totalPrice = CartManagement::calcTotalPriceAllCartItems($this->cartItems);

        $this->dispatch('updateCartCount', count($this->cartItems))->to(Navbar::class);

        $this->alert('success', 'Produk Berhasil Dihapus!', [
            'position' =>  'bottom-end',
            'timer' =>  3000,
            'toast' =>  true,
        ]);
    }
    
    public function render()
    {
        return view('livewire.cart-page', [
            'carts' => $this->cartItems,
            'totalPrice' => $this->totalPrice
        ]);
    }
}
