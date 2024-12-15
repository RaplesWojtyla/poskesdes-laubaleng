<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\SellingInvoice;
use App\Models\SellingInvoiceDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Checkout - Poskesdes Lau Baleng')]
class CheckoutPage extends Component
{
    use WithFileUploads;
    public $recipientName;
    public $phone;
    public $paymentMethod;
    public $resepDokter;
    public $requiresPrescription = false;

    public function mount()
    {
        $this->recipientName = auth()->user()->name;
        $this->phone = auth()->user()->customer->no_telp;
    }

    public function booking()
    {
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $this->validate([
            'recipientName' => 'required',
            'phone' => 'required',
            'paymentMethod' => 'required',
            'resepDokter' => $this->requiresPrescription ? 'required' : 'nullable',
        ], [
            'recipientName.required' => 'Nama Penerima wajib diisi.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'paymentMethod.required' => 'Metode pembayaran wajib dipilih.',
            'resepDokter.required' => 'Resep dokter wajib diunggah.',
        ]);
        
        DB::beginTransaction();
        try {
            $cartItems = CartManagement::getCartItems(auth()->user()->id_user);
            $totalPrice = CartManagement::calcTotalPriceAllCartItems($cartItems);
            $id_selling_invoice = \Illuminate\Support\Str::uuid();

            $lastInvoice = SellingInvoice::latest()->first();
            $currInvoice = $lastInvoice ? (int)substr($lastInvoice->invoice_code, 4) + 1 : 1;
            $invoiceCode = 'INV-' . str_pad($currInvoice, 5, '0', STR_PAD_LEFT);
            // $invoiceCode = 'INV-00054';

            $resepDokterPath = isset($this->resepDokter) ? $this->resepDokter->store('resep_dokter', 'public') : '';

            SellingInvoice::create([
                'id_selling_invoice' => $id_selling_invoice,
                'invoice_code' => $invoiceCode,
                'id_user' => auth()->user()->id_user,
                'recipient_name' => $this->recipientName,
                'recipient_phone' => $this->phone,
                'recipient_payment' => $this->paymentMethod,
                'resep_dokter' => $resepDokterPath,
                'payment_status' => 'Menunggu Pembayaran',
                'order_date' => now(),                                      
            ]);

            $params = array(
                'transaction_details' => array(
                    'order_id' => $invoiceCode,
                    'gross_amount' => $totalPrice,
                ),
                'enabled_payments' => array($this->paymentMethod),
                'customer_details' => array(
                    'first_name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                    'phone' => auth()->user()->customer->no_telp,
                ),
            );

            foreach ($cartItems as $cartItem) {
                SellingInvoiceDetail::create([
                    'id_selling_invoice' => $id_selling_invoice,
                    'product_name' => $cartItem->product->product_name,
                    'product_type' => $cartItem->product->productDescription->type,
                    'quantity' => $cartItem->quantity,
                    'product_sell_price' => $cartItem->product->product_sell_price,
                ]);

                ProductDetail::where('id_product', $cartItem->id_product)
                    ->where('stock', '>', 0)
                    ->orderBy('exp_date')
                    ->first()
                    ->decrement('stock', $cartItem->quantity);

                $params['item_details'][] = [
                    'id' => $cartItem->id_product,
                    'price' => $cartItem->product->product_sell_price,
                    'quantity' => $cartItem->quantity,
                    'name' => $cartItem->product->product_name,
                ];
            }
            
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            SellingInvoice::where('id_selling_invoice', $id_selling_invoice)
                ->update(['snap_token' => $snapToken]);

            
            CartManagement::clearCartItems(auth()->user()->id_user);
            
            DB::commit();
            return redirect()->to('/success?order_id=' . $invoiceCode);
        } 
        catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', $e->getMessage());

            throw $e;
        }
    }

    public function render()
    {
        $cartItems = CartManagement::getCartItems(auth()->user()->id_user);
        $totalPrice = CartManagement::calcTotalPriceAllCartItems($cartItems);
        $this->requiresPrescription = $cartItems->contains(function ($cartItem) {
            return $cartItem->product->productDescription->type === 'Resep dokter';
        });

        return view('livewire.checkout-page', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
            'requiresPrescription' => $this->requiresPrescription,
        ]);
    }
}
