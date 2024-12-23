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

#[Title('Products - Poskesdes Lau Baleng')]
class ProductsPage extends Component
{
    use WithPagination, LivewireAlert;
    
    #[Url]
    public $selected_categories;

    #[Url]
    public $golonganObat;

    #[Url]
    public $price_range = 70000;

    #[Url]
    public $sort = 'latest';

    #[Url]
    public $search = '';
    
    // Add items to cart
    public function addToCart($id_product)
    {
        $countItems = CartManagement::addItemsToCart(auth()->user()->id_user, $id_product);

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
        $products = Product::query()
            ->where('status', 'aktif')
            ->whereHas('productDetail', function($query) {
                $query->where('stock', '>', 0)
                      ->where('exp_date', '>', now());
            })
            // ->where('product_name', 'LIKE', $this->search . '%');
            ->search($this->search);
        
        // Filtering by categories
        if(!empty($this->selected_categories)) 
        {
            $products->when($this->selected_categories, function($query) {
                $query->whereHas('productDescription', function($que) {
                    $que->where('id_category', $this->selected_categories);
                });
            });
        }
        
        if(!empty($this->golonganObat)) 
        {
            $products->when($this->golonganObat, function($query) {
                $query->whereHas('productDescription', function($que) {
                    $que->where('golongan_obat', $this->golonganObat);
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
