@extends('layouts.layout')

@section('content')

	<div class="row">
		<div class="col-sm-12 blog-main">
			<div class="blog-post">
				<p class="blog-post-meta" style="float: right; margin-top: 8px;">{{ Carbon\Carbon::parse($post->created_at)->format('Дата d-m-Y - Время H:i:s') }}</p>
		        <h2 class="blog-post-title">{{$post->title}}</h2>

				<img src="{{ asset('uploads/'.$post->img) }}">

		        <p>{!!$post->body!!}</p>
		    </div>
		</div>
    </div>

@endsection
