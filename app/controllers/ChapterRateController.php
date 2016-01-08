<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 12/30/2015
 * Time: 2:41 PM
 */
class ChapterRateController extends ProjectController{
    const MESSAGE_KEY = "sqvbTPJC";
    public function get(){
        $chapters = Chapter::all();
        //push 'messages' to view
        $messages = $this->messageController->getMessages($this::MESSAGE_KEY);
        return View::make('admin-chapter-rate', array(
            'chapters' => $chapters,
            'messages' => $messages
        ));
    }
    public function post(){
        //page-navigation
        $admin_navigation = new AdminNavigation();
        if($admin_navigation->isNavigate()){
            return $admin_navigation->goToN();
        }
        //message-notification
        $messages = array();
        if(Input::has('chapter_rate')){
            $chapters = Chapter::all();
            //get chapter-data, create chapter-rules for validation
            $chapter_rate_data = array();
            $chapter_rate_rules = array();
            foreach($chapters as $chapter){
                $max_rate = $chapter->getQuestions->count();
                $chapter_rate_data[$chapter->id] = Input::get($chapter->id);
                $chapter_rate_rules[$chapter->id] = 'integer|max:'.$max_rate;
            }
            //validate if chapter-rate <= max_rate
            $validator = Validator::make($chapter_rate_data, $chapter_rate_rules);
            if($validator->fails()){
                $validate_messages = $validator->messages()->toArray();
                $this->messageController->send($validate_messages, $this::MESSAGE_KEY);
                return Redirect::back();
            }
            //save chapter-rate to database
            $i = -1;
            foreach($chapters as $chapter){
                $chapter->rate = Input::get($chapter->id);
                $chapter->save();
                $messages['chapter_rate['.(++$i).']'] = 'chapter-'.$chapter->id.'-chapter_rate:saved';
            }
            //return back, show confirm from database
            $this->messageController->send($messages, $this::MESSAGE_KEY);
            return Redirect::back();
        }
        //as a fallback
        $this->messageController->send($messages, $this::MESSAGE_KEY);
        return Redirect::to('admin/chapter-rate');
    }
}