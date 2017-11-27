<?php
class Sc_attendance_model extends CI_Model {
    private $_table='sc_student';
    private $_table_user='sc_user';
    private $_table_att='sc_attendance';
    
    function __construct() {
        parent::__construct();
    }
    
    function get_attendance_students_list_for_principal(){
        $this->db->select('u.fName,u.mName,u.lName,s.cardId,att.timestamp,att.status,att.inTime,att.outTime');
        $this->db->from($this->_table." AS s")->join($this->_table_user." AS u",'s.userId=u.userId','left');
        $this->db->from($this->_table_att." AS att")->join($this->_table." AS st",'att.studentId=st.studentId','left');
        $rs=$this->db->get()->result_array();
        //echo $this->db->last_query(); die;
        return $rs;
    }
}
