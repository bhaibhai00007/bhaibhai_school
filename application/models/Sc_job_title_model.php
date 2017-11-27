<?php
class Sc_job_title_model extends CI_Model {
    private $_table='sc_job_title';
    
    function __construct() {
        parent::__construct();   
    }
    
    function get_list(){
        $rs= $this->db->select('jobTitleId,title')->where('status',1)->get($this->_table)->result_array();
        return $rs;
    }
}