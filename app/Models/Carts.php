<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'carts';
    protected $primaryKey = 'id_cart';
    public $timestamps = false;
    public $incrementing = false;
    
    protected $fillable = [
        'id_cart',
        'id_customer',
        'id_product',
        'quantity'
    ];

    public function customer() {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function product() {
        return  $this->belongsTo(Product::class, 'id_product');
    }
}
