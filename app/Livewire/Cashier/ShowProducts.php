<?php

namespace App\Livewire\Cashier;

use App\Models\Carts;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Livewire\Component;
use Livewire\WithPagination;

class ShowProducts extends Component
{
    use WithPagination;

    public $search;
    public $categories;
    public $groups;
    public $units;
    public $product;

    public $selectedFilters = [];
    public $selectedUnit;
    public $selectedUnitName;
    public $selectedGroup;
    public $selectedGroupName;
    public $selectedCategory;
    public $selectedCategoryName;

    protected $listeners = ['filterChanged' => 'getFilteredProducts'];

    public function AddedToCart($product)
    {
        $existingCart = Carts::where('id_user', auth()->user()->id_user)
        ->where('id_product', $product['id_product'])
        ->first();

        if (!$existingCart) {
            Carts::create([
                "cart_id" => \Illuminate\Support\Str::uuid(),
                'id_user' => auth()->user()->id_user,
                'id_product' => $product['id_product'],
                'quantity' => 1
            ]);
        }
        $this->dispatch('productAddedToCart', auth()->user()->id_user, $product['id_product']);
    }

    public function search_product()
    {
        $filteredProducts = $this->getFilteredProducts();

        return $this->search
        ? ($filteredProducts
            ? $filteredProducts->where("product_name", "LIKE", "%" . $this->search . "%")->orderBy('status')->paginate(8)
            : Product::where("product_name", "LIKE", "%" . $this->search . "%")->orderBy('status')->paginate(8))
        : ($filteredProducts
            ? $filteredProducts->orderBy('status')->paginate(8)
            : Product::orderBy('status')->paginate(8));
    }

    public function applyFilter($filterType, $filterId)
    {
        $key = $filterType . '_' . $filterId;

        if (array_key_exists($key, $this->selectedFilters)) {
            unset($this->selectedFilters[$key]);
        } else {
            $this->selectedFilters[$key] = true;
        }

        $this->dispatch('filterChanged');
    }

    public function getFilteredProducts()
    {
        $filters = Product::query();

        foreach ($this->selectedFilters as $filterKey => $value) {
            list($filterType, $filterId) = explode('_', $filterKey);

            switch ($filterType) {
                case 'unit':
                    $filters->whereHas('productDescription.unit', function ($query) use ($filterId) {
                        $query->where('id_unit', $filterId);
                    });
                    break;

                case 'category':
                    $filters->whereHas('productDescription.category', function ($query) use ($filterId) {
                        $query->where('id_category', $filterId);
                    });
                    break;
            }
        }

        return $filters;
    }

    public function getFilterName($filterType, $filterId)
    {
        $filter = null;

        switch ($filterType) {
            case 'unit':
                $filter = Unit::find($filterId);
                break;

            case 'category':
                $filter = Category::find($filterId);
                break;
        }

        if ($filter) {
            return $filter->{$filterType}; 
        }

        return '';
    }

    public function clearFilter($filterType, $filterId)
    {
        $key = $filterType . '_' . $filterId;

        if (array_key_exists($key, $this->selectedFilters)) {
            unset($this->selectedFilters[$key]);
            $this->dispatch('filterChanged');
        }
    }


    public function render()
    {
        $product = $this->search_product();
        $this->categories = Category::orderBy('category')->get();
        $this->units = Unit::orderBy('unit')->get();

        return view('livewire.cashier.show-products', [
            'products' => $product ?? [],
            'categories' => $this->categories ?? [],
            'units' => $this->units ?? [],
            'groups' => $this->groups ?? [],
        ]);
    }
}
