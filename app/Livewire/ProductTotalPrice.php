<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;

class ProductTotalPrice extends Component
{
    protected $listeners = ["totalHarga"];
    public $jumlah;
    public $jumlah2;
    public $user_id;
    public $total;

    public function mount($user, $total){
        $this->user_id = $user;
        $this->total = $total;
    }
    
    public function totalHarga($total) {
        $this->jumlah += $total;
    }
    
    public function render()
    {
        $this->jumlah = $this->jumlah - $this->jumlah2;
        $this->jumlah2 = $this->jumlah;
        return view('livewire.product-total-price');
    }
}
