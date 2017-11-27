function removeTempProfileImage(img,elem){
    $("body").Lock({background: "rgba(249,249,249,.5)"});
    $.ajax({
        url:myJsMain.baseURLWithoutLogin+'ajax_controller/remove_temp_profile_image/',
        data:'img='+img,
        type:'POST',
        success:function(msg){
            $("body").Unlock();
            if(msg=='ok'){
                elem.remove();
                $('.input-fileupload').children(".form-section").show();
                $('.input-fileupload').children(".actions").show();
                $('.input-fileupload').children(".dropzone").show();
                Materialize.toast("Uploaded image removed successfully.", 5e3, "success");
            }else{
                Materialize.toast("Unow error happening to remove the image.", 5e3, "error");
            }
        }
    });
}
! function(e) {
    var a = function(e) {
            if (e.find(".collection").length < 1) {
                var a = "";
                a += '<div class="row no-gutter margin-bottom-0">', a += '\t<div class="col s12">', a += '\t\t<ul class="collection hide">', a += "\t\t</ul>", a += "\t</div>", a += "</div>", e.append(a)
            }
            var t = {
                url: myJsMain.baseURL+'ajax_controller_principal/upload_profile_image',
                dataType: "json",
                dropZone: e,
                autoUpload: !0,
                previewMaxWidth: 42,
                previewMaxHeight: 42,
                previewCrop: !1,
                filesContainer: e.find(".collection"),
                uploadTemplateId: null,
                downloadTemplateId: null,
                uploadTemplate: function(a) {
                    return s(e, a)
                },
                downloadTemplate: function(a) {
                    return c(e, a)
                },
                add: function (e, data) {
                    var uploadErrors = [];

                    var acceptFileTypes = /^image\/(gif|jpeg|jpg|png)$/i;
                    if(data.originalFiles[0]['type'].length && !acceptFileTypes.test(data.originalFiles[0]['type'])) {
                        uploadErrors.push('Selected file type are not accepted');
                    }

                    console.log(data.originalFiles[0]['size']) ;
                    if (data.originalFiles[0]['size'] > 5000000) {
                        uploadErrors.push('Selected file size is too big.');
                    }
                    if(uploadErrors.length > 0) {
                        myJsMain.commonFunction.erpAlert("Profile image update error",uploadErrors.join("\n"));
                        var uploadErrors = [];
                        return false;
                    } else {
                        //data.context = $('<p/>').text('Subiendo...').appendTo(document.body);
                        data.submit();
                        i(e);
                    }

                }
            };
            e.find("dropzone").length > 0 && (t.dropZone = e.find("dropzone")), e.fileupload(t)
        },
        s = function(a, s) {
            var c = "";
            return a.find(".collection").removeClass("hide"), e.each(s.files, function(e, a) {
                c += '<li class="collection-item avatar file upload">', c += ' <div class="fileupload-progress progress">', c += '     <div class="progress-bar determinate" style="width: 0%;"></div>', c += " </div>", c += t(a), c += ' <span class="title">' + a.name + "</span>", c += " <p>" + n(a) + "</p>", c += '\t<span class="secondary-content grey-text">', c += '\t\t<i class="material-icons">query_builder</i>', c += "\t</span>", c += "</li>"
            }), c
        },
        t = function(e) {
            return e.type.match("image.*") ? '<div class="preview circle"></div>' : o(e)
        },
        c = function(a, s) {
            var t = "";
            return a.find(".collection").removeClass("hide"), e.each(s.files, function(e, a) {
                "undefined" != typeof a.name ? t += i(a) : Materialize.toast(a.error, 5e3, "error")
            }), setTimeout(function() {
                a.find(".collection").children().length < 1 && a.find(".collection").addClass("hide")
            }, 10), t
        },
        i = function(e) {
            var a = "green-text",
                s = "check";
                //alert(e.error);
            if(!e.error){
                //Materialize.toast("File Uploaded successfully.", 5e3, "success");
                $('.input-fileupload').children(".form-section").hide();
                $('.input-fileupload').children(".actions").hide();
                $('.input-fileupload').children(".dropzone").hide();
            }alert(e.name);
                $('#profilePictureFileName').val(e.name);
            //1 === e.error && (a = "red-text", s = "close");
            1 === (a = "red-text", s = "close");
            var t = "";
            return t += '<li class="collection-item avatar file download">', t += l(e), t += ' <span class="title">' + e.name + "</span>", t += " <p>" + n(e) + "</p>", t += '<span class="secondary-content ' + a + '">', t += '   <i class="material-icons" onclick="removeTempProfileImage(\''+ e.name +'\',$(this).parent().parent())">' + s + "</i>", t += " </span>", t += "</li>"
        },
        l = function(e) {
            return e.type.match("image.*") && "undefined" != typeof e.url ? '<div class="circle"><img src="' + e.url + '" alt="' + e.name + '"/></div>' : o(e)
        },
        o = function(e) {
            var a = "",
                s = e.name.substring(e.name.lastIndexOf(".") + 1);
            switch (s) {
                case "doc":
                case "dot":
                case "docx":
                case "docm":
                case "dotx":
                case "dotm":
                case "docb":
                    a = "fa fa-file-word-o";
                    break;
                case "xls":
                case "xlt":
                case "xlm":
                case "xlsx":
                case "xlsm":
                case "xltx":
                case "xltm":
                case "xlsb":
                case "xla":
                case "xlam":
                case "xll":
                case "xlw":
                    a = "fa fa-file-excel-o";
                    break;
                case "ppt":
                case "pot":
                case "pps":
                case "pptx":
                case "pptm":
                case "potx":
                case "potm":
                case "ppam":
                case "ppsx":
                case "ppsm":
                case "sldx":
                case "sldm":
                    a = "fa fa-file-powerpoint-o";
                    break;
                case "pdf":
                    a = "fa fa-file-pdf-o";
                    break;
                case "txt":
                    a = "fa fa-file-text-o";
                    break;
                case "zip":
                case "gzip":
                case "gz":
                case "7z":
                case "rar":
                    a = "fa fa-file-archive-o";
                    break;
                case "png":
                case "jpg":
                case "jpeg":
                case "gif":
                    a = "fa fa-file-image-o";
                    break;
                default:
                    a = "fa fa-file-o"
            }
            return '<i class="circle ' + a + '" title="' + e.name + '"></i>'
        },
        n = function(e) {
            return e.size > 1048576 ? parseFloat(e.size / 1024 / 1024).toFixed(2) + " mb" : parseFloat(e.size / 1024).toFixed(2) + " kb"
        };
    e(document).ready(function() {
        e(".input-fileupload").each(function() {
            var s = e(this);
            a(s)
        }), e.support.cors && e.ajax({
            type: "HEAD",
            url: myJsMain.baseURL+'ajax_controller_principal/upload_profile_image'
        }).fail(function() {
            Materialize.toast("Upload server has gone away.", 5e3, "error")
        }).done(function(){
            //Materialize.toast("File Uploaded successfully.", 5e3, "success")
        }), e(".input-select2 select").select2()
    })
}(jQuery);