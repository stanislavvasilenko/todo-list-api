<?php

namespace App\Http\Resources\Task;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'parent_task_id' => $this->parent_task_id,
            'status_id' => $this->status_id,
            'priority_id' => $this->priority_id,
            'title' => $this->title,
            'description' => $this->description,
            'completed_at' => $this->completed_at,
            'created_at' => $this->created_at,
            'children' => $this->recursive($this->children),
        ];
    }

    private function recursive($collection, $layers = 0) {
        $array['children'] = $collection;
        if (count($array['children']) > 0) {
            foreach ($array['children'] as $subtask) {
                $child = $subtask->children;
                $this->recursive($child, $layers + 1);
            }
        }
        return $array['children'];
    }
}
