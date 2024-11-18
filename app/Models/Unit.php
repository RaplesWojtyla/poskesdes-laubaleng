<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'units';
    protected $primaryKey = 'id_unit';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_unit',
        'unit'
    ];

    public function productDescription() {
        return $this->hasMany(ProductDescription::class, 'id_unit');
    }
}
