<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    protected $table = 'products_detail';
    protected $primaryKey = 'id_product_detail';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_product_detail',
        'id_product',
        'exp_date',
        'stock',
        'product_buy_price',
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
