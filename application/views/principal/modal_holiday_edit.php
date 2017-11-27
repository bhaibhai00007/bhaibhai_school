<?php echo $common_css; ?>
<style>
    .datepicker{ z-index:9999999 !important; }
</style>
<?php echo $common_js; ?>
<?php 
$hidden = array($primary_key_field => $primary_key_field_val);
echo form_open_multipart(BASE_URL . $this->erpUserTypeArr[$this->userType] . '/ajax_controller_principal/edit_holiday', array('id' => 'erp_holiday_edit_form', 'class' => 'form-vertical'),$hidden); ?>
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
                    <?php foreach ($table_holiday_structure_text AS $key => $val): //pre($key);pre($val);die;?>
                        <div class="input-field col s12 m12 l6">
                            <?php
                            if (array_key_exists('not_editable', $val)):
                                echo '<label for="' . $key . '">' . $val['elementEditVal'] . '</label>';
                            else:
                                $element = '<input  id="' . $key . '" name="' . $key . '" type="' . $val['type'] . '"';
                                if (array_key_exists('required', $val)):
                                    $element .= ' required="required"';
                                endif;

                                if (array_key_exists('class', $val)):
                                    $element .= ' class=" validate ' . $val['class'] . '"';
                                else:
                                    $element .= ' class="validate"';
                                endif;
                                if (array_key_exists('jsEventAction', $val)):
                                    $element .= ' ' . $val['jsEventAction'];
                                endif;

                                if (array_key_exists('elementEditVal', $val)):
                                    $element .= ' ' . $val['elementEditVal'];
                                endif;
                                $element .= ' labelName="' . $val['label'] . '">';
                                echo $element;
                                echo '<label for="' . $key . '">' . $val['label'] . '</label>';
                            endif;
                            
                            ?>
                            <!--<input placeholder="Placeholder" id="first_name" type="text" class="validate" required="">
                            <label for="first_name">First Name</label>-->
                        </div>
                    <?php endforeach; ?>
                    <?php 
                   /*<div class="input-select2 col s12 m12 l6" class="validate required">
                        <select id="genderId" name="genderId" labelName="">
                            <option value="">Select gender</option>
                            <?php foreach ($genderArr AS $key => $val): ?>
                                <option value="<?php echo $val['genderId']; ?>" <?php if($val['genderId']==$teacherDataArr['genderId']){ echo 'selected';} ?>><?php echo $val['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    ///
                    <div class="input-select2 col s12 m12 l6">
                      <select id="countryId" name="countryId" labelName="" class="validate required">
                      <option value="">Select country</option>
                      <?php foreach ($countryArr AS $key => $val): ?>
                      <option value="<?php echo $val['locationId']; ?>"><?php echo $val['name']; ?></option>
                      <?php endforeach; ?>
                      </select>
                      </div>
                      <div class="input-select2 col s12 m12 l6">
                      <select id="stateId" name="stateId" labelName="" class="validate required">
                      <option value="">Select state</option>
                      </select>
                      </div>

                       <div class="input-select2 col s12 m12 l6">
                      <select id="cityId" name="cityId" labelName="" class="validate required">
                      <option value="">Select city</option>
                      </select>
                      </div> */ 
                      ?>
                </div>
            </div>
            <div class="panel-footer">
                <div class="right-align">
                    <button type="reset" class="btn-flat waves-effect" onclick="$('#editActionWindow').modal('open');">
                        RESET
                    </button>
                    <button type="submit" class="btn-flat waves-effect" id="holidayEditSubmit">
                        SUBMIT
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<script src="<?php echo SchoolSiteResourcesURL; ?>bower_components/blueimp-file-upload/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL; ?>bower_components/blueimp-load-image/js/load-image.all.min.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL; ?>bower_components/blueimp-canvas-to-blob/js/canvas-to-blob.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL; ?>bower_components/blueimp-file-upload/js/jquery.iframe-transport.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL; ?>bower_components/blueimp-file-upload/js/jquery.fileupload.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL; ?>bower_components/blueimp-file-upload/js/jquery.fileupload-process.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL; ?>bower_components/blueimp-file-upload/js/jquery.fileupload-image.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL; ?>bower_components/blueimp-file-upload/js/jquery.fileupload-validate.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL; ?>bower_components/blueimp-file-upload/js/jquery.fileupload-ui.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL; ?>bower_components/blueimp-tmpl/js/tmpl.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteJSURL; ?>custom/<?php echo $this->erpUserTypeArr[$this->userType]; ?>/holiday_form_edit.js" type="text/javascript"></script>

<script src="<?php echo SchoolSiteJSURL; ?>custom/<?php echo $this->erpUserTypeArr[$this->userType]; ?>/holiday_manage.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        $("body").Unlock();
        $("body").delegate(".datepicker", "focusin", function () {
            //$('#editActionWindow').on('shown.bs.modal', function() {
            $(this).datepicker({
                container: '#root-picker-outlet',
                format: 'dd/mm/yyyy',
                formatSubmit: 'yyyy/mm/dd',
                todayBtn: "linked",
                autoclose: true,
                todayHighlight: true,
                selectMonths: true,
                selectYears: 15,
            });
        });

        // jQuery(document).delegate('#countryId', 'change', function () { //alert('calling')
        //     myJsMain.commonFunction.showStateCity(jQuery('#countryId').val(), 'state');
        // });

        // jQuery(document).delegate('#stateId', 'change', function () {
        //     myJsMain.commonFunction.showStateCity(jQuery('#stateId').val(), 'city');
        // });
    });
</script>