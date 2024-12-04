<?php

namespace App\Livewire\Partials;

use App\Helpers\CartManagement;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    public $id_customer;
    public $countItems = 0;

    public function mount()
    {
        if (auth()->check() && auth()->user()->role == 'user') 
        {
            $this->id_customer = auth()->user()->customer->id_customer;
            $this->countItems = count(CartManagement::getCartItems($this->id_customer));
        }
        else
        {
            $this->countItems = 0;
        }
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
