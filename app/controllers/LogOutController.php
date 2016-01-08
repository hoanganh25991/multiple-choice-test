<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 07-Jan-16
 * Time: 9:33 PM
 */
class LogOutController extends Controller{
    //handle get-request from 'log-out'
    public function get(){
        if(Auth::check()){
            Auth::logout();
            echo '<h1>you-have-logged-out</h1>';
        }else{
            echo '<h1>you-havent-log-in</h1>';
        }
    }
}