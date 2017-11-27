<?php echo $html_heading; ?> 
<?php echo $header;
?>
<main>
    <div class="main-content">
        <div class="row">
            <div class="col s12">
                <div class="page-header">
                    <h1>
                        <i class="material-icons">show_upload</i> <?php //echo $bulkUploadType;?> Bulk Upload
                    </h1>
                    <!--<p>Some charts with Google Charts and AmCharts.</p>-->
                </div>
            </div>
        </div>
        <div class="row">
            <ul class="collapsible popout" data-collapsible="accordion">
                <li>
                    <div class="collapsible-header <?php if($bulkUploadType=='teacher'){?>active<?php } ?>"><i class="mdi mdi-file-excel"></i>Teacher Bulk Upload</div>
                    <div class="collapsible-body">
                        <div class="col s12 m12 l12">
                            <div class="panel panel-bordered">
                                <!--<div class="panel-header">
                                </div>-->
                                <div class="panel-header border-top-0">
                                    <div class="subtitle">
                                        <div class="card-panel alternative lighten-1">
                                            Tips for techer bulk upload.
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    
                                    <div class="row">
                                        <?php echo form_open_multipart('principal/bulk_upload_controller/',array('class' => 'validate bluk_upload_form','id' => 'form-upload-teacher'))?>
                                        <div class="col m6 s12 l4 text-center">
                                            <input type="file" name="userFile">
                                        </div>
                                        <div class="col m6 s12 l4 text-center">
                                            <!--<i class="mdi mdi-download"></i>-->
                                            <button type="button" class="btn btn-default bulk-upload-template-download" data-usertype="teacher">
                                                <i class="mdi mdi-download"></i>
                                            </button>
                                        </div>
                                        <div class="col m6 s12 l4 text-center">
                                            <button type="button" class="btn btn-default upload-btn" data-formactionid="teacher_upload_process">
                                                <i class="mdi mdi-upload"></i>
                                                Submit
                                            </button>
                                        </div>
                                        <?php echo form_close();?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header <?php if($bulkUploadType=='class'){?>active<?php } ?> "><i class="mdi mdi-file-excel"></i>Class & Section</div>
                    <div class="collapsible-body">
                        <div class="col s12 m12 l12">
                            <div class="panel panel-bordered">
                                <!--<div class="panel-header">
                                </div>-->
                                <div class="panel-header border-top-0">
                                    <div class="subtitle">
                                        <div class="card-panel alternative lighten-1">
                                            tips for class bulk upload.
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <?php echo form_open_multipart('principal/bulk_upload_controller/',array('class' => 'validate bluk_upload_form','id' => 'form-upload-class'))?>
                                            <div class="col m6 s12 l4 text-center">
                                                <input type="file" name="userFile">
                                            </div>
                                            <div class="col m6 s12 l4 text-center">
                                                <!--<i class="mdi mdi-download"></i>-->
                                                <button type="button" class="btn btn-default bulk-upload-template-download" data-usertype="class">
                                                    <i class="mdi mdi-download"></i>
                                                </button>
                                            </div>
                                            <div class="col m6 s12 l4 text-center">
                                                <button type="button" class="btn btn-default upload-btn" data-formactionid="class_upload_process">
                                                    <i class="mdi mdi-upload"></i>
                                                    Submit
                                                </button>
                                            </div>
                                        <?php echo form_close();?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header <?php if($bulkUploadType=='student'){?>active<?php } ?>"><i class="mdi mdi-file-excel"></i>Student Bulk Upload</div>
                    <div class="collapsible-body">
                        <div class="col s12 m12 l12">
                            <div class="panel panel-bordered">
                                <!--<div class="panel-header">
                                </div>-->
                                <div class="panel-header border-top-0">
                                    <div class="subtitle">
                                        <div class="card-panel alternative lighten-1">
                                            tips for Student bulk upload.
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <?php echo form_open_multipart('principal/bulk_upload_controller/',array('class' => 'validate bluk_upload_form','id' => 'form-upload-student'))?>
                                        <div class="col m6 s12 l4 text-center">
                                            <input type="file" name="userFile">
                                        </div>
                                        <div class="col m6 s12 l4 text-center">
                                            <!--<i class="mdi mdi-download"></i>-->
                                            <button type="button" class="btn btn-default bulk-upload-template-download" data-usertype="student">
                                                <i class="mdi mdi-download"></i>
                                            </button>
                                        </div>
                                        <div class="col m6 s12 l4 text-center">
                                            <button type="button" class="btn btn-default upload-btn" data-formactionid="student_upload_process">
                                                <i class="mdi mdi-upload"></i>
                                                Submit
                                            </button>
                                        </div>
                                        <?php echo form_close();?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header <?php if($bulkUploadType=='parent'){?>active<?php } ?>"><i class="mdi mdi-file-excel"></i>Parent Bulk Upload</div>
                    <div class="collapsible-body">
                        <div class="col s12 m12 l12">
                            <div class="panel panel-bordered">
                                <!--<div class="panel-header">
                                </div>-->
                                <div class="panel-header border-top-0">
                                    <div class="subtitle">
                                        <div class="card-panel alternative lighten-1">
                                            tips for Parent bulk upload.
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <?php echo form_open_multipart('principal/bulk_upload_controller/',array('class' => 'validate bluk_upload_form','id' => 'form-upload-parent'))?>
                                            <div class="col m6 s12 l4 text-center">
                                                <input type="file" name="userFile">
                                            </div>
                                            <div class="col m6 s12 l4 text-center">
                                                <!--<i class="mdi mdi-download"></i>-->
                                                <button type="button" class="btn btn-default bulk-upload-template-download" data-usertype="parent">
                                                    <i class="mdi mdi-download"></i>
                                                </button>
                                            </div>
                                            <div class="col m6 s12 l4 text-center">
                                                <button type="button" class="btn btn-default upload-btn" data-formactionid="parent_upload_process">
                                                    <i class="mdi mdi-upload"></i>
                                                    Submit
                                                </button>
                                            </div>
                                        <?php echo form_close();?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header <?php if($bulkUploadType=='subject'){?>active<?php } ?>"><i class="mdi mdi-file-excel"></i> Subject Bulk Upload</div>
                    <div class="collapsible-body">
                        <div class="col s12 m12 l12">
                            <div class="panel panel-bordered">
                                <!--<div class="panel-header">
                                </div>-->
                                <div class="panel-header border-top-0">
                                    <div class="subtitle">
                                        <div class="card-panel alternative lighten-1">
                                            tips for Subject bulk upload.
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <?php echo form_open_multipart('#',array('id' => 'form-upload-subject', 'class' => 'validate bluk_upload_form'))?>
                                        <div class="col m6 s12 l4 text-center">
                                            <input type="file" name="userFile">
                                        </div>
                                        <div class="col m6 s12 l4 text-center">
                                            <!--<i class="mdi mdi-download"></i>-->
                                            <button type="button" class="btn btn-default bulk-upload-template-download" data-usertype="subject">
                                                <i class="mdi mdi-download"></i>
                                            </button>
                                        </div>
                                        <div class="col m6 s12 l4 text-center">
                                            <button type="button" class="btn btn-default">
                                                <i class="mdi mdi-upload"></i>
                                                Submit
                                            </button>
                                        </div>
                                        <?php echo form_close();?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="progress">
                <div id="progress-bar" class="progress-bar progress-bar-success progress-bar-striped " role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">
                    20%
                </div>
            </div>
        </div>
        
    </div>
</main>
<?php echo $footer; ?>
<script src="<?php echo SchoolSiteJSURL; ?>custom/<?php echo $this->erpUserTypeArr[$this->userType];?>/bulk_upload.js"></script>