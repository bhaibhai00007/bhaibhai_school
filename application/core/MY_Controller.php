<?php

class MY_Controller extends CI_Controller {
    public $erpUserTypeArr=array('PRI'=>'principal','PAR'=>'parent','STU'=>'student','TEA'=>'teacher','LIB'=>'librarian','ACC'=>'accountant','BUSA'=>'bus_admin');
    public $userType= '';
    function __construct() {
        parent::__construct();
        $this->userType=$this->session->userdata('USER_TYPE');
    }

    public function logout() {
        $this->session->unset_userdata('USER_TYPE');
        $this->session->unset_userdata('USER_ID');
        $this->session->unset_userdata('LOGEDIN');
        $this->session->unset_userdata('USER_NAME');
        $this->session->unset_userdata('USER_FNAME');
        $this->session->set_flashdata('success_message', 'You are logout successfully');
        redirect(BASE_URL,'refresh');
    }
    
    function _go_to_user_dashbooard(){
        //echo '$userType : '.$userType;die;
        redirect(BASE_URL.$this->erpUserTypeArr[$this->userType].'/'.$this->erpUserTypeArr[$this->userType].'/dashboard');
    }

    function _is_loged_in() {
        //echo 'LOGEDIN :'.$this->session->userdata('LOGEDIN');die;
        if($this->session->userdata('LOGEDIN')!="ok"){
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function _get_logedin_template($generalDataArr) {
        $data = array();
        $data = $this->html_heading($generalDataArr);
        //pre($data);die;
        //$data['CMSDataArr'] = $this->Cms_model->get_all();
        $this->lang->load('header', $this->session->userdata('site_lang'));
        $this->lang->load('footer', $this->session->userdata('site_lang'));
        $data['header'] = $this->load->view('header', $data, true);
        $data['common_js'] = $this->load->view('common_js', $data, true);
        $data['footer'] = $this->load->view('footer', $data, true);
        return $data;
    }

    public function _get_to_be_login_template($generalDataArr) {
        $data = array();
        $data = $this->html_heading($generalDataArr);
        $this->lang->load('footer1', $this->session->userdata('site_lang'));
        $data['common_js'] = $this->load->view('common_js', $data, true);
        $data['footer'] = $this->load->view('footer1', $data, true);
        return $data;
    }

    function _show_short_words_words($str, $NoOfWorrd = 20) {
        $strArr = explode(' ', $str);
        $shortStr = '';
        //echo 'NoOfWorrd '.$NoOfWorrd;die;
        for ($i = 0; $i < $NoOfWorrd; $i++) {
            if ($i == 0) {
                $shortStr = $strArr[$i];
            } else {
                $shortStr.=' ' . $strArr[$i];
            }
        }
        return $shortStr;
    }

    function switchLanguage($language = "") {
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
        redirect(base_url());
    }
    
    public function html_heading($SEODataArr = array()) {
        $cLanguage=$this->session->userdata('site_lang');
        if($cLanguage==''){
            $cLanguage = ($cLanguage != "") ? $cLanguage : "english";
            $this->session->set_userdata('site_lang', $cLanguage);
        }
        $cData=array();
        $common_css= $this->load->view('common_css',array(),TRUE);
       
        $this->lang->load('html_heading', $cLanguage);
        $data = array();
        $GateWayState=$this->input->get('GateWayState',TRUE);
        //echo '$GateWayState  ='.$GateWayState;die;
        if($GateWayState!=""){
            $this->session->set_userdata('GateWayState',$GateWayState);
        }

        $ClearGateWayState=$this->input->get('ClearGateWayState',TRUE);
        if($ClearGateWayState!=""){
            $this->session->unset_userdata('GateWayState');
        }

        if (empty($SEODataArr)) {
            $MetaData = $this->Siteconfig_model->get_html_head();
            $data['MetaTitle'] = $MetaData[0]['schoolName'];
            $meta[]=array('name' => 'description', 'content' => $MetaData[2]['schoolMetaDescription']);
            $meta[]=array('name' => 'keywords', 'content' =>$MetaData[1]['schoolMetaKeywords']);
            $data['meta']=$meta;
            $data['ogImage']='';
        } else {
            if(array_key_exists('meta', $SEODataArr)){
                //echo 'rrr ppp';die;
                $data['MetaTitle']=$SEODataArr['MetaTitle'];
                $data['meta']=$SEODataArr['meta'];
                if(!array_key_exists('ogImage', $SEODataArr)){
                    $data['ogImage']='';
                }else{
                    $data['ogImage']=$SEODataArr['ogImage'];
                }
            }else{
                $data['MetaTitle'] = $SEODataArr['MetaTitle'];
                $meta[]=array('name' => 'description', 'content' => $SEODataArr['MetaDescription']);
                $meta[]=array('name' => 'keywords', 'content' =>$SEODataArr['MetaKeyWord']);
                $data['meta']=$meta;
                $data['ogImage']='';
            }
        }
        //pre($this->session->userdata());die;
        //$this->load->model("Category_model");
        $data['navigationData']="<li></li>";
        if($this->userType!=""){
            $this->lang->load($this->erpUserTypeArr[$this->userType].'/navigation', $cLanguage);
            $data['navigation']=  $this->load->view($this->erpUserTypeArr[$this->userType].'/navigation',$data,TRUE);
        }
        $data['messageBoxTitle']=$this->lang->line('SCHOOL_ERP_SOLUCTION',FALSE);
        $data['common_css'] = $common_css;
        $data['html_heading'] = $this->load->view('html_heading', $data, true);
        return $data;
    }

}

?>