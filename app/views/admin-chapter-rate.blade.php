@extends('admin-template')
@section('admin-go-to-content')
    <h1>chapter-rate</h1>
    <hr>
    <form method="post">
        <fieldset><legend><button name="chapter_rate" value="set_new">set</button></legend>
        @foreach($chapters as $chapter)
            <label>chapter-{{$chapter->id}}</label>
            <input type="text" name="{{$chapter->id}}" value="{{$chapter->rate}}"><br>
        @endforeach
        </fieldset>
    </form>
@endsection