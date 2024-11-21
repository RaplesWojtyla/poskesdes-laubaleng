<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'suppliers';
    protected $primaryKey = 'id_supplier';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_supplier',
        'supplier',
        'address',
        'no_telp'
    ];

    public function productDescription() {
        return $this->hasMany(ProductDescription::class, 'id_supplier');
    }
}
