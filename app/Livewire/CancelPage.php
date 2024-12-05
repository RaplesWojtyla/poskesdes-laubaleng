<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;

class CancelPage extends Component
{
    public function render(Request $request)
    {
        return view('livewire.cancel-page');
    }
}
