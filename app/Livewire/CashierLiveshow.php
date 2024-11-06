<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use App\Models\Group;
use App\Models\Unit;
use App\Models\Cart;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class CashierLiveshow extends Component
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
        $existingCart = Cart::on('cashier')->where('user_id', auth()->user()->user_id)
        ->where('product_id', $product['product_id'])
        ->first();

        if (!$existingCart) {
            Cart::on('cashier')->create([
                "cart_id" => Str::uuid(),
                'user_id' => auth()->user()->user_id,
                'product_id' => $product['product_id'],
                'quantity' => 1
            ]);
        }
        $this->dispatch('productAddedToCart', auth()->user()->user_id, $product['product_id']);
    }

    public function search_product()
    {
        $filteredProducts = $this->getFilteredProducts();

        return $this->search
        ? ($filteredProducts
            ? $filteredProducts->where("product_name", "LIKE", "%" . $this->search . "%")->orderBy('product_status')->paginate(8)
            : Product::on('cashier')->where("product_name", "LIKE", "%" . $this->search . "%")->orderBy('product_status')->paginate(8))
        : ($filteredProducts
            ? $filteredProducts->orderBy('product_status')->paginate(8)
            : Product::on('cashier')->orderBy('product_status')->paginate(8));
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
                    $filters->whereHas('description.unit', function ($query) use ($filterId) {
                        $query->where('unit_id', $filterId);
                    });
                    break;

                case 'group':
                    $filters->whereHas('description.group', function ($query) use ($filterId) {
                        $query->where('group_id', $filterId);
                    });
                    break;

                case 'category':
                    $filters->whereHas('description.category', function ($query) use ($filterId) {
                        $query->where('category_id', $filterId);
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
                $filter = Unit::on('cashier')->find($filterId);
                break;

            case 'group':
                $filter = Group::on('cashier')->find($filterId);
                break;

            case 'category':
                $filter = Category::on('cashier')->find($filterId);
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
        $this->categories = Category::on('cashier')->orderBy('category')->get();
        $this->groups = Group::on('cashier')->orderBy('group')->get();
        $this->units = Unit::on('cashier')->orderBy('unit')->get();

        return view('livewire.cashier-liveshow', [
            'products' => $product ?? [],
            'categories' => $this->categories ?? [],
            'units' => $this->units ?? [],
            'groups' => $this->groups ?? [],
        ]);
    }
}
