@extends('layouts.main')
@section('content')
<div class="">
   <form method="POST" action="{{ route('task.store') }}">
      @csrf
      <div class="form-group">
         <label for="priority">Priority</label>
         <select class="form-select" id="priority" name="priority_id">
            @foreach($priorities as $priority)
            <option value="{{ $priority->id }}" {{ old('priority_id') == $priority->id ? 'selected' : ''}}>{{ $priority->title }}</option>
            @endforeach
         </select>
      </div>
      <div class="form-group">
         <label for="title" class="form-label">Title</label>
         <input type="text" class="form-control" name="title" id="title" aria-describedby="title" value="{{ old('title') }}">
      
         @error('title')
         <p style="color:red;">{{ $message }}</p>
         @enderror
      </div>
      <div class="form-group">
         <label for="description" class="form-label">Description</label>
         <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>

         @error('description')
         <p style="color:red;">{{ $message }}</p>
         @enderror
      </div>
      <div class="">
      <label for="parent_task">Subtask of</label>
         <select class="form-select" id="parent_task" name="parent_task_id">
            <option value="0">Select...</option>
            @foreach($tasks as $task)
            <option value="{{ $task->id }}" {{ (old('parent_task_id') == $task->id) ? 'selected' : ''}}>{{ $task->title }}</option>
            @endforeach
         </select>
      </div>
      <button type="submit" class="btn btn-primary mt-3">Submit</button>
   </form>
</div>
@endsection