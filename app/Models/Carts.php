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
        'id_user',
        'id_product',
        'quantity'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function product() {
        return  $this->belongsTo(Product::class, 'id_product');
    }
}
