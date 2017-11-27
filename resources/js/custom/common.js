$(function(){
var path = location.pathname;
var pathArr=path.split('/');
var groupMeberPaymentRequest='';

var track_click = 1; 
	
var total_pages;

var offPage = 0;
var tidiitConfirm1Var=false;

// add new validate method for phone number validation.
jQuery.validator.addMethod("phoneno", function(value, element) {
	return this.optional(element) || /^[0-9?=.\+\-\ ]+$/.test(value);
}, "Phone must contain only numbers, or special characters.");

// add new validate method for alphabets and space validation.
jQuery.validator.addMethod("erpAlphaSpace", function(value, element) {
	return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
}, "Phone must contain only alphabet and space.");

// add new validate method for alphabets validation.
jQuery.validator.addMethod("erpAlpha", function(value, element) {
	return this.optional(element) || /^[a-zA-Z]+$/.test(value);
}, "Phone must contain only alphabets.");

jQuery.validator.addMethod("notEqual", function(value, element, param) {
  return this.optional(element) || value != param;
}, "Please specify a different (non-default) value");

//pleaseWaitDiv = $('<div class="modal" id="myLoadingModal" tabindex="-1" role="dialog" aria-labelledby="myLoadingModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false"><div class="modal-dialog"><div class="center-mod text-center"><img alt="" src="'+myJsMain.baseURL+'resources/images/loader.gif" /></div></div>');
//pleaseWebadminWaitDiv = $('<div class="modal" id="myLoadingModal" tabindex="-1" role="dialog" aria-labelledby="myLoadingModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false"><div class="modal-dialog"><div class="center-mod"><img alt="" src="'+myJsMain.MainSiteBaseURL+'resources/images/loader.gif" /></div></div>');


// js utility function to submit formm using ajax 
myJsMain.commonFunction = {
    ajaxSubmit: function($this, url, callback) {
        //alert(callback);return false;
        var ajaxUrl =url;
        data = new FormData($this[0]);
        
        /*********** OLD CODE ***************************        
        //data = $this.serialize().replace(/%5B%5D/g, '[]');
        //data = $this.serialize();
        data = new FormData($this[0]);
        //alert(data);return false;
        //alert(callback);return false;
        /*jQuery.post(ajaxUrl, data, function(resultData) {
            resultData['thisVar'] = $this;
            
            myJsMain.commonFunction.callBackFuction(callback, resultData);
            //$('body,html').animate({scrollTop: 0}, 'slow');
        }, 'json');
        ********************  OLD CODE HERE ***********/
        
        /********************  
        //var data = new FormData();
        //data.append('file', $('input[type=file]')[0].files[0]);
        /********************  some try CODE to fix ***********/
        jQuery.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: data,
            dataType:'json',
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
            success: callback
        });
    },
    callBackFuction: function(callback, data) { 
        alert(callback);
        // Call our callback, but using our own instance as the context
        callback.call(this, data);
    },
    js_dynamic_text:function(length){
        var randomStuff =["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","1","2","3","4","5","6","7","8","9","0","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
        var sl=0;
        var index;
        var char;
        var str='';
        for(sl=0;sl<length;sl++){
                index=Math.floor((Math.random()*61)+1);
                char=randomStuff[index];
                str=str+char;
        }
        //document.cookie= myJsMain.CaptchaCookeName+'='+str;
        var SecretTextSetAjaxData='secret='+str;
        jQuery.ajax({
           type: "POST",
           url: myJsMain.baseURL+'ajax/reset_secret/',
           data: SecretTextSetAjaxData,
           success: function(){
               if(myJsMain.showHowItWorksBoxLoaded==0)
                    myJsMain.commonFunction.showHowItWorksBox();
           }
         });
        return str;
    },
    showHowItWorksBox:function(){
        if(myJsMain.isLogedIn==false && pathArr[1]=="" ){
            /*myJsMain.commonFunction.showPleaseWait();
            jQuery.ajax({
                type: "POST",
                url: myJsMain.baseURL+'ajax/show_how_it_works/',
                success: function(msg){
                    myJsMain.commonFunction.hidePleaseWait();
                    if(msg!=''){
                        myJsMain.showHowItWorksBoxLoaded=1;
                        jQuery('#autoLoadHowItWorks').html(msg)
                    }
                }
            });*/
        }
        
    },
    GeneratNewImage:function(){
        jQuery('#secret_img').html("");
        var c=document.getElementById("secret_img");
        c.width = c.width;
        var ctx=c.getContext("2d");
        var str='';
        ctx.font="20px cursive"; //monotype corsiva  Helvetica  sans-serif
        str=myJsMain.commonFunction.js_dynamic_text(8);
        ctx.fillText(str,5,15);
        var SecretTextSetAjaxData='secret='+str;
        jQuery.ajax({
           type: "POST",
           url: myJsMain.SecretTextSetAjaxURL,
           data: SecretTextSetAjaxData,
           success: function(msg){ //alert(msg);
           }
         });
    }
    ,erpAlert:function(boxTitle,boxBodyMsg){
        var calBackAction={hooks: {onOk: function () {
                        /*r(), setTimeout(function () {
                             //Materialize.toast(a.length + " items deleted", 5e3, "success")
                        }, 1e3)*/
                    //alert("calBackAction calling");
                    }}};
       //$.Modal("Alert", "This is alert box", calBackAction,'alert');
       $.Modal(boxTitle,boxBodyMsg, calBackAction,'alert');
    },
    showStateCity:function(locationId,type){
        //$.LoadingOverlay("show");
        $("body").Lock({background: "rgba(249,249,249,.5)"});
        jQuery.ajax({
            url:myJsMain.baseURLWithoutLogin+'ajax_controller/show_state_city',
            data:'locationId='+locationId+'&type='+type,
            type:'POST',
            success:function(optionStr){ //alert(optionStr);
                //$.LoadingOverlay("hide");
                $("body").Unlock();
                jQuery('#'+type+'Id').html(optionStr);
                jQuery('#'+type+'Id').select2('refresh');
            }
        });
    },
    removeProfileImage:function(img,elem){
        $("body").Lock({background: "rgba(249,249,249,.5)"});
        $.ajax({
            url:myJsMain.baseURLWithoutLogin+'ajax_conroller/remove_temp_profile_image/',
            data:'img='+img,
            type:'POST',
            success:function(msg){
                $("body").Unlock();
                if(msg=='ok'){
                    elem.remove();
                    Materialize.toast("Uploaded image removed successfully.", 5e3, "success");
                }else{
                    Materialize.toast("Unow error happening to remove the image.", 5e3, "error");
                }
            }
        });
    },
    //MainSiteBaseURL
};
});

function getURLParameter(name) {
        return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null;
    }

function changeUrlParam (param, value, cururl) {
        
        var currentURL = window.location.href+'&';
        
        var change = new RegExp('('+param+')=(.*)&', 'g');
        var newURL = currentURL.replace(change, '$1='+value+'&');

        if (getURLParameter(param) !== null){
            try {
                window.history.replaceState('', '', newURL.slice(0, - 1) );
            } catch (e) {
                console.log(e);
            }
        } else {
            var currURL = window.location.href;
            if (currURL.indexOf("?") !== -1){
                window.history.replaceState('', '', currentURL.slice(0, - 1) + '&' + param + '=' + value);
            } else {
                window.history.replaceState('', '', currentURL.slice(0, - 1) + '?' + param + '=' + value);
            }
        }
    }
    
(function () {
    'use strict';
    var queryString = {};

    queryString.parse = function (str) {
        if (typeof str !== 'string') {
            return {};
        }

        str = str.trim().replace(/^\?/, '');

        if (!str) {
            return {};
        }

        return str.trim().split('&').reduce(function (ret, param) {
            var parts = param.replace(/\+/g, ' ').split('=');
            var key = parts[0];
            var val = parts[1];

            key = decodeURIComponent(key);
            // missing `=` should be `null`:
            // http://w3.org/TR/2012/WD-url-20120524/#collect-url-parameters
            val = val === undefined ? null : decodeURIComponent(val);

            if (!ret.hasOwnProperty(key)) {
                ret[key] = val;
            } else if (Array.isArray(ret[key])) {
                ret[key].push(val);
            } else {
                ret[key] = [ret[key], val];
            }

            return ret;
        }, {});
    };

    queryString.stringify = function (obj) {
        return obj ? Object.keys(obj).map(function (key) {
            var val = obj[key];

            if (Array.isArray(val)) {
                return val.map(function (val2) {
                    return encodeURIComponent(key) + '=' + encodeURIComponent(val2);
                }).join('&');
            }

            return encodeURIComponent(key) + '=' + encodeURIComponent(val);
        }).join('&') : '';
    };

    queryString.push = function (key, new_value) {
    var params = queryString.parse(location.search);
    params[key] = new_value;
    var new_params_string = queryString.stringify(params);
    history.pushState({}, "", window.location.pathname + '?' + new_params_string);
  };

    if (typeof module !== 'undefined' && module.exports) {
        module.exports = queryString;
    } else {
        window.queryString = queryString;
    }
})();


$(document).ready(function () {
    $("body").delegate('ul.js-p-sort li a', "click", function(e){
        e.preventDefault();
        var sort = $(this).attr('data-content');
        var jqout = $(this);
        $('ul.js-p-sort li a').removeClass('active');
        $(this).addClass('active');
        //changeUrlParam ('sort', sort);
        queryString.push('sort', sort);
        getRefinedPro(1,1);
    });     
    
    $( "body" ).delegate( "ul#brand input[class='brandsort']", "click", function() {
    //$("ul#brand input[class='brandsort']").click(function(){ 
        var jqout = $(this);
        var brands = [];
        
        $('ul#brand').find("input[class='brandsort']:checked").each(function() {
            brands.push(jQuery(this).val());
        });
        
        if(brands){
            var brand = brands.join("|");
        } else {
            var brand = false;
        }  
        
        //changeUrlParam ('brand', brand);
        queryString.push('brand', brand);
        location.reload();
        //getRefinedPro(1,1);
    });

    $( "body" ).delegate( "ul#options input[class='optionsort']", "click", function() {
        //$("ul#brand input[class='brandsort']").click(function(){
        var jqout = $(this);
        var options = [];

        $('ul#options').find("input[class='optionsort']:checked").each(function() {
            options.push(jQuery(this).val());
        });

        if(options){
            var option = options.join("|");
        } else {
            var option = false;
        }

        var name = $(this).attr('data-name');
        queryString.push('query', option);
        location.reload();
        //getRefinedPro(1,1);
    });

    $("body").delegate("ul#options select[class='optionsort']", "change", function() {
        var jqout = $(this);
        var options = [];
        options.push(jQuery(this).val());


        var option = options.join("|");


        queryString.push('querys', option);
        location.reload();
        //getRefinedPro(1,1);
    });

    
    $( ".jslider-pointer" ).mouseup( function() {
        var prices = $("input[id='Slider1']").val();
        var price = prices.split(";");
        price = price.join("|");
        queryString.push('range', price);
        getRefinedPro(1,1);
    } );
    
    
    $(".load_more").click(function (e) { //user clicks on button	
        $(this).hide(); //hide load more button on click
        $('.animation_image').show(); //show loading image

        if(track_click <= total_pages){ 
            getRefinedPro(track_click,0);
            //console.log(track_click);
        }
         
        if(track_click >= total_pages-1){
            //$(".load_more").attr("disabled", "disabled");
            $(".load_more").hide();
        }

    });
    /*if (typeof searchurl != 'undefined'){
    //if(searchurl!='undefined'){
        $("#topic_title").autocomplete({
            source: searchurl+"ajax/ajax_search_autocomplete",
            minLength: 2,
            select: function(event, ui) {
                if(ui.item.id != "#") {
                    var url = ui.item.type + '&id=' + ui.item.id;
                    $(".js-s-q").val(ui.item.type);
                    $(".js-s-id").val(ui.item.id);
                } else {
                    $(".js-s-q").val('');
                    $(".js-s-id").val('');
                }
            },
            html: true, // optional (jquery.ui.autocomplete.html.js required)
            // optional (if other layers overlap autocomplete list)
            open: function(event, ui) {
                $(".ui-autocomplete").css("z-index", 1000);
            }
        });
    }
    

    $( ".js-click-search" ).click(function() {
        $( ".js-site-search" ).submit();
    });*/
});    
    
    
function getRefinedPro(offPage,cls){
    var curUrl = window.location.href;
    $.get( 
        curUrl,
        {  page: offPage,
           cls: cls,
           stype: "ajax" 
        },
        function(data) {
            //console.log(data);
            $(".load_more").show();
            total_pages = data.total_pages;
            if (!$('ul#brand li').length) {
                $("div.js-add-widget").append(data.brands);
            }

            if(data.header){
                $("h2.js-header-title").html(data.header);
            }

            if(data.optionsdata){
                $("div.js-option-list").html(data.optionsdata);
            }
            
            if(data.products){ 
                if(data.cls){
                    $("div.js-product-area").empty();
                    $("div.js-product-area").html(data.products);
                    track_click = 1;
                } else {
                    $("div.js-product-area").append(data.products);
                    track_click++;
                }                
                $('.animation_image').hide();
            } else {
                if(data.cls){
                    $("div.js-product-area").empty();  
                    var htm = '<div class="alert alert-danger" role="alert"><h3><i class="fa fa-exclamation-triangle"></i> &nbsp; &nbsp; Oops! No products found as per your search criteria!</h3></div>';
                    $("div.js-product-area").html(htm);
                }
                $('.animation_image').hide();
                $(".load_more").hide();
            }
            
            //console.log(track_click);
            if(track_click == total_pages){
                $('.animation_image').hide();
                $(".load_more").hide();
            }
        },
        'json'
    ); 
}
    


