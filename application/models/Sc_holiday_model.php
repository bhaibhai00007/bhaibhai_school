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
}