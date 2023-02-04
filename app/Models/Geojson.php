<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geojson extends Model
{
    use HasFactory;
    protected $table = 'geojson';
    protected $primaryKey = 'geojson_id';

    protected $fillable = [
        'category', 
        'geojson_name', 
        'geojson_color',
        'geojson_opacity',
    ];
}
