<?php
class Sc_blood_group_model extends CI_Model {
    private $_table='Sc_blood_group';
    
    function __construct() {
        parent::__construct();   
    }
    
    function get_list(){
        $rs= $this->db->select('bloodGroupId,title')->get($this->_table)->result_array();
        return $rs;
    }
}

