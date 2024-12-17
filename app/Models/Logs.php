<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'logs';
    protected $primaryKey = 'id_log';
    public $incrementing = false;

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
