<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileMenu extends Model
{
    use HasFactory;

    protected $table = 'file_menus';
    protected $primaryKey = 'file_menu_id';

    protected $fillable = [
        'file_menu_title',
        'file_menu_file',
        'file_menu_display',
    ];

    public $timestamps = false;
}
