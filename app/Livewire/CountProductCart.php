<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;

class CountProductCart extends Component
{
    public $stock_product;
    public $halaman_keranjang;
    public $quantity;
    public $cart_id;
    public function mount($stock, $keranjang, $quantity, $cart)
    {
        $this->stock_product = $stock;
        $this->halaman_keranjang = $keranjang ?? false;
        $this->quantity = $quantity ?? 0;
        $this->cart_id = $cart ??0;
    }

    public function decrement() {
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

    public function increment() {
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
        return view('livewire.count-product-cart');
    }
}
