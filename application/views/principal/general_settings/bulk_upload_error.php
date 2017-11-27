<?php echo $html_heading; ?> 
<?php echo $header;?>
<style>
.panel .panel-header{height: 65px !important;}
.panel .panel-footer{height: 65px !important;}
</style>
    
<main>
    <div class="main-content">
        <div class="row">
            <div class="col s12">
                <div class="page-header">
                    <h1>
                        <?php echo ucfirst($bulkUploadType);?> Bulk Upload Errors Details
                    </h1>
                    <!--<p>Some charts with Google Charts and AmCharts.</p>-->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="panel panel-bordered">
                    <div class="panel-header">
                        <div class="col s12 m6 l6">
                            <button type="button" class="waves-effect waves-purple btn z-depth-3 pull-left" onclick="location.href='<?php echo BASE_URL.$this->erpUserTypeArr[$this->userType].'/bulk_upload_controller/download_bulk_upload_error/'.$bulkUploadType;?>'">Download Excelfile for Re-Upload</button>
                        </div>
                        <div class="col s12 m6 l6">
                            <button type="button" class="waves-effect waves-purple btn z-depth-3 pull-right" onclick="location.href='<?php echo BASE_URL.$this->erpUserTypeArr[$this->userType].'/principal/bulk_upload/'.$bulkUploadType;?>';">Go for Bulk Upload</button>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php echo $errors;?>
                    </div>
                    <div class="panel-footer">
                        <div class="col s12 m6 l6">
                            <button type="button" class="waves-effect waves-purple btn z-depth-3 pull-left" onclick="location.href='<?php echo BASE_URL.$this->erpUserTypeArr[$this->userType].'/bulk_upload_controller/download_bulk_upload_error/'.$bulkUploadType;?>'">Download Excelfile for Re-Upload</button>
                        </div>
                        <div class="col s12 m6 l6" >
                            <button type="button" class="waves-effect waves-purple btn z-depth-3 pull-right" onclick="location.href='<?php echo BASE_URL.$this->erpUserTypeArr[$this->userType].'/principal/bulk_upload/'.$bulkUploadType;?>';">Go for Bulk Upload</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php echo $footer; ?>