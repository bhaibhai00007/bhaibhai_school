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

if (!function_exists('my_seo_freindly_url')) {
    function my_seo_freindly_url($String) {
        $ChangedStr = preg_replace('/\%/', ' percentage', $String);
        $ChangedStr = preg_replace('/\@/', ' at ', $ChangedStr);
        $ChangedStr = preg_replace('/\'/', ' - ', $ChangedStr);
        $ChangedStr = preg_replace('/\&/', ' and ', $ChangedStr);
        $ChangedStr = preg_replace('/\s[\s]+/', '-', $ChangedStr);    // Strip off multiple spaces
        $ChangedStr = preg_replace('/[\s\W]+/', '-', $ChangedStr);    // Strip off spaces and non-alpha-numeric
        $ChangedStr = preg_replace('/^[\-]+/', '', $ChangedStr); // Strip off the starting hyphens
        $ChangedStr = preg_replace('/[\-]+$/', '', $ChangedStr); // // Strip off the ending hyphens
        return $ChangedStr;
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

if (!function_exists('get_home_url')) {
    function get_home_url() {
        $CI = & get_instance();
        $countryId = $CI->session->userdata('USER_SHIPPING_COUNTRY');
        if ($countryId == 1) {
            return base_url() . 'send-online-gifts-usa';
        } else if ($countryId == 99) {
            return base_url() . 'send-wine-cakes-flowers-online-india';
        } else if ($countryId == 240) {
            return base_url() . 'send-gifts-worldwide';
        }
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

if (!function_exists('return_current_country_code')) {
    function return_current_country_code() {
        return 'IN';
        die;
        $ip = $_SERVER['REMOTE_ADDR'];

        $params = getopt('l:i:');
        if (!isset($params['l']))
            $params['l'] = 'puDQd5MDgVxy';
        //if (!isset($params['i'])) $params['i'] = '24.24.24.24';
        //if (!isset($params['i'])) $params['i'] = $ip; //'122.177.246.210';
        if (!isset($params['i']))
            $params['i'] = '122.177.246.210';

        $query = 'http://geoip.maxmind.com/a?' . http_build_query($params);

        $insights_keys = array(
            'country_code',
            'country_name',
            'region_code',
            'region_name',
            'city_name',
            'latitude',
            'longitude',
            'metro_code',
            'area_code',
            'time_zone',
            'continent_code',
            'postal_code',
            'isp_name',
            'organization_name',
            'domain',
            'as_number',
            'netspeed',
            'user_type',
            'accuracy_radius',
            'country_confidence',
            'city_confidence',
            'region_confidence',
            'postal_confidence',
            'error'
        );

        $curl = curl_init();
        curl_setopt_array(
                $curl, array(
            CURLOPT_URL => $query,
            CURLOPT_USERAGENT => 'MaxMind PHP Sample',
            CURLOPT_RETURNTRANSFER => true
                )
        );

        $resp = curl_exec($curl);

        if (curl_errno($curl)) {
            throw new Exception(
            'GeoIP request failed with a curl_errno of '
            . curl_errno($curl)
            );
        }

        $insights_values = str_getcsv($resp);
        $insights_values = array_pad($insights_values, sizeof($insights_keys), '');
        $insights = array_combine($insights_keys, $insights_values);
        return $insights['country_code'];
    }

    //send_sms_notification($data){
}

if (!function_exists('send_sms_notification')):
    function send_sms_notification($data) {
        $CI = & get_instance();
        $CI->load->model('User_model', 'user');
        $CI->load->model('Siteconfig_model', 'siteconfig');
        $CI->load->library('tidiitsms');
        /*
          $notify['senderId'] = ;
          $notify['receiverId'] = ;
          $notify['nType'] = ;
          $notify['nTitle'] = ;
          $notify['nMessage'] = ;
         */
        $SMS_SEND_ALLOW = $CI->siteconfig->get_value_by_name('SMS_SEND_ALLOW');
        if ($SMS_SEND_ALLOW == 'yes') {
            $smsLogPath = ResourcesPath . 'sms_log/' . date('d-m-Y') . '/';
            if (!is_dir($smsLogPath)) { //create the folder if it's not already exists
                @mkdir($smsLogPath, 0755, TRUE);
            }
            $logData = $data['nMessage'] . ' message send mobile no ' . $data['receiverMobileNumber'];
            $smsLogFile = $smsLogPath . time() . uniqid() . '.txt';
            if (!write_file($smsLogFile, $logData)) {
                //echo 'Unable to write the file';
            } else {
                //echo 'File written!';
            }
            if (!array_key_exists('receiverMobileNumber', $data)) {
                return FALSE;
            } elseif ($data['receiverMobileNumber'] == "") {
                return FALSE;
            } else {
                if (!array_key_exists('senderId', $data)) {
                    $data['senderId'] = "";
                }

                if (!array_key_exists('receiverId', $data)) {
                    $data['receiverId'] = "";
                }

                if (!array_key_exists('senderMobileNumber', $data)) {
                    $data['senderMobileNumber'] = "";
                }

                if (!array_key_exists('nType', $data)) {
                    $data['nType'] = "";
                }
                //Send Mobile message
                $smsAddHistoryDataArr = array();
                $smsConfig = array('sms_text' => $data['nMessage'], 'receive_phone_number' => $data['receiverMobileNumber']);
                $smsResult = $CI->tidiitsms->send_sms($smsConfig);

                $smsAddHistoryDataArr = array('senderUserId' => $data['senderId'], 'receiverUserId' => $data['receiverId'],
                    'senderPhoneNumber' => $data['senderMobileNumber'], 'receiverPhoneNumber' => $data['receiverMobileNumber'],
                    'IP' => $CI->input->ip_address(), 'sms' => $data['nMessage'], 'sendActionType' => $data['nType'],
                    'smsGatewaySenderId' => $CI->siteconfig->get_value_by_name('SMS_GATEWAY_SENDERID'), 'smsGatewayReturnData' => $smsResult);
                $CI->user->add_sms_history($smsAddHistoryDataArr);
            }
        }
    }

endif;

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

if (!function_exists('send_push_notification')) {
    function send_push_notification($data) {
        $CI = & get_instance();
        $CI->load->model('User_model', 'user');
        $CI->load->model('Siteconfig_model', 'siteconfig');
        //$CI->load->library('tidiitsms');
        /*
          $notify['senderId'] = ;
          $notify['receiverId'] = ;
          $notify['nType'] = ;
          $notify['nTitle'] = ;
          $notify['nMessage'] = ;
         */


        //die('rrr');
        if (!array_key_exists('receiverId', $data)) {
            return FALSE;
        } elseif ($data['receiverId'] == "") {
            return FALSE;
        } else {
            $regIds = $this->user->get_reg_id_by_user_id($data['receiverId']);
            if ($regIds != FALSE) {
                //'data' =>
                $apiData = array('message' => $data['nMessage'], 'userId' => $data['receiverId']);
                $regIdArr = array();
                foreach ($regIds AS $k) {
                    $sendNotificationFlag = FALSE;
                    //$regIdArr[]=$k->registrationId;
                    $fields = array($k->registrationId, $data['nMessage']);
                    if ($data['nType'] == "BUYING-CLUB-ADD" || $data['nType'] == "BUYING-CLUB-MODIFY" || $data['nType'] == "BUYING-CLUB-MODIFY-NEW" || $data['nType'] == "BUYING-CLUB-MODIFY-DELETE") {
                        $apiData['notificationType'] = $data['nType'];
                        $apiData['tagStr'] = $data['nType'];
                        $sendNotificationFlag = TRUE;
                    } else if ($data['nType'] == "BUYING-CLUB-ORDER-DECLINE") {
                        $apiData['orderId'] = $data['orderId'];
                        $sendNotificationFlag = TRUE;
                    } else if ($data['nType'] == "BUYING-CLUB-ORDER") {
                        $apiData['orderId'] = $data['orderId'];
                        $sendNotificationFlag = TRUE;
                    }

                    $apiData['tagStr'] = $data['nType'];
                    if ($sendNotificationFlag == TRUE) {
                        if (send_gsm_message($fields, $data['nType']) == TRUE) {
                            foreach ($regIds as $kk) {
                                $dataArr[] = array('messsage' => $data['nMessage'], 'registrationNo' => $kk->registrationId, 'deviceType' => 'android', 'sendTime' => date('Y-m-d H:i:s'), 'userId' => $data['receiverId']);
                            }
                            $CI->user->save_push_notification_history($dataArr);
                        }
                    }
                }
            } else {
                return FALSE;
            }
        }
    }

}

if (!function_exists('send_normal_push_notification')) {
    function send_normal_push_notification($data) {
        $CI = & get_instance();
        $CI->load->model('User_model', 'user');
        $CI->load->model('Siteconfig_model', 'siteconfig');
        //$CI->load->library('tidiitsms');
        /*
          $notify['senderId'] = ;
          $notify['receiverId'] = ;
          $notify['nType'] = ;
          $notify['nTitle'] = ;
          $notify['nMessage'] = ;
         */

        //die('rrr');
        if (!array_key_exists('receiverId', $data)) {
            return FALSE;
        } elseif ($data['receiverId'] == "") {
            return FALSE;
        } else {
            $regIds = $CI->user->get_reg_id_by_user_id($data['receiverId']);
            if ($regIds != FALSE) {
                $regIdArr = array();
                foreach ($regIds AS $k) {
                    //$regIdArr[]=$k->registrationId;
                    $fields = array($k->registrationId, $data['nMessage']);
                    if (send_gsm_message($fields) == TRUE) {
                        foreach ($regIds as $kk) {
                            $dataArr[] = array('messsage' => $data['nMessage'], 'registrationNo' => $kk->registrationId, 'deviceType' => 'android', 'sendTime' => date('Y-m-d H:i:s'), 'userId' => $data['receiverId']);
                        }
                        $CI->user->save_push_notification_history($dataArr);
                    }
                    //}
                    //$fields=array('registration_ids'=>$regIdArr,'data' =>array('message'=>$data['nMessage']));
                    /* $fields=array($regIdArr,$data['nMessage']);
                      if(send_gsm_message($fields)==TRUE){
                      foreach($regIds as $k){
                      $dataArr[]=array('messsage'=>$data['nMessage'],'registrationNo'=>$k->registrationId,'deviceType'=>'android','sendTime'=>date('Y-m-d H:i:s'),'userId'=>$data['receiverId']);
                      }
                      $CI->user->save_push_notification_history($dataArr);
                      } */
                }
            } else {
                return FALSE;
            }
        }
    }

}

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

if (!function_exists('generate_user_table_data_arr')) {
    function generate_user_table_data_arr($tableUserStructureTextArr,$type){
        $CI=& get_instance();
        $userDataArr=array();
        foreach ($tableUserStructureTextArr AS $key => $val) {
            $userDataArr[$key]= $CI->input->post($key,TRUE);
        }
        //$passcode=generate_passcode('teacher');
        $passcode=generate_passcode($type['typeText']);
        $userDataArr['passcode']=$passcode;
        $userDataArr['password']= base64_encode($passcode).'~'.md5('jsrob');
        $userDataArr['userType ']= substr($passcode, 0,3);
        $userDataArr['status ']=1;
        $userDataArr['schoolId']=$CI->session->userdata('USER_SCHOOL_ID');
        if($userDataArr['schoolId']==""){
            $userDataArr['schoolId']=1;
        }
        return $userDataArr;
    }
}

if (!function_exists('bulk_upload_generate_user_table_data_arr')) {
    function bulk_upload_generate_user_table_data_arr($userDataArr,$type){
        $CI=& get_instance();
        //$passcode=generate_passcode('teacher');
        $passcode=generate_passcode($type['typeText']);
        $userDataArr['passcode']=$passcode;
        $userDataArr['password']= base64_encode($passcode).'~'.md5('jsrob');
        $userDataArr['userType ']= substr($passcode, 0,3);
        $userDataArr['status ']=1;
        $userDataArr['schoolId']=$CI->session->userdata('USER_SCHOOL_ID');
        if($userDataArr['schoolId']==""){
            $userDataArr['schoolId']=1;
        }
        return $userDataArr;
    }
}

if (!function_exists('generate_user_table_data_arr_for_edit')) {
    function generate_user_table_data_arr_for_edit($tableUserStructureTextArr,$type){
        $CI=& get_instance();
        foreach ($tableUserStructureTextArr AS $key => $val) {
            if(!array_key_exists('not_editable', $val))
                $userDataArr[$key]= $CI->input->post($key,TRUE);
        }
        return $userDataArr;
    }
}

if (!function_exists('generate_form_validation_arr')) {
    function generate_form_validation_arr($tableTeacherStructureTextArr,$formValidationConfigArr=array(),$actionEdit=FALSE){
        foreach ($tableTeacherStructureTextArr AS $key => $val) {
            if($actionEdit==TRUE && array_key_exists('not_editable', $val)){
                continue;
            }else{
                $tempArr = array('field' => $key, 'label' => $val['label']);
                $ruleStr = 'trim|xss_clean';
                $ruleStr .= generate_form_validation_rules($val);
                $tempArr['rules'] = $ruleStr;
                $formValidationConfigArr[] = $tempArr;
            }
        }
        return $formValidationConfigArr;
    }
}

if (!function_exists('generate_form_validation_rules')) {
    function generate_form_validation_rules($val){
        $ruleStr = '';
        if (array_key_exists('required', $val)):
            $ruleStr .= '|required';
        //$element.=' required="required"';
        endif;
        if (array_key_exists('type', $val)):
            if ($val['type'] == 'email') {
                $ruleStr .= '|valid_email';
            }
            if ($val['type'] == 'tel') {
                $ruleStr .= '|numeric|max_length[10]';
            }
        endif;
        
        if (array_key_exists('is_unique', $val)):
            $ruleStr .= '|is_unique[' . $val['is_unique'] . ']';
        //$element.=' required="required"';
        endif;
        return $ruleStr;
    }
}

if (!function_exists('generate_passcode')) {
    function generate_passcode($type){
        $passcode='';
        switch ($type){
            case 'parent':
                $passcode='PAR';
                break;
            case 'student':
                $passcode='STU';
                break;
            case 'teacher':
                $passcode='TEA';
                break;
            case 'librarian':
                $passcode='LIA';
                break;
            case 'accountant':
                $passcode='ACC';
                break;
            case 'busdriver':
                $passcode='BUS';
                break;
            case 'pricipal':
                $passcode='PRI';
                break;
            defult:
            break;
        }
        $length=5;
        $randumStr=substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
        $length=4;
        $randumStr1=substr(str_shuffle(str_repeat($x=time(), ceil($length/strlen($x)) )),1,$length);
        $passcode.=$randumStr.$randumStr1;
        return $passcode;
    }
}


if(!function_exists('generate_roll_no')){
    function generate_roll_no($class_id,$section_id){
        if($section_id=="" || $section_id == ""){
            return FALSE;
        }else{
            $CI=&get_instance();
            $sqlRoll="SELECT MAX(roll) latest_roll FROM enroll WHERE class_id='".$class_id."' AND section_id='".$section_id."'";
            generate_log($sqlRoll);
            $rsRoll=$CI->db->query($sqlRoll)->result_array();
            generate_log(serialize($rsRoll));
            generate_log("==".$rsRoll[0]['latest_roll']."==");
            if(count($rsRoll)>0 || $rsRoll[0]['latest_roll']!=NULL || $rsRoll[0]['latest_roll']!=""){
                return (int)$rsRoll[0]['latest_roll']+1;
            }else{
                return 1;
            }
        }
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

if ( ! function_exists('success_response_after_post_get')){
    function success_response_after_post_get($parram){
        $result=array();
        if(!array_key_exists('ajaxType', $parram)):
            if(array_key_exists('master_ip', $parram)){
                $result=  get_default_urls($parram['master_ip']);    
            }else{
                $result=  get_default_urls();    
            }
        endif;
        //$result['message']="Shipping address data updated successfully.";
        $result['timestamp'] = time();
        if(!empty($parram)):
            foreach ($parram as $k => $v){
                $result[$k]=$v;
            }
        endif;
        
        header('Content-type: application/json');
        echo json_encode($result);
    }
}

if ( ! function_exists('get_default_urls')){
    function get_default_urls($ip=SMS_IP_ADDR){
        $result=array();
        $result['site_logo_image_url']='http://'.$ip.'/upload/';
        $result['site_image_url']='http://'.$ip.'/assets/images/';
        $result['site_image_url']='http://'.$ip.'/assets/images/';
        return $result;
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
       $CI= & get_instance();
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

if(!function_exists('create_excel_file')){
    function create_excel_file($file_name_path,$data,$sheet_title="Student Upload Data"){
        include_once APPPATH.'third_party/PHPExcel.php';
        
        $objPHPExcel=new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0)->fromArray($data);
        $objPHPExcel->getActiveSheet()->setTitle($sheet_title);
        //$filename='just_some_random_name.xls'; 
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); //- See more at: https://arjunphp.com/how-to-use-phpexcel-with-codeigniter/#sthash.0d4ttuQe.dpuf
        //$filePath=$_SERVER['DOCUMENT_ROOT'].'/rentbike/uploads/'.$filename;
        $objWriter->save($file_name_path);
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

if(!function_exists('create_excel_file_multiple_sheet')){
    function create_excel_file_multiple_sheet($file_name_path,$data){
        include_once APPPATH.'third_party/PHPExcel.php';
        //pre($data);die;
        $objPHPExcel=new PHPExcel();
        foreach($data AS $k => $v){ 
            $key= array_keys($v);
            //pre($key);die;
            $cSheetData=array();
            $cSheetData=$v[$key[0]];
            //pre($key);
            //pre($cSheetData);die;
            if($key==0){
                $objPHPExcel->setActiveSheetIndex(0)->fromArray($cSheetData);
                $objPHPExcel->getActiveSheet()->setTitle($key[0]);
            }else{
                $objPHPExcel->createSheet();
                $sheet = $objPHPExcel->setActiveSheetIndex($k);
                $sheet->fromArray($cSheetData);
                $sheet->setTitle($key[0]);
            }
        }
        
        //$filename='just_some_random_name.xls'; 
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); //- See more at: https://arjunphp.com/how-to-use-phpexcel-with-codeigniter/#sthash.0d4ttuQe.dpuf
        //$filePath=$_SERVER['DOCUMENT_ROOT'].'/rentbike/uploads/'.$filename;
        $objWriter->save($file_name_path);
    }
}

if(!function_exists('read_mark_data_from_excel_file')){
    function read_mark_data_from_excel_file($file_path){
        include_once APPPATH.'third_party/PHPExcel.php';
        //include  FCPATH.'application/third_party/PHPExcel/IOFactory.php';
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objReader->setReadDataOnly(true);

        $objPHPExcel = $objReader->load($file_path);
        $totalSheet= $objPHPExcel->getSheetCount();
        $i = 0;
        $data=array();
        while ($i<$totalSheet){
            $objPHPExcel->setActiveSheetIndex($i);
            $sheetTitle=$objPHPExcel->getActiveSheet()->getTitle();
            $activeSheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
            $data[$sheetTitle]=$activeSheetData;
            $i++;
        }
        return $data;
    }
}

