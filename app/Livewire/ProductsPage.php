<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Category;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Products - Poskesdes Laubaleng')]
class ProductsPage extends Component
{
    use WithPagination, LivewireAlert;
    
    #[Url]
    public $selected_categories = [];

    #[Url]
    public $bebas;

    #[Url]
    public $bebasTerbatas;

    #[Url]
    public $keras;

    #[Url]
    public $narkotika;

    #[Url]
    public $price_range = 30000;

    #[Url]
    public $sort = 'latest';
    
    // Add items to cart
    public function addToCart($id_product)
    {
        $countItems = CartManagement::addItemsToCart(auth()->user()->customer->id_customer, $id_product);

        $this->dispatch('updateCartCount', countItems: $countItems)->to(Navbar::class);

        $this->alert('success', 'Obat Berhasil Ditambahkan ke dalam Keranjang!', [
            'position' =>  'bottom-end',
            'timer' =>  3000,
            'toast' =>  true,
        ]);
    }

    public function render()
    {
        $categories = Category::all();
        $products = Product::query()->where('status', 'aktif');
        
        // Filtering by categories
        if(!empty($this->selected_categories)) 
        {
            $products->when($this->selected_categories, function($query) {
                $query->whereHas('productDescription', function($que) {
                    $que->whereIn('id_category', $this->selected_categories);
                });
            });
        }
        
        if($this->bebas) 
        {
            $products->when($this->bebas, function($query) {
                $query->whereHas('productDescription', function($que) {
                    $que->where('golongan_obat', 'Bebas');
                });
            });
        }
        
        if($this->bebasTerbatas) 
        {
            $products->when($this->bebasTerbatas, function($query) {
                $query->whereHas('productDescription', function($que) {
                    $que->where('golongan_obat', 'Bebas Terbatas');
                });
            });
        }

        if($this->keras) 
        {
            $products->when($this->keras, function($query) {
                $query->whereHas('productDescription', function($que) {
                    $que->where('golongan_obat', 'Keras');
                });
            });
        }

        if($this->narkotika) 
        {
            $products->when($this->narkotika, function($query) {
                $query->whereHas('productDescription', function($que) {
                    $que->where('golongan_obat', 'Narkotika');
                });
            });
        }

        if($this->price_range)
        {
            $products->whereBetween('product_sell_price',   [0, $this->price_range]);
        }

        if($this->sort == 'latest')
        {
            $products->latest();
        }
        
        if($this->sort == 'price')
        {
            $products->orderBy('product_sell_price');   
        }

        return view('livewire.products-page', [
            'categories' => $categories,
            'products' => $products->paginate(6), 
        ]);
    }
}
