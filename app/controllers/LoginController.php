<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 1/1/2016
 * Time: 9:00 PM
 */
class LoginController extends ProjectController{
    const MESSAGE_KEY = "OF1sc1gV";
    //handle get request from 'login'
    public function get(){
        //push 'messages' to view
        $messages = $this->messageController->getMessages($this::MESSAGE_KEY);
        return View::make('login-bootstrap',array(
            'messages' => $messages,
        ));
    }
    //handle post request from 'login'
    public function post(){
        //step 1: validate input-data
        $validate_data = Input::only('contestant_id', 'keystone');
        $validate_rules = array(
            'contestant_id' => 'required|integer',
            'keystone' => 'required|min:8'
        );
        $validator = Validator::make($validate_data, $validate_rules);
        if($validator->fails()){
            $validate_messages = $validator->messages()->toArray();
            $this->messageController->send($validate_messages, $this::MESSAGE_KEY);
            return Redirect::to('login');
        }
        //step 2: check empty collection from 'contestant_id', bcs it may not exist
        $contestant = Contestant::find(Input::get('contestant_id'));
        if(!$contestant){
            $this->messageController->send(array('contestant_id' => ['contestant_id:wrong']), $this::MESSAGE_KEY);
            return Redirect::to('login');
        }
        //step 3: compare hashed-value, if equal, allow login
        //what we get after find is a 'collection', not a Contestant's instance, so fetch it, first()
        if(Hash::check(Input::get('keystone'), $contestant->keystone)){
            Auth::login($contestant);
            if($contestant->id == 1){
                //admin after 'login' refer go to 'admin' page
                return Redirect::to('admin');
            }else{
                //contestant after 'login' refer goto 'test' page
                return Redirect::to('test');
            }
        }else{
            $this->messageController->send(array('keystone' => ['keystone:wrong']), $this::MESSAGE_KEY);
        }
        //as a fall-back, return to login
        return Redirect::to('login');
    }
}