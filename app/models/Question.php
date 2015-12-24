<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 12/22/2015
 * Time: 9:01 PM
 */
class Question extends Eloquent{
    public $timestamps = false;
    public function getOptions(){
        return $this->hasMany('Option');
    }
}