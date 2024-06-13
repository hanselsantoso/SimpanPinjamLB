<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bunga extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'aturan_bunga';

    protected $fillable = [
        'bunga',
        'status',
    ];

    public function aturan()
    {
        return $this->hasOne(Aturan::class, 'id','id_bunga');
    }
}
