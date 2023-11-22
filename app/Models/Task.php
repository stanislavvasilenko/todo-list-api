<?php

namespace App\Models;

use App\Models\User;
use App\Models\Status;
use App\Models\Priority;
use App\Models\Traits\Filterable;
use App\Models\Enums\TaskStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;

    protected $guarded = false;
    protected $table = 'tasks';

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => TaskStatusEnum::class,
    ];

    // public function status() : BelongsTo
    // {
    //     return $this->belongsTo(Status::class, 'status_id', 'id');
    // }

    public function priority() : BelongsTo
    {
        return $this->belongsTo(Priority::class, 'priority_id', 'id');
    }

    public function user() : HasOne
    {
        return $this->hasOne(User::class, 'task_id', 'user_id');
    }

    public function parent() : BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_task_id');
    }

    public function children() : HasMany
    {
        return $this->hasMany(self::class, 'parent_task_id');
    }
}
