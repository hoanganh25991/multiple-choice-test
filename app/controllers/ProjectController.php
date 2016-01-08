<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 08-Jan-16
 * Time: 12:10 PM
 */
abstract class ProjectController extends BaseController{
//    final static $message_key;
    protected $messageController;
    public function __construct(){
        $this->messageController = new MessageController();
//        $this::$message_key = $this->generateMessageKey();
    }
//    abstract function generateMessageKey();
}