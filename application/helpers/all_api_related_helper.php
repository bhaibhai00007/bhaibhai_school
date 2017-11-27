<?php

if ( ! function_exists('success_response_after_post_get')){
    function success_response_after_post_get($parram){
        $result=array();
        if(!array_key_exists('ajaxType', $parram)):
            if(array_key_exists('master_ip', $parram)){
                $result=  get_default_urls($parram['master_ip']);    
            }else{
                $result=  get_default_urls();    
            }
        endif;
        //$result['message']="Shipping address data updated successfully.";
        $result['timestamp'] = time();
        if(!empty($parram)):
            foreach ($parram as $k => $v){
                $result[$k]=$v;
            }
        endif;
        
        header('Content-type: application/json');
        echo json_encode($result);
    }
}

if ( ! function_exists('get_default_urls')){
    function get_default_urls($ip=SMS_IP_ADDR){
        $result=array();
        $result['site_logo_image_url']='http://'.$ip.'/upload/';
        $result['site_image_url']='http://'.$ip.'/assets/images/';
        $result['site_image_url']='http://'.$ip.'/assets/images/';
        return $result;
    }
}