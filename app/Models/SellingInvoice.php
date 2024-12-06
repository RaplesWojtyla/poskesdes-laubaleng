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
        'recipient_payment',
        'resep_dokter',
        'order_date',
        'order_completed',
        'refund_file',
        'reject_reason',
        'payment_status',
        'order_status',
        'snap_token'
    ];

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            if ($model->isDirty('order_status') && $model->order_status !== 'Menunggu Pengambilan') {
                $model->order_completed = now();
                $model->cashier_name = auth()->user()->name; // Set the cashier_name to the current admin's name
            }
        });
    }

    public function sellingInvoiceDetail() {
        return $this->hasMany(SellingInvoiceDetail::class, 'id_selling_invoice');
    }

    public function customer() {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function getTotalInvoicePrice() {
        return $this->sellingInvoiceDetail->sum(function($detail) {
            return $detail->getTotalPrice();
        });
    }
}
