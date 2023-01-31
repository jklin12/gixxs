<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'display',
        'file_small',
        'file',
    ];
    protected $casts = [
        'created_at' => "datetime:Y-m-d\TH:iPZ",
    ];

    public function getCreatedAtAttribute($date)
    {
        return $date ?   Carbon::parse($date)->isoFormat('dddd, D MMMM Y') : '';
    }
    
    public function getUpdatedAtAttribute($date)
    {
        return $date ?   Carbon::parse($date)->isoFormat('dddd, D MMMM Y') : '';
    }

    public function getDisplayAttribute($display)
    {
        return $this->attributes['display'] = $display ? 'Ya' : 'Tidak';
    }
    public function getFileAttribute($file)
    {
        return $this->attributes['display'] = $file ? '/storage/' . $file : '';
    }
}
