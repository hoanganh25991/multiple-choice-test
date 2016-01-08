<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 12/30/2015
 * Time: 2:50 PM
 */
class AdminController extends ProjectController{
    const MESSAGE_KEY = "I7fSIL5A";
    //handle get-request from 'admin'
    public function get(){
        //check contestant is admin
        //admin has id == 1
        $contestant = Auth::user();
        if($contestant->id != "1"){
            return Redirect::to('test');
        }
        //go to admin-page
        //push 'messages' to view
        $messages = $this->messageController->getMessages($this::MESSAGE_KEY);
        return View::make('admin', array(
            'messages' => $messages
        ));
    }
    public function post(){
        //admin-navigation
        $admin_navigation = new AdminNavigation();
        if($admin_navigation->isNavigate()){
            return $admin_navigation->goToN();
        }
        return false;
    }
}