<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\SellingInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CancelPage extends Component
{
    public function render(Request $request)
    {
        if ($request->order_id !== null) 
        {
            $transaction = SellingInvoice::where('invoice_code', $request->order_id);
            
            foreach ($transaction->first()->sellingInvoiceDetail as $detail) 
            {
                $id_product = Product::where('product_name', $detail->product_name)->first()->id_product;

                DB::select('CALL stock_back(?, ?)', array($detail->quantity, $id_product));
            }

            $transaction->update([
                'payment_status' => 'Pembayaran Gagal',
                'order_completed' => now(),
                'order_status' => 'Dibatalkan',
                'reject_reason' => "Tidak melakukan pembayaran dalam batas waktu yang ditentukan."
            ]);
        }

        return view('livewire.cancel-page');
    }
}
