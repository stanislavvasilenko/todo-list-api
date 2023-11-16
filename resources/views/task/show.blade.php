@extends('layouts.main')
@section('content')
   <div class="">
      @if($notification)
      <div class="notification-wrapper" style="padding:10px;margin-buttom:3px;border:1px solid #bb2d3b;border-radius:10px;background:#bb2d3b;color:white;">
         You have some undone subtasks so you can't change status of current task to "Done"
      </div>
      @endif
      <div class="">
         {{ $task->id }}. {{ $task->title }}
      </div>
      <div class="">
         {{ $task->description }}
      </div>
      <div class="">
         <a href="{{ route('task.edit', $task->id) }}">Edit</a>
      </div>
      @if ($task->status_id != 2)
      <div class="">
         <form action="{{ route('task.destroy', $task->id )}}" method="post">
            @csrf
            @method('delete')
            <input type="submit" class="btn btn-danger" value="Delete">
         </form>
      </div>
      @endif
      <div class="">
         <a href="{{ route('task.index') }}">Back</a>
      </div>
      @if(!empty($taskList))
      <div class="">
         <label for="">Subtasks</label>
         <div class="">
            <table id="tasksTable" class="table table-striped table-bordered">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Status</th>
                     <th>Priority</th>
                     <th>Title</th>
                     <th>Description</th>
                     <th>Created at</th>
                     <th>Completed at</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($taskList as $subtask)
                     <tr>
                        <td>{{ $subtask->id }}</td>
                        <td>{{ $subtask->status->title }}</td>
                        <td>{{ $subtask->priority->title }}</td>
                        <td>{{ $subtask->title }}</td>
                        <td>{{ $subtask->description }}</td>
                        <td>{{ $subtask->created_at }}</td>
                        <td>{{ $subtask->completed_at }}</td>
                        <td>
                           <a href="{{ route('task.show', $subtask->id) }}">Details</a>
                        </td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
            
         </div>
      </div>
      @endif
   </div>
@endsection