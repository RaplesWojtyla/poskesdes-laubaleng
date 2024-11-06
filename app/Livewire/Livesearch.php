<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Livesearch extends Component
{
    protected $listeners = ["livesearch"];
    public $product;
    public $cari;

    public function livesearch($cari){
            $this->product = Product::on('user')->where("product_name", "Like", "%". $cari ."%")->take(10)->get();
    }
    
    public function render()
    {
        
        return view('livewire.livesearch',[
            'products'=> $this->product ?? [],
        ]);
    }
}