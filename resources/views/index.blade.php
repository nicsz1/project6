@extends('layouts.layout')

@section('content')

	<div class="row">

		@foreach($posts as $post)

			<div class="col-md-4">
                <div class="row">
                    <div class="col-md-9">
                        <h2>{{ $post->title }}</h2>
                    </div>
                    <div class="col-md-3">
                        <p style="margin-top: 13%; font-size: 10px;">Added: {{ Carbon\Carbon::parse($post->created_at)->format('d-m-y '.'H:i') }}</p>
                    </div>
                </div>
				<p>{{ $post->intro }}</p>
				<p><a href="/posts/{{ $post->id }}" class="btn btn-outline-dark">Read more</a></p>
				<div class="container">
					<div class="row justify-content-between">
						<p><a href="/posts/{{ $post->id }}/edit" class="btn btn-primary">Edit</a></p>
						<!-- <p><a href="#" class="btn btn-danger">Удалить</a></p> -->
						<form action="/posts/{{ $post->id }}" method="POST">
							{{ csrf_field() }}
							{!! method_field('delete') !!} <!-- Поле с токеном -->

							<button type="submit" class="btn btn-danger">
								Delete
							</button>
						</form>	
					</div>
				</div>		
			</div>

		@endforeach
		
	</div>

@endsection
