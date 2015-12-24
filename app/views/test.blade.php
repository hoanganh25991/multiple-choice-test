@extends('template')
@section('content')
    <label>total-time</label><input id="timer" value="{{$timer->value}}" readonly><br>
    <form method="post" id="answer_sheet">
    <?php $num_question = 0; ?>
    @foreach($random_questions as $random_questions_chapter_x)
        @foreach($random_questions_chapter_x as $question)
            <h3>{{++$num_question}}.{{$question->text}}</h3>
            @foreach($question->getOptions as $option)
                <input type="radio" name="question_{{$question->id}}" value="{{$option->id}}"/>{{$option->text}}<br>
            @endforeach
        @endforeach
   @endforeach
   <button>submit</button>
   </form>
@endsection
@section('my-script')
    <script>
        //set test timer
        $(document).ready(function(){
            function submitAnswer(){
                console.log('time-out');
                $('#answer_sheet').submit();
            }
            var timer = $('#timer').val(); console.log('timer: ' + timer);
            window.setTimeout(submitAnswer, timer * 60 * 1000);
        });
    </script>
@endsection