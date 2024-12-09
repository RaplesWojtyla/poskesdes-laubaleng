<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyingInvoicesDetail extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'buying_invoices_detail';
    protected $primaryKey = 'id_buying_invoice_detail';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_buying_invoice_detail',
        'id_buying_invoice',
        'product_name',
        'product_buy_price',
        'exp_date',
        'quantity',
    ];

    function buyingInvoice() {
        return $this->belongsTo(BuyingInvoices::class, 'id_buying_invoice');
    }
}
