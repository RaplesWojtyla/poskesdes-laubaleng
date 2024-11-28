<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Home Page - Poskesdes Laubaleng')]
class HomePage extends Component
{
    public function render()
    {
        $categories = Category::all();
        return view('livewire.home-page', [
            'categories' => $categories,
        ]);
    }
}
