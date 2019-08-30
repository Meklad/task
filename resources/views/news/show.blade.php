@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                	<div class="row">
                		<div>
                			<h2>Show: {{ $news->title }}</h2>
                		</div>
                	</div>
                </div>

                <div class="card-body">
                    <dl class="dl-horizontal">
                      <dt>Title</dt>
                      <dd>{{ $news->title }}</dd>
                      <dt>Author</dt>
                      <dd>{{ $news->author->name }}</dd>
                      <dt>Description</dt>
                      <dd>{{ $news->description }}</dd>
                      <dt>Body</dt>
                      <dd>{{ $news->body }}</dd>
                      <dt>Featured Image</dt>
                      <dd>
                          <img src="/img/featured/{{ $news->featured_image }}">
                      </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection