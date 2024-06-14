<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simpanan_H extends Model
{
    use HasFactory;

    protected $table = 'simpanan_h';
    protected $primaryKey = 'id_simpanan_h';

    protected $fillable = [
        'total_simpanan',
        'tanggal_simpanan',
        'id_user',
        'status_simpanan_h'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function simpanans()
    {
        return $this->hasMany(Simpanan::class, 'id_simpanan_h','id_simpanan_h');
    }
}
