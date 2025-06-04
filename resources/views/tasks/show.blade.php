@extends('tasks.layout')
   
@section('content')
<div class="card mt-5">
  <h2 class="card-header">Show Task Details</h2>
  <div class="card-body">
  
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ route('tasks.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
  
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong> 
                {{ $tasks->title }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Description:</strong> 
                {{ $tasks->description }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Due Date:</strong> 
                {{ \Carbon\Carbon::createFromFormat('Y-m-d', $tasks->due_date)->format('d-m-Y') }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Is Completed:</strong> 
                
                
               @if ($tasks->is_completed)
        <span style="color: green;">Yes</span>
    @else
        <span style="color: red;">No</span>
    @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Image:</strong><br/>
                <img src="{{asset('/images').'/'.$tasks->image}}" width="500px">
            </div>
        </div>
        
    </div>
  
  </div>
</div>
@endsection