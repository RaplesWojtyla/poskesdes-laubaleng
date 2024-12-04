<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;

class CancelPage extends Component
{
    public function render(Request $request)
    {
        dd($request->all());
        return view('livewire.cancel-page');
    }
}
