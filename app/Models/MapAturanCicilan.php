<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapAturanCicilan extends Model
{
    use HasFactory;

    protected $table = 'map_aturan_cicilan';
    protected $primaryKey = 'id_map';

    protected $fillable = [
        'id_aturan',
        'id_cicilan',
        'status_map',
    ];

    public function aturan()
    {
        return $this->belongsTo(Aturan::class, 'id_aturan');
    }

    public function cicilan()
    {
        return $this->belongsTo(Cicilan::class, 'id_cicilan');
    }
}
