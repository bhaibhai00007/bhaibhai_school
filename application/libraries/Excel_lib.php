<?php

defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'third_party/simplexlsx.class.php';
class Excel_lib {
    private $_excelObject;
    //$params = array('type' => 'large', 'color' => 'red');

    function __construct($params) {
        $this->_excelObject=new SimpleXLSX($params['excelFilePath']);
    }
    
    public function get_num_cols() {
        list($num_cols, $num_rows) = $this->_excelObject->dimension();
        return $num_cols;
    }
    
    public function get_all_rows(){
        $allRowsArr=$this->_excelObject->rows();
        return $allRowsArr;
    }

}
