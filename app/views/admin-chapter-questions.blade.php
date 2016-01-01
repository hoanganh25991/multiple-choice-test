@extends('template')
@section('content')

    {{--loop question in chapter--}}
    @foreach($questions as $question)
    <form method="post">
        <fieldset><legend><button>apply-changes</button></legend>
            <h3><label>{{$question->id}}</label><input type="text" style="width: 90%; font-weight: bold; font-size: 1em;" name="question_text" value="{{$question->text}}"></h3>
            <label>chapter</label><input type="text" name="change_chapter" value="{{$question->chapter_id}}" ><br>
                @foreach($question->getOptions as $option)
                    <input type="text" style="width: 50%;" name="options[{{$option->id}}]" value="{{$option->text}}"><br>
                @endforeach
        </fieldset>
        <input type="hidden" name="question_id" value="{{$question->id}}">
    </form>
    @endforeach

    {{--form to create new question--}}
    <form method="post">
        <fieldset><legend><button name="new_question" value="submit">new-question</button></legend>
            <label>question-text</label><input type="text" name="question_text" value=""><br>
            <label>question-chapter_id</label><input type="text" name="question_chapter_id" value="">
            <fieldset>
                <input type="radio" name="is_right" value="0"><label>option-1</label><input type="text" name="options[0]" value=""><br>
                <input type="radio" name="is_right" value="1"><label>option-2</label><input type="text" name="options[1]" value=""><br>
                <input type="radio" name="is_right" value="2"><label>option-3</label><input type="text" name="options[2]" value=""><br>
                <input type="radio" name="is_right" value="3"><label>option-4</label><input type="text" name="options[3]" value=""><br>
            </fieldset>
        </fieldset>
    </form>

    {{--input hidden store Session, to push Session-message  into JavaScript --}}
    <input type="hidden" name="change_chapter_message" value='{{$session_message}}' id="session_message">

@endsection
@section('my-script')
    <script>
        $(document).ready(function(){
            var message = $('#session_message').val();console.log(message);
            if(message != ''){
                alert(message);
            }
        });
    </script>
@endsection

