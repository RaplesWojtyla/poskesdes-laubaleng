<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyingInvoices extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'buying_invoices';
    protected $primaryKey = 'id_buying_invoice';
    public $incrementing = false;

    protected $fillable = [
        'id_buying_invoice',
        'kode_faktur',
        'id_supplier',
        'order_date'
    ];

    public function buyingInvoiceDetail() {
        return $this->hasMany(BuyingInvoicesDetail::class, 'id_buying_invoice');
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }
}
