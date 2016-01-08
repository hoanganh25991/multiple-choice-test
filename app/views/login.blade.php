@extends('template')
@section('title')
	<h1>login-page</h1>
@endsection
@section('content')
    <form method="post">
        <fieldset><legend><button>login</button></legend>
            <fieldset><legend>id</legend>
                <input type="number" name="contestant_id" placeholder="enter-your-id" required min="1" max="400">
            </fieldset>
            <fieldset><legend>keystone</legend>
                <input type="text" name="keystone" placeholder="enter-your-keystone" required minlength="8"><br>
            </fieldset>
        </fieldset>
    </form>
@endsection
@section('project_script')
@endsection