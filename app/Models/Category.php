<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'categories';
    protected $primaryKey = 'id_category';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'id_category',
        'category',
        'category_img'
    ];

    public function productDescription() {
        return $this->hasMany(ProductDescription::class, 'id_category');
    } 
}
