<?php

namespace App\Livewire;

use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProductPriceCart extends Component
{
    protected $listeners = ['quantity'];
    public $total_price;
    public $product_quantity;
    public $cart_id;
    public $cart;
    public $quantity;
    
    public function mount($totalprice, $cart) {
        $this->total_price = $totalprice;
        $this->cart = $cart;
    }
    public function quantity ($cart_id, $quantity){
        $this->cart_id = $cart_id;
        $this->product_quantity = $quantity;
        $this->total_price = DB::connection('user')->table('cart_view')->where('cart_id', $this->cart)->first()->total_harga;
        $this->quantity = Cart::on('user')->where('cart_id', $this->cart)->first()->quantity;
        $this->dispatch('totalHarga', $this->total_price);
    }


    public function render()
    {
        return view('livewire.product-price-cart');
    }
}
