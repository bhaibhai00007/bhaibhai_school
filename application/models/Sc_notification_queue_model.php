<?php
class Sc_notification_queue_model extends CI_Model {
    private $_table='sc_notification_queue';
    private $_table_primary_key='	notificatioQnueueId';
    function __construct() {
        parent::__construct();   
    }
    
    function get_list(){
        $rs= $this->db->get($this->_table)->result_array();
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
        $this->db->delete($this->_table, array($this->_table_primary_key=> $id)); 
        return TRUE;
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