<?php

namespace App\Livewire;

use App\Models\ProductDetail;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Product Detail - Poskesdes Laubaleng')]
class ProductDetailPage extends Component
{
    public $id_product;

    public function mount($id_product) 
    {
        $this->id_product = $id_product;
    }

    public function render()
    {
        $productDetail = ProductDetail::where('id_product', $this->id_product)->first();

        return view('livewire.product-detail-page', [
            'productDetail' => $productDetail,
        ]);
    }

}
