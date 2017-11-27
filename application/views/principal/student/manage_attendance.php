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
<div class="main-content ">
<br><br>
<div class="row">
<div class="col s9">
<div class="col s3">
<!-- Dropdown Trigger -->
<a class='dropdown-button123 btn' data-beloworigin="true" href='#' data-activates='dropdown1'>Select Class</a>

<!-- Dropdown Structure -->
<ul id='dropdown1' class='dropdown-content'>
	<li><a href="#!">one</a></li>
	<li class="divider"></li>
	<li><a href="#!">two</a></li>
	<li class="divider"></li>
	<li><a href="#!">three</a></li>
</ul>
</div>
<div class="col s3">
<!-- Dropdown Trigger -->
<a class='dropdown-button btn' data-beloworigin="true" href='#' data-activates='dropdown2'>Select Section</a>
<!-- Dropdown Structure -->
<ul id='dropdown2' class='dropdown-content'>
	<li><a href="#!">A</a></li>
	<li class="divider"></li>
	<li><a href="#!">B</a></li>
	<li class="divider"></li>
	<li><a href="#!">C</a></li>
</ul>
</div>
<div class="col s3">
<div id="root-picker-outlet" style="position:relative"></div>
<div class="input-field col s12 m6 l12">
	<input  id="DOB" name="DOB" type="date" required="required" class=" validate datepicker" labelName="Date of birth" placeholder='Select date'>                                            
</div>

<!-- <button class="btn waves-effect waves-light" >
	<i class="material-icons right">Date</i>
</button> -->
</div>
<div class="col s3">
<button class="btn waves-effect waves-light" type="submit" name="action">
	<i class="material-icons right">View</i>
</button>
</div>
</div>
</div>
<br><br>
<div>
<!-- <?php pre($attDataArr);?> -->
<table class="responsive-table bordered">
	<thead>
		<tr>
			<th data-field="id">No.</th>
			<th data-field="id">Student Name</th>
			<th data-field="id">RFID Card</th>
            <th data-field="id">Status</th>
            <th data-field="id">In Time</th>
            <th data-field="id">Out Time</th>
		</tr>
	</thead>

	<tbody>
        <?php $int=1; foreach($attDataArr as $att):?>
		<tr>
			<td><?php echo $int++; ?></td>
            <td><?php echo $att['fName'].' '.$att['mName'].' '.$att['lName']; ?></td>
            <td><?php echo $att['cardId']; ?></td>
            <td>
			<div class="input-select2 col s12 m6 l3">
				<select name="atten[<?php echo $att['studentId']?>]" labelName="">
					<option value="0" <?php echo $att['status'] == 0?'selected':'';?>>Undefined</option>
					<option value="1" <?php echo $att['status'] == 1?'selected':'';?>>Present</option>
					<option value="2" <?php echo $att['status'] == 2?'selected':'';?>>Absent</option>
				</select>
			</div>
			</td>
            <td><?php echo $att['inTime']; ?></td>
            <td><?php echo $att['outTime']; ?></td>

		</tr>
		<?php endforeach;?>
	</tbody>
</table>
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

