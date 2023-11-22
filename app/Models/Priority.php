<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Priority extends Model
{
    use HasFactory;

    protected $guarded = false;
    protected $table = "priorities";

    public function tasks() : HasMany
    {
        return $this->hasMany(Task::class, 'task_id', 'id');
    }
}
