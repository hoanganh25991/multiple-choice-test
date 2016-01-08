@extends('template')
@section('title')
	<h1>result-page</h1>
@endsection
@section('content')
    <form method="post">
		<fieldset>
			<legend>email</legend>
			@if($contestant->email == "")
				<input type="text" name="contestant_email" value=""><br>
				<button>set</button>
			@else
				<input type="text" name="contestant_email" value="{{$contestant->email}}"><br>
				<button>change</button>
			@endif
		</fieldset>
	</form>
	@if($contestant->result == "")
		<p>you-havent-take-the-test</p>
	@else
		<p>result: {{$contestant->result}}</p>
	@endif
@endsection