<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;

class CounterProduct extends Component
{
    public $count = 1;
    public $stock_product;
    public $user_id;
    public $product_id;
    public $status;

    public function mount($stock, $user, $product, $status)
    {
        $this->stock_product = $stock;
        $this->user_id = $user;
        $this->product_id = $product;
        $this->status = $status;
    }

    public function decrement() {
        $this->count = $this->count - 1;
    }

    public function increment() {
        $this->count = $this->count + 1;
    }
    
    public function counts() {
        $this->dispatch('count_cart', $this->user_id, $this->product_id, $this->count);
    }

    public function render()
    {
        return view('livewire.counter-product');
    }
}
