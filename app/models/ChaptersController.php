<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 12/30/2015
 * Time: 2:44 PM
 */
class  ChaptersController extends \Illuminate\Routing\Controller{
    public function view(){
        $chapters = Chapter::all();
        return View::make('admin-chapters', array(
            'chapters' => $chapters
        ));
    }
    public function handlePost(){
        //handle navigation
        $admin_navigation = new AdminNavigation();
        if($admin_navigation->isNavigate()){
            return $admin_navigation->goToN();
        }
        //handle other post
        if(Input::has('new_chapter')){
            $chapter = new Chapter;
            $chapter->text = Input::get('chapter_text');
            $chapter->rate = Input::get('chapter_rate');
            $chapter->save();
//            echo Input::get('chapter_text');
//            echo $chapter->id;
        }
        if(Input::has('delete_chapter')){
            $chapter = Chapter::find(Input::get('chapter_id'));
            $questions = $chapter->getQuestions;
            if(count($questions) > 0){
                $message = 'chapter-'.$chapter->id.' still has questions';
//                Session::put('delete_chapter_message', $message);
                return Redirect::back()->with('delete_chapter_message', $message);
            }else{
                $chapter->delete();
            }
        }
        return Redirect::back();
    }
    public function getChapter(Chapter $chapter){
        $questions = $chapter->getQuestions;
        $session_message = "";
        if(Session::has('message')){
            $session_message = Session::pull('message');
            $session_message = json_encode($session_message);
        }
        var_dump($session_message);
        return View::make('admin-chapter-questions', array(
            'questions' => $questions,
            'session_message' => $session_message
        ));
    }


}