<?php

namespace App\Livewire;

use App\Http\Controllers\GetMidtransRespons;
use App\Models\SellingInvoice;
use Illuminate\Http\Request;
use Livewire\Component;

class SuccessPage extends Component
{
    public function render(Request $request)
    {
        $transaction = SellingInvoice::where('invoice_code', $request->order_id)->first();
        $totalPrice = $transaction->getTotalInvoicePrice();

        return view('livewire.success-page', [
            'transaction' => $transaction,
            'totalPrice' => $totalPrice,
            'snapToken' => $transaction->snap_token,
        ]);
    }
}
