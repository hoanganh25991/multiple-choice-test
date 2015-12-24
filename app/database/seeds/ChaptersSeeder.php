<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 12/22/2015
 * Time: 9:18 PM
 */
class ChaptersSeeder extends DatabaseSeeder{
    public function run(){
        DB::table('chapters')->insert(
            array(
                array('id'=>1,'text'=>'dolores et ea rebum. Stet clita kasd.'),
                array('id'=>2,'text'=>'labore et dolore magna aliquyam erat,.'),
                array('id'=>3,'text'=>'eirmod tempor invidunt ut labore et.'),
                array('id'=>4,'text'=>'et accusam et justo duo dolores et.'),
                array('id'=>5,'text'=>'eirmod tempor invidunt ut labore et dolore magna.'),
                array('id'=>6,'text'=>'et dolore magna aliquyam erat, sed diam voluptua..'),
                array('id'=>7,'text'=>'diam voluptua. At vero eos et.'),
                array('id'=>8,'text'=>'sed diam voluptua. At vero eos et accusam.'),
                array('id'=>9,'text'=>'ut labore et dolore magna.')
            )
        );
    }
}