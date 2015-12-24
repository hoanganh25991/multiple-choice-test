<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 12/23/2015
 * Time: 2:17 PM
 */
class TestOptionsSeeder extends DatabaseSeeder{
    public function run(){
        DB::table('test_options')->insert(
            array(
                array('id'=>1,'key'=>'timer','value'=>'60')
            )
        );
    }
}