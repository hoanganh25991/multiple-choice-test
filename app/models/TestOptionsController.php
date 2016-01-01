<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 12/30/2015
 * Time: 2:38 PM
 */
class TestOptionsController extends \Illuminate\Routing\Controller{
    public function view(){
        $test_options = TestOption::all();
        return View::make('admin-test-options', array(
            'test_options' => $test_options
        ));
    }

    public function handlePost(){
        $admin_navigation = new AdminNavigation();
        if($admin_navigation->isNavigate()){
            return $admin_navigation->goToN();
        }
        //at this time, just one option in test-options, so
        $test_option = TestOption::first();
        if(Input::has($test_option->key)){
            $test_option->value = Input::get($test_option->key);
            $test_option->save();
            return Redirect::back();
        }

        return false;
    }
}