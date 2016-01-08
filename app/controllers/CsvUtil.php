<?php
/**
 * Created by PhpStorm.
 * User: Hoang Anh
 * Date: 11-Jan-16
 * Time: 9:27 AM
 */
class CsvUtil{
    protected $file_path;
    protected $file_upload_key;
    protected $file_name;
    protected $messages;
    protected $data;
    private $is_parsed;

    //csv-util 'need' file-csv's info, to read it
    public function __construct($file_path, $file_upload_key){
        $this->file_path = $file_path;
        $this->file_upload_key = $file_upload_key;
        $this->getFileName();
        //store data from file-csv into array()
        $this->data = array();
        //for notify
        $this->messages = array();
        $this->is_parsed = false;
    }
    /*
     * parse file-csv to array
     * @return data, array()
     */
    public function parse(){
        $target_file = $this->file_path.$this->file_name;
        //check file already exist
        if(file_exists($target_file)){
            $this->messages['file-exists'] = 'file-alredy-exist:check'.$this->file_path.$this->file_upload_key;
            return $this->data;
        }
        //check if file-type : csv
        $file_type = pathinfo($target_file,PATHINFO_EXTENSION);
        if($file_type != "csv"){
            $this->messages['file_type'] = 'file-type:not csv';
            return $this->data;
        }
        //move file from tmp >>> storage
        if (!move_uploaded_file($_FILES[$this->file_upload_key]["tmp_name"], $target_file)) {
            $this->messages['move-file'] = 'move-file:wrong';
            return $this->data;
        }
        //parse csv by fgetcsv
        try{
            $CSVfp = fopen($target_file, "r");
            while(! feof($CSVfp)) {
                $this->data[] = fgetcsv($CSVfp, 1000, ",");
            }
            fclose($CSVfp);
            $this->messages['pare-file-csv'] = 'parse:success';
            $this->is_parsed = true;
            return $this->data;
        }catch (Exception $e){
            $this->messages['parse-file-csv'] = array(
                'parse-error' => 'parse-error:get error in fopen/feof/fgetcsv',
                'error-info'  => 'error-info:'.$e->getMessage()
            );
            return $this->data;
        }
    }
    /*
     * import data from file-csv into database, based on 'model'
     */
    public function import($eloquent_class_name){
        //check 'match' column-field

        //import
        //parse data first
        if(!$this->is_parsed){
            $this->data = $this->parse();
        }
        $model = $eloquent_class_name;
        //check wrong class-name

        //bcs CPU-use, get last-model here, manually handle id, save id-libraries out of auto-increment
        //in future, create 'getId()' for Model
        $model_start_id = 1;
        $last_model = $model::all()->last();
        if($last_model){
            $model_start_id = $last_model->id + 1;
        }
        foreach($this->data as $data_row){
            if(is_array($data_row)){//ensure row has value, each row is an array
                $this->importOneRow($eloquent_class_name, $data_row, $model_start_id);
                $model_start_id++;
            }
        }
        //success import, then delete uploaded-file
        //check success > unlink
        unlink($this->file_path.$this->file_name);
    }
    /*
     * import one-row when read $data
     */
    public function importOneRow($eloquent_class_name, $data_row, $model_start_id){
        $model = $eloquent_class_name;
        $new_model = new $model();
        $i = -1;//$data_row start-index
        foreach($new_model->fillable as $model_column){
            $new_model->$model_column = $data_row[++$i];
        }
        $new_model->id = $model_start_id;
        $new_model->save();
        $this->messages[] = $model.'-'.$new_model->id.':imported';
    }

    public function getNotify(){
        //notify status
        return $this->messages;
    }

    private function getFileName(){
        $this->file_name = basename($_FILES[$this->file_upload_key]['name']);
    }

    public static function export($array_data, $filename = 'result.csv'){
        //download-header
        // disable caching
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // force download
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");

        //convert $array_data to file-csv
        // open the "output" stream, no temp files needed
        // see http://sg2.php.net/manual/en/wrappers.php.php
        if (count($array_data) == 0) {
            return null;
        }
        ob_start();
        $df = fopen("php://output", 'w');
        fputcsv($df, array_keys(reset($array_data)));
        foreach ($array_data as $row) {
            fputcsv($df, $row);
        }
        fclose($df);
        return ob_get_clean();
    }

    public static function arrayToCsv($array_data){
        // open the "output" stream, no temp files needed
        // see http://sg2.php.net/manual/en/wrappers.php.php
        if (count($array_data) == 0) {
            return null;
        }
        ob_start();
        $df = fopen("php://output", 'w');
        fputcsv($df, array_keys(reset($array_data)));
        foreach ($array_data as $row) {
            fputcsv($df, $row);
        }
        fclose($df);
        return ob_get_clean();
    }

    public static function download_send_headers($filename) {
        // disable caching
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // force download
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
    }
}