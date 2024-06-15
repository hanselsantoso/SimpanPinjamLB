<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman_D extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pinjaman_d';
    protected $table = 'pinjaman';

    protected $fillable = [
        'id_pinjaman_h',
        'id_admin',
        'tanggal',
        'pinjaman',
        'status_pinjaman_d',
    ];


    public function getTanggal($value)
    {
        return $value ? $this->asDateTime($value)->format('d-m-Y') : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pinjamanH()
    {
        return $this->belongsTo(Pinjaman_H::class, 'id_pinjaman_h','id_pinjaman_h');
    }
}
