<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 12/30/2015
 * Time: 2:31 PM
 */
class AdminNavigation extends \Illuminate\Routing\Controller{
    public function __construct(){
        //default constructor, should have
    }
    public function isNavigate(){
        if(Input::has('admin-go-to')){
            return true;
        }else{
            return false;
        }
    }
    public function goToN(){
        if($this->isNavigate()){
            $goto = Input::get('admin-go-to');
            $url = 'admin'.'/'.$goto;
            return Redirect::to($url);
        }
        return false;
        //debug
//        echo $url;
    }
}