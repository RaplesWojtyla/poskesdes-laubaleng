<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\SellingInvoice;
use Livewire\Component;

class MyOrderDetailPage extends Component
{
    public $id_selling_invoice;

    public function mount($id_selling_invoice)
    {
        $this->id_selling_invoice = $id_selling_invoice;
    }

    public function render()
    {
        $orderDetail = SellingInvoice::find($this->id_selling_invoice);

        return view('livewire.my-order-detail-page', [
            'orderDetail' => $orderDetail
        ]);
    }
}
