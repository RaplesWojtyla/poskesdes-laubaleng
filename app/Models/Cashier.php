<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'cashiers';
    protected $primaryKey = 'id_cashier';
    public $timestamps = false;

    protected $fillable = [
        'id_cashier',
        'id_user',
        'cashier_name',
        'gender',
        'no_telp',
        'address'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }
}
