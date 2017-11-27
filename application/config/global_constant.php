<?php
define("CURRENT_INSTANCE","erp");
define("SH_CURRENT_INSTANCE",CURRENT_INSTANCE);
define('CURRENT_SERVER_IP', '127.0.0.1');
$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://';
define('CURRENT_HTTP_PROTOCOL',$protocol);
define("SH_CURRENT_SCHOOL_DB",SH_CURRENT_INSTANCE);
define("SH_CURRENT_FI_DB",SH_CURRENT_SCHOOL_DB);
define("SH_DOCUMENTS", serialize (array('Transfer Certificate','Marks Sheets','Birth Certificate')));
define('DB_USER', 'root');
if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='localhost:8080'){
    define('DB_PASS', '');
}else{
    define('DB_PASS', '6syDmECEyqLneAULy2NYtbSLpCqy727M');
}
if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='localhost:8080'){
    define('BASE_URL', CURRENT_HTTP_PROTOCOL.$_SERVER['HTTP_HOST'].'/'.CURRENT_INSTANCE.'/');
}else{
    define('BASE_URL', CURRENT_HTTP_PROTOCOL.$_SERVER['HTTP_HOST'].'/');
}
define('SchoolSiteResourcesURL',BASE_URL.'resources/');
define('SchoolSiteImagesURL',SchoolSiteResourcesURL.'images/');
define('SchoolSiteImgURL',SchoolSiteResourcesURL.'img/');
define('SchoolSiteCSSURL',SchoolSiteResourcesURL.'css/');
define('SchoolSiteJSURL',SchoolSiteResourcesURL.'js/');
if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']==CURRENT_SERVER_IP){
    define('SchoolResourcesPath',$_SERVER['DOCUMENT_ROOT'].'/'.CURRENT_INSTANCE.'/resources/');
}else{
    define('SchoolResourcesPath',$_SERVER['DOCUMENT_ROOT'].'/resources/');
}