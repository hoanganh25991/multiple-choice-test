@extends('admin-template')
@section('admin-navigate-content')
<form method="post">
    <label style="font-weight: bold; font-size: 2em;">chapter-{{$chapter->id}}:</label><input style="width: 70%; font-weight: bold; font-size: 2em;" type="text" name="chapter_text" value="{{$chapter->text}}" required><button style="font-size: 2em;"name="chapter_change" value="{{$chapter->id}}">change</button>
</form>
<hr>
    {{--loop question in chapter--}}
    @foreach($questions as $question)
    <form method="post">
        <fieldset><legend>
            <button name="question_change" value="{{$question->id}}">apply-changes</button>
            <button name="delete_question" value="{{$question->id}}">delete-question</button>
        </legend>
            <h3><label>{{$question->id}}</label><input type="text" style="width: 90%; font-weight: bold; font-size: 1em;" name="question_text" value="{{$question->text}}" required></h3>
            <label>chapter</label><input type="number" name="chapter_id" value="{{$question->chapter_id}}" min="1" max="{{$total_chapter}}" required><br>
                <?php $i = -1; ?>
                @foreach($question->getOptions as $option)
                    {{--radio-button for option-is_right--}}
                    <input type="radio" name="is_right" value="{{$option->id}}" <?php if($option->is_right == 1) echo "checked" ?>>
                    {{--option-text validated by html-form: required--}}
                    <label>option-{{$i+1}}</label><input type="text" style="width: 50%;" name="options[{{$option->id}}]" value="{{$option->text}}" required><br>
                @endforeach
        </fieldset>
    </form>
    @endforeach
    {{--form to create new question--}}
    <form method="post">
        <fieldset><legend><button name="new_question" value="submit">new-question</button></legend>
            <label>question-text</label><input type="text" name="question_text" value="" required><br>
            <label>question-chapter_id</label><input type="number" name="chapter_id" value="" min="1" max="{{$total_chapter}}" required>
            <fieldset>
                <input type="radio" name="is_right" value="0" checked><label>option-1</label><input type="text" name="options[]" value="" required><br>
                <input type="radio" name="is_right" value="1"><label>option-2</label><input type="text" name="options[]" value="" required><br>
                <input type="radio" name="is_right" value="2"><label>option-3</label><input type="text" name="options[]" value="" required><br>
                <input type="radio" name="is_right" value="3"><label>option-4</label><input type="text" name="options[]" value="" required><br>
            </fieldset>
        </fieldset>
    </form>
@endsection
@section('project-script')
    <script>
        $(document).ready(function(){
            var message = $('#session_message').val();console.log(message);
            if(message != ''){
                alert(message);
            }
        });
    </script>
@endsection

