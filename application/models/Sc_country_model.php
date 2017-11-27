<?php
class Sc_country_model extends CI_Model {
    private $_table='Sc_country';
    
    function __construct() {
        parent::__construct();   
    }
    
    function get_list(){
        $rs= $this->db->select('locationId,name')->where('locationType','0')->get($this->_table)->result_array();
        return $rs;
    }
    
    function get_state_by_country_id($locationId){
        $rs= $this->db->select('locationId,name')->where('locationType','1')->where('parentId',$locationId)->get($this->_table)->result_array();
        //echo $this->db->last_query();die;
        return $rs;
    }
    
    function get_city_by_country_id($locationId){
        $rs= $this->db->select('locationId,name')->where('locationType','2')->where('parentId',$locationId)->get($this->_table)->result_array();
        return $rs;
    }
}
