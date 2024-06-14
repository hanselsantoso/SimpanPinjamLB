<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'simpanan';

    protected $fillable = [
        'id_simpanan_h',
        'id_admin',
        'tanggal',
        'nominal',
        'status',
    ];

    protected $status = array(
        '0' => 'Simpanan Pokok',
        '1' => 'Simpanan Bulanan',
        '2' => 'Bunga Bulanan',
    );

    public function getStatusSimpanan($value)
    {
        return $this->status[$value];
    }

    public function getTanggal($value)
    {
        return $value ? $this->asDateTime($value)->format('d-m-Y') : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function simpananH()
    {
        return $this->belongsTo(Simpanan_H::class, 'id_simpanan_h','id_simpanan_h');
    }
}
