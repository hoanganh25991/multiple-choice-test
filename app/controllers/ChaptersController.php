<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 12/30/2015
 * Time: 2:44 PM
 */
class  ChaptersController extends ProjectController{
    const MESSAGE_KEY = "lWln8RGZ";
    public function get(){
        $chapters = Chapter::all();
        //push 'messages' to view
        $messages = $this->messageController->getMessages($this::MESSAGE_KEY);
        return View::make('admin-chapters', array(
            'chapters' => $chapters,
            'messages' => $messages
        ));
    }
    public function getQuestions(Chapter $chapter){
        $total_chapter = Chapter::all()->count();
        $questions = $chapter->getQuestions;
        //push 'messages' to view
        $messages = $this->messageController->getMessages($this::MESSAGE_KEY);
        return View::make('admin-chapter-questions', array(
            'chapter' => $chapter,
            'questions' => $questions,
            'total_chapter' => $total_chapter,
            'messages' => $messages
        ));
    }
    public function post(){
        //message-notification
        $messages = array();
        //handle navigation
        $admin_navigation = new AdminNavigation();
        if($admin_navigation->isNavigate()){
            return $admin_navigation->goToN();
        }
        //chapters-change
        //delete-chapter
        if(Input::has('delete_chapter')){
            $chapter = Chapter::find(Input::get('chapter_id'));
            $questions = $chapter->getQuestions;
            if(count($questions) > 0){
                $messages['delete_chapter'] = 'chapter-'.$chapter->id.':has questions';
            }else{
                $chapter->delete();
                $messages['delete_chapter'] = 'chapter-'.$chapter->id.':deleted';
            }
        }
        //new-chapter
        if(Input::has('new_chapter')){
            $chapter = new Chapter;
            //delete +  auto_increment >>> modidify chapter-id not continuous
            //manually change chapter-id
            $last_chapter = Chapter::all()->last();
            $chapter->id = $last_chapter->id + 1;
            $chapter->text = Input::get('chapter_text');
            $chapter->rate = 0;
            $chapter->save();
            //messages-notification
            $messages['new_chapter'] = 'chapter-'.$chapter->id.'-'.$chapter->text.':saved';
        }
        $this->messageController->send($messages, $this::MESSAGE_KEY);
        return Redirect::back();
    }
    public function postQuestionChange(){
        //message-notification
        $messages = array();
        //handle navigation
        $admin_navigation = new AdminNavigation();
        if($admin_navigation->isNavigate()){
            return $admin_navigation->goToN();
        }
        //handle chapter-text change
        //redirect after changed
        if(Input::has('chapter_change')){
            $chapter = Chapter::find(Input::get('chapter_change'));
            $chapter->text = Input::get('chapter_text');
            $chapter->save();
            $messages['chapter_change_text'] = 'chapter-'.$chapter->id.':saved';
            $this->messageController->send($messages, $this::MESSAGE_KEY);
            return Redirect::back();
        }
        //handle delete-question
        //redirect after deleted, no need to modify other inputs
        if(Input::has('delete_question')){
            $question = Question::find(Input::get('delete_question'));
            $store_question_id = $question->id;
            $question->delete();
            $messages['delete_question'] = 'question-'.$store_question_id.':deleted';
            $this->messageController->send($messages, $this::MESSAGE_KEY);
            return Redirect::back();
        }
        //handle change on a question (both this one, and it's options)
        //redirect after all-changes saved
        if(Input::has('question_change')){
            $question = Question::find(Input::get('question_change'));
            //question-change, change question-text
            if(Input::has('question_text')){
                $question->text = Input::get('question_text');
                $question->save();
                $messages['question_change_text'] = 'question-'.$question->id.':saved';
            }
            //question-change, change question-chapter_id
            if(Input::has('chapter_id')){
                $question->chapter_id = Input::get('chapter_id');
                $question->save();
                $new_chapter = $question->getChapter;
                $messages['question_change_chapter_id'] = 'question-'.$question->id.':now belongs to chapter-'.$new_chapter->id;
            }
            //options-change
            if(Input::has('options')) {
                $options = Input::get('options');
                //save options-change
                $i = -1;
                foreach($options as $option_id => $option_text){
                    $option = Option::find($option_id);
                    $option->text = $option_text;
                    //reset all option-is_right = 0
                    //is_right set again with input-is_right checked
                    $option->is_right = 0;
                    $option->save();
                    $messages['options_change['.(++$i).']'] = 'option-'.$option->id.':saved';
                }
                //modify option-is_right
                if(Input::has('is_right')){
                    $option = Option::find(Input::get('is_right'));
                    //this option set is_right = 1
                    $option->is_right = 1;
                    $option->save();
                    $messages['options_change_is_right'] = 'option-'.$option->id.'-is_right:saved';
                }
            }
            //send message-notification
            $this->messageController->send($messages, $this::MESSAGE_KEY);
            return Redirect::back();
        }
        //new-question
        //redirect after create new-one
        if(Input::has('new_question')){
            //save new question
            $question = new Question;
            //delete + auto_increment >>> modify question-id not continuous
            //manually change question-id
            $last_question = Question::all()->last();
            $question->id = $last_question->id + 1;
            $question->text = Input::get('question_text');
            $question->chapter_id = Input::get('chapter_id');
            $question->save();
            $question_id = $question->id;
            $messages['new_question'] = 'question-'.$question->id.':saved';
            //save new options
            $options_text = Input::get('options');
            $created_options = array();
            for($i = 0; $i < 4; $i++){
                $option = new Option;
                $option->text = $options_text[$i];
                $option->question_id = $question_id;
                $option->is_right = 0;
                $option->save();
                //store in array new-option in $created_options, to add is_right on which
                $created_options[$i] = $option;
                $messages['option['.$i.']'] = 'option-'.$option->id.':saved';
            }
            if(Input::has('is_right')){
                $right_option = Input::get('is_right');
                //get option from store-$created_options, which selected is_right
                $option = $created_options[$right_option];
                $option->is_right = 1;
                $option->save();
                $messages['option_is_right'] = 'option-'.$option->id.'-is_right:saved';
            }
            //send message-notification
            $this->messageController->send($messages, $this::MESSAGE_KEY);
            return Redirect::back();
        }
        //as a fallback
        //send message-notification
        $this->messageController->send($messages, $this::MESSAGE_KEY);
        return Redirect::back();
    }
}