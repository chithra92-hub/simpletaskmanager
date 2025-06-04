@extends('Tasks.layout')
     
@section('content')
<div class="card mt-5">
  <h2 class="card-header">CRUD with Image Upload</h2>
  <div class="card-body">
          
        @session('success')
            <div class="alert alert-success" role="alert"> {{ $value }} </div>
        @endsession
  
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-success btn-sm" href="{{ route('tasks.create') }}"> <i class="fa fa-plus"></i> Create New Product</a>
        <a class="btn btn-success btn-sm" href="{{ route('dashboard') }}"> <i class="fa fa-arrow-left"></i> Back</a>
        </div>
  
        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th width="80px">No</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th width="250px">Action</th>
                </tr>
            </thead>
  
            <tbody>
            @forelse ($tasks as $task)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td><img src="{{asset('/images').'/'.$task->image}}" width="80" height="50" class="image"></td>
             <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>
                        <form action="{{ route('tasks.destroy',$task->id) }}" method="POST">
             
                            <a class="btn btn-info btn-sm" href="{{ route('tasks.show',$task->id) }}"><i class="fa-solid fa-list"></i> Show</a>
              
                            <a class="btn btn-primary btn-sm" href="{{ route('tasks.edit',$task->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
             
                            @csrf
                            @method('DELETE')
                
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">There are no data.</td>
                </tr>
            @endforelse
            </tbody>
  
        </table>
        
        {!! $tasks->withQueryString()->links('pagination::bootstrap-5') !!}
  
  </div>
</div>      
@endsection