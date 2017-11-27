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
            <h4 class="main-text lighten-1">Manage Holidays</h4>
            <ul class="tabs tab-demo z-depth-1">
                <li class="tab col s3"><a class="active" href="#HolidayList">Holidays List</a></li>
                <li class="tab col s3"><a  href="#HolidayAdd">Add Holiday</a></li>
            </ul>
            <div id="HolidayList" class="col s12">
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
                                            <th>Title</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Status</th>
                                            <th class="center-align" data-searchable="false" data-orderable="false">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($holidayDataArr)): $slNo=0;
                                            foreach ($holidayDataArr AS $key =>$value): //pre($value);    ?>
                                        <tr>
                                            <td class="center-align" width="10%">
                                                <input type="checkbox" id="holiday<?php echo $value['holidayId'];?>">
                                                <label for="holiday<?php echo $value['holidayId'];?>"><?php echo ++$slNo;?></label>
                                            </td>
                                            <td data-id="<?php echo $value['holidayId'];?>" width="20%"><?php echo $value['title'];?></td>
                                            <td width="25%"><?php echo $value['startDate'];?></td>
                                            <td width="15%"><?php echo $value['endDate'];?></td>
                                            <td with="15%"><?php echo $value['status'];?></td>
                                            <td class="center-align" width="20%">
                                                <div class="btn-group">
                                                    <a href="javascript:void(0);" class="btn-flat btn-small waves-effect">
                                                        <i class="material-icons material-icons-edit" data-editid="<?php echo $value['holidayId'];?>">edit</i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn-flat btn-small waves-effect">
                                                        <?php if($value['status']==1):?>
                                                        <i style="font-size:0.8rem !important;" class="make-inactive-cl" data-statusid="<?php echo $value['holidayId'];?>" title="Active">Make Inactive</i>
                                                        <?php else:?>
                                                        <i style="font-size:0.8rem !important;" class="make-active-cl" data-statusid="<?php echo $value['holidayId'];?>" title="Inactive">Make Active</i>
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
            <div id="HolidayAdd" class="col s12">
            <?php echo form_open_multipart('#',array('id'=>'erp_holiday_add_form','class'=>'form-vertical'));?>
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
                                        <?php foreach($holiday_list_arr AS $key=>$val): //pre($key);//die;?>
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
                                </div>
                                <div class="panel-footer">
                                    <div class="right-align">
                                        <button type="reset" class="btn-flat waves-effect">
                                            RESET
                                        </button>
                                        <button type="submit" class="btn-flat waves-effect" id="holidayAddSubmit">
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
<script src="<?php echo SchoolSiteJSURL; ?>custom/<?php echo $this->erpUserTypeArr[$this->userType];?>/holiday_list.js" type="text/javascript"></script>


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
<script src="<?php echo SchoolSiteJSURL; ?>custom/<?php echo $this->erpUserTypeArr[$this->userType];?>/holiday_form.js" type="text/javascript"></script>
<?php /*
 * <script src="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-file-upload/js/jquery.fileupload-audio.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-file-upload/js/jquery.fileupload-video.js" type="text/javascript"></script>

 */?>


<script src="<?php echo SchoolSiteJSURL; ?>custom/<?php echo $this->erpUserTypeArr[$this->userType];?>/holiday_manage.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
    jQuery('.datepicker').pickadate({
        selectMonths: true, /* Creates a dropdown to control month*/
        selectYears: 15, /* Creates a dropdown of 15 years to control year*/
        container: '#root-picker-outlet',
        format: 'dd/mm/yyyy',
		formatSubmit: 'yyyy/mm/dd'
    });
    
    myJsMain.holiday_add();
    myJsMain.holiday_edit();
    myJsMain.holiday_update_status();
    
});
    
</script>
