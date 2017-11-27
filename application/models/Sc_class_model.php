<?php
class Sc_class_model extends CI_Model {
    private $_table='sc_class';
    private $_table_primary_key='classId';
    
    function __construct() {
        parent::__construct();   
    }
    
    function get_class_list_for_principal($schoolId=1){
        $this->db->select('*')->from($this->_table.' AS t');
        $rs=$this->db->where('schoolId',$schoolId)->get()->result_array();
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
            $this->db->delete('sc_section', array($this->_table_primary_key=> $id));
            $this->db->delete($this->_table, array($this->_table_primary_key=> $id)); 
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    function get_details_by_id($id){
        return $this->db->from($this->_table)->where($this->_table_primary_key,$id)->get()->row_array();
    }
    
    function get_full_details_by_id($id){
        $rs=$this->db->where($this->_table_primary_key,$id)->get()->result_array();
        //echo $this->db->last_query();die;
        return $rs;
    }
}