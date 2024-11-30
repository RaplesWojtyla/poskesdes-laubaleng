<?php

namespace App\Livewire\Partials;

use App\Helpers\CartManagement;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    // public $id_customer = auth()->user()->customer->id_customer;
    public $id_customer = '4da66a8b-aee6-11ef-b717-c01850850fc6';
    public $countItems = 0;

    public function mount()
    {
        $this->countItems = count(CartManagement::getCartItems($this->id_customer));
    }

    #[On('updateCartCount')]
    public function updateCartCount($countItems)
    {
        $this->countItems = $countItems;
    }

    public function render()
    {
        return view('livewire.partials.navbar', [
            'title' => 'Poskesdes Laubaleng',
        ]);
    }
}
