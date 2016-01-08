@extends('template-bootstrap')
@section('section')
<section id="test">
    <div class="container">
        <label for="timer">total-time</label><input id="timer" value="{{$timer->value}}" readonly><br>
            <div class="row">
                <div class="col-lg-8 success">
                    <form method="post" id="answer_sheet" class="ac-custom ac-radio ac-fill" autocomplete="off">
                    <?php $num_question = 0; ?>
                    @foreach($random_questions as $random_questions_chapter_x)
                        @foreach($random_questions_chapter_x as $question)
                        <h4 id="{{++$num_question}}" <?php if($num_question != 1){echo 'style="padding-top: 100px"';} ?>>{{$num_question.'. '.$question->text}}</h4>
                        <ul>
                            @foreach($question->getOptions as $option)
                                <li><input type="radio" name="{{$num_question}}" value="{{$option->id}}" id="{{$question->id.$option->id}}"><label for="{{$question->id.$option->id}}">{{$option->text}}</label></li>
                            @endforeach
                        </ul>
                        @endforeach
                    @endforeach
                    </form>
                </div>
                <div class="col-lg-4" style="position: relative">
                    <div>
                        <div id="question_answered_sidebar">
                            @for($i = 0;  $i < $num_question; $i++)
                                <a href="#{{($i + 1)}}" class="btn btn-default button_{{($i+1)}}" style="width: 55px">{{($i + 1)}}</a>
                            @endfor
                        </div>
                        <a class="btn btn-default answer_sheet_submit">Nop bai</a>
                    </div>
                </div>
            </div>
        <div class="col-lg-8 col-lg-offset-2 text-center">
            <a class="btn btn-lg btn-success answer_sheet_submit">
                <i class="fa fa-download"></i> Nop bai
            </a>
        </div>
    </div>
    <!-- Portfolio Modals -->
    <div class="modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <div style="position: relative">
                                <div>
                                    <div id="question_answered_review"></div>
                                    <a class="btn btn-default answer_sheet_submit">Nop bai</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('project_script')
<script>

    $(document).ready(function(){
    //set test timer
        function submitAnswer(){
            console.log('time-out');
            $('#answer_sheet').submit();
        }
        var timer = $('#timer').val(); console.log('timer: ' + timer);
        window.setTimeout(submitAnswer, timer * 60 * 1000);

    //button 'nop-bai' submit 'answer_sheet'
        $('.answer_sheet_submit').click(function(){
            console.log('answer_sheet_submit');
            $('#answer_sheet').submit();
        });

    //copy question_answered_sidebar to question_answerd_review
        var content = $('#question_answered_sidebar').html();
        $('#question_answered_review').html(content);

    //track on question-answered
        $('input[type="radio"]').click(function(){
            //question_answerd_review >>> color into green
            var button_id = $(this).attr('name');console.log(button_id);
            var question_button = $('.button_'+button_id);
            question_button.removeClass('btn-default');
            question_button.addClass('btn-success');

            //move to next question
            var next_question = Number(button_id) + 1;
            $('html,body').animate({scrollTop: $("#"+next_question).offset().top},'slow');
        });
    });
</script>
@endsection