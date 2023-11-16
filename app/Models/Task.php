<?php

namespace App\Models;

use App\Models\User;
use App\Models\Status;
use App\Models\Priority;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;

    protected $guarded = false;

    public function status() {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function priority() {
        return $this->belongsTo(Priority::class, 'priority_id', 'id');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_tasks', 'task_id', 'user_id');
    }

    public function parent() {
        return $this->belongsTo(self::class, 'parent_task_id');
    }

    public function children() {
        return $this->hasMany(self::class, 'parent_task_id');
    }
}
