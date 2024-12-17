<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Product Detail - Poskesdes Lau Baleng')]
class ProductDetailPage extends Component
{
    use LivewireAlert;

    public $id_product;

    public $quantity = 1;

    public function mount($id_product) 
    {
        $this->id_product = $id_product;
    }

    public function increaseQuantity()
    {
        $productDetail = ProductDetail::where('id_product', $this->id_product)
            ->where('stock', '>', 0)
            ->where('exp_date', '>', now())
            ->orderBy('exp_date')->first();

        ++$this->quantity;

        if ($this->quantity > $productDetail->stock) 
        {
            $this->quantity = $productDetail->stock;
        }
    }

    public function decreaseQuantity()
    {
        if ($this->quantity > 1) {
            --$this->quantity;
        }
    }

    public function addToCart($id_product)
    {
        $countItems = CartManagement::addItemsToCart(auth()->user()->id_user, $id_product, $this->quantity);

        $this->dispatch('updateCartCount', $countItems)->to(Navbar::class);

        $this->alert('success', 'Obat Berhasil Ditambahkan ke dalam Keranjang!', [
            'position' =>  'bottom-end',
            'timer' =>  3000,
            'toast' =>  true,
        ]);
    }
    

    public function render()
    {
        $productDetail = ProductDetail::where('id_product', $this->id_product)
                            ->where('stock', '>', 0)
                            ->where('exp_date', '>', now())
                            ->orderBy('exp_date')->first();

        if ($productDetail == null) 
        {
            $productDetail = ProductDetail::where('id_product', $this->id_product)
                ->orderBy('exp_date')
                ->first();
        }

        return view('livewire.product-detail-page', [
            'productDetail' => $productDetail
        ]);
    }

}
