@extends('template')
@section('content')
    <ul>
        <li><form method="post"><button name="admin-go-to" value="test-options">test-options</button></form></li>
        <li><form method="post"><button name="admin-go-to" value="chapter-rate">chapter-rate</button></form></li>
        <li><form method="post"><button name="admin-go-to" value="chapters">chapters</button></form></li>
    </ul>
    <div id="admin-go-to-content">
        @yield('admin-go-to-content')
    </div>
@endsection
