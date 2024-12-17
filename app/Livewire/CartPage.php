<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Carts;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;

#[Title('Keranjang - Poskesdes Lau Baleng')]
class CartPage extends Component
{
    use LivewireAlert;

    public $id_user;
    public $cartItems = [];
    public $totalPrice = 0;

    public function mount()
    {
        if (auth()->check() && auth()->user()->role == 'user')
        {
            $this->id_user = auth()->user()->id_user;
            $this->cartItems = CartManagement::getCartItems($this->id_user);
            $this->totalPrice = CartManagement::calcTotalPriceAllCartItems($this->cartItems);
        }
        else
        {
            $this->cartItems = [];
            $this->totalPrice = 0;
        }
    }

    public function increaseQuantity($id_product)
    {
        $this->cartItems = CartManagement::increaseQuantity($this->id_user, $id_product);
        $this->totalPrice = CartManagement::calcTotalPriceAllCartItems($this->cartItems);
    }

    public function decreaseQuantity($id_product)
    {
        $this->cartItems = CartManagement::decreaseQuantity($this->id_user, $id_product);
        $this->totalPrice = CartManagement::calcTotalPriceAllCartItems($this->cartItems);
        
        $this->dispatch('updateCartCount', count($this->cartItems))->to(Navbar::class);
    }
    
    public function removeItem($id_product)
    {
        $this->cartItems = CartManagement::removeItemsFromCart($this->id_user, $id_product);
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
