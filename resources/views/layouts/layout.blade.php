<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.5.1/css/fileinput.css"
          media="all" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
          media="all" type="text/css">

	<!-- CSS -->
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">

	<!-- WYSIWYG - TinyMCE -->
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  	<script>tinymce.init({ selector:'textarea' });</script>
</head>
<body>

@include('layouts.headerNavigation')

	<div class="jumbotron">
		<div class="container">
            <div class="row justify-content-between">
                <div class="col-md-3">
                    <h1>Posts</h1>
                    <p>New project</p>
                </div>
                <div class="col-md-2">
                        <div class="im_ex">
                            <form method='post' action='{{url('/post/import')}}' enctype='multipart/form-data' >
                                {{ csrf_field() }}
                                <input type='submit' name='submit' value='Import' class="btn btn-primary btn-block">
                            </form>
                        </div>
                        <div class="im_ex">
                            <a href="/all-posts-csv" class="btn btn-success btn-block" style="float: right;">Export</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
	<div class="container">
		@yield('content')
	</div>


    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.5.1/js/fileinput.js"
            type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.5.1/themes/fa/theme.js"
            type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/popper.min.js"
            type="text/javascript"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"
            type="text/javascript"></script>

    <script type="text/javascript">
        $("#file-1").fileinput({
            theme: 'fa',
            uploadUrl: "/image-submit",
            uploadExtraData:function () {
                return {
                    _token:$("input[name='_token']").val()
                };
            },
            allowedFileExtensions:['jpg', 'jpeg', 'png', 'gif'],
            overwriteInitial: false,
            maxFileSize: 4000,
            maxFileNum: 5,
            slugCallback: function (filename) {
                return filename.replace('(','_').replace(']','_');
            }
        });
    </script>
</body>
</html>
