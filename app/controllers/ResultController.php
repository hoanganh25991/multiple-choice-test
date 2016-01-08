<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 07-Jan-16
 * Time: 9:14 PM
 */
class ResultController extends ProjectController{
    const MESSAGE_KEY = "6wXNciDn";
    //handle get-request from 'result'
    public function get(){
        $contestant = Auth::user();
        //push 'messages' to view
        $messages = $this->messageController->getMessages($this::MESSAGE_KEY);
        return View::make('result', array(
            'contestant' => $contestant,
            'messages' => $messages
        ));
    }
    //handle post-request from 'result'
    public function post(){
        $contestant_email = Input::get('contestant_email');
        $contestant = Auth::user();
        $contestant->email = $contestant_email;
        $contestant->save();
        return Redirect::to('result');
    }
}