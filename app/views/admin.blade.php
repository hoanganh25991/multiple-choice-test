@extends('template')
@section('content')
<table>
    <thead>
        <tr id="row_header">
            <td><strong>number_question</strong></td>
            @for($i = 0; $i < $num_chapter; $i++)
                <td><strong>chapter_0{{$i+1}}</strong></td>
            @endfor
        </tr>
    </thead>
    <tbody>
        <tr id="row_value">
            <td><input type="text" name="num_question" value="50" style="width: 150px"></td>
            @for($i = 0; $i < $num_chapter; $i++)
                <td><input id="chapter_0{{$i+1}}" type="text" name="chaper_rate" value="10" style="width: 100px"></td>
            @endfor
        </tr>
    </tbody>
</table>
<button id="set_question_rate">set</button>
    <form id="row_rate_calculated" method="post">

    </form>
<script>
    $(document).ready(function(){
        $('#set_question_rate').click(function(){
            var $row_value = $('#row_value');
            var num_chapter = $row_value.children().length - 1; console.log('num_chapter: ' + num_chapter);
            var num_question = $row_value.find('input[name="num_question"]').val(); console.log('num_question: ' + num_question);

            var $row_rate_calculated = $('#row_rate_calculated');
            for(var i = 0; i < num_chapter; i++){
                var name = '#' + 'chapter_0' + ( i + 1); console.log(name);
                var inputItem = $('#' + 'chapter_0' + (i + 1)); console.log(inputItem.val());
                var chapter_rate = inputItem.val(); console.log('chapter_rate: ' + chapter_rate);
                var rate = chapter_rate / 100 * num_question; console.log('rate: ' + rate);
                var inputItemForm = $('<input/>');
                inputItemForm.attr('name', name);
                inputItemForm.attr('value', rate);
                inputItemForm.attr('style', "width: 100px");
                $row_rate_calculated.append(inputItemForm);
            }
            $row_rate_calculated.submit();
        });
    });
</script>
@endsection