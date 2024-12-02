<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellingInvoice extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'selling_invoice';
    protected $primaryKey = 'id_selling_invoice';
    public $incrementing = false;

    protected $fillable = [
        'id_selling_invoice',
        'invoice_code',
        'cashier_name',
        'id_customer',
        'recipient_name',
        'recipient_phone',
        'recipient_bank',
        'recipient_payment',
        'resep_dokter',
        'order_date',
        'order_completed',
        'refund_file',
        'reject_reason',
        'order_status'
    ];

    public function sellingInvoiceDetail() {
        return $this->hasMany(SellingInvoiceDetail::class, 'id_selling_invoice');
    }

    public function customer() {
        return $this->belongsTo(Customer::class, 'id_customer');
    }
}
