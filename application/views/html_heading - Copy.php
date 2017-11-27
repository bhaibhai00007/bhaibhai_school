<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $MetaTitle;?></title>
<?php echo meta($meta);?>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo SchoolSiteCSSURL;?>bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo SchoolSiteCSSURL;?>bootstrap-responsive.min.css" />
<!--<link rel="stylesheet" href="<?php //echo SchoolSiteCSSURL;?>fullcalendar.css" />-->
<link rel="stylesheet" href="<?php echo SchoolSiteCSSURL;?>uniform.css" />
<link rel="stylesheet" href="<?php echo SchoolSiteCSSURL;?>select2.css" />
<link rel="stylesheet" href="<?php echo SchoolSiteCSSURL;?>maruti-style.css" />
<link rel="stylesheet" href="<?php echo SchoolSiteCSSURL;?>maruti-media.css" class="skin-color" />
<script type="text/javascript">
//<![CDATA[
    // URL for access ajax data
    myJsMain = window.myJsMain || {};
    myJsMain.baseURL = '<?php echo BASE_URL;?>';
    myJsMain.showHowItWorksBoxLoaded =0;
    //myJsMain.securityCode='<?php //echo $this->session->userdata("secret");?>';
    <?php if($this->session->userdata('logedin')==''):?>
    myJsMain.isLogedIn=false;
    <?php else:?>
    myJsMain.isLogedIn=true;
    <?php endif;?>
    <?php /*if($isMobile=='yes'):?>
        myJsMain.isMobile='yes';
    <?php else: ?>
        myJsMain.isMobile='no';
    <?php endif; */?>    
    myJsMain.SecretTextSetAjaxURL='<?php echo BASE_URL.'ajax/reset_secret/'?>';
    myJsMain.CaptchaCookeName='<?php //echo $this->config->item('CAPTCHA_COOKIE_NAME');?>';     
    myJsMain.messageBoxTitle='<?php echo $messageBoxTitle;?>';
//]]>
manualClick=false;
    var searchurl = '<?php echo BASE_URL;?>';
    var dialog=null;
</script>
</head>
<body>