<?php

namespace App\Livewire;

use App\Models\Cart;
use Illuminate\Support\Str;
use Livewire\Component;

class ButtonAddCartCashier extends Component
{
    public $user_id;
    public $product_id;
    protected $listeners = [AddedToCart];

    // public function mount($user,$product)
    // {
    //     $this->user_id = $user;
    //     $this->product_id = $product;
    // }

    public function render()
    {
        return view('livewire.button-add-cart-cashier');
    }
}
