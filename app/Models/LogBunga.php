<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogBunga extends Model
{
    use HasFactory;

    protected $table = 'log_bunga';
    protected $primaryKey = 'id_log';

    protected $fillable = [
        'tanggal_log',
        'status_log'
    ];
}
