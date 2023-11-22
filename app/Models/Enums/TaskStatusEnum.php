<?php

namespace App\Models\Enums;

enum TaskStatusEnum: int
{
   case TODO = 1;
   case DONE = 2;
}