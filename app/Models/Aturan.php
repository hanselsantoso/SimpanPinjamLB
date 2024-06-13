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
        'id_pinjaman',
        'id_iuran',
        'status',
    ];

    public function bunga()
    {
        return $this->belongsTo(Bunga::class, 'id_bunga','id');
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
        return $this->hasOne(Cicilan::class, 'id_cicilan');
    }


}
