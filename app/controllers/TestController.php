<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 07-Jan-16
 * Time: 9:36 PM
 */
class TestController extends ProjectController{
    const MESSAGE_KEY = "OFwQq7ob";
    //handle get-request from 'test'
    public function get(){
        $messages = $this->messageController->getMessages($this::MESSAGE_KEY);
        //contestant take test only one time, so
        //if !admin && has-result >>> redirect to 'result'
        //(admin not blocked, need to review test-page)
        $contestant = Auth::user();
        if($contestant->id != 1 && $contestant->result != ""){
            return Redirect::to('result');
        }
        //load random-question from database
        $chapters = Chapter::all();
        $random_questions = array();
        foreach($chapters as $chapter) {
            //each chapter, load random-questions by chapter-rate
            //then store in $random_questions
//            if($chapter->rate != 0){//make sure chapter has question
//                $random_questions[] = $chapter->getQuestions->random($chapter->rate);
//            }
            if(count($chapter->getQuestions) > $chapter->rate){
                $random_questions[] = $chapter->getQuestions->random($chapter->rate);
            }
        }
        //get timer from test option
        $test_options = TestOption::all();
        $timer = $test_options[0];
        return View::make('test-bootstrap', array(
            'random_questions' => $random_questions,
            'timer' => $timer,
            'messages' => $messages
        ));
    }
    //handle post-request from 'test'
    public function post(){
        //receive chose-options from contestant
        $answers_contestant = array_values(Input::all());
        $result = 0;
        for($i = 0; $i < count($answers_contestant); $i++){
            $option = Option::find($answers_contestant[$i]);
            //if the option is right, result++
            if($option->is_right == '1'){
                $result += 1;
            }
        }
        //save result from this contestant
        $contestant = Auth::user();
        $contestant->result = $result;
        $contestant->save();
        //show result on 'result'-page
        return Redirect::to('result');
    }
}