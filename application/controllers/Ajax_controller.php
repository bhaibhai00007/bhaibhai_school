<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_controller extends MY_Controller {
    
    function __construct() {
        parent::__construct();
    }
    
    function validate_login(){
        $this->load->model('Sc_user_model');
        $config = array(
            array('field'   => 'userName','label'   => 'User Name','rules'   => 'trim|required|xss_clean|valid_email'),
            array('field'   => 'password','label'   => 'Password','rules'   => 'trim|required|xss_clean')
         );
        //initialise the rules with validatiion helper
        $this->form_validation->set_rules($config); 
        //checking validation
        if($this->form_validation->run() == FALSE){
                //retun to login page with peroper error
                echo json_encode(array('result'=>'bad','msg'=>str_replace('</p>','',str_replace('<p>','',validation_errors()))));die;
        }else{
            $userName=$this->input->post('userName',TRUE);
            $password=$this->input->post('password',TRUE);
            $DataArr=$this->Sc_user_model->check_login_data($userName,$password);
            //print_r($DataArr);die;
            if(count($DataArr)>0){
                $this->session->set_userdata('LOGEDIN','ok');
                $this->session->set_userdata('USER_ID',$DataArr[0]['userId']);
                $this->session->set_userdata('USER_NAME',$userName);
                $this->session->set_userdata('USER_FNAME',$DataArr[0]['fName']);
                $this->session->set_userdata('USER_TYPE',$DataArr[0]['userType']);
                $this->session->set_userdata('USER_SCHOOL_ID',$DataArr[0]['schoolId']);
                
                //$this->Sc_user_model->add_login_history(array('userId'=>$DataArr[0]->userId,'IP'=>$this->input->ip_address()));
                $redirect_url = $_SERVER['HTTP_REFERER'];
                echo json_encode(array('result'=>'good','url'=>$redirect_url?$redirect_url:$_SERVER['HTTP_REFERER']));die; 
            }else{
                echo json_encode(array('result'=>'bad','msg'=>'Please check your "Username" and "Password" and try again.'));die;     
            }
        }
    }
    
    function show_state_city(){
        $locationId= $this->input->post('locationId',TRUE);
        $type= $this->input->post('type',TRUE);
        if($type!=""){
            $this->load->model("Sc_country_model");
            //pre($type);die;
            if($type=='state')
                $dataArr= $this->Sc_country_model->get_state_by_country_id($locationId);
            else
                $dataArr= $this->Sc_country_model->get_city_by_country_id($locationId);
            //pre($dataArr);die;
            $optionStr='<option value="">Select '.$type.'</option>';
            foreach ($dataArr AS $key=>$val){
                $optionStr.='<option value="'.$val['locationId'].'">'.$val['name'].'</option>';
            }
            echo $optionStr;die;
        }else{
            echo '';die;
        }
    }
    
    function checkUserNameIsExist(){
        $this->load->model('Sc_user_model');
        $userName=$this->input->post('userName',TRUE);
        echo '$userName : '.$userName;die;
        $DataArr=$this->Sc_user_model->is_user_name_exist($userName);
        if(!empty($DataArr)){
            echo 'ok';die;
        }else{
            echo 'not';die;
        }
    }
    
    
    function remove_temp_profile_image(){
        $img= $this->input->post('img',TRUE);
        if($img==""){
            echo '';die;
        }else{
            $profilePicPath=SchoolResourcesPath.'uploads/'. $img;
            if(@unlink($profilePicPath)){
                echo 'ok';die;
            }else{
                echo '';die;
            }
        }
    }
}