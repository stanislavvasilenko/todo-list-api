<?php

namespace App\Http\Requests\Task;

use App\Models\Status;
use App\Models\Priority;
use App\Models\Enums\TaskStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $available_priorities = Priority::all()->pluck('id');
        return [
            'parent_task_id' => 'integer',
            'status_id' => 'integer|in:' . implode(',', [TaskStatusEnum::TODO->value, TaskStatusEnum::DONE->value]),
            'priority_id' => 'integer|in:' . implode(',', $available_priorities->all()),
            'title' => 'string',
            'description' => 'string',
            'completed_at' => 'date',
        ];
    }
}
