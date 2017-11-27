<?php

if(!function_exists('create_excel_file')){
    function create_excel_file($file_name_path,$data,$sheet_title="Student Upload Data"){
        //die($file_name_path);
        include_once APPPATH.'third_party/PHPExcel.php';
        
        $objPHPExcel=new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0)->fromArray($data);
        $objPHPExcel->getActiveSheet()->setTitle($sheet_title);
        //$filename='just_some_random_name.xls'; 
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); //- See more at: https://arjunphp.com/how-to-use-phpexcel-with-codeigniter/#sthash.0d4ttuQe.dpuf
        //$filePath=$_SERVER['DOCUMENT_ROOT'].'/rentbike/uploads/'.$filename;
        $objWriter->save($file_name_path);
    }
}

if(!function_exists('create_excel_file_multiple_sheet')){
    function create_excel_file_multiple_sheet($file_name_path,$data){
        include_once APPPATH.'third_party/PHPExcel.php';
        //pre($data);die;
        $objPHPExcel=new PHPExcel();
        foreach($data AS $k => $v){ 
            $key= array_keys($v);
            //pre($key);die;
            $cSheetData=array();
            $cSheetData=$v[$key[0]];
            //pre($key);
            //pre($cSheetData);die;
            if($key==0){
                $objPHPExcel->setActiveSheetIndex(0)->fromArray($cSheetData);
                $objPHPExcel->getActiveSheet()->setTitle($key[0]);
            }else{
                $objPHPExcel->createSheet();
                $sheet = $objPHPExcel->setActiveSheetIndex($k);
                $sheet->fromArray($cSheetData);
                $sheet->setTitle($key[0]);
            }
        }
        
        //$filename='just_some_random_name.xls'; 
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); //- See more at: https://arjunphp.com/how-to-use-phpexcel-with-codeigniter/#sthash.0d4ttuQe.dpuf
        //$filePath=$_SERVER['DOCUMENT_ROOT'].'/rentbike/uploads/'.$filename;
        $objWriter->save($file_name_path);
    }
}

if(!function_exists('read_mark_data_from_excel_file')){
    function read_mark_data_from_excel_file($file_path){
        include_once APPPATH.'third_party/PHPExcel.php';
        //include  FCPATH.'application/third_party/PHPExcel/IOFactory.php';
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objReader->setReadDataOnly(true);

        $objPHPExcel = $objReader->load($file_path);
        $totalSheet= $objPHPExcel->getSheetCount();
        $i = 0;
        $data=array();
        while ($i<$totalSheet){
            $objPHPExcel->setActiveSheetIndex($i);
            $sheetTitle=$objPHPExcel->getActiveSheet()->getTitle();
            $activeSheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
            $data[$sheetTitle]=$activeSheetData;
            $i++;
        }
        return $data;
    }
}
