@extends('template')
@section('content')
<form method="post">
    <fieldset>
        <fieldset>
            <legend>id</legend>
            <input type="text" name="contestant_id" value="" placeholder="enter-your-id"/>
        </fieldset>
        <fieldset>
            <legend>keystone</legend>
            <input type="text" name="keystone" value="" placeholder="enter-your-keystone"/><br>
            @if($keystone_message == "")
            @else
                <p>{{$keystone_message}}</p>
            @endif
        </fieldset>
        <button>login</button>
    </fieldset>
</form>
@endsection