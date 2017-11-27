<?php
class Sc_parent_model extends CI_Model {
    private $_table='sc_parent';
    public $_table_primary_key='parentId';
    private $_table_user='sc_user';
    private $_caste='sc_caste';
    public $_table_parent_structure_text=array(
        'motherFName'=> array('type'=> 'text', 'required'=>'required','label'=>'Mother First Name'),
        'motherMName'=> array('type'=> 'text', 'required'=>'required','label'=>'Mother Middle Name'),
        'motherLName'=> array('type'=> 'text', 'required'=>'required','label'=>'Mother Last Name'),
        'address'=> array('type'=>'text','required'=>'required','label'=>'Address'),
        'fatherProfession'=> array('type'=>'text','required'=>'required','label'=>'Father\'s Profession'),
        'fatherQualification'=> array('type'=>'text','required'=>'required','label'=>'Father\'s Qualification'),
        'motherProfession'=> array('type'=>'text','required'=>'required','label'=>'Mother\'s Profession'),
        'motherQualification'=> array('type'=>'text','required'=>'required','label'=>'Mother\'s Qualification'),
        'religion'=> array('type'=>'text','required'=>'required','label'=>'Religion'),
        'homePhone'=> array('type'=>'text','required'=>'required','label'=>'Home Phone'),
        'zip'=> array('type'=>'text','required'=>'required','label'=>'Zip Code')

    );
    
    public $_table_user_structure_text=array(
        'userName'=>array('type'=>'email','required'=>'required','is_unique'=>'sc_user.userName','label'=>'User Name','jsEventAction'=>'onblur="$(\'#communicationEmail\').val($(this).val());"','not_editable'=>'true'),
        'communicationEmail'=>array('type'=>'email','required'=>'required','label'=>'Communication Email'),
        'fName'=>array('type'=>'text','required'=>'required','label'=>'First Name'),
        'mName'=>array('type'=>'text','label'=>'Middle Name'),
        'lName'=>array('type'=>'text','required'=>'required','label'=>'Last Name'),
        'phoneNumber'=>array('type'=>'tel','required'=>'required','label'=>'Phone Number')
    );
    
    
    
    public $_table_parent_structure_foreign_key=array(
        'countryId'=>array('required'=>'required','label'=>'Country'),
        'stateId'=>array('required'=>'required','label'=>'State'),
        'cityId'=>array('required'=>'required','label'=>'Phone Number')
    );
            
    function __construct() {
        parent::__construct();
        
    }
    
    function get_parents_list_for_principal($schoolId=1){
        $this->db->select('p.parentId,u.fName,u.lName,u.communicationEmail,p.motherFName,p.motherLName,u.phoneNumber,u.status')->from($this->_table.' AS p');
        $this->db->join($this->_table_user.' AS u','p.userId=u.userId');
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