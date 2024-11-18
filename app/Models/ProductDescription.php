<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDescription extends Model
{
    use HasFactory;

    protected $table = 'products_description';
    protected $primaryKey = 'id_product_description';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_product_description',
        'id_category',
        'id_unit',
        'deskripsi',
        'side_effect',
        'dosage',
        'type',
        'product_img'
    ];

    public function product() {
        return $this->hasOne(Product::class, 'id_product_description');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function unit() {
        return $this->belongsTo(Unit::class, 'id_unit');
    }
}
