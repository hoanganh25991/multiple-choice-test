<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 12/30/2015
 * Time: 10:57 PM
 */
class ChapterQuestionsController extends \Illuminate\Routing\Controller{
    public function handleQuestionPost(){
        if(Input::has('question_id')){
            $message = "";
            $question_id = Input::get('question_id');
            $question = Question::find($question_id);
            if(Input::has('question_text')){
                $question->text = Input::get('question_text');
                $question->save();
                $message .= 'question-'.$question->id.' saved';
            }
            if(Input::has('options')) {
                $options = Input::get('options');
//                dd($options);
                foreach($options as $option_id => $option_text){
                    $option = Option::find($option_id);
                    $option->text = $option_text;
                    $option->save();
                    $message .= 'options saved';
                }
            }
            if(Input::has('change_chapter')){
                $question->chapter_id = Input::get('change_chapter');
                $question->save();
                $new_chapter = $question->getChapter;
//                $new_chapter = Chapter::find(Input::get('change_chapter'));
                $message = 'question-'.$question->id.' now belongs to chapter-'.$new_chapter->id;
                Session::put(array(
                   'message.change_chapter' => $message
                ));
                return Redirect::back();
            }
        }
        //cai nay nam ngoai has question_id
        if(Input::has('new_question')){

            //save new question
            $question = new Question;
            $question->text = Input::get('question_text');
            $question->chapter_id = Input::get('question_chapter_id');
            $question->save();
            $question_id = $question->id;
            $new_question_message = 'question- '.$question->id.' created';
            //save new options
            $new_options_message = "";
            $options_text = Input::get('options');
//            dd($options_text);
//            var_dump($options_text);
//            die();
            $options = array();
            for($i = 0; $i < 4; $i++){
                $option = new Option;
                $option->text = $options_text[$i];
                $option->question_id = $question_id;
                $option->is_right = 0;
                $option->save();
                //store in array $options to modify later
                $options[$i] = $option;
                $new_options_message = 'new options created';
            }
            $option_is_right_message = "";
            if(Input::has('is_right')){
                $right_option = Input::get('is_right');
//                dd($right_option);
                $option = $options[$right_option];
                $option->is_right = 1;
                $option->save();
                $option_is_right_message = 'right option saved';
            }
//            return Redirect::back(302, array(
////                'message' => array($message, $message_1, $message_2)
////                'test' => 'hoanganh'
//            ))->with('test', 'hoanganh');
//            $messages = array($message, $message_1);
//            $message_json = json_encode($messages, JSON_FORCE_OBJECT);
//            dd($message_json);

//            return Redirect::back(302)->with(array(
////                'test' => $message_json,
//                'message.new_question' => $new_question_message,
//                'message.new_options' => $new_options_message,
//                'message.option_is_right' => $option_is_right_message
//            ));
            Session::put(array(
                'message' => 'hoanganh',
                'message.new_question' => $new_question_message,
                'message.new_options' => $new_options_message,
                'message.option_is_right' => $option_is_right_message
            ));
            return Redirect::back();
        }
        return Redirect::back();
    }
}