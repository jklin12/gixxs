<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sppl extends Model
{
    use HasFactory;

    protected $table = 'sppls';
    protected $primaryKey = 'sppl_id';

    protected $fillable = [
        'sppl_name',
        'sppl_file',
        'sppl_exp_date',
    ];

    public function getSpplExpDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->isoFormat('dddd, D MMMM Y') : '';
    }

}
