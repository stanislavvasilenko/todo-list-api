<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Task\CreateRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Http\Resources\Task\TaskResource;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $request->all();

        $tasks = $this->service->filterTasks($data);
        
        return TaskResource::collection($tasks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $data = $request->validated();

        $task = $this->service->store($data);

        return $task["error_message"] ?? TaskResource::make($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $response = Gate::inspect('view', $task);
        return $response->allowed() 
            ? TaskResource::make($task)
            : $response->message();

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Task $task)
    {
        $response = Gate::inspect('update', $task);
        if ($response->allowed()) {
            $data = $request->validated();

            $task = $this->service->update($task, $data);

            return $task["error_message"] ?? TaskResource::make($task);
        }
        else {
            return $response->message();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $response = Gate::inspect('delete', $task);

        if ($response->allowed()) {
            $result = $this->service->delete($task);

            return response()->json([
                'message' => $result,
            ]);
        }
        else {
            return $response->message();
        }
    }
}
