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
    ];

    public function sellingInvoice() {
        return $this->belongsTo(SellingInvoice::class, 'id_selling_invoice');
    }
}
