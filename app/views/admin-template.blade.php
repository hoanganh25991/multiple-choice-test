@extends('template')
@section('title')
	<h1>admin-page</h1>
@endsection
@section('content')
	{{--page-navigation--}}
	<div id='admin-navigate'>
		<ul>
			<li><form method="post"><button name="admin-go-to" value="test-options">test-options</button></form></li>
			<li><form method="post"><button name="admin-go-to" value="chapter-rate">chapter-rate</button></form></li>
			<li><form method="post"><button name="admin-go-to" value="chapters">chapters</button></form></li>
		</ul>
	</div>
	
	<div id="admin-navigate-content">
		@yield('admin-navigate-content')
	</div>
@endsection
