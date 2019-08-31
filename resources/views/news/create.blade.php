@extends('layouts.app')

@section('title')
    Create News
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                	<div class="row">
                		<div class="col-md-6">
                			<h2>Create News</h2>
                		</div>
                	</div>
                </div>

                <div class="card-body">
                    <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data" id="dynamic_form">
                        @csrf()
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" name="description" class="form-control" id="description" placeholder="Enter Description">
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea class="form-control" name="body" id="body" placeholder="Enter Body"></textarea>
                        </div>
                        <div class="form-group">
                        <label for="featured_image">Featured Image</label>
                        <input type="file" name="featured_image" class="form-control-file" id="featured_image">
                        </div>
                        @include('news.mult_upload_img')
                        <button type="submit" id="save" class="btn btn-primary">Submit</button>
                        <a href="/news" class="btn btn-danger">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
$(document).ready(function(){

 var count = 1;

 dynamic_field(count);

 function dynamic_field(number)
 {
  html = '<tr>';
        html += '<td><input type="file" name="gallery[]" class="form-control-fil" /></td>';
        html += '<td><img src="/img/featured/seed.jpg" width"100px" height="100px"></td>';
        if(number > 1)
        {
            html += '<td><button type="button" name="remove" id="remove" class="btn btn-danger remove">Remove</button></td></tr>';
            $('tbody').append(html);
        }
        else
        {   
            html += '<td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
            $('tbody').html(html);
        }
 }

 $(document).on('click', '#add', function(){
  count++;
  dynamic_field(count);
 });

 $(document).on('click', '.remove', function(){
  count--;
  $(this).closest("tr").remove();
 });

 // $('#dynamic_form').on('submit', function(event){
 //        event.preventDefault();
 //        $.ajax({
 //            url:'{{ route("news.store") }}',
 //            method:'post',
 //            data:$(this).serialize(),
 //            dataType:'json',
 //            beforeSend:function(){
 //                $('#save').attr('disabled','disabled');
 //            },
 //            success:function(data)
 //            {
 //                if(data.error)
 //                {
 //                    var error_html = '';
 //                    for(var count = 0; count < data.error.length; count++)
 //                    {
 //                        error_html += '<p>'+data.error[count]+'</p>';
 //                    }
 //                    $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
 //                }
 //                else
 //                {
 //                    dynamic_field(1);
 //                    $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
 //                }
 //                $('#save').attr('disabled', false);
 //            }
 //        })
 // });

});
</script>
@endpush
