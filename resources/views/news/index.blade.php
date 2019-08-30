@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                	<div class="row">
                		<div class="col-md-6">
                			<h2>News</h2>
                		</div>
                		<div class="col-md-6">
                			<a href="#" class="btn btn-primary float-right">Add News</a>
                		</div>
                	</div>
                </div>

                <div class="card-body">
					<table class="table table-striped">
						<thead>
						<tr>
						  <th scope="col">#</th>
						  <th scope="col">Title</th>
						  <th scope="col">Description</th>
						  <th scope="col">Featured</th>
						  <th scope="col">Options</th>
						</tr>
						</thead>
						<tbody>
							@foreach($news as $element)
						    <tr>
						      <th scope="row">{{ $loop->iteration }}</th>
						      <td>{{ $element->title }}</td>
						      <td>{{ $element->description }}</td>
						      <td>
						      	<img src="{{ $element->image_full_path }}" width="100px" height="100px">
						      </td>
						      <td>
						      	<a href="#" class="btn btn-success">Edit</a>
						      	<a href="#" class="btn btn-danger">Delete</a>
						      </td>
						    </tr>
						@endforeach
						</tbody>
					</table>
					<center>{{ $news->links() }}</center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection