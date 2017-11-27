<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
    
    function __construct() {
        parent::__construct();
    }
    
    public function index(){ 
        if($this->_is_loged_in()){
            $this->_go_to_user_dashbooard();
        }else{
            $generalDataArr=array();
            $meta=array();
            $generalDataArr['MetaTitle']="Temp School";
            $meta[]=array('name' => 'description', 'content' => "School");
            $meta[]=array('name' => 'keywords', 'content' =>'content');
            $generalDataArr['meta']=$meta;
            $generalDataArr['ogImage']='';
            $data=$this->_get_to_be_login_template($generalDataArr);
            $this->load->view('login',$data);
        }
    }
    
}
