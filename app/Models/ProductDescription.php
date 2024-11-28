<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDescription extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'products_description';
    protected $primaryKey = 'id_product_description';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_product_description',
        'id_category',
        'id_unit',
        'golongan_obat',
        'id_supplier',
        'deskripsi',
        'indication',
        'side_effect',
        'dosage',
        'NIE',
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

    public function supplier() {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }
}
