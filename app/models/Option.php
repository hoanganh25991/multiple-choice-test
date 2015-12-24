<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 12/22/2015
 * Time: 9:02 PM
 */
class Option extends Eloquent{
    public $timestamps = false;
    public function getQuestion(){
        return $this->belongsTo('Question');
    }
}