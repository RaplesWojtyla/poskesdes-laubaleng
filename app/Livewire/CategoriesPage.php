<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Category Page - Poskesdes Laubaleng')]
class CategoriesPage extends Component
{
    public function render()
    {
        $categories = Category::all();
        
        
        return view('livewire.categories-page', [
            'categories' => $categories,
        ]);
    }
}
