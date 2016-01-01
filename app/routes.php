<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//Route::post('admin', function(){
//    echo "hoanganh";
//});
Route::post('admin-ajax', function(){
    //chapter clicked
    if(Input::has('load_chapter')){
        $chapter_number = Input::get('load_chapter');
        $chapter = Chapter::find($chapter_number);
        $questions = $chapter->getQuestions;
        echo $questions->toJson();
//        echo $questions->toJson();
    }else{
//        echo "khong vao if"; ,..
    }
    if(Input::has('question_id')){
//        $question_id = Input::get('question_id');
//        $question = Question::get($question_id);
//        $options = $question->getOptions;
//        echo $options->toJson();
        echo "sao ko co ajax";
    }
    if(Input::has('test_ajax')){
        echo "test success";
    }
    if(Input::has('test_ajax_response_form')){
        echo "test response form success";
    }
});

Route::get('login', function(){
//    $hashed = Hash::make("OF1sc1gV");
//    echo $hashed;
//    if(Auth::attempt())
    if(Session::has('keystone_message')){
        $keystone_message = Session::get('keystone_message');
    }else{
        $keystone_message = "";
    }
    return View::make('login')->with('keystone_message', $keystone_message);
});

Route::post('login', function(){
//    $candidate_keystone = Input::get('keystone');
//    $hashed = Contestant::find(1)->keystone;
//    echo $cadidate_keystone;
//    echo $hashed;
//    if(Hash::check($cadidate_keystone, $hashed)){
//        echo "success";
//    }else{
//        echo "failed";
//    }
    //get ID, keystone from input
    $contestant_id = Input::get('contestant_id');
    $contestant_keystone_candidate = Input::get('keystone');
    //get contestant from input ID
    $contestant = Contestant::find($contestant_id);
    //check key stone
    if(Hash::check($contestant_keystone_candidate, $contestant->keystone)){
        //push contestant_id to global view (Session)
        Session::put('contestant_id', $contestant->id);
        Auth::login($contestant, true);
        //clear Session['keystone_message']
        if(Session::has('keystone_message')){
            Session::forget('keystone_message');
        }
        return Redirect::intended('test');
    }//because filter auth not set, when using Hash::check() >>> Auth::login()
//    if(Auth::attempt(array('id' => $contestant_id, 'keystone' => $contestant_keystone_candidate), true)){
//        Session::put('contestant_id', $contestant->id);
//        return Redirect::to('test');
//    }//Auth::attempt accept $credentials, 'password' must be provided
    //send login a message about checking keystone
//    Session::put('keystone_message', 'keystone-wrong');
    return Redirect::to('login');
});

Route::get('result', function(){
    //get result from Database, because we need other information from contestant, so get contestant, DONE
    //because we make sure that login happen before result
    //contestant_id have been stored in Session
    $contestant_id = Session::get('contestant_id');//contestant_id from login
    $contestant = Contestant::find($contestant_id);
    return View::make('result')->with('contestant', $contestant);
});

Route::post('result', function(){
    $contestant_email = Input::get('contestant_email');
    $contestant = Contestant::find(Session::get('contestant_id'));
    $contestant->email = $contestant_email;
    $contestant->save();
//    $result = $contestant->result;
    Session::put('result', $contestant->result);
    return Redirect::to('result');
});

Route::group(array('before'=>'auth'), function(){
    Route::get('/', function()
    {
        return Redirect::to('test');
    });
    Route::get('admin', function(){
        if(Auth::user()->id == "1"){
            $chapters = Chapter::all();
            $test_options = TestOption::all();
//            return View::make('admin02')->with('chapters', $chapters)->with('test_options', $test_options);
            return View::make('admin-03');
        }else{
            return Redirect::to('test');
        }

    });
    Route::get('test', function(){
        $result = Auth::user()->result;
        $id = Auth::user()->id;
//        echo $id;
        if($result != "" && $id != "1"){//contestant had test
            return Redirect::to('result');
        }
        $chapters = Chapter::all();
        //create random questions
        $random_questions = array();
        foreach($chapters as $chapter){
            $random_questions_chapter_x = 'random_questions_chapter_0'.$chapter->id;//just create a name programmatic
            $$random_questions_chapter_x = $chapter->getQuestions->random($chapter->rate);
            $random_questions[] = $$random_questions_chapter_x;
        }
        //get timer from test option
        $test_options = TestOption::all();
        $timer = $test_options[0];
        return View::make('test')->with('random_questions', $random_questions)->with('timer', $timer);
    });
    Route::get('admin/test-options', 'TestOptionsController@view');
    Route::get('admin/chapter-rate', 'ChapterRateController@view');
    Route::model('chapter', 'Chapter');//bind model for chapters
    Route::get('admin/chapters', 'ChaptersController@view');
    Route::get('admin/chapters/{chapter}', array(
        'uses' => 'ChaptersController@getChapter'
    ));

    Route::post('admin', 'AdminController@handlePost');
    Route::post('admin/test-options', 'TestOptionsController@handlePost');
    Route::post('admin/chapter-rate', 'ChapterRateController@handlePost');
    Route::post('admin/chapters', 'ChaptersController@handlePost');
    Route::post('admin/chapters/{chapter}', array(
        'uses' => 'ChapterQuestionsController@handleQuestionPost'
    ));
    Route::post('test', function(){
        // calculate result
//    echo Session::get('contestant_id');
        $answers_contestant = array_values(Input::all());
//    var_dump($answers_contestant);
        $result = 0;
        for($i = 0; $i < count($answers_contestant); $i++){
            $option = Option::find($answers_contestant[$i]);
            if($option->is_right == '1'){
                $result += 1;
            }
        }
//    echo $result;
        //save result to database
        $contestant_id = Session::get('contestant_id');
        $contestant = Contestant::find($contestant_id);
//    echo $contestant->id;
        $contestant->result = $result;
        $contestant->save();
        //push result to global view (Session)
//    Session::put('result', $result);//because we have saved to database, read result from that, don't have to push more
        return Redirect::to('result');
    });


});

Route::get('log-out', function(){
   if(Auth::check()){
       Auth::logout();
       echo '<h1>you-have-logged-out</h1>';
   }else{
       echo '<h1>you-havent-log-in</h1>';
   }
});

Route::get('request-uri/abc', function(){
    $uri = Request::path();
    $return = '<form method="get"><input type="text" name="submit" value="123"><button>set</button></form>';
    $request_method = "khong co \$request_method";
    if(Request::isMethod('get')){
        $request_method = Request::method();
    }
    $url = Request::url();
    $segment = Request::segment(2);
    $value = Request::server('PATH_INFO');
    echo $return;
    var_dump($uri);
    var_dump($request_method);
    var_dump($url);
    var_dump($segment);
    var_dump($value);
});


