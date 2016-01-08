<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 12/30/2015
 * Time: 2:38 PM
 */
class TestOptionsController extends ProjectController{
    const MESSAGE_KEY = "30dwbOfr";
    public function get(){
        $test_options = TestOption::all();
        //push 'messages' to view
        $messages = $this->messageController->getMessages($this::MESSAGE_KEY);
        return View::make('admin-test-options', array(
            'test_options' => $test_options,
            'messages' => $messages
        ));
    }

    public function post(){
        //admin-navigation
        $admin_navigation = new AdminNavigation();
        if($admin_navigation->isNavigate()){
            return $admin_navigation->goToN();
        }
        //message-notification
        $messages = array();
        //at this time, just one option in test-options, so
        $test_option = TestOption::first();//'timer'
        if(Input::has($test_option->key)){
            $test_option->value = Input::get($test_option->key);
            $test_option->save();
            $messages[$test_option->key] = $test_option->key.':saved';
            $this->messageController->send($messages, $this::MESSAGE_KEY);
            return Redirect::back();
        }
        return Redirect::to('result');
    }
}