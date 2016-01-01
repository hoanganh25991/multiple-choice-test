<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 12/30/2015
 * Time: 2:50 PM
 */
class AdminController extends \Illuminate\Routing\Controller{
    public function handlePost(){
        $admin_navigation = new AdminNavigation();
        if($admin_navigation->isNavigate()){
            return $admin_navigation->goToN();
        }
        return false;
    }
}