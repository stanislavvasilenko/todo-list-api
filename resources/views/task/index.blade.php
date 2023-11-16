@extends('layouts.main')
@section('content')
   <div class="mb-3">
      <a href="{{ route('task.create') }}" class="btn btn-primary">Create task</a>
   </div>
   <div class="">
      <table id="tasksTable" class="table table-striped table-bordered">
         <thead>
            <tr>
               <th>ID</th>
               <th>Status</th>
               <th class="orderable" id="priority_id" data-direction="{{ $direction1 ?? 'asc' }}" data-col="column1" data-dir="direction1">
                  <!-- <i class="bi bi-arrow-up-circle" data-type="priority_id" style="cursor:pointer;">a</i>  -->Priority
               </th>
               <th>Title</th>
               <th>Description</th>
               <th class="orderable" id="created_at" data-direction="{{ $direction2 ?? 'asc' }}" data-col="column2" data-dir="direction2">Created at
                  <!-- <i class="bi bi-arrow-up-circle" data-type="created_at" style="cursor:pointer;">a</i> -->
                  
               </th>
               <th class="orderable" id="completed_at" data-direction="{{ $direction3 ?? 'asc' }}" data-col="column3" data-dir="direction3" >Completed at
                  <!-- <i class="bi bi-arrow-up-circle" data-type="completed_at" style="cursor:pointer;">a</i> -->
                  
               </th>
               <th></th>
            </tr>
         </thead>
         <tbody>
         @if(empty($tasks))
            <p>Empty list</p>
         @else
            <tr>
               <form id="searchForm" method="get" action="{{ route('task.index') }}">
                  <td></td>
                  <td>
                     <div class="form-group">
                        <!-- <label for="status">Status</label> -->
                        <select class="form-select" id="status" name="status_id">
                           <option value="0">Select...</option>
                           @foreach($statuses as $status)
                           <option value="{{ $status->id }}" {{ isset($filters['status_id']) ? ($filters['status_id'] == $status->id ? 'selected' : '') : '' }}>{{ $status->title }}</option>
                           @endforeach
                        </select>
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <!-- <label for="priority">Priority</label> -->
                        <select class="form-select" id="priority" name="priority_id">
                           <option value="0">Select...</option>
                           @foreach($priorities as $priority)
                           <option value="{{ $priority->id }}" {{ isset($filters['priority_id']) ? ($filters['priority_id'] == $priority->id ? 'selected' : '' ) : '' }}>{{ $priority->title }}</option>
                           @endforeach
                        </select>
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <!-- <label for="title" class="form-label">Title</label> -->
                        <input type="text" class="form-control" name="title" id="title" value="{{ isset($filters['title']) ? $filters['title'] : '' }}">
                     </div>
                  </td>
                  <td>
                     <div class="form-group">
                        <!-- <label for="description" class="form-label">Description</label> -->
                        <textarea class="form-control" name="description" id="description">{{ isset($filters['description']) ? $filters['description'] : '' }}</textarea>
                     </div>
                  </td>
                  <td></td>
                  <td></td>
                  <td>
                     <button type="submit" class="btn btn-primary mt-3 search-button">Search</button>
                  </td>
               </form>
            </tr>
            @foreach($tasks as $task)
               <tr>
                  <td>{{ $task->id }}</td>
                  <td>{{ $task->status->title }}</td>
                  <td>{{ $task->priority->title }}</td>
                  <td>{{ $task->title }}</td>
                  <td>{{ $task->description }}</td>
                  <td>{{ $task->created_at }}</td>
                  <td>{{ $task->completed_at }}</td>
                  <td>
                     <a href="{{ route('task.show', $task->id) }}">Details</a>
                  </td>
               </tr>
            @endforeach
         @endif
         </tbody>
      </table>

      <div class="mt-3">
         {{ $tasks->withQueryString()->links() }}
      </div>
   </div>
@endsection