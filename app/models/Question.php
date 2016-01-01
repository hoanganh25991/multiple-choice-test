<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 12/22/2015
 * Time: 9:01 PM
 */
class Question extends Eloquent{
    public $timestamps = false;
    public $fillable = array('text', 'chapter_id');
    public function getOptions(){
        return $this->hasMany('Option');
    }
    public function getChapter(){
        return $this->belongsTo('Chapter', 'chapter_id');
    }
}