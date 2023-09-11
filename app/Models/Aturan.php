<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aturan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'aturan';

    protected $fillable = [
        'minimal_tabungan',
        'pinjaman',
        'status',
    ];
}
