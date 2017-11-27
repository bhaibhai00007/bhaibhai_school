<?php
class Sc_student_model extends CI_Model {
    private $_table='sc_student';
    private $_table_user='sc_user';
    private $_table_enroll='sc_enroll';
    private $_table_join_parent='sc_student_parent';
    //private $_table_user='sc_';
    
    
    function __construct() {
        parent::__construct();
    }
    
    function get_students_list_for_principal(){
        $this->db->select('u.communicationEmail,u.fName,u.phoneNumber,u.userType');
        $this->db->from($this->_table." AS s")->join($this->_table_user." AS u",'s.userId=u.userId','left');
        $rs=$this->db->get()->result_array();
        //echo $this->db->last_query();
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

    function enroll_student($dataArr){
        $this->db->insert($this->_table_enroll,$dataArr);
        return $this->db->insert_id();
    }
    
    function connect_with_parent($dataArr){
        $this->db->insert($this->_table_join_parent,$dataArr);
        return $this->db->insert_id();
    }
}
