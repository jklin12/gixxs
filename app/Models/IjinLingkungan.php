<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IjinLingkungan extends Model
{
    use HasFactory;

    protected $table = 'ijin_lingkungans';
    protected $primaryKey = 'il_id';

    protected $fillable = [
        'il_nama',
        'il_nib',
        'il_jenis_usaha',
        'il_penanggung_jawab',
        'il_jabatan',
        'il_alamat_pusat',
        'il_alamat_perwakilan',
        'il_alamat_cabang',
        'il_lokasi',
        'il_file',
        'il_exp_date',
        'il_file_small',
    ];

    public function getIlExpDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->isoFormat('dddd, D MMMM Y') : '';
    }
}
