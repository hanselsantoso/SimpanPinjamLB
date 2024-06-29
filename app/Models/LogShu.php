<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogShu extends Model
{
    use HasFactory;

    protected $table = 'log_shu';
    protected $primaryKey = 'id_log_shu';

    protected $fillable = [
        'id_pemegang_shu',
        'shu',
        'tanggal',
        'status_log_shu'
    ];

    public function pemegangShu()
    {
        return $this->belongsTo(PemegangShu::class, 'id_pemegang_shu');
    }

    public function getTanggal($value)
    {
        return $value ? $this->asDateTime($value)->format('d-m-Y') : null;
    }
}
