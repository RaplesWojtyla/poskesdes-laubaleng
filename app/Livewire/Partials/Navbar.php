<?php

namespace App\Livewire\Partials;

use App\Helpers\CartManagement;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    public $id_user;
    public $countItems = 0;

    public function mount()
    {
        if (auth()->check() && auth()->user()->role == 'user') 
        {
            $this->id_user = auth()->user()->id_user;
            $this->countItems = count(CartManagement::getCartItems($this->id_user));
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
            'title' => 'Poskesdes Lau Baleng',
        ]);
    }
}
