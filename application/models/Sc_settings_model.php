<?php
class Sc_settings_model extends CI_Model {
    private $_table='sc_settings';
    private $_table_year='sc_year';
            
    function __construct() {
        parent::__construct();
    }
    
    function edit($constantValueArr,$constantName){
        $this->db->where('constantName',$constantName);
        $this->db->update($this->_table,$constantValueArr);
        return TRUE;
    }
    
    function get_details_by_id($constantName){
        return $this->db->from($this->_table)->where('constantName',$constantName)->get()->row_array();
    }
    
    function get_current_session_id(){ 
        $this->db->select('y.sessionId')->from($this->_table.' AS s')->join($this->_table_year.' AS y','s.constantValue=y.session');
        $rs=$this->db->where('s.constantName','RUNNING_SESSION')->get()->result_array();
        //echo $this->db->last_query();die;
        //pre($rs);die;
        return $rs[0]['sessionId'];
    }
}