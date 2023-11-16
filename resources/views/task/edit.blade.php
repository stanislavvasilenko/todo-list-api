@extends('layouts.main')
@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
@section('content')
<div class="">
   <form method="POST" action="{{ route('task.update', $task->id) }}">
      @csrf
      @method('patch')
      <div class="form-group">
         <label for="status">Status</label>
         <select class="form-select" id="status" name="status_id">
            @foreach($statuses as $status)
            <option value="{{ $status->id }}" {{ $task->status_id == $status->id ? 'selected' : '' }}>{{ $status->title }}</option>
            @endforeach
         </select>
      </div>
      <div class="form-group">
         <label for="priority">Priority</label>
         <select class="form-select" id="priority" name="priority_id">
            @foreach($priorities as $priority)
            <option value="{{ $priority->id }}" {{ $task->priority_id == $priority->id ? 'selected' : '' }}>{{ $priority->title }}</option>
            @endforeach
         </select>
      </div>
      <div class="form-group">
         <label for="title" class="form-label">Title</label>
         <input type="text" class="form-control" name="title" id="title" aria-describedby="title" value="{{ $task->title }}">
      
         @error('title')
         <p style="color:red;">{{ $message }}</p>
         @enderror
      </div>
      <div class="form-group">
         <label for="description" class="form-label">Description</label>
         <textarea class="form-control" name="description" id="description">{{ $task->description }}</textarea>

         @error('description')
         <p style="color:red;">{{ $message }}</p>
         @enderror
      </div>
      <div class="form-group">
         <label for="completed_at" class="form-label">Completed At</label>
         <input type="datetime-local" class="form-control" name="completed_at" id="completed_at" aria-describedby="completed_at" value="{{ $task->completed_at }}">
      
         @error('completed_at')
         <p style="color:red;">{{ $message }}</p>
         @enderror
      </div>
      <button type="submit" class="btn btn-primary mt-3">Submit</button>
   </form>
</div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
   flatpickr("input[type=datetime-local]", {
      enableTime: true,
      maxDate: "today"
   });
</script>
@endpush