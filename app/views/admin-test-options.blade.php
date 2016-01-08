@extends('admin-template')
@section('admin-navigate-content')
<h1>test-options</h1>
<hr>
	<form method="post">
		<fieldset><legend><button>set-timer</button></legend>
			@foreach($test_options as $test_option)
				<label>{{$test_option->key}}</label><input type='text' name='{{$test_option->key}}' value='{{$test_option->value}}'/><br>
			@endforeach
		</fieldset>
	</form>
@endsection