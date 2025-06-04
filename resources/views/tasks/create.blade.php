@extends('tasks.layout')
  
@section('content')
<div class="card mt-5">
  <h2 class="card-header">Add Task Details</h2>
  <div class="card-body">
  <div id="msg"></div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ route('tasks.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
  
    <form action="{{ route('tasks.store') }}" method="POST" id="addtask" enctype="multipart/form-data">
        @csrf
  
        <div class="mb-3">
            <label for="inputName" class="form-label"><strong>Title:</strong></label>
            <input 
                type="text" name="title"  class="form-control" id="title">
            
        </div>
  
        <div class="mb-3">
            <label for="inputDetail" class="form-label"><strong>Description:</strong></label>
            <textarea 
                class="form-control" style="height:150px" name="description" id="description"></textarea>
           
        </div>

        <div class="mb-3">
            <label for="inputImage" class="form-label"><strong>Image:</strong></label>
            <input 
                type="file" name="image" class="form-control " id="image">
            
        </div>
         <div class="mb-3">
            <label for="iscompleted" class="form-label"><strong>Is Completed:</strong></label>
            <br><input type="radio" id="yes" name="complete" value="1">
                  <label for="Yes">Yes</label>
                  <input type="radio" id="no" name="complete" value="0" checked>
                  <label for="no">No</label><br>
        </div>

         <div class="mb-3">
            <label for="duedate" class="form-label"><strong>Due Date:</strong></label>
            <input 
                type="date" name="duedate" class="form-control" id="duedate">
        </div>


        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
    </form>
  
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready( function () {
    //success message close icon
 $(".alert").click(function() {
  $(".alert").alert('close');

 });
    //create button function
$(document).on('submit','#addtask',function(e){
            e.preventDefault();
            
            let form_data = new FormData(this);
            $(".error-message").remove();
           
$.ajax({
                url:"{{ route('tasks.store') }}",
                method:'post',
                data:form_data,
                cache:false,
                contentType: false,
                processData: false,
                success:function(response){
                   
                     
                    if(response.errors)
        {
            // alert(response.errors);
            $.each(response.errors,function(key,value)
            {
                $("#"+key).after('<div class="text-danger error-message">'+value[0]+'</div>');
            })
        }
        else
        {
         
          $('#msg').html('<div class="alert alert-success alert-dismissible fade show" role="alert">'+response.success+'&nbsp;&nbsp;<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
             $('#addtask')[0].reset();
        }
                },
                error:function(error){
                    //let error = err.responseJSON;
                   // $('.error_success_msg_container').html('');
                    $.each(error.errors, function (index, value) {
                        $('#msg').append('<p class="text-danger">'+value+'<p>');
                    });
                    
                }
            });
});



} );
  </script>
</div>
@endsection