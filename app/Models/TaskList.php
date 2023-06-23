<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $tasks
 */
class TaskList extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
