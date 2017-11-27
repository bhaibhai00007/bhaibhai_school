<?php
$config['useragent'] = 'CodeIgniter';
/*$config['protocol'] = 'smtp';
//$config['mailpath'] = '/usr/sbin/sendmail';
$config['smtp_host'] = 'ssl://smtp.googlemail.com';
//'smtpout.secureserver.net';
////ssl://smtp.googlemail.com
$config['smtp_user'] = 'snalwaoffice@gmail.com';//    judhisthira@dailyplaza.com
$config['smtp_pass'] = 'Letmein10';//   ///judhsithira123
$config['smtp_port'] = 465; 
$config['smtp_timeout'] = 5;*/
$config['protocol'] = 'sendmail';
$config['mailpath'] = 'D:/xampp/sendmail/sendmail.exe';
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;
$config['wrapchars'] = 76;
$config['mailtype'] = 'html';
//$config['charset'] = 'utf-8';
$config['validate'] = FALSE;
$config['priority'] = 3;
$config['crlf'] = "\r\n";
$config['newline'] = "\r\n";
$config['bcc_batch_mode'] = FALSE;
$config['bcc_batch_size'] = 200;
$config['monthArr'] = array('1'=>'Jan','2'=>'Feb','3'=> 'Mar', 4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',
9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec');
?>