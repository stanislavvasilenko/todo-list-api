<?php

namespace App\Http\Requests\Task;

use App\Models\Priority;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'parent_task_id' => '',
            'priority_id' => 'integer|in:' . implode(',', $available_priorities->all()),
            'title' => 'string',
            'description' => 'string',
        ];
    }
}
