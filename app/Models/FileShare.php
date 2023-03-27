<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FileShare extends Model
{
    use HasFactory;

    protected $table = 'file_shares';
    protected $primaryKey = 'file_share_id';

    protected $fillable = [
        'file_share_menu',
        'file_share_title',
        'file_share_file',
    ];

    public function menu(): HasOne
    {
        return $this->hasOne(FileMenu::class,'file_menu_id','file_share_menu');
    }

}
