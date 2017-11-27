<?php 
echo $html_heading;?> 

<link href="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-file-upload/css/jquery.fileupload.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SchoolSiteResourcesURL;?>bower_components/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SchoolSiteCSSURL;?>apps/crud.css" rel="stylesheet" type="text/css" />
<?php echo $header;
?>
<style>
.errorTxt{
  min-height: 20px;
}
</style>
<main>
    <div class="main-content">
        <!--<div class="row">
            <div class="col s12">
                <div class="page-header">
                    <h1>
                        <i class="material-icons">Students</i> Student List
                    </h1>
                    <p>A simple and practical CRUD application.</p>
                </div>
            </div>
        </div>-->
        <div class="col s12">
            <h4 class="main-text lighten-1">Manage Teacher</h4>
            <ul class="tabs tab-demo z-depth-1">
                <li class="tab col s3"><a class="active" href="#TeacherList">Teacher List</a></li>
                <li class="tab col s3"><a  href="#TeacherAdd">Add Teacher</a></li>
            </ul>
            <div id="TeacherList" class="col s12">
                <section id="apps_crud">
                    <div class="crud-app">
                        <div class="fixed-action-btn">
                            <!--<a class="btn-floating btn-large tooltipped" data-tooltip="Add" data-position="top" data-delay="50" href="apps_crud_form.html">
                                <i class="large material-icons">add</i>
                            </a>-->
                            <button class="btn-floating btn-large white tooltipped scrollToTop" data-tooltip="Scroll to top" data-position="top" data-delay="50">
                                <i class="large material-icons">keyboard_arrow_up</i>
                            </button>
                            <button class="btn-floating btn-large tooltipped" id="btnDeleteAll" data-tooltip="Delete" data-position="top" data-delay="50" disabled>
                                <i class="large material-icons">delete</i>
                            </button>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <table class="datatable bordered">
                                    <thead>
                                        <tr>
                                            <th class="center-align" data-searchable="false" data-orderable="false">
                                                <input type="checkbox" id="chkDeleteAll" class="checkToggle" data-target=".crud-app table tbody [type=checkbox]">
                                                <label for="chkDeleteAll">Sl No</label>
                                            </th>
                                            <th>Teacher Name</th>
                                            <th>Teacher Email</th>
                                            <th>Teacher Job title</th>
                                            <th>Teacher Phone</th>
                                            <th class="center-align" data-searchable="false" data-orderable="false">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($teacherDataArr)): $slNo=0;
                                            foreach ($teacherDataArr AS $key =>$value): //pre($value);?>
                                        <tr>
                                            <td class="center-align" width="10%">
                                                <input type="checkbox" id="teacher<?php echo $value['teacherId'];?>">
                                                <label for="teacher<?php echo $value['teacherId'];?>"><?php echo ++$slNo;?></label>
                                            </td>
                                            <td data-id="<?php echo $value['teacherId'];?>" width="20%"><?php echo $value['fName'].' '.$value['lName'];?></td>
                                            <td width="25%"><?php echo $value['communicationEmail'];?></td>
                                            <td width="15%"><?php echo $value['title'];?></td>
                                            <td with="15%"><?php echo $value['phoneNumber'];?></td>
                                            <td class="center-align" width="20%">
                                                <div class="btn-group">
                                                    <a href="javascript:void(0);" class="btn-flat btn-small waves-effect">
                                                        <i class="material-icons material-icons-edit" data-editid="<?php echo $value['teacherId'];?>">edit</i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn-flat btn-small waves-effect">
                                                        <?php if($value['status']==1):?>
                                                        <i style="font-size:0.8rem !important;" class="make-inactive-cl" data-statusid="<?php echo $value['teacherId'];?>" title="Active">Make Inactive</i>
                                                        <?php else:?>
                                                        <i style="font-size:0.8rem !important;" class="make-active-cl" data-statusid="<?php echo $value['teacherId'];?>" title="Inactive">Make Active</i>
                                                        <?php endif;?>
                                                    </a>
                                                    <a class="btn-flat btn-small waves-effect btnDelete">
                                                        <i class="material-icons">delete</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach;
                                        endif;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div id="TeacherAdd" class="col s12">
                <?php echo form_open_multipart('#',array('id'=>'erp_teacher_add_form','class'=>'form-vertical'));?>
                    <div class="row">
                        <div class="col s12 m12">
                            <div class="panel panel-bordered">
                                <div class="panel-header">
                                    <div class="errorTxt error-text"></div>
                                    <!--<div class="title">General elements</div>
                                    <div class="subtitle">Customize in your own way. See more <a href="components_forms.html">clicking here.</a></div>-->
                                </div>
                                <div class="panel-body">
                                    <div class="row no-gutter">
                                        <?php foreach($table_user_structure_text AS $key=>$val): //pre($key);//die;?>
                                        <div class="input-field col s12 m6 l3">
                                            <?php $element='<input  id="'.$key.'" name="'.$key.'" type="'.$val['type'].'"';
                                            if(array_key_exists('required', $val)):
                                                $element.=' required="required"';
                                            endif;
                                            
                                            if(array_key_exists('class', $val)):
                                                $element.=' class=" validate '.$val['class'].'"';
                                            else:
                                                $element.=' class="validate"';
                                            endif;
                                            if(array_key_exists('jsEventAction', $val)):
                                                $element.=' '.$val['jsEventAction'];
                                            endif;
                                            $element.=' labelName="'.$val['label'].'">';
                                            echo $element;
                                            echo '<label for="'.$key.'">'.$val['label'].'</label>';
                                            ?>
                                            <!--<input placeholder="Placeholder" id="first_name" type="text" class="validate" required="">
                                            <label for="first_name">First Name</label>-->
                                        </div>
                                        <?php endforeach;?>
                                        <?php foreach($table_teacher_structure_text AS $key=>$val): //pre($key);//die;?>
                                        <?php if($val['type']!='date')?>
                                            <div id="root-picker-outlet" style="position:relative"></div>
                                        <div class="input-field col s12 m6 l3">
                                            <?php 
                                            $element='<input  id="'.$key.'" name="'.$key.'" type="'.$val['type'].'"';
                                            if(array_key_exists('required', $val)):
                                                $element.=' required="required"';
                                            endif;
                                            
                                            if(array_key_exists('class', $val)):
                                                $element.=' class=" validate '.$val['class'].'"';
                                            else:
                                                $element.=' class="validate"';
                                            endif;
                                            if(array_key_exists('jsEventAction', $val)):
                                                $element.=' '.$val['jsEventAction'];
                                            endif;
                                            $element.=' labelName="'.$val['label'].'">';
                                            echo $element;
                                            if($val['type']!='date')
                                            echo '<label for="'.$key.'">'.$val['label'].'</label>';
                                            ?>
                                            <!--<input placeholder="Placeholder" id="first_name" type="text" class="validate" required="">
                                            <label for="first_name">First Name</label>-->
                                        </div>
                                        <?php endforeach;?>
                                        <div class="input-select2 col s12 m6 l3">
                                            <select id="jobTitleId" name="jobTitleId" labelName="">
                                                <option value="">Select Job Title</option>
                                                <?php foreach ($jobTitleArr AS $key=>$val):?>
                                                <option value="<?php echo $val['jobTitleId'];?>"><?php echo $val['title'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="input-select2 col s12 m3" class="validate required">
                                            <select id="genderId" name="genderId" labelName="">
                                                <option value="">Select gender</option>
                                                <?php foreach ($genderArr AS $key=>$val):?>
                                                <option value="<?php echo $val['genderId'];?>"><?php echo $val['title'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <div class="input-select2 col s12 m6 l3">
                                            <select id="bloodGroupId" name="bloodGroupId" labelName="" class="validate required">
                                                <option value="">Select blood group</option>
                                                <?php foreach ($blogGroupArr AS $key=>$val):?>
                                                <option value="<?php echo $val['bloodGroupId'];?>"><?php echo $val['title'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <div class="input-select2 col s12 m6 l3">
                                            <select id="countryId" name="countryId" labelName="" class="validate required">
                                                <option value="">Select country</option>
                                                <?php foreach ($countryArr AS $key=>$val):?>
                                                <option value="<?php echo $val['locationId'];?>"><?php echo $val['name'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <div class="input-select2 col s12 m6 l3">
                                            <select id="stateId" name="stateId" labelName="" class="validate required">
                                                <option value="">Select state</option>
                                            </select>
                                        </div>
                                        
                                        <div class="input-select2 col s12 m6 l3">
                                            <select id="cityId" name="cityId" labelName="" class="validate required">
                                                <option value="">Select city</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row no-gutter margin-bottom-0">
                                        <div class="input-fileupload col s12 m12 l6">
                                            <div class="form-section">Uploads</div>
                                            <div class="actions">
                                                <span class="btn-flat small font-size-0-95 waves-effect fileinput-button">
                                                    <i class="material-icons">add</i>
                                                    <span>Add files</span>
                                                    <input type="file" id="files" name="files[]">
                                                </span>
                                            </div>
                                            <div class="dropzone valign-wrapper">
                                                <div class="valign center">
                                                    <i class="material-icons">get_app</i> or drop the files here
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="profilePictureFileName" id="profilePictureFileName" />
                                <div class="panel-footer">
                                    <div class="right-align">
                                        <button type="reset" class="btn-flat waves-effect">
                                            RESET
                                        </button>
                                        <button type="submit" class="btn-flat waves-effect" id="teacherAddSubmit">
                                            SUBMIT
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</main>
<?php echo $footer; ?>
<script src="<?php echo SchoolSiteJSURL; ?>custom/<?php echo $this->erpUserTypeArr[$this->userType];?>/teacher/teacher_list.js" type="text/javascript"></script>


<script src="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-file-upload/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-load-image/js/load-image.all.min.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-canvas-to-blob/js/canvas-to-blob.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-file-upload/js/jquery.iframe-transport.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-file-upload/js/jquery.fileupload.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-file-upload/js/jquery.fileupload-process.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-file-upload/js/jquery.fileupload-image.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-file-upload/js/jquery.fileupload-validate.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-file-upload/js/jquery.fileupload-ui.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-tmpl/js/tmpl.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteJSURL; ?>custom/<?php echo $this->erpUserTypeArr[$this->userType];?>/teacher/teacher_form.js" type="text/javascript"></script>
<?php /*
 * <script src="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-file-upload/js/jquery.fileupload-audio.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-file-upload/js/jquery.fileupload-video.js" type="text/javascript"></script>

 */?>


<script src="<?php echo SchoolSiteJSURL; ?>custom/<?php echo $this->erpUserTypeArr[$this->userType];?>/teacher/teacher_manage.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
    jQuery('.datepicker').pickadate({
        selectMonths: true, /* Creates a dropdown to control month*/
        selectYears: 15, /* Creates a dropdown of 15 years to control year*/
        container: '#root-picker-outlet',
        format: 'dd/mm/yyyy',
		formatSubmit: 'yyyy/mm/dd'
    });
    
    myJsMain.teacher_add();
    myJsMain.teacher_edit();
    myJsMain.teacher_update_status();
    
});
    
</script>
