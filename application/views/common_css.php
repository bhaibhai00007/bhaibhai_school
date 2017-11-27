<link href="//cdn.materialdesignicons.com/2.0.46/css/materialdesignicons.min.css" rel="stylesheet" />
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
<?php /*<link href="<?php echo SchoolSiteResourcesURL;?>bower_components/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<?php /*<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">*/?>
<link href="<?php echo SchoolSiteResourcesURL;?>bower_components/Materialize/dist/css/materialize.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SchoolSiteResourcesURL;?>bower_components/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SchoolSiteResourcesURL;?>bower_components/code-prettify/src/prettify.css" rel="stylesheet" type="text/css" />

<link href="<?php echo SchoolSiteCSSURL;?>themes/light.css" id="ssThemeColor" rel="stylesheet" type="text/css" />
<link href="<?php echo SchoolSiteCSSURL;?>themes/main/materialize-red.css" id="ssMainColor" rel="stylesheet" type="text/css" />
<link href="<?php echo SchoolSiteCSSURL;?>themes/alternative/red.css" id="ssAlternativeColor" rel="stylesheet" type="text/css" />

<link href="<?php echo SchoolSiteCSSURL;?>theme-switcher.css" rel="stylesheet" type="text/css" />
<?php if($this->session->userdata('LOGEDIN')==''):?>
<link href="<?php echo SchoolSiteCSSURL;?>login.css" rel="stylesheet" type="text/css" />
<?php else:?>
<link href="<?php echo SchoolSiteCSSURL;?>pages/dashboard.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SchoolSiteCSSURL;?>admin.css" rel="stylesheet" type="text/css" />

<link href="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-file-upload/css/jquery.fileupload.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SchoolSiteResourcesURL;?>bower_components/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SchoolSiteCSSURL;?>apps/crud.css" rel="stylesheet" type="text/css" />
<?php endif;?>
<link rel="shortcut icon" href="<?php echo SchoolSiteImgURL;?>favicon.ico" type="image/x-icon">