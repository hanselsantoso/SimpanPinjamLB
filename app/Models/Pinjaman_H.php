<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman_H extends Model
{
    use HasFactory;

    protected $table = 'pinjaman_h';
    protected $primaryKey = 'id_pinjaman_h';

    protected $fillable = [
        'total_pinjaman',
        'total_cicilan',
        'tanggal_pinjaman',
        'jatuh_tempo',
        'id_user',
        'status_pinjaman_h'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pinjamans()
    {
        return $this->hasMany(Pinjaman_D::class, 'id_pinjaman_h','id_pinjaman_h');
    }

    public function getTanggal($value)
    {
        return $value ? $this->asDateTime($value)->format('d-m-Y') : null;
    }

    public function getTotalPinjamanD()
    {
        return $this->pinjamans()->sum('pinjaman');
    }

    
}
