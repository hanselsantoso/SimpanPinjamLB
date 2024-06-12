<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iuran extends Model
{
    use HasFactory;

    protected $table = 'aturan_iuran';
    protected $primaryKey = 'id_iuran';

    protected $fillable = [
        'iuran',
        'status_iuran',
    ];

    public function aturan()
    {
        return $this->hasOne(Aturan::class, 'id_iuran','id_iuran');
    }
}
