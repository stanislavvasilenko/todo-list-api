<?php


namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class TaskFilter extends AbstractFilter
{
   public const TITLE = 'title';
   public const DESCRIPTION = 'description';
   public const PRIORITY_ID = 'priority_id';
   public const STATUS_ID = 'status_id';

   protected function getCallbacks(): array {
      return [
         self::TITLE => [$this, 'title'],
         self::DESCRIPTION => [$this, 'description'],
         self::PRIORITY_ID => [$this, 'priorityId'],
         self::STATUS_ID => [$this, 'statusId'],
      ];
   }

   public function title(Builder $builder, $value) {
      $builder->where('title', 'like', "%{$value}%");
   }

   public function description(Builder $builder, $value) {
      $builder->where('description', 'like', "%{$value}%");
   }

   public function priorityId (Builder $builder, $value) {
      $builder->where('priority_id', $value);
   }

   public function statusId (Builder $builder, $value) {
      $builder->where('status_id', $value);
   }
}