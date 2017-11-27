// here i am handle product data selected by the user by submit event and handle show product list in Prackage details page
myJsMain.login=function(){
    var loginValidationRules = {
        userName: {
            required: true,
            email:true
        },
        password: {
            required: true
        }
    };
    $('#erp_user_login_form').validate({rules: loginValidationRules,onsubmit: true});
    $('#erp_user_login_form').submit(function(e) {
        e.preventDefault(); 
        if ($(this).valid()) { 
            //myJsMain.commonFunction.showPleaseWait();
            //$.LoadingOverlay("show");
            $("body").Lock({background: "rgba(249,249,249,.5)"});
            $('#loginInSubmit').prop('disabled',true);
            //$('#fade_background').fadeIn();
            /*var actionObject = {hooks: {onOk: function () {
                        $("body").Lock({background: "rgba(249,249,249,.5)"}), 
                                setTimeout(function () {
                            //e("#chkDeleteAll").prop("checked", !1)
                            //n(),
                            myJsMain.commonFunction.ajaxSubmit($(this),myJsMain.baseURLWithoutLogin+'ajax_controller/validate_login', loginFormCallback)
                        }, 1e3)
                    }}};
            $.Modal("Testing cofniorm Box","Are you sure want to do the action ?",actionObject);*/
            
            myJsMain.commonFunction.ajaxSubmit($(this),myJsMain.baseURLWithoutLogin+'ajax_controller/validate_login', loginFormCallback);
        }
    });
        
        // this is just to show product list page
    function loginFormCallback(resultData){ 
        //myJsMain.commonFunction.hidePleaseWait();
        //$.LoadingOverlay("show");
        $("body").Unlock();
        //$.LoadingOverlay("hide");
        $('#loginInSubmit').prop('disabled',false);
        //alert(resultData.result);
        //alert(resultData.msg);
        //console.log('resultData.result : '+resultData.result);
        //$('#fade_background').fadeOut();
        //$('#LoadingDiv').fadeOut();
        if(resultData.result=='bad'){
            myJsMain.commonFunction.erpAlert(myJsMain.messageBoxTitle+' System Message',resultData.msg);
        }else if(resultData.result=='good'){
            //alert(resultData.url);
            window.location.href = resultData.url;
            //myJsMain.commonFunction.tidiitAlert('Tidiit System Message',resultData.url,200);
        }
    }       
}
myJsMain.forgot_password=function(){
    var forgotPasswrodValidationRules = {
        userForgotPasswordEmail: {
            required: true,
            email:true
        }
    };
    $('#retailershangout_user_forgot_form').validate({rules: forgotPasswrodValidationRules,onsubmit: true});
    $('#retailershangout_user_forgot_form').submit(function(e) {
        e.preventDefault();
        if ($(this).valid()) {
            //myJsMain.commonFunction.showPleaseWait();
            $.LoadingOverlay("show");
            $('#forgotPasswrod').prop('disabled',true);
            //$('#fade_background').fadeIn();
            //$('#LoadingDiv').fadeIn();
            myJsMain.commonFunction.ajaxSubmit($(this),myJsMain.baseURLWithoutLogin+'ajax/retribe_forgot_password/', forgotPasswordFormCallback);
        }
    });
        
        // this is just to show product list page
    function forgotPasswordFormCallback(resultData){
        $('#forgotPasswrod').prop('disabled',false);
        //myJsMain.commonFunction.hidePleaseWait();
        $.LoadingOverlay("hide");
        myJsMain.commonFunction.tidiitAlert('Retailershangout System Message',resultData.msg,200);
    }
    
    
        
}

function check_profile_completion_for_start_order(msg){
    if(msg!=""){
        myJsMain.commonFunction.tidiitAlert('Retailershangout System Message',msg,200);
    }else{
        return false
    }
}