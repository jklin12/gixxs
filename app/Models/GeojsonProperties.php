<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeojsonProperties extends Model
{
    use HasFactory;
    use Blameable;

    protected $table = 'geojson_properties';
    protected $primaryKey = 'prop_id';

    protected $fillable = [
        'geojson_id',
        'table_key',
    ];
}
