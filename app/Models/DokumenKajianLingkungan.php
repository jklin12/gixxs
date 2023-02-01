<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenKajianLingkungan extends Model
{
    use HasFactory;

    protected $table = 'dokumen_kajian_lingkungans';
    protected $primaryKey = 'dkl_id';

    protected $fillable = [
        'dkl_nama',
        'dkl_file',
        'dkl_exp_date',

    ];
}
