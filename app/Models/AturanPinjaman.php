<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AturanPinjaman extends Model
{
    use HasFactory;

    protected $table = 'aturan_pinjaman';
    protected $primaryKey = 'id_pinjaman';

    protected $fillable = [
        'pinjaman',
        'status_pinjaman',
    ];

    public function aturan()
    {
        return $this->hasOne(Aturan::class, 'id_pinjaman', 'id_pinjaman');
    }
}
