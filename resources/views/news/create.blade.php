@extends('layouts.app')

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
                    <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data">
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
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="/news" class="btn btn-danger">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection