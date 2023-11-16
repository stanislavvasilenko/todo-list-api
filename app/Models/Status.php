<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $guarded = false;

    public const STATUS_TODO = 1;
    public const STATUS_DONE = 2;

    public function tasks() {
        return $this->hasMany(Task::class, 'task_id', 'id');
    }
}
