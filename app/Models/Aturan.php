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
        'maximal_tabungan',
        'id_bunga',
        'id_bunga_pinjaman',
        'id_pinjaman',
        'id_cicilan',
        'id_iuran',
        'status',
    ];

    public function bunga()
    {
        return $this->belongsTo(Bunga::class, 'id_bunga','id');
    }

    public function bungaPinjaman()
    {
        return $this->belongsTo(BungaPinjaman::class, 'id_bunga_pinjaman','id');
    }

    public function pinjaman()
    {
        return $this->belongsTo(AturanPinjaman::class, 'id_pinjaman');
    }

    public function iuran()
    {
        return $this->belongsTo(Iuran::class, 'id_iuran');
    }

    public function cicilan()
    {
        return $this->belongsTo(Cicilan::class, 'id_cicilan');
    }


}
