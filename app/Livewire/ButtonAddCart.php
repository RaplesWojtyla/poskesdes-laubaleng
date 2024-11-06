<?php

namespace App\Livewire;

use Livewire\Component;

class ButtonAddCart extends Component
{
    public $user_id;
    public $product_id;
    public function mount($user, $product){
        $this->user_id = $user;
        $this->product_id = $product;
    }

    public function count() {
        $this->dispatch('count_cart', $this->user_id, $this->product_id, 1);
    }

    public function render()
    {
        return view('livewire.button-add-cart');
    }
}
