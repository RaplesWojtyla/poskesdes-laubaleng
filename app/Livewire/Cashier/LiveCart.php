<?php

namespace App\Livewire\Cashier;

use App\Models\Carts;
use Livewire\Component;

class LiveCart extends Component
{
    public $id_user;
    public $id_product;
    public $cartItems;
    public $cart;
    public $totalProducts = 0;
    public $quantity;
    protected $listeners = ['productAddedToCart', 'decrementButton', 'incrementButton'];

    public function mount() 
    {
        $this->cartItems = Carts::where('id_user', auth()->user()->id_user)->get();
    }

    public function productAddedToCart($user, $product)
    {
        $existingCart = Carts::where('id_user', $user)
                        ->where('id_product', $product)
                        ->first();

        if (!$existingCart) 
        {
            Carts::create([
                "id_cart" => \Illuminate\Support\Str::uuid(),
                'id_user' => auth()->user()->id_user,
                'id_product' => $this->product,
                'quantity' => 1
            ]);
        }
        
        $this->cartItems = Carts::where('id_user', $user)->get();
    }


    public function decrementButton($cart) 
    {
        if($cart['quantity'] > 1) 
        {
            Carts::where('id_cart', $cart['id_cart'])->update([
                'quantity'=> $cart['quantity'] - 1,
            ]);
        }
        else 
        {
            Carts::where('id_cart', $cart['id_cart'])->delete();
        }

        $this->cartItems = Carts::where('id_user', auth()->user()->id_user)->get();
    }

    public function incrementButton($cart, $detail_product) 
    {
        if($cart['quantity'] > $detail_product) 
        {
            Carts::where('id_cart', $cart['id_cart'])->update([
                'quantity'=> $detail_product,
            ]);
        }
        else if($cart['quantity'] < $detail_product) 
        {
            Carts::where('id_cart', $cart['id_cart'])->update([
                'quantity'=> $cart['quantity'] + 1,
            ]);
        }
        
        $this->cartItems = Carts::where('id_user', auth()->user()->id_user)->get();
    }

    public function checkout()
    {
        
    }

    public function render()
    {
        return view('livewire.cashier.live-cart');
    }
}
