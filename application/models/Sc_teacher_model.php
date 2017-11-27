<?php
class Sc_teacher_model extends CI_Model {
    private $_table='sc_teacher';
    public $_table_primary_key='teacherId';
    private $_table_user='sc_user';
    private $_table_job_title='sc_job_title';
    public $_table_teacher_structure_text=array(
        'DOB'=>array('type'=>'date','class'=>'datepicker','required'=>'required','label'=>'Date of birth'),
        'DOJ'=>array('type'=>'date','class'=>'datepicker','required'=>'required','label'=>'Date of Join'),
        'qualification'=>array('type'=>'text','required'=>'required','label'=>'Qualification'),
        'specialisation'=>array('type'=>'text','required'=>'required','label'=>'Specialisation'),
        'experience'=>array('type'=>'text','required'=>'required','label'=>'Experience'),
        'address'=>array('type'=>'text','required'=>'required','label'=>'Address'),
        'zipCode'=>array('type'=>'text','required'=>'required','label'=>'Zip Code'),
        'homePhone'=>array('type'=>'text','required'=>'required','label'=>'Home Phone'),
        'cardId'=>array('type'=>'text','required'=>'required','label'=>'Card Id')
    );
    
    public $_table_user_structure_text=array(
        'userName'=>array('type'=>'email','required'=>'required','is_unique'=>'sc_user.userName','label'=>'User Name','jsEventAction'=>'onblur="$(\'#communicationEmail\').val($(this).val());"','not_editable'=>'true'),
        'communicationEmail'=>array('type'=>'email','required'=>'required','label'=>'Communication Email'),
        'fName'=>array('type'=>'text','required'=>'required','label'=>'First Name'),
        'mName'=>array('type'=>'text','label'=>'Middle Name'),
        'lName'=>array('type'=>'text','required'=>'required','label'=>'Last Name'),
        'phoneNumber'=>array('type'=>'tel','required'=>'required','label'=>'Phone Number'),
    );
    
    public $_table_teacher_structure_foreign_key=array(
        'jobTitleId'=>array('required'=>'required','label'=>'Job Title'),
        'genderId'=>array('required'=>'required','label'=>'Gender'),
        'bloodGroupId'=>array('type'=>'text','required'=>'required','label'=>'Blood Group'),
        'countryId'=>array('required'=>'required','label'=>'Country'),
        'stateId'=>array('required'=>'required','label'=>'State'),
        'cityId'=>array('required'=>'required','label'=>'Phone Number'),
    );
            
    function __construct() {
        parent::__construct();
        
    }
    
    function get_teachers_list_for_principal($schoolId=1){
        $this->db->select('t.teacherId,u.fName,u.lName,u.communicationEmail,u.phoneNumber,jt.title,u.status')->from($this->_table.' AS t');
        $this->db->join($this->_table_user.' AS u','t.userId=u.userId')->join($this->_table_job_title.' AS jt','t.jobTitleId=jt.jobTitleId');
        $rs=$this->db->where('u.schoolId',$schoolId)->get()->result_array();
        //echo $this->db->last_query();die;
        return $rs;
    }
    
    function add($dataArr){
        $this->db->insert($this->_table,$dataArr);
        return $this->db->insert_id();
    }
    
    function edit($dataArr,$id){
        $this->db->where($this->_table_primary_key,$id);
        $this->db->update($this->_table,$dataArr);
        return TRUE;
    }
    
    function delete($id){
        $DataArr= $this->get_details_by_id($id);
        if(!empty($DataArr)){
            $this->db->delete($this->_table, array($this->_table_primary_key=> $id)); 
            $this->db->delete($this->_table_user,array('userId'=>$DataArr['userId']));
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    function get_details_by_id($id){
        return $this->db->from($this->_table)->where($this->_table_primary_key,$id)->get()->row_array();
    }
    
    function get_full_details_by_id($id){
        $this->db->from($this->_table.' AS t')->join($this->_table_user.' AS u','t.userId=u.userId');
        $rs=$this->db->where($this->_table_primary_key,$id)->get()->result_array();
        //echo $this->db->last_query();die;
        return $rs;
    }
}