<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Models\SellingInvoice;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('My Orders - Poskesdes Lau Baleng')]
class MyOrderPage extends Component
{
    use WithPagination;

    public function render()
    {
        $myOrders = SellingInvoice::where('id_user', auth()->user()->id_user)->latest()->paginate(10);
        // $totalPrice = CartManagement::calcTotalPriceAllCartItems($myOrders);
        return view('livewire.my-order-page', [
            'myOrders' => $myOrders    
        ]);
    }
}
