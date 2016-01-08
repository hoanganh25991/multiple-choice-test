<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
{{--laravel prevent csrf by token, jquery-ajax need this token sent to ajax-file.php (place handle ajax-request)--}}
<meta name="_token" content="{!! csrf_token() !!}"/>
<title>Document</title>
{{--bootstrap-css--}}
<link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/bootstrap-iso.css')}}">
</head>
<body>
	<h1>cau lac bo chung khoan-dai hoc ngoai thuong</h1>
	@yield('title')
	<hr>
	<div class="wrapper">
		@yield('content')
	</div>
	<hr>
	<p>contact us</p>
	<p>mr.hoang-anh</p>
	<p>mobile: 0903865657</p>
	{{--loop messages from server to DOM, for javascript use--}}
	<div id="page_messages">
	@if(is_array($messages))
		@foreach($messages as $key => $values)
			@if(is_array($values))
				@foreach($values as $value)
					<input type="hidden" name="{{$key}}" value="{{$value}}">
				@endforeach
			@else
				<input type="hidden" name="{{$key}}" value="{{$values}}">
			@endif
		@endforeach
	@else
		<input type="hidden" name="messages" value="{{$messages}}">
	@endif
	</div>
	{{--jQuery--}}
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	{{--bootstrap-js--}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
		});
		$(document).ready(function(){
		    var message = "";
		    $('#page_messages').find(':input').each(function(){
		        message += $(this).val() + "\n";
		    });console.log(message);
		    if(message != ""){
                alert(message);
		    }
		});
	</script>
	@yield('project_script')
</body>
</html>

