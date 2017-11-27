<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bulk_upload_controller extends MY_Controller {

    private $_SEODataArr = array();

    function __construct() {
        parent::__construct();
        $generalDataArr = array();
        $meta = array();
        $generalDataArr['MetaTitle'] = "Temp School";
        $meta[] = array('name' => 'description', 'content' => "School");
        $meta[] = array('name' => 'keywords', 'content' => 'content');
        $generalDataArr['meta'] = $meta;
        $generalDataArr['ogImage'] = '';
        $this->_SEODataArr = $generalDataArr;
    }
    
    function download_bulk_upload_template($userType){
        $this->load->helper('download');
        $data = file_get_contents(SchoolResourcesPath.'all_templates/'.$userType.'_upload_template.xlsx');
        //$name = 'parent_bulk_upload_error_details_for_excel_file.xlsx';
        $name = $userType.'_upload_template.xlsx';
        force_download($name, $data);
    }
    
    function download_bulk_upload_error($userType){
        $this->load->helper('download');
        $data = file_get_contents(SchoolResourcesPath.'bulk_upload_error/'.$userType.'_bulk_upload_error_details_for_excel_file.xlsx');
        $name = $userType.'_bulk_upload_with_error_data.xlsx';
        force_download($name, $data);
    }
    
    function teacher_upload_process() {
        $config['upload_path'] = SchoolResourcesPath . 'uploads/';
        $config['allowed_types'] = 'xls|xlsx';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('userFile')) {
            //$error = array('error' => );
            echo json_encode(array('result'=>'bad','msg'=>$this->upload->display_errors()));die;
        } else {
            $data = $this->upload->data();
            $excelFilePath=$data['full_path'];
            //$excelFilePath=SchoolResourcesPath."uploads/teacher_upload_template.xlsx";
            $this->load->library('Excel_lib',array('excelFilePath'=>$excelFilePath));
            //die("kkk");
            @ini_set('memory_limit', '-1');
            @set_time_limit(0);
            $num_cols= $this->excel_lib->get_num_cols();
            $f = 0;
            $fielsdStringForAdmin="First Name,Last Name,phone number,user name,DOB,DOJ,Job Title,qualification,specialisation,experience,gender,blood,group,address,country,state,city,zip code,home phone,cardid"; /// lable in excel file
            $fielsdString="fName,lName,phoneNumber,userName,DOB,DOJ,jobTitleId,qualification,specialisation,experience,genderId,bloodGroupId,address,countryId,stateId,cityId,zipCode,homePhone,cardId"; // real db fields
            $fielsdStringMandotary =$fielsdString ;// real db fields which are mandetory;
            $fielsdArr = explode(',', $fielsdString);
            $fielsdStringForAdminArr = explode(',', $fielsdStringForAdmin);
            $fielsdStringMandotaryArr = explode(',', $fielsdStringMandotary);
            
            $someRowError = FALSE;
            $errorMsgArr = array();
            $errorExcelArr = array();
            $errorExcelArr[] = $fielsdStringForAdminArr;
            $errorRowNo = 2;
            $allDataRows=$this->excel_lib->get_all_rows();
            $NotAutoAddCollArr=array('DOB','DOJ','jobTitleId','genderId','bloodGroupId','countryId','stateId','cityId');
            //pre($allDataRows);die;
            $this->load->model('Sc_user_model');
            foreach ($allDataRows as $r) {
                $data = array();
                $dataStudent = array();
                $error = FALSE;
                // Ignore the inital name row of excel file
                if ($f == 0) {
                    $f++;
                    continue;
                } $f++;
                
                //pre($r); die('here');
                //pre($r);pre('above are $r data');
                if ($num_cols > count($fielsdArr)) {
                    $num_cols = count($fielsdArr);
                }
                $blankErrorMsgArr = array();
                $errorRowIncrease = FALSE;
                
                for ($i = 0; $i < $num_cols; $i++) {    // checking is filds is mandetory or not
                    //pre($fielsdArr); echo $i;
                    if (in_array($fielsdArr[$i], $fielsdStringMandotaryArr)) {
                        //pre($fielsdArr[$i]);die;
                        //now validating mandetory fiels
                        //generate_log("Field ".$fielsdArr[$i]." value ".$r[$i]."\n",'student_bulk_upload_'.date('d-m-Y-H').'.log');
    
                        if (trim($r[$i]) == "") {
                            $error = TRUE;
                            $blankErrorMsgArr[] = $fielsdStringForAdminArr[$i] . " should not be blank at row no " . $errorRowNo;
                            //pre($blankErrorMsgArr);die;
                        } else {
                            $validPhoneEmailCheck = "ok";
                            $rsEmailPhoneUnique = array();
                            // now check teh uniques for email then phone
    
                            /*$fieldType = $this->Dynamic_field_model->get_field_type_student($fielsdArr[$i]);
                            //pre('$fieldType : '.$fieldType);
                            if ($fieldType == 'email') {
                                $rsEmailPhoneUnique = $this->Student_model->get_data_by_cols('student_id', array($fielsdArr[$i] => trim($r[$i])));
                                $validPhoneEmailCheck = $this->checkValidPhoneEmail(trim($r[$i]), 'email');
                            }
    
                            if ($fieldType == 'tel') {
                                $rsEmailPhoneUnique = $this->Student_model->get_data_by_cols('student_id', array($fielsdArr[$i] => trim($r[$i])));
                                $validPhoneEmailCheck = $this->checkValidPhoneEmail(trim($r[$i]), 'phone');
                            }*/
    
                            if ($fielsdArr[$i] == 'userName') {
                                $rsEmailPhoneUnique = $this->Sc_user_model->get_data_by_cols('userId', array('userName' => trim($r[$i])));
                                $validPhoneEmailCheck = $this->checkValidPhoneEmail(trim($r[$i]), 'email');
                            } elseif ($fielsdArr[$i] == 'phoneNumber') {
                                $rsEmailPhoneUnique = $this->Sc_user_model->get_data_by_cols('userId', array('phoneNumber' => trim($r[$i])));
                                $validPhoneEmailCheck = $this->checkValidPhoneEmail(trim($r[$i]), 'phone');
                            } 
    
                            if (count($rsEmailPhoneUnique) > 0) {
                                $error = TRUE;
                                $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " is already entered.Should be unique information at row no -" . $errorRowNo;
                                //echo '<br>';
                            }
    
                            if ($validPhoneEmailCheck != 'ok') {
                                $error = TRUE;
                                $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " Should be " . $validPhoneEmailCheck . " at row no -" . $errorRowNo;
                            }
    
                            //pre("kkk");pre($errorMsgArr);die;
    
                            if ($fielsdArr[$i] == 'DOB') {
                            //if ($fieldType == 'date') {
                                $excelDOB = trim($r[$i]);
                                //$unixTimestamp = ($excelDOB - 25569) * 86400;
                                //$rawDOB= date('d.m.Y',$unixTimestamp);
                                $rawDOB = $excelDOB;
                                //generate_log("Harvinder ".date('Y-m-d', $ts),'student_bulk_upload_'.date('d-m-Y-H').'.log');
                                $newDOB = $this->get_mysql_date_formate_from_raw($rawDOB);
                                if ($newDOB != "") {
                                    $data[$fielsdArr[$i]] = $newDOB; //date('Y-m-d', $ts);
                                } else {
                                    $error = TRUE;
                                    $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " content invalid data at row no -" . $errorRowNo;
                                }
                            }
    
                            if ($fielsdArr[$i] == 'DOJ') {
                            //if ($fieldType == 'date') {
                                $excelDOB = trim($r[$i]);
                                //$unixTimestamp = ($excelDOB - 25569) * 86400;
                                //$rawDOB= date('d.m.Y',$unixTimestamp);
                                $rawDOB = $excelDOB;
                                //generate_log("Harvinder ".date('Y-m-d', $ts),'student_bulk_upload_'.date('d-m-Y-H').'.log');
                                $newDOB = $this->get_mysql_date_formate_from_raw($rawDOB);
                                if ($newDOB != "") {
                                    $data[$fielsdArr[$i]] = $newDOB; //date('Y-m-d', $ts);
                                } else {
                                    $error = TRUE;
                                    $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " content invalid data at row no -" . $errorRowNo;
                                }
                            }
    
                            if ($fielsdArr[$i] == 'jobTitleId') {
                                $rs=get_data_generic_fun('sc_job_title','jobTitleId',array('title'=>trim($r[$i])));
                                if(!empty($rs)){
                                    $data[$fielsdArr[$i]]=$rs[0]->jobTitleId;
                                }else{
                                    $error = TRUE;
                                    $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " is match with master data for job_title at row no -" . $errorRowNo;
                                }
                            }
                            
                            if ($fielsdArr[$i] == 'genderId') {
                                $rs=get_data_generic_fun('sc_gender','genderId',array('title'=>trim($r[$i])));
                                if(!empty($rs)){
                                    $data[$fielsdArr[$i]]=$rs[0]->genderId;
                                }else{
                                    $error = TRUE;
                                    $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " is match with master data for gender at row no -" . $errorRowNo;
                                }
                            }
    
                            if ($fielsdArr[$i] == 'bloodGroupId') {
                                $rs=get_data_generic_fun('sc_blood_group','bloodGroupId',array('title'=>trim($r[$i])));
                                if(!empty($rs)){
                                    $data[$fielsdArr[$i]]=$rs[0]->bloodGroupId;
                                }else{
                                    $error = TRUE;
                                    $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " is match with master data for blood_group at row no -" . $errorRowNo;
                                }
                            }
    
                            if ($fielsdArr[$i] == 'countryId') {
                                $rs=get_data_generic_fun('sc_country','locationId',array('name'=>trim($r[$i]),'locationType'=>0));
                                if(!empty($rs)){
                                    $data[$fielsdArr[$i]]=$rs[0]->locationId;
                                }else{
                                    $error = TRUE;
                                    $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " is match with master data for country at row no -" . $errorRowNo;
                                }
                            }
    
                            if ($fielsdArr[$i] == 'stateId') {
                                $rs=get_data_generic_fun('sc_country','locationId',array('name'=>trim($r[$i]),'locationType'=>1));
                                if(!empty($rs)){
                                    $data[$fielsdArr[$i]]=$rs[0]->locationId;
                                }else{
                                    $error = TRUE;
                                    $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " is match with master data for state at row no -" . $errorRowNo;
                                }
                            }
    
                            if ($fielsdArr[$i] == 'cityId') {
                                $rs=get_data_generic_fun('sc_country','locationId',array('name'=>trim($r[$i]),'locationType'=>2));
                                if(!empty($rs)){
                                    $data[$fielsdArr[$i]]=$rs[0]->locationId;
                                }else{
                                    $error = TRUE;
                                    $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " is match with master data for city at row no -" . $errorRowNo;
                                }
                            }
                            
                        }
                        //pre($blankErrorMsgArr);
                        if ( !in_array($fielsdArr[$i],$NotAutoAddCollArr)) {
                            //echo '$i : '.$i.' ==== $fielsdArr[$i] :'.$fielsdArr[$i].' ==== $r[$i] : '.$r[$i].'<br>';
                            $data[$fielsdArr[$i]] = trim($r[$i]);
                        }
                    } else {
                        //echo '$i++ : '.$i.' ==== $fielsdArr[$i]++ :'.$fielsdArr[$i].' ==== $r[$i]++ : '.$r[$i].'<br>';
                        //if($fielsdArr[$i]=='roll' && trim($r[$i])!="")
                        $data[$fielsdArr[$i]] = trim($r[$i]);
                    }
                }
                //pre($errorMsgArr);die;
                if (count($blankErrorMsgArr) > 0) {
                    $error = TRUE;
                    if (count($blankErrorMsgArr) < 20) {
                        foreach ($blankErrorMsgArr AS $errorKey => $errorVal) {
                            $errorMsgArr[] = $errorVal;
                        }
                    }
                }
               
                //pre('$error'); 
                if ($error === FALSE) {
                    $userData=array('fName'=>$data['fName'],'lName'=>$data['lName'],'phoneNumber'=>$data['phoneNumber'],'userName'=>$data['userName'],'communicationEmail'=>$data['userName']);
    
                    $userDataArr = array();
                    $userDataArr = bulk_upload_generate_user_table_data_arr($userData, array('typeText' => 'teacher'));
                    //pre($userDataArr);pre($data);die;
                    $userId = $this->Sc_user_model->add($userDataArr);
    
                    unset($data['fName']);
                    unset($data['lName']);
                    unset($data['phoneNumber']);
                    unset($data['userName']);
    
                    $data['userId'] = $userId;
    
                    //$dataStudent['date_added'] = strtotime(date("Y-m-d H:i:s"));
                    
                    //pre('final student data');
                    //pre($data); die;
                    //pre($dataStudent);die;
                    $this->load->model("Sc_teacher_model");
                    $student_id = $this->Sc_teacher_model->add($data);
                } else {
                    $errorExcelArr[] = $r;
                    $someRowError = TRUE;
                }
                $errorRowNo++;
            }
            $this->final_bulk_upload_success_error_process('teacher',$someRowError,$errorMsgArr,$errorExcelArr);
        }
    }
    
    function class_upload_process() {
        $config['upload_path'] = SchoolResourcesPath . 'uploads/';
        $config['allowed_types'] = 'xls|xlsx';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('userFile')) {
            //$error = array('error' => );
            echo json_encode(array('result'=>'bad','msg'=>$this->upload->display_errors()));die;
        } else {
            $data = $this->upload->data();
            $excelFilePath=$data['full_path'];
            //$excelFilePath=SchoolResourcesPath."uploads/teacher_upload_template.xlsx";
            $this->load->library('Excel_lib',array('excelFilePath'=>$excelFilePath));
            //die("kkk");
            @ini_set('memory_limit', '-1');
            @set_time_limit(0);
            $num_cols= $this->excel_lib->get_num_cols();
            $f = 0;
            $fielsdStringForAdmin="Class Name,Class numeric name,Section name,Section nick name,Teacher email,Room number,Max capacity"; /// lable in excel file
            $fielsdString="name,numericName,nameSection,nickName,email,roomNo,maxCapacity"; // real db fields
            $fielsdStringMandotary ="name,numericName,nameSection,nickName,email"; // real db fields ;// real db fields which are mandetory;
            $fielsdArr = explode(',', $fielsdString);
            $fielsdStringForAdminArr = explode(',', $fielsdStringForAdmin);
            $fielsdStringMandotaryArr = explode(',', $fielsdStringMandotary);
            
            $someRowError = FALSE;
            $errorMsgArr = array();
            $errorExcelArr = array();
            $errorExcelArr[] = $fielsdStringForAdminArr;
            $errorRowNo = 2;
            $allDataRows=$this->excel_lib->get_all_rows();
            $NotAutoAddCollArr=array();
            //pre($allDataRows);die;
            $this->load->model('Sc_class_model');
            $this->load->model('Sc_section_model');
            $this->load->model('Sc_user_model');
            
            foreach ($allDataRows as $r) {
                $data = array();
                $dataStudent = array();
                $error = FALSE;
                // Ignore the inital name row of excel file
                if ($f == 0) {
                    $f++;
                    continue;
                } $f++;
                
                //pre($r); die('here');
                //pre($r);pre('above are $r data');
                if ($num_cols > count($fielsdArr)) {
                    $num_cols = count($fielsdArr);
                }
                $blankErrorMsgArr = array();
                $errorRowIncrease = FALSE;
                
                for ($i = 0; $i < $num_cols; $i++) {    // checking is filds is mandetory or not
                    //pre($fielsdArr); echo $i;
                    if (in_array($fielsdArr[$i], $fielsdStringMandotaryArr)) {
                        //pre($fielsdArr[$i]);die;
                        //now validating mandetory fiels
                        //generate_log("Field ".$fielsdArr[$i]." value ".$r[$i]."\n",'student_bulk_upload_'.date('d-m-Y-H').'.log');
    
                        if (trim($r[$i]) == "") {
                            $error = TRUE;
                            $blankErrorMsgArr[] = $fielsdStringForAdminArr[$i] . " should not be blank at row no " . $errorRowNo;
                            //pre($blankErrorMsgArr);die;
                        } else {
                            $validPhoneEmailCheck = "ok";
                            $rsEmailPhoneUnique = array();
                            
                            if ($fielsdArr[$i] == 'name') {
                                $classData['name']=trim($r[$i]);
                            }
                            
                            if ($fielsdArr[$i] == 'numericName') {
                                $classData['numericName']=trim($r[$i]);
                            }
                            
                            if ($fielsdArr[$i] == 'email') {
                                $rsEmailPhoneUnique = $this->Sc_user_model->get_data_by_cols('userId', array('userName' => trim($r[$i])));
                                $validPhoneEmailCheck = $this->checkValidPhoneEmail(trim($r[$i]), 'email');
                                
                                if ($validPhoneEmailCheck != 'ok') {
                                    $error = TRUE;
                                    $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " Should be " . $validPhoneEmailCheck . " at row no -" . $errorRowNo;
                                }else{
                                    $sectionDataArr['teacherId']=$rsEmailPhoneUnique[0]->userId;
                                }
                            }
                            
                            if ($fielsdArr[$i] == 'nameSection') {
                                $sectionDataArr['name']=trim($r[$i]);
                            }
                            
                            if ($fielsdArr[$i] == 'nickName') {
                                $sectionDataArr['nickName']=trim($r[$i]);
                            }
                            
                        }
                        
                    } else {
                        //echo '$i++ : '.$i.' ==== $fielsdArr[$i]++ :'.$fielsdArr[$i].' ==== $r[$i]++ : '.$r[$i].'<br>';
                        //if($fielsdArr[$i]=='roll' && trim($r[$i])!="")
                        $sectionDataArr[$fielsdArr[$i]] = trim($r[$i]);
                    }
                }
                
                //pre($errorMsgArr);die;
                if (count($blankErrorMsgArr) > 0) {
                    $error = TRUE;
                    if (count($blankErrorMsgArr) < 20) {
                        foreach ($blankErrorMsgArr AS $errorKey => $errorVal) {
                            $errorMsgArr[] = $errorVal;
                        }
                    }
                }
                //pre('$error'); 
                if ($error === FALSE) {
                    $this->load->model("Sc_class_model");
                    $classId="";
                    $classDataArr= get_data_generic_fun('sc_class','classId',array('name'=>$classData['name']));
                    if(empty($classDataArr)){
                        $classNumericNameCheckArr=get_data_generic_fun('sc_class','*',array('numericName'=>$classData['numericName']));
                        if(count($classNumericNameCheckArr)==0){
                            $classData['schoolId']= $this->session->userdata('USER_SCHOOL_ID');
                            //create a class here
                            $classId=$this->Sc_class_model->add($classData);
                        }else{
                            $errorMsgArr[]="Class numeric name ".$classData['numericName']." is already exist, for row no -" . $errorRowNo;
                            $errorExcelArr[] = $r;
                            $someRowError = TRUE;
                            $error=TRUE;
                        }
                    }else{
                        $classId=$classDataArr[0]->classId;
                    }


                    
                    if($classId==""){
                        $errorMsgArr[]="Unknown error arrises to add data for row no -" . $errorRowNo;
                        $errorExcelArr[] = $r;
                        $someRowError = TRUE;
                    }else{
                        if ($error === FALSE) {
                            $sectionDataArr['classId']=$classId;
                            $sectionDataArr['schoolId']=$this->session->userdata('USER_SCHOOL_ID');
                            $sectionOldDataArr= get_data_generic_fun('sc_section','sectionId',array('name'=>$sectionDataArr['name'],'classId'=>$sectionDataArr['classId']));
                            //pre($sectionOldDataArr);die;
                            if(!empty($sectionOldDataArr)){
                                $errorMsgArr[]="Section already created  for row no -" . $errorRowNo;
                                $errorExcelArr[] = $r;
                                $someRowError = TRUE;
                            }else{
                                $this->load->model("Sc_section_model");
                                $this->Sc_section_model->add($sectionDataArr);
                            }
                        }
                    }
                } else {
                    $errorExcelArr[] = $r;
                    $someRowError = TRUE;
                }
                $errorRowNo++;
            }
            $this->final_bulk_upload_success_error_process('class',$someRowError,$errorMsgArr,$errorExcelArr);
        }
    }

    function parent_upload_process() {
        $config['upload_path'] = SchoolResourcesPath . 'uploads/';
        $config['allowed_types'] = 'xls|xlsx';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('userFile')) {
            //$error = array('error' => );
            echo json_encode(array('result'=>'bad','msg'=>$this->upload->display_errors()));die;
        } else {
            $data = $this->upload->data();
            $excelFilePath=$data['full_path'];
            $this->load->library('Excel_lib',array('excelFilePath'=>$excelFilePath));
            //die("kkk");
            @ini_set('memory_limit', '-1');
            @set_time_limit(0);
            $num_cols= $this->excel_lib->get_num_cols();
            $f = 0;
            $fielsdStringForAdmin="First Name,Last Name,Phone Number,User Name,Mother First Name,Mother Last Name,Address,Father Profession,Father Qualification,Religion,Caste,Home Phone,Country,State,City,Zip"; /// lable in excel file
            $fielsdString="fName,lName,phoneNumber,userName,motherFName,motherLName,address,fatherProfession,fatherQualification,religion,caste,homePhone,countryId,stateId,cityId,zip"; // real db fields
            $fielsdStringMandotary ="fName,lName,phoneNumber,userName,motherFName,address,countryId,stateId,cityId"; // real db fields ;// real db fields which are mandetory;
            $fielsdArr = explode(',', $fielsdString);
            $fielsdStringForAdminArr = explode(',', $fielsdStringForAdmin);
            $fielsdStringMandotaryArr = explode(',', $fielsdStringMandotary);
            
            $someRowError = FALSE;
            $errorMsgArr = array();
            $errorExcelArr = array();
            $errorExcelArr[] = $fielsdStringForAdminArr;
            $errorRowNo = 2;
            $allDataRows=$this->excel_lib->get_all_rows();
            $NotAutoAddCollArr=array('countryId','stateId','cityId');
            //pre($allDataRows);die;
            $this->load->model('Sc_user_model');
            foreach ($allDataRows as $r) {
                $data = array();
                $dataStudent = array();
                $error = FALSE;
                // Ignore the inital name row of excel file
                if ($f == 0) {
                    $f++;
                    continue;
                } $f++;
                
                //pre($r); die('here');
                //pre($r);pre('above are $r data');
                if ($num_cols > count($fielsdArr)) {
                    $num_cols = count($fielsdArr);
                }
                $blankErrorMsgArr = array();
                $errorRowIncrease = FALSE;
                
                for ($i = 0; $i < $num_cols; $i++) {    // checking is filds is mandetory or not
                    //pre($fielsdArr); echo $i;
                    if (in_array($fielsdArr[$i], $fielsdStringMandotaryArr)) {
                        //pre($fielsdArr[$i]);die;
                        //now validating mandetory fiels
                        //generate_log("Field ".$fielsdArr[$i]." value ".$r[$i]."\n",'student_bulk_upload_'.date('d-m-Y-H').'.log');
    
                        if (trim($r[$i]) == "") {
                            $error = TRUE;
                            $blankErrorMsgArr[] = $fielsdStringForAdminArr[$i] . " should not be blank at row no " . $errorRowNo;
                            //pre($blankErrorMsgArr);die;
                        } else {
                            $validPhoneEmailCheck = "ok";
                            $rsEmailPhoneUnique = array();
                            // now check teh uniques for email then phone

                            if ($fielsdArr[$i] == 'userName') {
                                $rsEmailPhoneUnique = $this->Sc_user_model->get_data_by_cols('userId', array('userName' => trim($r[$i])));
                                $validPhoneEmailCheck = $this->checkValidPhoneEmail(trim($r[$i]), 'email');
                            } elseif ($fielsdArr[$i] == 'phoneNumber') {
                                $rsEmailPhoneUnique = $this->Sc_user_model->get_data_by_cols('userId', array('phoneNumber' => trim($r[$i])));
                                $validPhoneEmailCheck = $this->checkValidPhoneEmail(trim($r[$i]), 'phone');
                            } 
    
                            if (count($rsEmailPhoneUnique) > 0) {
                                $error = TRUE;
                                $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " is already entered.Should be unique information at row no -" . $errorRowNo;
                                //echo '<br>';
                            }
    
                            if ($validPhoneEmailCheck != 'ok') {
                                $error = TRUE;
                                $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " Should be " . $validPhoneEmailCheck . " at row no -" . $errorRowNo;
                            }
    
                            //pre("kkk");pre($errorMsgArr);die;
    
                            if ($fielsdArr[$i] == 'countryId') {
                                $rs=get_data_generic_fun('sc_country','locationId',array('name'=>trim($r[$i]),'locationType'=>0));
                                if(!empty($rs)){
                                    $data[$fielsdArr[$i]]=$rs[0]->locationId;
                                }else{
                                    $error = TRUE;
                                    $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " is match with master data for country at row no -" . $errorRowNo;
                                }
                            }
    
                            if ($fielsdArr[$i] == 'stateId') {
                                $rs=get_data_generic_fun('sc_country','locationId',array('name'=>trim($r[$i]),'locationType'=>1));
                                if(!empty($rs)){
                                    $data[$fielsdArr[$i]]=$rs[0]->locationId;
                                }else{
                                    $error = TRUE;
                                    $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " is match with master data for state at row no -" . $errorRowNo;
                                }
                            }
    
                            if ($fielsdArr[$i] == 'cityId') {
                                $rs=get_data_generic_fun('sc_country','locationId',array('name'=>trim($r[$i]),'locationType'=>2));
                                if(!empty($rs)){
                                    $data[$fielsdArr[$i]]=$rs[0]->locationId;
                                }else{
                                    $error = TRUE;
                                    $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " is match with master data for city at row no -" . $errorRowNo;
                                }
                            }
                            
                        }
                        //pre($blankErrorMsgArr);
                        if ( !in_array($fielsdArr[$i],$NotAutoAddCollArr)) {
                            //echo '$i : '.$i.' ==== $fielsdArr[$i] :'.$fielsdArr[$i].' ==== $r[$i] : '.$r[$i].'<br>';
                            $data[$fielsdArr[$i]] = trim($r[$i]);
                        }
                    } else {
                        //echo '$i++ : '.$i.' ==== $fielsdArr[$i]++ :'.$fielsdArr[$i].' ==== $r[$i]++ : '.$r[$i].'<br>';
                        //if($fielsdArr[$i]=='roll' && trim($r[$i])!="")
                        $data[$fielsdArr[$i]] = trim($r[$i]);
                    }
                }
                //pre($errorMsgArr);die;
                if (count($blankErrorMsgArr) > 0) {
                    $error = TRUE;
                    if (count($blankErrorMsgArr) < 20) {
                        foreach ($blankErrorMsgArr AS $errorKey => $errorVal) {
                            $errorMsgArr[] = $errorVal;
                        }
                    }
                }
               
                //pre('$error'); 
                if ($error === FALSE) {
                    $userData=array('fName'=>$data['fName'],'lName'=>$data['lName'],'phoneNumber'=>$data['phoneNumber'],'userName'=>$data['userName'],'communicationEmail'=>$data['userName']);
    
                    $userDataArr = array();
                    $userDataArr = bulk_upload_generate_user_table_data_arr($userData, array('typeText' => 'parent'));
                    //pre($userDataArr);pre($data);die;
                    $userId = $this->Sc_user_model->add($userDataArr);
    
                    unset($data['fName']);
                    unset($data['lName']);
                    unset($data['phoneNumber']);
                    unset($data['userName']);
    
                    $data['userId'] = $userId;
    
                    //$dataStudent['date_added'] = strtotime(date("Y-m-d H:i:s"));
                    
                    //pre('final student data');
                    //pre($data); die;
                    //pre($dataStudent);die;
                    $this->load->model("Sc_parent_model");
                    $student_id = $this->Sc_parent_model->add($data);
                } else {
                    $errorExcelArr[] = $r;
                    $someRowError = TRUE;
                }
                $errorRowNo++;
            }
            $this->final_bulk_upload_success_error_process('parent',$someRowError,$errorMsgArr,$errorExcelArr);
        }
    }

    function student_upload_process() {
        $config['upload_path'] = SchoolResourcesPath . 'uploads/';
        $config['allowed_types'] = 'xls|xlsx';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('userFile')) {
            //$error = array('error' => );
            echo json_encode(array('result'=>'bad','msg'=>$this->upload->display_errors()));die;
        } else {
            $data = $this->upload->data();
            $excelFilePath=$data['full_path'];
            $this->load->library('Excel_lib',array('excelFilePath'=>$excelFilePath));
            //die("kkk");
            @ini_set('memory_limit', '-1');
            @set_time_limit(0);
            $num_cols= $this->excel_lib->get_num_cols();
            $f = 0;
            $fielsdStringForAdmin="First Name,Last Name,Phone Number,User Name,Gender,DOB,Blood Group,Card No,Class Numeric Name,Section Name,Parent Email"; /// lable in excel file
            $fielsdString="fName,lName,phoneNumber,userName,genderId,DOB,bloodGroupId,cardId,classId,sectionId,parentId"; // real db fields
            $fielsdStringMandotary =$fielsdString ;// real db fields which are mandetory;
            $fielsdArr = explode(',', $fielsdString);
            $fielsdStringForAdminArr = explode(',', $fielsdStringForAdmin);
            $fielsdStringMandotaryArr = explode(',', $fielsdStringMandotary);
            
            $someRowError = FALSE;
            $errorMsgArr = array();
            $errorExcelArr = array();
            $errorExcelArr[] = $fielsdStringForAdminArr;
            $errorRowNo = 2;
            $allDataRows=$this->excel_lib->get_all_rows();
            $NotAutoAddCollArr=array('DOB','genderId','bloodGroupId','parentId','classId','sectionId');
            //pre($allDataRows);die;
            $this->load->model('Sc_user_model');
            foreach ($allDataRows as $r) {
                $data = array();
                $dataStudent = array();
                $error = FALSE;
                // Ignore the inital name row of excel file
                if ($f == 0) {
                    $f++;
                    continue;
                } $f++;
                
                //pre($r); die('here');
                //pre($r);pre('above are $r data');
                if ($num_cols > count($fielsdArr)) {
                    $num_cols = count($fielsdArr);
                }
                $blankErrorMsgArr = array();
                $errorRowIncrease = FALSE;
                $studentParentData=array();
                $enrollData=array();
                for ($i = 0; $i < $num_cols; $i++) {    // checking is filds is mandetory or not
                    //pre($fielsdArr); echo $i;
                    if (in_array($fielsdArr[$i], $fielsdStringMandotaryArr)) {
                        //pre($fielsdArr[$i]);die;
                        //now validating mandetory fiels
                        //generate_log("Field ".$fielsdArr[$i]." value ".$r[$i]."\n",'student_bulk_upload_'.date('d-m-Y-H').'.log');
    
                        if (trim($r[$i]) == "") {
                            $error = TRUE;
                            $blankErrorMsgArr[] = $fielsdStringForAdminArr[$i] . " should not be blank at row no " . $errorRowNo;
                            //pre($blankErrorMsgArr);die;
                        } else {
                            $validPhoneEmailCheck = "ok";
                            $rsEmailPhoneUnique = array();
                            // now check teh uniques for email then phone
    
                            if ($fielsdArr[$i] == 'userName') {
                                $rsEmailPhoneUnique = $this->Sc_user_model->get_data_by_cols('userId', array('userName' => trim($r[$i])));
                                $validPhoneEmailCheck = $this->checkValidPhoneEmail(trim($r[$i]), 'email');
                            } elseif ($fielsdArr[$i] == 'phoneNumber') {
                                $rsEmailPhoneUnique = $this->Sc_user_model->get_data_by_cols('userId', array('phoneNumber' => trim($r[$i])));
                                $validPhoneEmailCheck = $this->checkValidPhoneEmail(trim($r[$i]), 'phone');
                            } 
    
                            if (count($rsEmailPhoneUnique) > 0) {
                                $error = TRUE;
                                $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " is already entered.Should be unique information at row no -" . $errorRowNo;
                                //echo '<br>';
                            }
    
                            if ($validPhoneEmailCheck != 'ok') {
                                $error = TRUE;
                                $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " Should be " . $validPhoneEmailCheck . " at row no -" . $errorRowNo;
                            }
    
                            //pre("kkk");pre($errorMsgArr);die;
    
                            if ($fielsdArr[$i] == 'DOB') {
                            //if ($fieldType == 'date') {
                                $excelDOB = trim($r[$i]);
                                //$unixTimestamp = ($excelDOB - 25569) * 86400;
                                //$rawDOB= date('d.m.Y',$unixTimestamp);
                                $rawDOB = $excelDOB;
                                //generate_log("Harvinder ".date('Y-m-d', $ts),'student_bulk_upload_'.date('d-m-Y-H').'.log');
                                $newDOB = $this->get_mysql_date_formate_from_raw($rawDOB);
                                if ($newDOB != "") {
                                    $data[$fielsdArr[$i]] = $newDOB; //date('Y-m-d', $ts);
                                } else {
                                    $error = TRUE;
                                    $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " content invalid data at row no -" . $errorRowNo;
                                }
                            }
                            
                            if ($fielsdArr[$i] == 'genderId') {
                                $rs=get_data_generic_fun('sc_gender','genderId',array('title'=>trim($r[$i])));
                                if(!empty($rs)){
                                    $data[$fielsdArr[$i]]=$rs[0]->genderId;
                                }else{
                                    $error = TRUE;
                                    $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " is match with master data for gender at row no -" . $errorRowNo;
                                }
                            }
    
                            if ($fielsdArr[$i] == 'bloodGroupId') {
                                $rs=get_data_generic_fun('sc_blood_group','bloodGroupId',array('title'=>trim($r[$i])));
                                if(!empty($rs)){
                                    $data[$fielsdArr[$i]]=$rs[0]->bloodGroupId;
                                }else{
                                    $error = TRUE;
                                    $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " is match with master data for blood_group at row no -" . $errorRowNo;
                                }
                            }

                            if ($fielsdArr[$i] == 'parentId') {
                                $rs=get_data_generic_fun('sc_user','userId',array('userName'=>trim($r[$i])));
                                if(!empty($rs)){
                                    $studentParentData[$fielsdArr[$i]]=$rs[0]->userId;
                                }else{
                                    $error = TRUE;
                                    $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " is match with master data for pareent email at row no -" . $errorRowNo;
                                }
                            }

                            if ($fielsdArr[$i] == 'classId') {
                                $rs=get_data_generic_fun('sc_class','classId',array('numericName'=>trim($r[$i])));
                                if(!empty($rs)){
                                    $enrollData[$fielsdArr[$i]]=$rs[0]->userId;
                                }else{
                                    $error = TRUE;
                                    $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " is match with master data for pareent email at row no -" . $errorRowNo;
                                }
                            }

                            if ($fielsdArr[$i] == 'sectionId') {
                                $rs=get_data_generic_fun('sc_section','sectionId',array('name'=>trim($r[$i])));
                                if(!empty($rs)){
                                    $enrollData[$fielsdArr[$i]]=trim($r[$i]);
                                }else{
                                    $error = TRUE;
                                    $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " is match with master data for pareent email at row no -" . $errorRowNo;
                                }
                            }
                        }
                        //pre($blankErrorMsgArr);
                        if ( !in_array($fielsdArr[$i],$NotAutoAddCollArr)) {
                            //echo '$i : '.$i.' ==== $fielsdArr[$i] :'.$fielsdArr[$i].' ==== $r[$i] : '.$r[$i].'<br>';
                            $data[$fielsdArr[$i]] = trim($r[$i]);
                        }
                    } else {
                        //echo '$i++ : '.$i.' ==== $fielsdArr[$i]++ :'.$fielsdArr[$i].' ==== $r[$i]++ : '.$r[$i].'<br>';
                        //if($fielsdArr[$i]=='roll' && trim($r[$i])!="")
                        $data[$fielsdArr[$i]] = trim($r[$i]);
                    }
                }
                //pre($errorMsgArr);die;
                if (count($blankErrorMsgArr) > 0) {
                    $error = TRUE;
                    if (count($blankErrorMsgArr) < 20) {
                        foreach ($blankErrorMsgArr AS $errorKey => $errorVal) {
                            $errorMsgArr[] = $errorVal;
                        }
                    }
                }
               
                //pre('$error'); 
                if ($error === FALSE) {
                    $sectionDataDetails=get_data_generic_fun('sc_section','*',array('classId'=>$enrollData['classId'],'name'=>$eenrollData['sectionId']));
                    if(count($sectionDataDetails)>0){
                        $userData=array('fName'=>$data['fName'],'lName'=>$data['lName'],'phoneNumber'=>$data['phoneNumber'],'userName'=>$data['userName'],'communicationEmail'=>$data['userName']);
                        
                        $userDataArr = array();
                        $userDataArr = bulk_upload_generate_user_table_data_arr($userData, array('typeText' => 'student'));
                        $userId = $this->Sc_user_model->add($userDataArr);
                        //$userId=10;
        
                        unset($data['fName']);
                        unset($data['lName']);
                        unset($data['phoneNumber']);
                        unset($data['userName']);
        
                        $data['userId'] = $userId;
        
                        //$dataStudent['date_added'] = strtotime(date("Y-m-d H:i:s"));
                        
                        //pre('final student data');
                        pre($data); die;
                        //pre($dataStudent);die;
                        $this->load->model("Sc_student_model");
                        $this->Sc_student_model->add($data);

                        $enrollData['sectionId']=$sectionDataDetails[0]->sectionId;
                        $enrollData['studentId']=$userId;
                        $finaleEnrollData=generate_enroll_data_arr($enrollData);
                        $this->Sc_student_model->enroll_student($data);

                        $studentParentData['studentId']=$userId;
                        $this->Sc_student_model->connect_with_parent($studentParentData);
                    }else{
                        $errorMsgArr[]="class and section data are mismatch to each other at row no -" . $errorRowNo;
                        $errorExcelArr[] = $r;
                        $someRowError = TRUE;
                    }
                } else {
                    $errorExcelArr[] = $r;
                    $someRowError = TRUE;
                }
                $errorRowNo++;
            }
            $this->final_bulk_upload_success_error_process('teacher',$someRowError,$errorMsgArr,$errorExcelArr);
        }
    }


    function upload_process_test(){
        
    }

    function final_bulk_upload_success_error_process($bulkUploadType,$someRowError,$errorMsgArr=array(),$errorExcelArr=array()){
        if ($someRowError == FALSE) {
            echo json_encode(array('result'=>'good','msg'=>ucfirst($bulkUploadType).' bulk upload completed successfully.'));die;
        } else {
            //pre($errorMsgArr);die;
            generate_log(json_encode($errorMsgArr), $bulkUploadType.'_bulk_upload_error_details.log', TRUE);
            $file_name_with_path = SchoolResourcesPath.'bulk_upload_error/'.$bulkUploadType.'_bulk_upload_error_details_for_excel_file.xlsx';
            @unlink($file_name_with_path);
            create_excel_file($file_name_with_path, $errorExcelArr);
            echo json_encode(array('result'=>'need_good','msg'=>'some data are not uploaded,plz check with error details.','url'=>BASE_URL.$this->erpUserTypeArr[$this->userType].'/principal/bulk_upload_error/'.$bulkUploadType));die;
        }
    }

    function student_upload_process_old() {
        $this->load->helper('general_used');
        @unlink('uploads/student_import.xlsx');
        @unlink('uploads/student_bulk_upload_error_details.log');
        //pre($_FILES);die;
        if ($_FILES['userfile']['error'] == 0) {
            //pre($_FILES);
            if (move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_import.xlsx')) {
                @ini_set('memory_limit', '-1');
                @set_time_limit(0);
                // Importing excel sheet for bulk student uploads
                include 'Simplexlsx.class.php';
                $xlsx = new SimpleXLSX('uploads/student_import.xlsx');
                //pre($_FILES);die;
                //pre($xlsx);die;
                list($num_cols, $num_rows) = $xlsx->dimension();
                $f = 0;
                $this->load->model("Dynamic_field_model");
                $rs_student_bulk_upload_fields = $this->Dynamic_field_model->get_student_bulk_upload();
                $rs_student_bulk_upload_mandatory_fields = $this->Dynamic_field_model->get_student_bulk_upload_mandatory();
                $rs_student_bulk_upload_label_fields = $this->Dynamic_field_model->get_student_bulk_upload_label();

                //$fielsdStringForAdmin="Student Name,Middle Name,Last Name,Gender,Date Of Birth,Caste Category, Class Name,Section,Roll,Course,Previous School,Parent EmailId,Address,Location,Phone,Email,Passport No,Card,Identity Card Type,Identity Card,Dormitory,Transport,Place of Birth,Country,Nationality";
                //$fielsdStringForAdmin = "Student Name,Middle Name,Last Name,Gender,Date Of Birth,Caste Category, Class Name,Section,Roll,Course,Previous School,Parent EmailId,Address,Location,Phone,Email,Passport No,Card,Identity Card Type,Identity Card,Place of Birth,Country,Nationality";
                $fielsdStringForAdmin = $rs_student_bulk_upload_label_fields[0]['tableCol'];
                //$fielsdString="name,mname,lname,sex,birthday,caste_category,class_id,section_id,roll,course,previous_school,parent_id,address,location,phone,email,passport_no,card_id,type,icard_no,dormitory_id,transport_id,place_of_birth,country,nationality";
                //$fielsdString = "name,mname,lname,sex,birthday,caste_category,class_id,section_id,roll,course,previous_school,parent_id,address,location,phone,email,passport_no,card_id,type,icard_no,place_of_birth,country,nationality";
                $fielsdString = $rs_student_bulk_upload_fields[0]['tableCol'];
                //$fielsdStringMandotary = "name,sex,birthday,class_id,section_id,parent_id,address,location,email,country,nationality";
                $fielsdStringMandotary = $rs_student_bulk_upload_mandatory_fields[0]['tableCol'];

                $fielsdArr = explode(',', $fielsdString);
                $fielsdStringForAdminArr = explode(',', $fielsdStringForAdmin);
                $fielsdStringMandotaryArr = explode(',', $fielsdStringMandotary);
                $fielsdStringForAdminArr1 = array();
                foreach ($fielsdStringForAdminArr AS $k => $v) {
                    $fielsdStringForAdminArr1[] = get_phrase($v);
                }
                $fielsdStringForAdminArr = $fielsdStringForAdminArr1;
                //pre($fielsdArr);die;
                $someRowError = FALSE;
                $errorMsgArr = array();
                $errorExcelArr = array();
                $errorExcelArr[] = $fielsdStringForAdminArr;
                $errorRowNo = 2;
                //pre($xlsx->rows());die;
                foreach ($xlsx->rows() as $r) {
                    $data = array();
                    $dataStudent = array();
                    $error = FALSE;
                    // Ignore the inital name row of excel file
                    if ($f == 0) {
                        $f++;
                        continue;
                    } $f++;
                    //pre($r); die('here');
                    //pre($r);pre('above are $r data');
                    if ($num_cols > count($fielsdArr)) {
                        $num_cols = count($fielsdArr);
                    }
                    $blankErrorMsgArr = array();
                    $errorRowIncrease = FALSE;
                    for ($i = 0; $i < $num_cols; $i++) {    // checking is filds is mandetory or not
                        //pre($fielsdArr); echo $i;
                        if (in_array($fielsdArr[$i], $fielsdStringMandotaryArr)) {
                            //pre($fielsdArr[$i]);
                            //now validating mandetory fiels
                            //generate_log("Field ".$fielsdArr[$i]." value ".$r[$i]."\n",'student_bulk_upload_'.date('d-m-Y-H').'.log');

                            if (trim($r[$i]) == "") {
                                $error = TRUE;
                                $blankErrorMsgArr[] = $fielsdStringForAdminArr[$i] . " should not be blank at row no " . $errorRowNo;
                                //pre($blankErrorMsgArr);
                            } else {
                                $validPhoneEmailCheck = "";
                                $rsEmailPhoneUnique = array();
                                // now check teh uniques for email then phone

                                $fieldType = $this->Dynamic_field_model->get_field_type_student($fielsdArr[$i]);
                                //pre('$fieldType : '.$fieldType);
                                if ($fieldType == 'email') {
                                    $rsEmailPhoneUnique = $this->Student_model->get_data_by_cols('student_id', array($fielsdArr[$i] => trim($r[$i])));
                                    $validPhoneEmailCheck = $this->checkValidPhoneEmail(trim($r[$i]), 'email');
                                }

                                if ($fieldType == 'tel') {
                                    $rsEmailPhoneUnique = $this->Student_model->get_data_by_cols('student_id', array($fielsdArr[$i] => trim($r[$i])));
                                    $validPhoneEmailCheck = $this->checkValidPhoneEmail(trim($r[$i]), 'phone');
                                }

                                /* if ($fielsdArr[$i] == 'email') {
                                  $rsEmailPhoneUnique = $this->Student_model->get_data_by_cols('student_id', array('email' => trim($r[$i])));
                                  $validPhoneEmailCheck = $this->checkValidPhoneEmail(trim($r[$i]), 'email');
                                  } elseif ($fielsdArr[$i] == 'phone') {
                                  $rsEmailPhoneUnique = $this->Student_model->get_data_by_cols('student_id', array('phone' => trim($r[$i])));
                                  $validPhoneEmailCheck = $this->checkValidPhoneEmail(trim($r[$i]), 'phone');
                                  } */

                                if (count($rsEmailPhoneUnique) > 0) {
                                    $error = TRUE;
                                    $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " is already entered.Should be unique information at row no -" . $errorRowNo;
                                    //echo '<br>';
                                }

                                if ($validPhoneEmailCheck != 'ok' && ($fieldType == 'email' || $fieldType == 'tel')) {
                                    $error = TRUE;
                                    $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " Should be " . $validPhoneEmailCheck . " at row no -" . $errorRowNo;
                                }

                                //if ($fielsdArr[$i] == 'birthday') {
                                if ($fieldType == 'date') {
                                    $excelDOB = trim($r[$i]);
                                    //$unixTimestamp = ($excelDOB - 25569) * 86400;
                                    //$rawDOB= date('d.m.Y',$unixTimestamp);
                                    $rawDOB = $excelDOB;
                                    //generate_log("Harvinder ".date('Y-m-d', $ts),'student_bulk_upload_'.date('d-m-Y-H').'.log');
                                    $newDOB = $this->get_mysql_date_formate_from_raw($rawDOB);
                                    if ($newDOB != "") {
                                        $data[$fielsdArr[$i]] = $newDOB; //date('Y-m-d', $ts);
                                    } else {
                                        $error = TRUE;
                                        $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " content invalid data at row no -" . $errorRowNo;
                                    }
                                }

                                /* if ($fielsdArr[$i] == 'date_time') {
                                  $excelDOB = trim($r[$i]);
                                  $unixTimestamp = ($excelDOB - 25569) * 86400;
                                  $rawDOB = date('d.m.Y', $unixTimestamp);

                                  $newDOB = $this->get_mysql_date_formate_from_raw($rawDOB);
                                  if ($newDOB != "") {
                                  $data[$fielsdArr[$i]] = $newDOB;
                                  } else {
                                  $error = TRUE;
                                  $errorMsgArr[] .= $fielsdStringForAdminArr[$i] . " content invalid data at row no -" . $errorRowNo;
                                  }
                                  } */

                                if ($fielsdArr[$i] == 'parent_id') { //echo "parent_id ";
                                    $rsParent = $this->Parent_model->get_data_by_cols('*', array('email' => trim($r[$i])));
                                    //echo $this->db->last_query();
                                    //pre($rsParent);die;
                                    if (count($rsParent) > 0) {
                                        $data['parent_id'] = $rsParent[0]->parent_id;
                                    } else {
                                        $error = TRUE;
                                        $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " content invalid data at row no -" . $errorRowNo;
                                    }
                                }

                                $stu_password = create_passcode('student');
                                $data['password'] = ($stu_password != 'invalid') ? sha1($stu_password) : '';
                                $data['passcode'] = ($stu_password != 'invalid') ? $stu_password : '';
                                $data['student_status'] = '1';

                                if ($fielsdArr[$i] == 'class_id') {
                                    $rsClass = $this->Class_model->get_name($r[$i]);
                                    if (count($rsClass) > 0) {
                                        $dataStudent['class_id'] = $rsClass[0]->class_id;
                                    } else {
                                        $dataStudent['class_id'] = "";
                                        $error = TRUE;
                                        $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " content invalid data at row no -" . $errorRowNo;
                                    }
                                }

                                if ($fielsdArr[$i] == 'section_id') {
                                    if ($dataStudent['class_id'] == "") {
                                        $error = TRUE;
                                        $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " content invalid data at row no -" . $errorRowNo;
                                    } else {
                                        $rsClassSection = $this->Section_model->get_name($dataStudent['class_id'], $r[$i]);

                                        if (count($rsClassSection) > 0) {
                                            $dataStudent['section_id'] = $rsClassSection[0]->section_id;
                                        } else {
                                            $error = TRUE;
                                            $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " content invalid data at row no -" . $errorRowNo;
                                        }
                                    }
                                }
                            }
                            //pre($blankErrorMsgArr);
                            if ($fielsdArr[$i] != 'section_id' && $fielsdArr[$i] != 'class_id' && $fielsdArr[$i] != 'birthday' && $fielsdArr[$i] != 'date_time' && $fielsdArr[$i] != 'parent_id') {
                                //echo '$i : '.$i.' ==== $fielsdArr[$i] :'.$fielsdArr[$i].' ==== $r[$i] : '.$r[$i].'<br>';
                                $data[$fielsdArr[$i]] = trim($r[$i]);
                            }
                        } else {
                            $validPhoneEmailCheck = "";
                            $rsEmailPhoneUnique = array();
                            // now check teh uniques for email then phone

                            $fieldType = $this->Dynamic_field_model->get_field_type($fielsdArr[$i], '1');
                            if (trim($r[$i]) != "") {
                                if ($fieldType == 'email') {
                                    $rsEmailPhoneUnique = $this->Student_model->get_data_by_cols('student_id', array($fielsdArr[$i] => trim($r[$i])));
                                    $validPhoneEmailCheck = $this->checkValidPhoneEmail(trim($r[$i]), 'email');
                                }

                                if ($fieldType == 'tel') {
                                    $rsEmailPhoneUnique = $this->Student_model->get_data_by_cols('student_id', array($fielsdArr[$i] => trim($r[$i])));
                                    $validPhoneEmailCheck = $this->checkValidPhoneEmail(trim($r[$i]), 'phone');
                                }

                                /* if ($fielsdArr[$i] == 'email') {
                                  $rsEmailPhoneUnique = $this->Student_model->get_data_by_cols('student_id', array('email' => trim($r[$i])));
                                  $validPhoneEmailCheck = $this->checkValidPhoneEmail(trim($r[$i]), 'email');
                                  } elseif ($fielsdArr[$i] == 'phone') {
                                  $rsEmailPhoneUnique = $this->Student_model->get_data_by_cols('student_id', array('phone' => trim($r[$i])));
                                  $validPhoneEmailCheck = $this->checkValidPhoneEmail(trim($r[$i]), 'phone');
                                  } */

                                if (count($rsEmailPhoneUnique) > 0) {
                                    $error = TRUE;
                                    $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " is already entered.Should be unique information at row no -" . $errorRowNo;
                                    //echo '<br>';
                                }

                                if ($validPhoneEmailCheck != 'ok' && ($fieldType == 'email' || $fieldType == 'tel')) {
                                    $error = TRUE;
                                    $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " Should be " . $validPhoneEmailCheck . " at row no -" . $errorRowNo;
                                } else {
                                    $data[$fielsdArr[$i]] = trim($r[$i]);
                                }

                                if ($fielsdArr[$i] == 'parent_id' && trim($r[$i]) != "") { //echo "parent_id ";
                                    $rsParent = $this->Parent_model->get_data_by_cols('*', array('email' => trim($r[$i])));
                                    //echo $this->db->last_query();
                                    //pre($rsParent);die;
                                    if (count($rsParent) > 0) {
                                        $data['parent_id'] = $rsParent[0]->parent_id;
                                    } else {
                                        $error = TRUE;
                                        $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " content invalid data at row no -" . $errorRowNo;
                                    }
                                } else {
                                    if ($fielsdArr[$i] == 'parent_id' && trim($r[$i]) == "") {
                                        $error = TRUE;
                                        $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " content invalid data at row no -" . $errorRowNo;
                                    }
                                }
                            }

                            if ($fielsdArr[$i] == 'roll' && trim($r[$i]) == "") {
                                $data['roll'] = ""; //substr(uniqid(),0,8);
                            }
                            if ($fielsdArr[$i] == 'dormitory_id' && trim($r[$i]) != "") {
                                $rsDormitory = array();
                                $rsDormitory = $this->Dormitory_model->get_name($r[$i]);

                                if (count($rsDormitory) > 0) {
                                    $data['dormitory_id'] = $rsDormitory[0]->dormitory_id;
                                } else {
                                    $error = TRUE;
                                    $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " content invalid data at row no -" . $errorRowNo;
                                }
                            } else {
                                $data['dormitory_id'] = 0;
                            }

                            if ($fielsdArr[$i] == 'transport_id' && trim($r[$i]) != "") {
                                $rsTransport = $this->Transport_model->get_name($r[$i]);

                                if (count($rsTransport) > 0) {
                                    //pre($rsTransport);die($rsTransport[0]->transport_id);
                                    $transport_id = $rsTransport[0]->transport_id;
                                    $rsTransport = array();
                                    $data['transport_id'] = $transport_id;
                                } else {
                                    $error = TRUE;
                                    $errorMsgArr[] = $fielsdStringForAdminArr[$i] . " content invalid data at row no -" . $errorRowNo;
                                }
                            } else {
                                $data['transport_id'] = 0;
                            }

                            //echo '$i++ : '.$i.' ==== $fielsdArr[$i]++ :'.$fielsdArr[$i].' ==== $r[$i]++ : '.$r[$i].'<br>';
                            //if($fielsdArr[$i]=='roll' && trim($r[$i])!="")
                            $data[$fielsdArr[$i]] = trim($r[$i]);
                        }
                    }
                    if (count($blankErrorMsgArr) > 0) {
                        $error = TRUE;
                        if (count($blankErrorMsgArr) < 20) {
                            foreach ($blankErrorMsgArr AS $errorKey => $errorVal) {
                                $errorMsgArr[] = $errorVal;
                            }
                        }
                    }
                    //pre($errorMsgArr);
                    //pre('$error');
                    if ($error === FALSE) {
                        //pre('comming to add data');
                        //pre($data);
                        //$data['date_time']=strtotime(date("Y-m-d H:i:s"));
                        if (!array_key_exists('roll', $data)) {
                            $data['roll'] = "";
                        }
                        $dataStudent['roll'] = $data['roll'];

                        unset($data['roll']);
                        unset($data['class_id']);
                        unset($data['section_id']);

                        //$dataStudent['date_added'] = strtotime(date("Y-m-d H:i:s"));
                        $dataStudent['enroll_code'] = substr(md5(rand(0, 1000000)), 0, 7);
                        $dataStudent['year'] = $this->Setting_model->get_setting_record(array('type' => 'running_year'), 'description');
                        $data = array_filter($data, create_function('$a', 'return $a!=="";'));
                        //pre('final student data');
                        //pre($data); die;
                        //pre($dataStudent);die;
                        $student_id = $this->Student_model->save_student($data);
                        $dataStudent['student_id'] = $student_id;

                        $dataStudent['roll'] = generate_roll_no($dataStudent['class_id'], $dataStudent['section_id']);
                        generate_log(serialize($dataStudent));
                        $enroll_id = $this->Student_model->enroll_student($dataStudent);
                    } else {
                        $errorExcelArr[] = $r;
                        $someRowError = TRUE;
                    }
                    $errorRowNo++;
                }
                //pre($errorExcelArr);die();

                if ($someRowError == FALSE) {
                    //$this->generate_cv($error_msg);
                    generate_log("No error for this upload at - " . time(), 'student_bulk_upload_' . date('d-m-Y-H') . '.log');
                    $this->session->set_flashdata('flash_message', get_phrase('students_details_added'));
                    redirect(base_url() . 'index.php?school_admin/bulk_upload/' . $this->input->post('class_id'), 'refresh');
                } else {
                    //pre($errorMsgArr);die;
                    generate_log(json_encode($errorMsgArr), 'student_bulk_upload_error_details.log', TRUE);
                    $file_name_with_path = 'uploads/student_bulk_upload_error_details_for_excel_file.xlsx';
                    @unlink($file_name_with_path);
                    create_excel_file($file_name_with_path, $errorExcelArr);
                    $this->session->set_flashdata('flash_message_error', "Some rows are not uploaded,due to invalid data.");
                    redirect(base_url() . 'index.php?school_admin/student_bulk_upload_error' . $this->input->post('class_id'), 'refresh');
                }
            } else {
                generate_log("Unknown error while uploading file.", 'student_bulk_upload_' . date('d-m-Y-H') . '.log');
                $this->session->set_flashdata('flash_message', 'Unknown error while uploading file.please contact with support@rarome.com');
                redirect(base_url() . 'index.php?school_admin/bulk_upload', 'refresh');
            }
        } else {
            generate_log("Unknown error while uploading file as ", 'student_bulk_upload_' . date('d-m-Y-H') . '.log');
            $this->session->set_flashdata('flash_message', 'File upload error no ' . $_FILES['userfile']['error'] . '.please contact with support@rarome.com');
            redirect(base_url() . 'index.php?school_admin/bulk_upload', 'refresh');
        }
    }

    function checkValidPhoneEmail($data, $type) {
        if ($type == 'email') {
            if (filter_var($data, FILTER_VALIDATE_EMAIL)) {
                return 'ok';
            } else {
                return ' an email address like name@doamin.tld. ';
            }
        } else if ($type == 'phone') {
            if (!ctype_digit($data)) {
                return ' a phone number only content 0 to 9 digit';
            } else {
                if (strlen($data) < 11 && strlen($data) > 6) {
                    return 'ok';
                } else {
                    return ' a phone number only content 7 to 10 chaacters';
                }
            }
        }
    }

    function get_mysql_date_formate_from_raw($data) {
		$dateDataArr = explode('.', $data);
		//echo count($dateDataArr);
		if (count($dateDataArr) != 3) {
			return '';
		} elseif (strlen($dateDataArr[2]) != 4) {
			return '';
		} elseif (strlen($dateDataArr[1]) != 2) {
			return '';
		} elseif (strlen($dateDataArr[0]) != 2) {
			return '';
		} elseif ($dateDataArr[0] < 0 || $dateDataArr[0] > 31) {
			return '';
		} elseif ($dateDataArr[1] < 0 || $dateDataArr[1] > 12) {
			return '';
			//} elseif ($dateDataArr[2] > (date('Y') - 1)) { echo $dateDataArr[2].'<br>'; echo date('Y') - 1;echo '<br>';die('G');
			// return '';
		} else {
			return $dateDataArr[2] . '-' . $dateDataArr[1] . '-' . $dateDataArr[0];
		}
	}


}
