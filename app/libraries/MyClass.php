<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 12/29/2015
 * Time: 10:19 AM
 */
class MyClass extends Illuminate\Routing\Controller {


    public static function adminGoTo(){
//        echo "DKM";
        //where to go
        if(Input::has('admin-go-to')){
            $admin_go_to = Input::get('admin-go-to');
//        echo $admin_go_to;
            //go to test-options
            if($admin_go_to == 'test-options'){
//            echo "redirect ne";
                return Redirect::to('admin/test-options');
            }
            //go to chapter-rate
            if($admin_go_to == 'chapter-rate'){
                return Redirect::to('admin/chapter-rate');
            }
            //or go to chapters
            if($admin_go_to == 'chapters'){
                return Redirect::to('admin/chapters');
            }
        }

        //on fallback go to test-options
        Session::put('admin-go-to', 'no-navigate');
    }
}