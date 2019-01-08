@extends('layouts.layout')

@section('content')

	<h2>Edit a post:</h2>
	<div class="row">
		<div class="col-md-6">
			<form action="/posts/{{$post->id}}" method="POST" enctype="multipart/form-data">
				
				{{ csrf_field() }}
				{!! method_field('patch') !!}

				<div class="form-group">
					<label for="title">Title</label>
					<input class="form-control" type="text" name="title" id="title" value="{{$post->title}}"/>
				</div>
				<div class="form-group">
					<label for="slug">Slug</label>
					<input class="form-control" type="text" name="slug" id="slug" value="{{$post->slug}}"/>
				</div>	
				<div class="form-group">
					<label for="intro">Intro</label>
					<input class="form-control" type="text" name="intro" id="intro" value="{{$post->intro}}"/>
				</div>

				<div class="form-group">
					<label for="img">Выберите файл</label>
					<input id="img" type="file" name="files[]" multile>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-lg-12 col-sm-12 col-11 main-section">
							<label for="image">Images</label>
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />
							<div class="form-group">
								<input type="file" id="file-1" name="file" multiple class="file" data-overwrite-initial="false" data-min-file-count />
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="body">Body</label>
					<textarea class="form-control" type="text" name="body" id="body">{!!$post->body!!}</textarea>
				</div>
				<div class="row justify-content-end">
					<div class="col-md-5">
						<div class="form-group">
							<button class="btn btn-success form-control" type="submit">Update</button>
						</div>
					</div>
				</div>

				@include('errors.error')

			</form>
		</div>
	</div>

@endsection
