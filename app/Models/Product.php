<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'products';
    protected $primaryKey = 'id_product';
    public $incrementing = false;

    protected $fillable = [
        'id_product',
        'product_name',
        'id_product_description',
        'product_sell_price',
        'status'
    ];

    public function productDetail() {
        return $this->hasMany(ProductDetail::class, 'id_product');
    }

    public function productDescription() {
        return $this->belongsTo(ProductDescription::class, 'id_product_description');
    }

    public function cart() {
        return $this->hasMany(Carts::class, 'id_product');
    }

    public function getTotalStockAttribute() {
        return $this->productDetail->sum('stock');
    }
}
