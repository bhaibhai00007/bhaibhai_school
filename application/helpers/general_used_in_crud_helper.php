<?php

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

if(!function_exists('generate_enroll_code')):
    function generate_enroll_code(){
        /// wite login got generate enrolle code
        $prefixArr= get_data_generic_fun('sc_settings','constantValue',array('constantName'=>'SCHOOL_ENROLL_PREFIX'),'result_arr');
        $suffixArr= get_data_generic_fun('sc_settings','constantValue',array('constantName'=>'SCHOOL_ENROLL_SUFFIX'),'result_arr');
        $sufixVal=(int)$suffixArr[0]['constantValue'];
        $enrollCode=$prefixArr[0]['constantValue'].'-'.str_pad($sufixVal,6,'0',STR_PAD_LEFT);
        return $enrollCode;
    }
endif;

if(!function_exists('generate_enroll_data_arr')):
    function generate_enroll_data_arr($enrollData){   
        //pre($enrollData) ;
        $sessionId=get_current_school_sessionid();
        //pre('sessionId : '.$sessionId) ;die;
        $enrollData['sessionId']=$sessionId;
        //pre($enrollData) ;die;
        $enrollData['enrollCode']=generate_enroll_code();
        return $enrollData;
    }
endif;
