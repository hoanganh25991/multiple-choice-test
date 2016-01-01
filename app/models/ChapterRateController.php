<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 12/30/2015
 * Time: 2:41 PM
 */
class ChapterRateController extends \Illuminate\Routing\Controller{
    public function view(){
        $chapters = Chapter::all();
        return View::make('admin-chapter-rate', array(
            'chapters' => $chapters
        ));
    }
    public function handlePost(){
        $admin_navigation = new AdminNavigation();
        if($admin_navigation->isNavigate()){
            return $admin_navigation->goToN();
        }
        if(Input::has('chapter_rate')){
            $chapters = Chapter::all();
            foreach($chapters as $chapter){
                $chapter->rate = Input::get($chapter->id);
                $chapter->save();
            }
            return Redirect::back();
        }
        return false;
    }
}