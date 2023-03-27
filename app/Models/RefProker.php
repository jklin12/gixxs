<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefProker extends Model
{
    use HasFactory;

    protected $primaryKey = 'ref_proker_id';

    protected $fillable = [
        'ref_proker_name',
    ];

    public $timestamps = false;
}
