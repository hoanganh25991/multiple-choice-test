@extends('admin-template')
@section('admin-go-to-content')
    <h1>chapters</h1>
    <hr>
    <fieldset><legend>chapters</legend>
    @foreach($chapters as $chapter)
        <form method="post">
            <fieldset><legend><button name="delete_chapter" value="submit">delete</button></legend>
                <a href="{{URL::to('admin/chapters')}}/{{$chapter->id}}">chapter-{{$chapter->id}}.{{$chapter->text}}</a>
                <input type="hidden" name="chapter_id" value="{{$chapter->id}}">
            </fieldset>
        </form>
    @endforeach
    </fieldset>
    <form method="post">
        <fieldset><legend><button name="new_chapter" value="submit">new-chapter</button></legend>
            <label>chapter-text</label><input type="text" name="chapter_text" value=""><br>
            <label>chapter-rate</label><input type="text" name="chapter_rate" value=""><br>
        </fieldset>
    </form>
    {{--input hidden to store Session from server-side--}}
    <input type="hidden" name="session_delete_message" value="{{Session::get('delete_chapter_message')}}" id="session">
@endsection
@section('my-script')
    <script>
        $(document).ready(function(){
            var message = $('#session').val();console.log(message);
            if(message != ""){
                alert(message);
            }
        });
    </script>
@endsection