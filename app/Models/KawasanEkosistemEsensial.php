<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KawasanEkosistemEsensial extends Model
{
    use HasFactory;

    protected $table = 'kawasan_ekosistem_esensials';
    protected $primaryKey = 'kes_id';

    protected $fillable = [
        'kes_nama',
        'kes_file',
        'kes_exp_date',
    ];

    public function getKesExpDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->isoFormat('dddd, D MMMM Y') : '';
    }
}
