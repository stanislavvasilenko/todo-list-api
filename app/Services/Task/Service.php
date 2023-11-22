<?php 

namespace App\Services\Task;

use App\Models\Task;
use App\Models\User;
use App\Models\Status;
use App\Models\Priority;
use App\Http\Filters\TaskFilter;
use Illuminate\Support\Facades\DB;
use App\Models\Enums\TaskStatusEnum;

class Service
{
   public function store($data) {


      try {
         DB::beginTransaction();

         $data['status_id'] = TaskStatusEnum::TODO->value;
         $data['user_id'] = auth('api')->user()->id;
         $task = Task::create($data);

         DB::commit();
      } catch (\Exception $e) {
         DB::rollback();
         return ["error_message" => $e->getMessage()];
      }
      
      return $task;
   }
   
   public function update($task, $data) {
      
      try {
         DB::beginTransaction();

         $children = $this->filterByStatus($task->children);
         if (count($children) > 0) {
            throw new \Exception("You cannot complete a task, it has unfinished subtasks");
         }

         $task->update($data);

         DB::commit();
      } catch (\Exception $e) {
         DB::rollback();
         return ["error_message" => $e->getMessage()];
      }

      return $task->fresh();
   }

   private function filterByStatus($collection, $layers = 0) {

      if (count($collection) === 0) return [];

      $filtered = $collection->filter(function ($value, $key) {
         return $value->status_id != TaskStatusEnum::DONE->value;
      });

      if (count($filtered) > 0) {
         foreach ($filtered as $subtask) {
            $child = $subtask->children;
            if (count($child) > 0) {
               $filtered = $this->filterByStatus($child, $layers + 1);
            }
         }
      }
      return $filtered;
   }

   public function delete(Task $task) {
      if ($task->status_id != TaskStatusEnum::DONE->value) {
         $task->delete();
         $result = "Task was successfully deleted";
      }
      else {
         $result = "You can not delete your task because its already done";
      }
      return $result;
   }

   public function filterTasks($data) {
      $user = User::find(auth('api')->user()->id);

      $filter = app()->make(TaskFilter::class, ['queryParams' => array_filter($data['filters'] ?? [])]);
      $tasks = $user->tasks()->filter($filter);

      if (!empty($data['sortBy'])) {
         foreach($data['sortBy'] as $column => $direction) {
            $tasks = $tasks->orderBy($column, $direction);
         }
      }

      return $tasks->get();
   }
}