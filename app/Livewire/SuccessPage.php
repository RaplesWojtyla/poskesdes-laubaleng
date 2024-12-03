<?php

namespace App\Livewire;

use Livewire\Component;

class SuccessPage extends Component
{
    public $snapToken;

    public function mount()
    {
        $this->snapToken = session()->get('snap_token');
    }

    public function render()
    {
        return view('livewire.success-page', [
            'snapToken' => $this->snapToken,
        ]);
    }
}
