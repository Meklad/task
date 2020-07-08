@extends('layouts.app')

@section('title')
  {{ $news->title }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                	<div class="row">
                		<div>
                			<h2>Title: {{ $news->title }}</h2>
                		</div>
                	</div>
                </div>

                <div class="card-body">
                    <dl class="dl-horizontal">
                      <dt>Title</dt>
                      <dd>{{ $news->title }}</dd>
                      <hr>
                      <dt>Published</dt>
                      <dd>{{ $news->created_at }}</dd>
                      <hr>
                      <dt>Author</dt>
                      <dd>{{ $news->author->name }}</dd>
                      <hr>
                      <dt>Description</dt>
                      <dd>{{ $news->description }}</dd>
                      <hr>
                      <dt>Body</dt>
                      <dd>{{ $news->body }}</dd>
                      <hr>
                      <dt>Featured Image</dt>
                      <dd>
                          <img src="/img/featured/{{ $news->featured_image }}" width="400px" height="250px">
                      </dd>
                    </dl>
                    <hr>
                    <a href="{{ route('news.edit', $news->id) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ route('news.blog', $news->id) }}" class="btn btn-info" target="_blank">Preview</a>
                    <a href="/news" class="btn btn-danger">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection