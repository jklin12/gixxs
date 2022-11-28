<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeojsonCategory extends Model
{
    use HasFactory;
    use Blameable;

    protected $table = 'geojson_categories';
    protected $primaryKey = 'category_id';

    protected $fillable = [
        'category_name',
        'fill_color',
        'fill_opacity',
    ];
}
