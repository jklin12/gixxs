<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Proker extends Model
{
    use HasFactory;

    protected $primaryKey = 'proker_id';

    protected $fillable = [
        'ref_proker_id',
        'proker_title',
        'proker_body',
    ];

    public function ref(): HasOne
    {
        return $this->hasOne(RefProker::class,'ref_proker_id','ref_proker_id');
    }
}
