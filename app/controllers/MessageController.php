<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 1/4/2016
 * Time: 4:11 PM
 */
class MessageController{
    public function __construct(){
    }
    public function send($messages, $message_key){
        Session::put($message_key, $messages);
    }
    public function getMessages($message_key){
        if(Session::has($message_key)){
            return Session::pull($message_key);
        }
        return array();
    }
}