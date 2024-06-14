<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cicilan extends Model
{
    use HasFactory;

    protected $table = 'aturan_cicilan';
    protected $primaryKey = 'id_cicilan';

    protected $fillable = [
        'cicilan',
        'status_cicilan',
    ];

    public function aturan()
    {
        return $this->hasOne(Aturan::class, 'id_cicilan');
    }
}
