<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class simpanan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
protected $table = 'simpanan';

    protected $fillable = [
        'id_user',
        'id_admin',
        'tanggal',
        'nominal',
        'status',
    ];

    protected $status = array(
        '0' => 'Simpanan Pokok',
        '1' => 'Simpanan Bulanan',
    );

    public function getStatusSimpanan($value)
    {
        return $this->status[$value];
    }

    public function getTanggal($value)
{
    return $value ? $this->asDateTime($value)->format('d-m-Y') : null;
}
}
