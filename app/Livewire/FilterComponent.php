<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Arr;

class FilterComponent extends Component
{
    public $filterOptions = [];
    public $selectedOptions = [];
    public $filteredProducts = [];

    protected $listeners = ['filterUpdated' => 'updateFilterOptions'];

    public function mount($filterOptions)
    {
        $this->filterOptions = $filterOptions;
        $this->updateFilteredProducts(); // Initialize with all products
    }

    public function render()
    {
        return view('livewire.filter-component');
    }

    public function filter($filter, $option)
    {
        $this->selectedOptions[$filter][] = $option;
        $this->updateFilteredProducts();
    }

    public function removeFilter($filter, $option)
    {
        $this->selectedOptions[$filter] = array_diff($this->selectedOptions[$filter], [$option]);
        $this->updateFilteredProducts();
    }

    private function updateFilteredProducts()
    {
        if (empty($this->selectedOptions)) {
            $this->filteredProducts = Product::all();
        } else {
            $query = Product::query();

            foreach ($this->selectedOptions as $filter => $options) {
                foreach ($options as $option) {
                    $filterArray = json_decode($option, true);
                    if ($filterArray) {
                        $query->whereIn($filter, Arr::flatten([$filterArray[$filter]]));
                    }
                }
            }

            $this->filteredProducts = $query->get();
        }
    }

    public function updateFilterOptions($filterOptions)
    {
        $this->filterOptions = $filterOptions;
        $this->updateFilteredProducts();
    }
}
