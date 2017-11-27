<div id="editActionWindow" class="modal "><!-- modal-fixed-footer-->
    <div class="modal-header">
        <h5 class="title">test</h5>
    </div>
    <div class="modal-content">
        
    </div>
    <!--<div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">Cancel</a>
        <a href="#!" class="modal-action waves-effect waves-green btn-flat ">Save</a>
    </div> -->
</div>
<footer class="page-footer">
    <div class="footer-copyright">
        <div class="container">
            &copy; <?php echo date('Y'); ?> , 
        </div>
    </div>
</footer>
<?php echo $common_js;?>
<script type="text/javascript">
    <?php 
    $crud_operation_success_msg=$this->session->set_flashdata('success_message');
    if($crud_operation_success_msg!=""){?>
        myJsMain.commonFunction.erpAlert(myJsMain.messageBoxTitle+' System Message',$crud_operation_success_msg);
    <?php }
    ?>
    <?php 
    $crud_operation_fail_msg=$this->session->set_flashdata('fail_message');
    if($crud_operation_fail_msg!=""){?>
        myJsMain.commonFunction.erpAlert(myJsMain.messageBoxTitle+' System Message',$crud_operation_fail_msg);
    <?php }
    ?>
    jQuery(document).ready(function(){
        jQuery('body').on('click','.closeEditModelWin',function(){
            $('#editActionWindow').modal('close');
        });
    });
</script>
</body>
</html>