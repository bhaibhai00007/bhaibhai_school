// here i am handle product data selected by the user by submit event and handle show product list in Prackage details page
jQuery(document).ready(function(){
    jQuery.validator.messages.required = function (param, input) {
        var el =document.getElementById(input.name); 
        //console.log(el.getAttribute("labelName"));
        //console.log('=='+input+'==');
        return 'The ' + el.getAttribute("labelName") + ' field is required';
    }
});
myJsMain.holiday_add=function(){
    var holidayAddValidationRules = {
        userName:{required: true,email:true},
        communicationEmail: {required: true,email:true},
        fName: {required: true},
        lName: {required: true},
        phoneNumber: {required: true},
    };
    $('#erp_holiday_add_form').validate({rules: holidayAddValidationRules,errorElement : 'div',
    errorLabelContainer: '.errorTxt',onsubmit: true});
    $('#erp_holiday_add_form').submit(function(e) {
        e.preventDefault(); 
        if ($(this).valid()) { 
            //  $.LoadingOverlay("show");
            $("body").Lock({background: "rgba(249,249,249,.5)"});
            $('#parentAddSubmit').prop('disabled',true);
            myJsMain.commonFunction.ajaxSubmit($(this),myJsMain.baseURL+'ajax_controller_principal/add_holiday', holidayAddFormCallback);
        }
    });
        
        // this is just to show product list page
    function holidayAddFormCallback(resultData){
        //$.LoadingOverlay("hide");
        $("body").Unlock();
        //myJsMain.commonFunction.hidePleaseWait();
        $('#holidayAddSubmit').prop('disabled',false); //alert(resultData.result);
        if(resultData.result=='bad'){
            myJsMain.commonFunction.erpAlert(myJsMain.messageBoxTitle+' System Message',resultData.msg);
        }else if(resultData.result=='good'){
            myJsMain.holiday_add_form_reset();
            myJsMain.commonFunction.erpAlert(myJsMain.messageBoxTitle+' System Message',resultData.msg);
            myJsMain.holiday_ajax_list();
            $('ul.tabs').tabs('select_tab', 'HolidayList');
        }
    }
}

myJsMain.holiday_add_form_reset=function(){
    $('#erp_holiday_add_form')[0].reset();
    $('.input-fileupload').children(".form-section").show();
    $('.input-fileupload').children(".actions").show();
    $('.input-fileupload').children(".dropzone").show();
    $('ul.collection').empty();
    $('#profilePictureFileName').val("");
    $("#countryId").val("");
    $("#stateId").val("");
    $("#cityId").val("");
}

myJsMain.holiday_ajax_list=function(){
    $("body").Lock({background: "rgba(249,249,249,.5)"});
    $('.datatable').find("tbody").empty();
    $.ajax({
        url:myJsMain.baseURL+'ajax_controller_principal/show_holiday_list_in_update_data_table/',
        success:function(html){
            $("body").Unlock();
            $('.datatable').find("tbody").append(html).draw();
        }
    });
}

myJsMain.holiday_delete=function(id){
    $.ajax({
        url:myJsMain.baseURL+'ajax_controller_principal/holiday_delete/',
        data:'holidayId='+id,
        type:'POST',
        dataType:'json',
        success:function(resultData){
            $("body").Unlock();
            //myJsMain.commonFunction.hidePleaseWait();
            if(resultData.result=='bad'){
                myJsMain.commonFunction.erpAlert(myJsMain.messageBoxTitle+' System Message',resultData.msg);
            }else if(resultData.result=='good'){
                myJsMain.commonFunction.erpAlert(myJsMain.messageBoxTitle+' System Message',resultData.msg);
                //alert(resultData.url);
                /*setTimeout(function(){
                    window.location.reload();
                  }, 3000);*/
            }
        }
    });
}

myJsMain.holiday_edit=function(){
    $(document).on('click','.material-icons-edit',function(){
        var cId=0;
        cId=$(this).data("editid");
        if(cId==0){
            myJsMain.commonFunction.erpAlert(myJsMain.messageBoxTitle+' System Message',"Invalid holiday index selection for update.");
            return false;
        }else if(cId==0){
            myJsMain.commonFunction.erpAlert(myJsMain.messageBoxTitle+' System Message',"Invalid holiday index selection for update.");
            return false;
        }else{
            //location.href=myJsMain.baseURL+'principal/show_teacher_edit/'+cId;
            $("body").Lock({background: "rgba(249,249,249,.5)"});
            //$.LoadingOverlay("show");
            $.ajax({
                url:myJsMain.baseURL+'ajax_controller_principal/get_holiday_details_with_edit_mode/',
                data:"holidayId="+cId,
                type:'POST',
                dataType:'json',
                success:function(resultData){
                     if(resultData.result=='bad'){
                         myJsMain.commonFunction.erpAlert(myJsMain.messageBoxTitle+' System Message',resultData.msg);
                     }else{
                         $("#editActionWindow").children(".modal-header").find("h5.title").html('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> <i class="fa fa-user" aria-hidden="true"></i> Update Holiday');
                         $("#editActionWindow").children(".modal-content").html(resultData.resultContent);
                         $('.modal').modal({
                            dismissible: true, // Modal can be dismissed by clicking outside of the modal
                            opacity: .5, // Opacity of modal background
                            in_duration: 300, // Transition in duration
                            out_duration: 200, // Transition out duration
                            starting_top: '4%', // Starting top style attribute
                            ending_top: '10%', // Ending top style attribute
                            ready: function(modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
                              //alert("Ready");
                              console.log(modal, trigger);
                            },
                            complete: function() { 
                                //alert('Closed'); // Callback for Modal close
                            } 
                        });
                        //$("body").Unlock();
                        //$.LoadingOverlay("hide");
                        $('#editActionWindow').modal('open');
                     }
                }
            });
        }
    });
}

myJsMain.holiday_edit_save=function(){
    /*var teacherAddValidationRules = {
        userName:{required: true,email:true},
        communicationEmail: {required: true,email:true},
        fName: {required: true},
        lName: {required: true},
        phoneNumber: {required: true},
    };
    $('#erp_teacher_edit_form').validate({rules: teacherAddValidationRules,errorElement : 'div',
    errorLabelContainer: '.errorTxt',onsubmit: true});*/
    $('#erp_holiday_edit_form').submit(function(e) {
        $.LoadingOverlay("show");
        /*e.preventDefault(); 
        if ($(this).valid()) { 
            //  $.LoadingOverlay("show");
            $("body").Lock({background: "rgba(249,249,249,.5)"});
            //$('#teachereditSubmit').prop('disabled',true);
            myJsMain.commonFunction.ajaxSubmit($(this),myJsMain.baseURL+'ajax_controller_principal/edit_teacher', teacherEditFormCallback);
        }*/
    });
    
    function holidayEditFormCallback(resultData){
        //$.LoadingOverlay("hide");
        $("body").Unlock();
        //myJsMain.commonFunction.hidePleaseWait();
        //$('#teacherAddSubmit').prop('disabled',false); //alert(resultData.result);
        if(resultData.result=='bad'){
            myJsMain.commonFunction.erpAlert(myJsMain.messageBoxTitle+' System Message',resultData.msg);
        }else if(resultData.result=='good'){
            //myJsMain.teacher_add_form_reset();
            $('#editActionWindow').modal('close');
            myJsMain.commonFunction.erpAlert(myJsMain.messageBoxTitle+' System Message',resultData.msg);
            myJsMain.holiday_ajax_list();
            $('ul.tabs').tabs('select_tab', 'HolidayList');
        }
    }
}

myJsMain.holiday_update_status=function(){
    $(document).on('click','.make-inactive-cl',function(){
        var cId=0;
        cId=$(this).data("statusid");        
        $("body").Lock({background: "rgba(249,249,249,.5)"});
        holiday_update_status_by_action(cId,0);
    });
    
    $(document).on('click','.make-active-cl',function(){
        var cId=0;
        cId=$(this).data("statusid");        
        $("body").Lock({background: "rgba(249,249,249,.5)"});
        holiday_update_status_by_action(cId,1);
    });
    
    function holiday_update_status_by_action(cId,changeTo){
        $.ajax({
            url:myJsMain.baseURL+'ajax_controller_principal/holiday_status_chanage/',
            data:'holidayId='+cId+'&changeTo='+changeTo,
            type:'POST',
            dataType:'json',
            success:function(resultData){
                $("body").Unlock();
                //myJsMain.commonFunction.hidePleaseWait();
                if(resultData.result=='bad'){
                    myJsMain.commonFunction.erpAlert(myJsMain.messageBoxTitle+' System Message',resultData.msg);
                }else if(resultData.result=='good'){
                    myJsMain.commonFunction.erpAlert(myJsMain.messageBoxTitle+' System Message',resultData.msg);
                    //alert(resultData.url);
                    setTimeout(function(){
                        window.location.reload();
                      }, 3000);
                }
            }
        });
    }
}
