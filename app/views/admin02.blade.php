@extends('template')
@section('content')
<form method="post">
<fieldset>
    <legend>chapter-rate</legend>
    @foreach($chapters as $chapter)
        <label>chapter-0{{$chapter->id}}</label><input type="text" name="chapter_0{{$chapter->id}}_rate" value="{{$chapter->rate}}"/><br>
    @endforeach
</fieldset>
<fieldset>
        <legend>test-option</legend>
        @foreach($test_options as $test_option)
            <label>{{$test_option->key}}</label><input type="text" name="{{$test_option->key}}" value="{{$test_option->value}}"/><br>
        @endforeach
</fieldset>
<button name="set_options">set</button>
</form>
@endsection
