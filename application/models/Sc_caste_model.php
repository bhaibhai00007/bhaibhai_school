<?php
class Sc_caste_model extends CI_Model {
    private $_table='sc_caste';
    
    function __construct() {
        parent::__construct();   
    }
    
    function get_list(){
        $rs= $this->db->select('casteId,title')->get($this->_table)->result_array();
        //echo $this->db->last_query();die;
        return $rs;
    }
}