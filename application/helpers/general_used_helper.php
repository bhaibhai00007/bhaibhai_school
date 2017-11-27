<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('short_words')) {
    function short_words($str, $NoOfWorrd = 20) {
        $strArr = explode(' ', $str);
        $shortStr = '';
        if (count($strArr) < $NoOfWorrd)
            $NoOfWorrd = count($strArr);
        for ($i = 0; $i < $NoOfWorrd; $i++) {
            if ($i == 0) {
                $shortStr = $strArr[$i];
            } else {
                $shortStr .= ' ' . $strArr[$i];
            }
        }
        return $shortStr;
    }

}

if (!function_exists('check_exists_BPO')) {

    function check_exists_BPO($v, $rs) {
        foreach ($rs AS $k) {
            if ($k['Objectives'] == $v) {
                return true;
            }
        }
        return false;
    }

}

if (!function_exists('pre')) {
    function pre($var) { //die('rrr');
        echo '<pre>'; //print_r($var);
        if (is_array($var) || is_object($var)) {
            print_r($var);
        } else {
            var_dump($var);
        }
        echo '</pre>';
    }

}

if (!function_exists('multiple_array_search')) {
    function multiple_array_search($id, $column, $dataArray) { //die('rrr');
        foreach ($dataArray as $key => $val) {
            //echo $val[$column].' = '.$id .'<br>';
            if ($val[$column] === $id) {
                //echo 'PP';
                return $key;
            } else {
                //echo 'zzz';
            }
        }
        return FALSE;
    }

}

if (!function_exists('user_role_check')) {
    function user_role_check($controller, $method) {
        $CI = &get_instance();
        if ($CI->session->userdata('ADMIN_SESSION_USER_VAR_TYPE') == 'supper_admin') {
            return TRUE;
        }
        //$roleArr=$CI->se
        $found = FALSE;
        $roleVar = unserialize($CI->session->userdata('ADMIN_ROLE_VAR'));
        //pre($roleVar);die;
        if (in_array($controller, $roleVar['controller'])) {
            return TRUE;
        } else {
            return FALSE;
        }
        /* foreach($roleVar AS $k => $v){
          if($v['method']==$method && $v['controller']==$controller){
          return TRUE;
          }elseif($v['controller']==$controller){
          return TRUE;
          }
          } */
    }

}

if (!function_exists('title_more_string')) {
    function title_more_string($str, $no_char = 22) {
        $strArr = explode(' ', $str);
        $strLen = 0;
        $newStr = '';
        foreach ($strArr AS $k) {
            $strLen = $strLen + strlen($k);
            if ($strLen > $no_char) {
                return $newStr . ' .....';
            }
            $newStr .= $k . ' ';
        }
        return $str;
    }

}

if (!function_exists('get_full_address_from_lat_long')):
    function get_full_address_from_lat_long($lat, $long) {
        $url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$long&sensor=false";
        // Make the HTTP request
        $data = @file_get_contents($url);
        // Parse the json response
        $jsondata = json_decode($data, true);
        return $jsondata["results"][0]["formatted_address"];
    }
endif;

if (!function_exists('get_country_code_from_lat_long')):
    function get_country_code_from_lat_long($lat, $long) {
        return 'IN';
        //("country", $jsondata["results"][0]["address_components"]);
        /* $url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$long&sensor=false";
          // Make the HTTP request
          $data = @file_get_contents($url);
          // Parse the json response
          $jsondata = json_decode($data,true);
          //pre($jsondata);die;
          if(!empty($jsondata["results"])){
          foreach( $jsondata["results"][0]["address_components"] as $value) {
          if (in_array('country', $value["types"])) {
          return $value["short_name"];
          }
          }
          }else{
          return FALSE;
          } */
        //return $jsondata["results"][0]["formatted_address"];
    }

endif;


if (!function_exists('get_formatted_address_from_lat_long')):
    function get_formatted_address_from_lat_long($lat, $long) {
        //("country", $jsondata["results"][0]["address_components"]);
        $url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$long&sensor=false";
        // Make the HTTP request
        $data = @file_get_contents($url);
        // Parse the json response
        $jsondata = json_decode($data, true);

        if (array_key_exists('formatted_address', $jsondata["results"][0])) {
            return $jsondata["results"][0]["formatted_address"];
        } else {
            return FALSE;
        }
        //return $jsondata["results"][0]["formatted_address"];
    }

endif;

if (!function_exists('send_gsm_message')) {
    function send_gsm_message($fields_data, $action_data = "") {
        $CI = & get_instance();
        $CI->load->config('product');
        $GOOGLE_API_KEY = $CI->config->item('GoogleGSMKEY');
        //$url = 'https://android.googleapis.com/gcm/send';
        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = array(
            'to' => $fields_data[0],
            'notification' => array('title' => 'Retailershangout Notification', 'body' => $fields_data[1]),
            'data' => array('show_screen' => $action_data)
        );

        $headers = array(
            'Authorization: key=' . $GOOGLE_API_KEY,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        // Close connection
        curl_close($ch);
        $jsonObject = json_decode($result);
        if (isset($jsonObject->success) && $jsonObject->success == 1) {
            //if ($result === FALSE) {
            //die('Curl failed: ' . curl_error($ch));
            //return FALSE;
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

if (!function_exists('generate_breadcrumb')) {
    function generate_breadcrumb($breadcrumbDataArr = array()) {
        $breadcrumbStr = '<div id = "breadcrumb"><a href = "' . BASE_URL . '" title = "Go to Home" class = "tip-bottom"><i class = "icon-home"></i> Home</a>';
        foreach ($breadcrumbDataArr AS $k => $v) {
            if (array_key_exists('breadcrumbLink', $v)) {
                $breadcrumbStr .= '<a href = "' . $v['breadcrumbLink'] . '" class = "tip-bottom"';
            } else {
                $breadcrumbStr .= '<a href = "#" class = "current"';
            }

            if (array_key_exists('tooltip', $v)) {
                $breadcrumbStr .= 'title = "' . $v['tooltip'] . '"';
            }
            $breadcrumbStr .= '>';
            if (array_key_exists('breadcrumbIcon', $v)) {
                $breadcrumbStr .= '<i class = "' . $v['breadcrumbIcon'] . '"></i>';
            }
            $breadcrumbStr .= $v['breadcrumbText'] . ' </a>';
        }
        $breadcrumbStr .= '</div>';
        return $breadcrumbStr;
    }

}

if(!function_exists('get_user_img_url')){
    function get_user_img_url($type,$id){
        //echo $type.$id; exit;
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg')){
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
            //echo $image_url; exit;
        }else{
            $image_url = base_url() . 'uploads/user.jpg';
        //echo $image_url. "fgfg"; exit; http://localhost/beta_ag/uploads/admin_image/1.jpg
        }
        return $image_url;
    }
}

if(!function_exists('create_school_data_backup')){
    function create_school_data_backup($backupFilename,$backup_drive){
        generate_log("calling create_mysql_manual_back_up_current_db.log()","create_mysql_manual_back_up_current_db.log");
        date_default_timezone_set('Asia/Calcutta');
        
        $CI=&get_instance();
        $CI->load->dbutil();
        $tables         =       $CI->db->list_tables(); 
        $statement_values   =   '';
        $statement_values   .=   'SET @TRIGGER_BEFORE_INSERT_CHECKS = FALSE;'.PHP_EOL;
        $statement_values   .=   'SET @TRIGGER_AFTER_INSERT_CHECKS = FALSE;'.PHP_EOL;
        $statement_values   .=   'SET @TRIGGER_BEFORE_UPDATE_CHECKS = FALSE;'.PHP_EOL;
        $statement_values   .=   'SET @TRIGGER_AFTER_UPDATE_CHECKS = FALSE;'.PHP_EOL;
        $statement_values   .=   'SET @TRIGGER_BEFORE_DELETE_CHECKS = FALSE;'.PHP_EOL;
        $statement_values   .=   'SET @TRIGGER_AFTER_DELETE_CHECKS = FALSE;'.PHP_EOL;
        $statement_values   .=   'SET FOREIGN_KEY_CHECKS=0;'.PHP_EOL;
        $statement_query    =   '';
        $prev_table_name="";
        $skipTableBackupArr=array('member','member1');
        $skipTableArr=array();
        foreach ($tables as $table_names){
            generate_log("start for ".$table_names,"database_data_backup_log_".CURRENT_INSTANCE.".log");
            if(in_array($table_names, $skipTableBackupArr)){
                continue;
            }
            if(!in_array($table_names, $skipTableArr)){
                if($table_names=='main_currency'){
                    $statement_values.=PHP_EOL."TRUNCATE TABLE `tm_emp_timesheets`;".PHP_EOL;
                    $statement_values.=PHP_EOL."TRUNCATE TABLE `tm_projects`;".PHP_EOL;
                }
                $statement_values.=PHP_EOL."TRUNCATE TABLE `".$table_names."`;".PHP_EOL;
            }
            generate_log("just before taking data from table get_data_generic_fun(): ".$table_names,"database_data_backup_log_".CURRENT_INSTANCE.".log");
            $statement =  get_data_generic_fun($table_names,'*',array(),'result_arr');
            if(!empty($statement)){
                foreach ($statement as $key => $post) {
                    if(isset($statement_values)) {
                        $statement_values .= "\n";
                    }
                    $values = array_values($post);
                    foreach($values as $index => $value) {
                        $quoted = str_replace("'","\'",str_replace('"','\"', $value));
                        $values[$index] = (!isset($value) ? 'NULL' : "'" . $quoted."'") ;
                    }
                $statement_values .="insert into ".$table_names." values "."(".implode(',',$values).");";
                }
                generate_log("get_data_generic_fun() return data for : ".$table_names." ==== ".$statement_values,"database_data_backup_log_".CURRENT_INSTANCE.".log");
            }else{
                generate_log("get_data_generic_fun() return no data : ".$table_names,"database_data_backup_log_".CURRENT_INSTANCE.".log");
            }
            $statement = $statement_values . ";";     
        }
        $statement_values   .=   PHP_EOL.'SET @TRIGGER_BEFORE_INSERT_CHECKS = TRUE;'.PHP_EOL;
        $statement_values   .=   'SET @TRIGGER_AFTER_INSERT_CHECKS = TRUE;'.PHP_EOL;
        $statement_values   .=   'SET @TRIGGER_BEFORE_UPDATE_CHECKS = TRUE;'.PHP_EOL;
        $statement_values   .=   'SET @TRIGGER_AFTER_UPDATE_CHECKS = TRUE;'.PHP_EOL;
        $statement_values   .=   'SET @TRIGGER_BEFORE_DELETE_CHECKS = TRUE;'.PHP_EOL;
        $statement_values   .=   'SET @TRIGGER_AFTER_DELETE_CHECKS = TRUE;'.PHP_EOL;
        $statement_values   .=   'SET FOREIGN_KEY_CHECKS=1;'.PHP_EOL;
        $backup         =   $statement_values;
        //echo $backup;die;
        generate_log("helper init for save the backup data to SQL : ","create_mysql_manual_back_up_current_db.log");
        $CI->load->helper('file'); 
        generate_log("back_up_file_full_path : ".$backup_drive.$backupFilename,"create_mysql_manual_back_up_current_db.log");
        write_file($backup_drive.$backupFilename, $backup);
        //die("write done");
        generate_log("going back to main function : ","create_mysql_manual_back_up_current_db.log");
        return $backupFilename;
    }
}
if(!function_exists('get_session_links')){
	function get_session_links($sess_link_id=false){
        $CI=&get_instance();
        $CI->load->dbutil();
        $rec = $CI->db->get_where('session_links',array('id'=>$sess_link_id))->row();
        $links = $rec?json_decode($rec->links,true):array();
        buildMenu($links);
    }
}

if(!function_exists('generate_log')){
	function generate_log($message,$log_file_name="",$isOverwritting=FALSE){
        $dir="";
        //die($dir);
        if($_SERVER['HTTP_HOST']==CURRENT_IP_ADDR || $_SERVER['HTTP_HOST']==SMS_IP_ADDR || $_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='localhost:8080'){
            $dir .= SchoolResourcesPath.'msc_logs/';
        }else{
                $dir .= SchoolResourcesPath.'msc_logs/';
        }
        if($log_file_name==""){
            $log_file_path=$dir.'demo_school_curl_'.date('Y-m-d').'.log';
        }else{
            $log_file_path=$dir.$log_file_name;
        }
        //echo $log_file_path;die;
        if($isOverwritting == FALSE){
            $fileOpenType = 'a+';
        }else{
            $fileOpenType = 'w+';
        }   
        if (!$handle = fopen($log_file_path, $fileOpenType)) {
            return false;
        }else{
            $message.=PHP_EOL;
            if (fwrite($handle, $message) === FALSE) {
                return false;
            }else{
                fclose($handle);
            }
        }
    }
}


if(!function_exists('get_data_generic_fun')){
    /**
    * 
    * @param type $columnName
    * @param type $conditionArr
    * @param type $return_type="result"
    * @return type
    * example it will use in controlelr
    * 
    * =====bellow is for * data without conditions======
    * get_data_generic_fun('parent','*');
    *  =====bellow is for * data witht conditions======
    * get_data_generic_fun('parent','*',array('column1'=>$column1Value,'column2'=>$column2Value));
    * 
    * =====bellow is for 1 or more column data without conditions======
    * get_data_generic_fun('parent','column1,column2,column3');
    *  =====bellow is for 1 or more column data with conditions======
    * get_data_generic_fun('parent','column1,column2,column3',array('column1'=>$column1Value,'column2'=>$column2Value));
    *  =====bellow is for 1 or more column data with conditions and return as result all======
    * get_data_generic_fun('parent','column1,column2,column3',array('column1'=>$column1Value,'column2'=>$column2Value),'result_arr');
    * 
    * ==== modification for  adding sortby and limit and add conditionArr for AND -- OR -- IN ---
    * get_data_generic_fun('parent','parent_id,passcode',array('passcode'=>$passcoad,'device_token'=>$deviceToken,'condition_type'=>'or'),array('parrent_id'=>'asc','date_time'=>'desc'),1);
    */
   function get_data_generic_fun($table_name,$columnName="*",$conditionArr=array(),$return_type="result",$sortByArr=array(),$limit=""){
       $CI = &get_instance();
       $CI->db->select($columnName);
       $condition_type='and';
       if(array_key_exists('condition_type', $conditionArr)){
           if($conditionArr['condition_type']!=""){
               $condition_type=$conditionArr['condition_type'];
           }
       }
       unset($conditionArr['condition_type']);
       $condition_in_data_arr=array();
       $startCounter=0;
       $condition_in_column="";
       foreach($conditionArr AS $k=>$v){
           if($condition_type=='in'){
               if(array_key_exists('condition_in_data', $conditionArr)){
                   $condition_in_data_arr=  explode(',', $conditionArr['condition_in_data']);
                   $condition_in_column=$conditionArr['condition_in_col'];
               }
               
           }elseif($condition_type=='or'){
               if($startCounter==0){
                   $CI->db->where($k,$v);
               }else{
                   $CI->db->or_where($k,$v);
               }
           }elseif($condition_type=='and'){
               $CI->db->where($k,$v);
           }
           $startCounter++;
       }
        
        if($condition_type=='in'){
            if(!empty($condition_in_data_arr))
                $CI->db->where_in($condition_in_column,$condition_in_data_arr);
       }

       if($limit!=""){
           $CI->db->limit($limit);
       }

       foreach($sortByArr AS $key=>$val){
           $CI->db->order_by($key,$val);
       }

       if($return_type=='result'){
           $rs=$CI->db->get($table_name)->result();
       }else{
           $rs=$CI->db->get($table_name)->result_array();
       }
       
       if($table_name!="settings")
            generate_log($CI->db->last_query(),'get_data_generic_fun_'.date('d-m-Y-H').'.log');
       
       return $rs;
   } 
} 

if(!function_exists('fire_api_by_curl')){
    function fire_api_by_curl($url,$post){
        generate_log($url.PHP_EOL);
        generate_log('starting curl execute with POST fields '.json_encode($post) . PHP_EOL);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        
        generate_log('starting curl execute ' . PHP_EOL);
        // execute!
        $response = curl_exec($ch);
        generate_log('getting cURL ' . $url . ' response ' . $response . PHP_EOL);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        generate_log('getting cURL status ' . $status . ' response ' . $response . PHP_EOL);
        if($response === false){
            generate_log('getting cURL error Details ' . curl_error($ch)  . PHP_EOL);
        }
        curl_close($ch);
        return $response;
    }
    
}

if(!function_exists('admission_process_allow')){
    function admission_process_allow(){
        $CI                             =       &get_instance();
        $CI->load->model('Admission_settings_model');
        
        $cYear=date('Y')+1;
        $student_running_year=($cYear-1).'-'. ($cYear); 
        $rsCSetting=$CI->Admission_settings_model->get_admission_settings_by_running_year($student_running_year);
        if(count($rsCSetting)>=1 && $rsCSetting[count($rsCSetting)-1]->isActive==1){
            return 1;
        }else{
            return 0;
        }
    }   
}

if(!function_exists('get_current_school_sessionid')):
    function get_current_school_sessionid(){
        /// get data from setting by query..
        $CI=&get_instance();
        $CI->load->model('Sc_settings_model');
        $sessionId=$CI->Sc_settings_model->get_current_session_id();
        //die('sessionId : '.$sessionId);
        return $sessionId;
    }
endif;

if(!function_exists('send_notification_by_group')):
    function send_notification_by_group($notificationGroup,$sendTos,$messageArr){
        
    }
endif;

/**
 * 
 * $notificationGroup ==>> school_in,school_out,exam,function etc
 * $sendToType mostly 3 type as bellow
 *      1 =>common,
 *      2=>Specific Group like 
 *             parent,teacher,student 
 *                           if student then class and section must specificy
 *      3=>by ids group of ids wit type
*    example :-
*    for 1 case $sendToType=array('groupType'=>'common');
*    for 2 case
 *          $sendToType=array('groupType'=>'specific','groupMemberType'=>'teacher'); 
 *          $sendToType=array('groupType'=>'specific','groupMemberType'=>'parent','classId'=>5);
 *          $sendToType=array('groupType'=>'specific','groupMemberType'=>'student','classId'=>5,'sectionId'=>10);
 *   for 3 case
 *          $sendToType=array('groupType'=>'ungroup'); 
 * $messageArr=array('msgBody'=>$messageContent,'msgTitle'=>'message title');
 * 
 * if $sendToType groupType will 'ungroup' then send there user ids by array else it will nothing
 * 
 */
if(!function_exists('fire_notification_manager')):
    function fire_notification_manager($notificationGroup,$sendToType,$messageArr,$sendTos=array()){
        if($sendToType['groupType']=='ungroup'):
            /// sending message now istead of store it in queue
            send_notification_by_group($notificationGroup,$sendTos,$messageArr);
        else:
            //store it is quue
            $CI=&get_instance();
            $CI->load->model('Sc_notification_queue_model');
            $dataArr=array('notificationGroupId'=>$notificationGroup,$sendToType['groupType']);
            if(array_key_exists('groupMemberType',$sendToType)):
                $dataArr['groupMemberType']=$sendToType['groupMemberType'];
            endif;

            if(array_key_exists('classId',$sendToType)):
                $dataArr['classId']=$sendToType['classId'];
            endif;

            if(array_key_exists('sectionId',$sendToType)):
                $dataArr['sectionId']=$sendToType['sectionId'];
            endif;
            $dataArr['msgBody']=$messageArr['msgBody'];

            if(array_key_exists('msgTitle',$messageArr)):
                $dataArr['msgTitle']=$sendToType['msgTitle'];
            endif;
            $this->Sc_notification_queue_model->add($dataArr);
        endif;
    }
endif;


