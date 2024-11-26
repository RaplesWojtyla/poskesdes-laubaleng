<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'customers';
    protected $primaryKey = 'id_customer';
    public $timestamps = false;

    protected $fillable = [
        'id_customer',
        'id_user',
        'no_telp'
    ];

    public function cart() {
        return $this->hasMany(Carts::class, 'id_customer');
    }

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function sellingInvoice() {
        return $this->hasMany(SellingInvoice::class, 'id_customer');
    }
}
