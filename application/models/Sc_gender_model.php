<?php
class Sc_gender_model extends CI_Model {
    private $_table='sc_gender';
    
    function __construct() {
        parent::__construct();
        
    }
    
    function get_list(){
        $rs= $this->db->select('genderId,title')->get($this->_table)->result_array();
        return $rs;
    }
}
?>