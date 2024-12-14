<?php

namespace App\Livewire\Cashier;

use App\Helpers\CartManagement;
use App\Models\Carts;
use App\Models\ProductDetail;
use App\Models\SellingInvoice;
use App\Models\SellingInvoiceDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LiveCart extends Component
{
    public $id_user;
    public $id_product;
    public $cartItems;
    public $cart;
    public $totalProducts = 0;
    public $quantity;
    protected $listeners = ['productAddedToCart', 'decrementButton', 'incrementButton'];

    public function mount() 
    {
        $this->cartItems = Carts::where('id_user', auth()->user()->id_user)->get();
    }

    public function productAddedToCart($user, $product)
    {
        $existingCart = Carts::where('id_user', $user)
                        ->where('id_product', $product)
                        ->first();

        if (!$existingCart) 
        {
            Carts::create([
                "id_cart" => \Illuminate\Support\Str::uuid(),
                'id_user' => auth()->user()->id_user,
                'id_product' => $this->product,
                'quantity' => 1
            ]);
        }
        
        $this->cartItems = Carts::where('id_user', $user)->get();
    }


    public function decrementButton($product) 
    {
        $this->cartItems = CartManagement::decreaseQuantity(auth()->user()->id_user, $product['id_product']);
    }

    public function incrementButton($product) 
    {
        $this->cartItems = CartManagement::increaseQuantity(auth()->user()->id_user, $product['id_product']);
    }

    public function checkout()
    {
        DB::beginTransaction();
        try {
            $cartItems = CartManagement::getCartItems(auth()->user()->id_user);
            $totalPrice = CartManagement::calcTotalPriceAllCartItems($cartItems);
            $id_selling_invoice = \Illuminate\Support\Str::uuid();

            $lastInvoice = SellingInvoice::latest()->first();
            $currInvoice = $lastInvoice ? (int)substr($lastInvoice->invoice_code, 4) + 1 : 1;
            $invoiceCode = 'INV-' . str_pad($currInvoice, 5, '0', STR_PAD_LEFT);

            SellingInvoice::create([
                'id_selling_invoice' => $id_selling_invoice,
                'invoice_code' => $invoiceCode,
                'id_user' => auth()->user()->id_user,
                'cashier_name' => auth()->user()->name,
                'recipient_payment' => 'Cash',
                'payment_status' => 'Pembayaran Berhasil',
                'order_status' => 'Offline',
                'order_date' => now(),              
                'order_completed' => now(),                      
            ]);

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
            }
            CartManagement::clearCartItems(auth()->user()->id_user);
            
            DB::commit();
            return redirect()->back()->with('success', 'Pembayaran Berhasil');
        } 
        catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()->with('error', 'Transaksi Gagal');
            // throw $e;
        }
    }

    public function clearCart()
    {
        $this->cartItems = CartManagement::clearCartItems(auth()->user()->id_user);

        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.cashier.live-cart');
    }
}
