<?php

namespace App\Models;

use App\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    use Blameable;
    protected $table = 'menus';
    protected $primaryKey = 'menu_id';

    protected $fillable = [
        'menu_order',
        'menu_name',
        'menu_show',
    ];
}
