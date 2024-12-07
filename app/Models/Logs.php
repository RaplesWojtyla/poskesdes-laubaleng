<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_log',
        'log_time',
        'invoice_code',
        'pelaku',
        'log_target',
        'log_description',
        'old_value',
        'new_value',
    ];
}
