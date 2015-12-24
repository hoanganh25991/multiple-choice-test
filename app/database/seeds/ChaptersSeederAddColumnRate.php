<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 12/23/2015
 * Time: 8:42 AM
 */
class ChaptersSeederAddColumnRate extends DatabaseSeeder{
    public function run(){
        DB::table('chapters')->where('id','=', '1')->update(array('rate'=>10));
    }
}