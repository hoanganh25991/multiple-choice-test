<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 12/22/2015
 * Time: 9:03 PM
 */
class Chapter extends Eloquent{
    public $timestamps = false;
    public function getQuestions(){
        return $this->hasMany('Question');
    }
}