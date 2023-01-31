<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'display', 
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
}
