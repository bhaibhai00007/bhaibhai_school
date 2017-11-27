<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?php echo $MetaTitle;?></title>
<?php echo meta($meta);?>
<meta charset="UTF-8" />
<meta name="author" content="">
<?php echo $common_css;?>
<script type="text/javascript">
//<![CDATA[
    // URL for access ajax data
    myJsMain = window.myJsMain || {};
    <?php if($this->userType!=""):?>
    myJsMain.baseURL = '<?php echo BASE_URL.$this->erpUserTypeArr[$this->userType].'/';?>';
    <?php endif;?>
    myJsMain.baseURLWithoutLogin = '<?php echo BASE_URL;?>';
    myJsMain.showHowItWorksBoxLoaded =0;
    //myJsMain.securityCode='<?php //echo $this->session->userdata("secret");?>';
    <?php if($this->session->userdata('LOGEDIN')==''):?>
    myJsMain.isLogedIn=false;
    <?php else:?>
    myJsMain.isLogedIn=true;
    <?php endif;?>
    <?php /*if($isMobile=='yes'):?>
        myJsMain.isMobile='yes';
    <?php else: ?>
        myJsMain.isMobile='no';
    <?php endif; */?>    
    myJsMain.SecretTextSetAjaxURL='<?php echo BASE_URL.'ajax_controller/reset_secret/'?>';
    myJsMain.CaptchaCookeName='<?php //echo $this->config->item('CAPTCHA_COOKIE_NAME');?>';     
    myJsMain.messageBoxTitle='<?php echo $messageBoxTitle;?>';
    myJsMain.isConfirmBoxClick="no";
    myJsMain.isConfirmBoxClickCheck="";
//]]>
manualClick=false;
    var searchurl = '<?php echo BASE_URL;?>';
    var dialog=null;
</script>
<style>
    .modal .modal-header{padding:10px 24px !important;}
    .modal .modal-content{padding:10px 24px !important;}
    .modal .modal-footer{height:46px;}
</style>
</head>
<body>