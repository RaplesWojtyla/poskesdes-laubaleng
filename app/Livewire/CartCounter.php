<?php

namespace App\Livewire;
use App\Models\Cart;
use Livewire\Component;

class CartCounter extends Component
{
    public $stock_product;
    public $quantity;
    public $cart_id;

    public function cashier_count($item)
    {
        $this->dispatch('addToCart',auth()->user()->user_id,$item);
    }

    public function decrementButton($cart_id,$quantity,$stock_product) {
            if($this->quantity > $this->stock_product) {
                Cart::on('user')->where('cart_id', $this->cart_id)->update([
                    'quantity'=> $this->stock_product,
                ]);
            }else if($this->quantity <= $this->stock_product && $this->quantity >= 1) {
                Cart::on('user')->where('cart_id', $this->cart_id)->update([
                    'quantity'=> $this->quantity - 1,
                ]);
            }else{
                Cart::on('user')->where('cart_id', $this->cart_id)->update([
                    'quantity'=> 1,
                ]);
            }
            $this->quantity = Cart::on('user')->where('cart_id', $this->cart_id)->first()->quantity;
            $this->dispatch('quantity', $this->cart_id, $this->quantity);
        
    }

    public function incrementButton($cart_id,$quantity,$stock_product) {
            if($this->quantity > $this->stock_product) {
                Cart::on('user')->where('cart_id', $this->cart_id)->update([
                    'quantity'=> $this->stock_product,
                ]);
            }else if($this->quantity <= $this->stock_product && $this->quantity >= 1) {
                Cart::on('user')->where('cart_id', $this->cart_id)->update([
                    'quantity'=> $this->quantity + 1,
                ]);
            }else{
                Cart::on('user')->where('cart_id', $this->cart_id)->update([
                    'quantity'=> 1,
                ]);
            }
            $this->quantity = Cart::on('user')->where('cart_id', $this->cart_id)->first()->quantity;
            $this->dispatch('quantity', $this->cart_id, $this->quantity);
    }

    public function render()
    {
        return view('livewire.cartdisplay');
    }
}
