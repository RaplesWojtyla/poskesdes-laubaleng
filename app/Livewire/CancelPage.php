<?php

namespace App\Livewire;

use App\Models\SellingInvoice;
use Illuminate\Http\Request;
use Livewire\Component;

class CancelPage extends Component
{
    public function render(Request $request)
    {
        if ($request->order_id !== null) 
        {
            $transaction = SellingInvoice::where('invoice_code', $request->order_id);
            $transaction->update([
                'payment_status' => 'Pembayaran Gagal',
                'order_completed' => now(),
                'order_status' => 'Dibatalkan',
            ]);
        }

        return view('livewire.cancel-page');
    }
}
