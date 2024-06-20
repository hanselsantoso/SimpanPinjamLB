<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemegangSHU extends Model
{
    use HasFactory;
    protected $table = 'pemegang_shu';
    protected $primaryKey = 'id_pemegang_shu';

    protected $fillable = [
        'nama_pemegang_shu',
        'status_pemegang_shu',
    ];


    public function getTanggal($value)
    {
        return $value ? $this->asDateTime($value)->format('d-m-Y') : null;
    }
}
