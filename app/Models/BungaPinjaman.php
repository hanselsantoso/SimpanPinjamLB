<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BungaPinjaman extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'aturan_bunga_pinjaman';

    protected $fillable = [
        'bunga_pinjaman',
        'status',
    ];

    public function aturan()
    {
        return $this->hasOne(Aturan::class, 'id','id_bunga_pinjaman');
    }
}
