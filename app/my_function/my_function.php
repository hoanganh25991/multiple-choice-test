<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 12/29/2015
 * Time: 10:14 AM
 */
function adminGoTo(){
//    echo "DKM";
        //where to go
        $admin_go_to = Input::get('admin-go-to', 'test-options');
        //go to test-options
        if($admin_go_to == 'test-options'){
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
        //on fallback go to test-options
        return Redirect::to('admin/test-option');
}