<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellingInvoiceDetail extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'selling_invoice_detail';
    protected $primaryKey = 'id_selling_invoice_detail';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_selling_invoice_detail',
        'id_selling_invoice',
        'product_name',
        'product_type',
        'product_sell_price',
        'quantity',
    ];

    public function sellingInvoice() {
        return $this->belongsTo(SellingInvoice::class, 'id_selling_invoice');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_name', 'product_name');
    }

    public function getTotalPrice() {
        return $this->product_sell_price * $this->quantity;
    }
}
