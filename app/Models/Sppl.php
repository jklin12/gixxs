<?php

namespace App\Models;

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
    ];
}
