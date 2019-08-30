@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
			@if (Session::has('success_message'))
				<div class="alert alert-info">{{ Session::get('success_message') }}</div>
			@endif
            <div class="card">
                <div class="card-header">
                	<div class="row">
                		<div class="col-md-6">
                			<h2>News</h2>
                		</div>
                		<div class="col-md-6">
                			<a href="/news/create" class="btn btn-primary float-right">Add News</a>
                		</div>
                	</div>
                </div>

                <div class="card-body">
					<table class="table table-striped">
						<thead>
						<tr>
						  <th scope="col">#</th>
						  <th scope="col">Title</th>
						  <th scope="col">Featured</th>
						  <th scope="col">Publish At</th>
						  <th scope="col">Options</th>
						</tr>
						</thead>
						<tbody>
							@foreach($news as $element)
						    <tr>
						      <th scope="row">{{ $loop->iteration }}</th>
						      <td>{{ $element->title }}</td>
						      <td>
						      	<img src="/img/featured/{{ $element->featured_image }}" width="100px" height="100px">
						      </td>
						      <td>{{ $element->created_at }}</td>
						      <td>
						      	<a href="{{ route('news.edit', $element->id) }}" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						      	<a href="{{ route('news.show', $element->id) }}" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i></a>
								  <form id="delete-form" method="POST" action="{{ route('news.destroy', $element->id) }}">
								    {{ csrf_field() }}
								    {{ method_field('DELETE') }}

								    <div class="form-group">
								    	<button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
								    </div>
								  </form>
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