<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $path
 * @property string $preview_path
 */
class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'name',
        'preview_path',
        'filetype',
    ];
}
