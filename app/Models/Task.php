<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'is_done',
        'priority',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
}
