<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Home Page - Poskesdes Lau Baleng')]
class HomePage extends Component
{
    public function render()
    {
        if (auth()->check() && auth()->user()->role == 'owner') 
        {
            abort(403);
        }

        $categories = Category::all();
        return view('livewire.home-page', [
            'categories' => $categories,
        ]);
    }
}
