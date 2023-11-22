<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Post(
 *  path="/api/tasks",
 *  summary="Create task",
 *  tags={"Task"},
 *  security={{ "bearerAuth": {} }},
 *  @OA\RequestBody(
 *      request="some request",
 *      @OA\JsonContent(
 *          allOf={
 *              @OA\Schema(
 *                  @OA\Property(property="parent_task_id", type="integer"),
 *                  @OA\Property(property="priority_id", type="integer"),
 *                  @OA\Property(property="title", type="string"),
 *                  @OA\Property(property="description", type="string"),
 *                  example={"parent_task_id": null, "priority_id": 3, "title": "Some title", "description": "Some description"}
 *              )
 *          }
 *      )
 *  ),
 * 
 *  @OA\Response(
 *      response=200,
 *      description="Ok",
 *      @OA\JsonContent(
 *          @OA\Property(property="data", type="object",
 *              @OA\Property(property="id", type="integer"),
 *              @OA\Property(property="status_id", type="integer"),
 *              @OA\Property(property="priority_id", type="integer"),
 *              @OA\Property(property="title", type="string"),
 *              @OA\Property(property="description",type="string"),
 *              example={"id": 1, "status_id": 1, "priority_id": 3, "title": "Some title", "description": "Some description"}
 *          ),
 *      ),
 *  ),
 * ),
 * 
 * @OA\Get(
 *  path="/api/tasks",
 *  summary="List of tasks",
 *  tags={"Task"},
 *  security={{ "bearerAuth": {} }},
 *  @OA\Parameter(
 *      name="filters[status_id]",
 *      description="filter by task status",
 *      in="query",
 *      required=false,
 *      @OA\Schema(
 *          type="integer"
 *      )
 *  ),
 *  @OA\Parameter(
 *      name="filters[priority_id]",
 *      description="filter by task priority",
 *      in="query",
 *      required=false,
 *      @OA\Schema(
 *          type="integer"
 *      )
 *  ),
 *  @OA\Parameter(
 *      name="filters[title]",
 *      description="filter by task title",
 *      in="query",
 *      required=false,
 *      @OA\Schema(
 *          type="string"
 *      )
 *  ),
 *  @OA\Parameter(
 *      name="filters[description]",
 *      description="filter by task description",
 *      in="query",
 *      required=false,
 *      @OA\Schema(
 *          type="string"
 *      )
 *  ),
 *  @OA\Parameter(
 *      name="sortBy",
 *      description="filter for sorting task by columns",
 *      in="query",
 *      required=false,
 *      @OA\Schema(
 *          type="object",
 *      ),
 *      example={{"priority_id":"asc"}}
 *  ),
 *  @OA\Response(
 *      response=200,
 *      description="Ok",
 *      @OA\JsonContent(
 *          @OA\Property(property="data", type="array", 
 *              @OA\Items(
 *                  @OA\Property(property="id", type="integer"),
 *                  @OA\Property(property="status_id", type="integer"),
 *                  @OA\Property(property="priority_id", type="integer"),
 *                  @OA\Property(property="title", type="string"),
 *                  @OA\Property(property="description",type="string"),
 *                  example={"id": 1, "status_id": 1, "priority_id": 3, "title": "Some title", "description": "Some description"}
 *              )
 *          ),
 *      ),
 *  ),
 * ),
 * 
 * @OA\Get(
 *  path="/api/tasks/{task}",
 *  summary="Get task info",
 *  tags={"Task"},
 *  security={{ "bearerAuth": {} }},
 *  @OA\Parameter(
 *      description="Task id",
 *      in="path",
 *      name="task",
 *      required=true,
 *      example=1
 *  ),
 * 
 *  @OA\Response(
 *      response=200,
 *      description="Ok",
 *      @OA\JsonContent(
 *          @OA\Property(property="data", type="object",
 *              @OA\Property(property="id", type="integer"),
 *              @OA\Property(property="status_id", type="integer"),
 *              @OA\Property(property="priority_id", type="integer"),
 *              @OA\Property(property="title", type="string"),
 *              @OA\Property(property="description",type="string"),
 *              example={"id": 1, "status_id": 1, "priority_id": 3, "title": "Some title", "description": "Some description"}
 *          ),
 *      ),
 *  ),
 * ),
 * 
 * @OA\Patch(
 *  path="/api/tasks/{task}",
 *  summary="Update task info",
 *  tags={"Task"},
 *  security={{ "bearerAuth": {} }},
 *  @OA\Parameter(
 *      description="Task id",
 *      in="path",
 *      name="task",
 *      required=true,
 *      example=1
 *  ),
 * 
 * @OA\RequestBody(
 *      request="some request",
 *      @OA\JsonContent(
 *          allOf={
 *              @OA\Schema(
 *                  @OA\Property(property="status_id", type="integer"),
 *                  @OA\Property(property="priority_id", type="integer"),
 *                  @OA\Property(property="title", type="string"),
 *                  @OA\Property(property="description", type="string"),
 *                  example={"status_id": 1, "priority_id": 3, "title": "Some title", "description": "Some description"}
 *              )
 *          }
 *      )
 *  ),
 * 
 *  @OA\Response(
 *      response=200,
 *      description="Ok",
 *      @OA\JsonContent(
 *          @OA\Property(property="data", type="object",
 *              @OA\Property(property="id", type="integer"),
 *              @OA\Property(property="status_id", type="integer"),
 *              @OA\Property(property="priority_id", type="integer"),
 *              @OA\Property(property="title", type="string"),
 *              @OA\Property(property="description",type="string"),
 *              example={"id": 1, "status_id": 1, "priority_id": 3, "title": "Some title", "description": "Some description"}
 *          ),
 *      ),
 *  ),
 *  @OA\Response(
 *      response=500,
 *      description="Ok",
 *      @OA\JsonContent(
 *          @OA\Property(property="message", type="object", example=""),
 *      ),
 *  ),
 * ),
 * 
 * @OA\Delete(
 *  path="/api/tasks/{task}",
 *  summary="Delete task",
 *  tags={"Task"},
 *  security={{ "bearerAuth": {} }},
 *  @OA\Parameter(
 *      description="Task id",
 *      in="path",
 *      name="task",
 *      required=true,
 *      example=1
 *  ),
 * 
 *  @OA\Response(
 *      response=200,
 *      description="Ok",
 *      @OA\JsonContent(
 *          @OA\Property(property="message", type="object", example="done"),
 *      ),
 *  ),
 * ),
 */
class TaskController extends Controller
{
    
}
