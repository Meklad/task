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
                        <div>
                            <h2>Edit: {{ $news->title }}</h2>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('news.update', $news->id) }}" method="post" enctype="multipart/form-data">
                        @csrf()
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title" value="{{ $news->title }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" name="description" class="form-control" id="description" placeholder="Enter Description" value="{{ $news->description }}">
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea class="form-control" name="body" id="body" placeholder="Enter Body">{{ $news->body }}</textarea>
                        </div>
                        <div class="form-group">
                        <label for="featured_image">Featured Image</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="file" name="featured_image" class="form-control-file" id="featured_image">

                                </div>
                                <div class="col-md-6">
                                    <img src="/img/featured/{{ $news->featured_image }}" width="100px" height="100px">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection