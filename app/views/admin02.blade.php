@extends('template')
@section('content')

<h3>Test Options</h3>
    <form method='post'>
        <fieldset><legend><button>set</button></legend>
            <fieldset><legend>chapter-rate</legend>
                @foreach($chapters as $chapter)
                    <label>chapter-0{{$chapter->id}}</label><input type='text' name='chapter_0{{$chapter->id}}_rate' value='{{$chapter->rate}}'/><br>
                @endforeach
            </fieldset>
            <fieldset><legend>timer</legend>
                @foreach($test_options as $test_option)
                    <label>{{$test_option->key}}</label><input type='text' name='{{$test_option->key}}' value='{{$test_option->value}}'/><br>
                @endforeach
            </fieldset>
        </fieldset>
    </form>

<h3>CRUD-basic</h3>
    <form method="post" id="test_ajax">
        <input type="hidden" name="test_ajax" value="vkl">
        <button>test</button>
    </form>
    <div id="test_ajax_response"></div>
    <fieldset><legend>chapter</legend>
        @foreach($chapters as $chapter)
            <form method='post' class='load_chapter_ajax'>
                <input type='hidden' name='load_chapter' value='{{$chapter->id}}'>
                <input type='hidden' name='load_chapter_text' value='{{$chapter->text}}'>
                <button>{{$chapter->id}}: {{$chapter->text}}</button>
            </form>
        @endforeach
        <fieldset id='question_result'><legend id='legend'></legend>
            <div id='div'></div>
            <fieldset id='option_result'><legend id='option_result_legend'></legend>
            <div id='option_result_loop'></div>
            </fieldset>
        </fieldset>
    </fieldset>

@endsection
@section('my-script')
<script>
    $(document).ready(function(){
        $('.load_question_ajax').submit(function(event){
            event.preventDefault();
            var data = $(this).serialize();console.log(data);
            var dataArray = $(this).serializeArray();console.log(dataArray);
            $.post('admin-ajax', data, function(options){
//                alert(options);

            });
        });
        $('#test_ajax').submit(function(event){
            event.preventDefault();
            var data = $(this).serialize();
            $.post('admin-ajax', data, function(response){
//                alert(response);
                var result = $('#test_ajax_response');
                result.append(
                    '<form method="post" class="test_ajax_response_form"><input type="hidden" name="test_ajax_response_form" value="vkl"><button>test</button>'
                );
            });
        });
        $('.test_ajax_response_form').submit(function(event){
            event.preventDefault();
            var data = $(this).serialize();
            $.post('admin-ajax', data, function(response){
                alert(response);
            });
        });
        $('.load_chapter_ajax').submit(function(event){
            event.preventDefault();
            var data = $(this).serialize(); console.log(data);
            var dataArray = $(this).serializeArray();console.log(dataArray);
            $.post('admin-ajax', data, function(questions) {
//                alert(questions);
                var result = $('#question_result');
                var parse_questions = jQuery.parseJSON(questions); console.log(parse_questions);
                //modify result-fieldset
                //clear >>> empty()
                //change legend
                result.find('#legend').html(
                    'chapter-0' + dataArray[0]['value'] + ':' + dataArray[1]['value']
                );
                result.find('#div').empty();
                for (var i = 0; i < parse_questions.length; i++){
                    var question = parse_questions[i];
                    result.find('#div').append(
                        '<form method="post" class="load_question_ajax">' +
                            '<input type="hidden" name="question_id" value=' + question['id'] + '>' +
                            '<input type="hidden" name="question_text" value=' + question['text'] + '>' +
                            '<button>' + (i+1) + '.' + question['text'] + '</button>' +
                        '</form>'
                    );
                }
            });
        });

    });
</script>
@endsection
<form method='post'>
    <input type='hidden' name='question_id' value='question['id']'>
    <button></button>
</form>
