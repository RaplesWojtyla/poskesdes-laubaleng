<?php

namespace App\Livewire;

use App\Http\Controllers\GetMidtransRespons;
use App\Models\SellingInvoice;
use Illuminate\Http\Request;
use Livewire\Component;

class PaymentSuccessPage extends Component
{

    public function render(Request $request)
    {
        $Midtrans = new GetMidtransRespons();
        $respons = $Midtrans->getTransactionStatus($request->order_id);
 
        $transaction = SellingInvoice::where('invoice_code', $request->order_id);

        $totalPrice = $transaction->first()->sellingInvoiceDetail->sum(function ($item) {
            return $item->product_sell_price * $item->quantity;
        });
        
        if (($respons['transaction_status'] == 'settlement' || $request->transaction_status == 'settlement') && $transaction->first()->payment_status == 'Menunggu Pembayaran')
        {
            $transaction->update([
                'payment_status' => 'Pembayaran Berhasil',
                'order_status' => 'Menunggu Pengambilan',
                'order_completed' => now(),
            ]);
        }

        return view('livewire.payment-success-page', [
            'transaction' => $transaction->first(),
            'totalPrice' => $totalPrice
        ]);
    }
}
