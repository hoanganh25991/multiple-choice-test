<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 10-Jan-16
 * Time: 9:51 PM
 */
class CsvController extends ProjectController{
    const MESSAGE_KEY = '123';
    public function get(){
        $messages = $this->messageController->getMessages($this::MESSAGE_KEY);
        return View::make('csv', array(
            'messages' => $messages,
        ));
    }
    public function post(){
        //admin-navigation
        $admin_navigation = new AdminNavigation();
        if($admin_navigation->isNavigate()){
            return $admin_navigation->goToN();
        }
        //handle upload file
        if(Input::hasFile('file_to_upload')){
            $file_patth = storage_path();
            $file_upload_key = 'file_to_upload';
            $csvUtil = new CsvUtil($file_patth, $file_upload_key);
            $data = $csvUtil->parse();
            //now try import by csvUtil :)
            if(Input::has('model')){
                $csvUtil->import(Input::get('model'));
                $this->messageController->send($csvUtil->getNotify(), $this::MESSAGE_KEY);
                return Redirect::to('admin/csv')->with('data', $data);
            }
        }
        if(Input::has('export-result')){
            $contestants = Contestant::where('result', '>=', 0)->get();
            $data = array();
            foreach ($contestants as $contestant) {
                $data[] = array($contestant->id, $contestant->result, $contestant->email);
            }
            return CsvUtil::export($data);
        }
        //as a fallback
        return Redirect::to('admin/csv');
    }
}