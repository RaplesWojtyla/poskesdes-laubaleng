<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Group;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LiveshowProduct extends Component
{
    protected $listeners = ["liveshow"];
    public $products;
    public $cari;
    public $filter;
    public $kategori;
    public $golongan;
    public $bentuk;
    public $minimum;
    public $maksimum;
    public $product_id;

    public function mount($filter, $kategori, $golongan, $bentuk, $minimum, $maksimum){
        $this->filter = $filter;
        $this->kategori = $kategori;
        $this->golongan = $golongan;
        $this->bentuk = $bentuk;
        $this->minimum = $minimum;
        $this->maksimum = $maksimum;
    }

    public function liveshow($cari){
        // dd($this->kategori);
        // dd($cari); 
        // filter kategori
        if ($this->kategori) {
            if (Category::on('user')->where('category', $this->kategori)->first() != NULL) {
                // ubah menjadi view
                $product = Product::on('user')->whereHas('description.category', function ($query) { 
                    $query->where('category', $this->kategori);
                });
            }else{
                $product = NULL;
            }
        }
        // akhir filter kategori

        // filter group
        if ($this->golongan) {
            if (Group::on('user')->where('group', $this->golongan)->first() != NULL) {
                // ubah menjadi view
                if($this->kategori) {
                    $product = $product->whereHas('description.group', function ($query)  {
                        $query->where('group', $this->golongan);
                    });
                }else{
                    $product = Product::on('user')->whereHas('description.group', function ($query)  { 
                        $query->where('group', $this->golongan);
                    });
                }
            }else{
                $product = NULL;
            }
        }
        // akhir filter group

        // filter unit
        if ($this->bentuk) {
            if (Unit::on('user')->where('unit', $this->bentuk)->first() != NULL) {
                // ubah menjadi view
                if($this->golongan) {
                    $product = $product->whereHas('description.unit', function ($query)  {
                        $query->where('unit', $this->bentuk);
                    });
                }elseif($this->kategori){
                    $product = $product->whereHas('description.unit', function ($query)  {
                        $query->where('unit', $this->bentuk);
                    });
                }else{
                    $product = Product::on('user')->whereHas('description.unit', function ($query)  { 
                        $query->where('unit', $this->bentuk);
                    });
                }
            }else{
                $product = NULL;
            }
        }
        // akhir filter unit

        // filter harga
        if ($this->maksimum || $this->minimum) {
            if ($this->maksimum) {
                if($this->golongan || $this->kategori || $this->bentuk) {
                    $product = $product->whereHas('detail', function($query)  {
                        $query->where('product_sell_price', '<=', $this->maksimum);
                    });
                }else{
                    $product = Product::on('user')->whereHas('detail', function($query)  {
                        $query->where('product_sell_price', '<=', $this->maksimum);
                    });
                }
            }
            
            if ($this->minimum){
                if($this->golongan || $this->kategori || $this->bentuk || $this->maksimum) {
                    $product = $product->whereHas('detail', function($query)  {
                        $query->where('product_sell_price', '>=', $this->minimum);
                    });
                }else{
                    $product = Product::on('user')->whereHas('detail', function($query)  {
                        $query->where('product_sell_price', '>=', $this->minimum);
                    });
                }
            }
        }
        // akhir filter harga

        // filter
        if ($this->filter) {
            if ($this->filter == "Popular") {
                if($this->golongan || $this->kategori || $this->bentuk || $this->maksimum || $this->minimum) {
                    $product = Product::on('user')->join('Selling_Invoice_Details', 'Products.product_name', '=', 'Selling_Invoice_Details.product_name')
                    ->whereIn('Products.product_name', $product->pluck('product_name')->toArray())
                    ->select('Products.*', DB::connection('user')->raw('COUNT(Selling_Invoice_Details.product_name) as jumlah_kemunculan'))
                    ->groupBy('Products.product_id', 'Products.description_id', 'Products.product_name')
                    ->orderBy('jumlah_kemunculan', 'DESC');
                }else{
                    $product = Product::on('user')->join('Selling_Invoice_Details', 'Products.product_name', '=', 'Selling_Invoice_Details.product_name')
                    ->select('Products.*', DB::connection('user')->raw('COUNT(Selling_Invoice_Details.product_name) as jumlah_kemunculan'))
                    ->groupBy('Products.product_id', 'Products.description_id', 'Products.product_name')
                    ->orderBy('jumlah_kemunculan', 'DESC');
                }
            }
            
            if ($this->filter == "Nama A - Z"){
                if($this->golongan || $this->kategori || $this->bentuk || $this->minimum || $this->maksimum) {
                    $product = $product->orderBy('product_name');
                }else{
                    $product = Product::on('user')->orderBy('product_name');
                }
            }

            if ($this->filter == "Nama Z - A"){
                if($this->golongan || $this->kategori || $this->bentuk || $this->minimum || $this->maksimum) {
                    $product = $product->orderBy('product_name', 'DESC');
                }else{
                    $product = Product::on('user')->orderBy('product_name', 'DESC');
                }
            }

            if ($this->filter == "Harga Tinggi - Rendah"){
                if($this->golongan || $this->kategori || $this->bentuk || $this->minimum || $this->maksimum) {
                    $product = $product->join('product_details', 'products.product_id', '=', 'product_details.product_id')
                    ->orderBy('product_details.product_sell_price', 'DESC')
                    ->select('products.*', 'product_details.product_sell_price')
                    ->distinct();
                }else{
                    $product = Product::on('user')->join('product_details', 'products.product_id', '=', 'product_details.product_id')
                    ->orderBy('product_details.product_sell_price', 'DESC')
                    ->select('products.*', 'product_details.product_sell_price')
                    ->distinct();
                }
            }

            if ($this->filter == "Harga Rendah - Tinggi"){
                if($this->golongan || $this->kategori || $this->bentuk || $this->minimum || $this->maksimum) {
                    $product = $product->join('product_details', 'products.product_id', '=', 'product_details.product_id')
                    ->orderBy('product_details.product_sell_price', 'ASC')
                    ->select('products.*', 'product_details.product_sell_price')
                    ->distinct();
                }else{
                    $product = Product::on('user')->join('product_details', 'products.product_id', '=', 'product_details.product_id')
                    ->orderBy('product_details.product_sell_price', 'ASC')
                    ->select('products.*', 'product_details.product_sell_price')
                    ->distinct();
                }
            }
        }
        // akhir filter

        // filter cari
            if($this->golongan || $this->kategori || $this->bentuk || $this->minimum || $this->maksimum || $this->filter) {
                $product = $product->where('Products.product_name', 'like' ,"%". $cari ."%");
            }else{
                $product = Product::on('user')->where('Products.product_name', 'like' ,"%". $cari ."%");
            }
        // akhir filter cari

        $this->products = $product->orderBy('product_status')->get();

        // dd($this->products);
    }
    
    public function counts($product) {
        $this->dispatch('count_cart', auth()->user()->user_id, $product['product_id'], 1);
    }

    public function render()
    {
        return view('livewire.liveshow-product');
    }
}
