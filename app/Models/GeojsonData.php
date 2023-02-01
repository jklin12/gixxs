<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeojsonData extends Model
{
    use HasFactory;
    use Blameable;
    protected $table = 'geojson_data';
    protected $primaryKey = 'data_id';

    protected $fillable = [
        'data_name',
        'data_properties',
        'data_type',
        'data_coordinates',
    ];
}
