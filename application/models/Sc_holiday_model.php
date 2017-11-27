<?php
class Sc_holiday_model extends CI_Model {
    private $_table='sc_holiday';
    public $_table_holiday_structure_text=array(
        'title'=>array('type'=>'text','required'=>'required','label'=>'Holiday Title'),
        'startDate'=>array('type'=>'date','class'=>'datepicker','required'=>'required','label'=>'Start Date'),
        'endDate'=>array('type'=>'date','class'=>'datepicker','required'=>'required','label'=>'End Date')
    );
    
    function __construct() {
        parent::__construct();   
    }
    
    function get_list(){
        $rs= $this->db->select('holidayId,title,startDate,endDate,status')->get($this->_table)->result_array();
        //echo $this->db->last_query();die;
        return $rs;
    }

    function add($dataArr){
        $this->db->insert($this->_table,$dataArr);
        return $this->db->insert_id();
    }

    function get_holiday_list_for_principal($schoolId=1){
        $this->db->select('h.holidayId,h.title,h.startDate,h.endDate')->from($this->_table.' AS h');
        $rs=$this->db->where('h.schoolId',$schoolId)->get()->result_array();
        //echo $this->db->last_query();die;
        return $rs;
    }

    function edit($dataArr,$id){
        $this->db->where($this->_table_primary_key,$id);
        $this->db->update($this->_table,$dataArr);
        return TRUE;
    }

    function get_full_details_by_id($id){
        $this->db->from($this->_table.' AS h');
        $rs=$this->db->where($this->_table_primary_key,$id)->get()->result_array();
        //echo $this->db->last_query();die;
        return $rs;
    }

    function get_details_by_id($id){
        return $this->db->from($this->_table)->where($this->_table_primary_key,$id)->get()->row_array();
    }
}