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
table{
	border: none;
}
table td{
	border-left: 1px solid #000;
	border-right: 1px solid #000;
}
table th{
	border-left: 1px solid #000;
	border-right: 1px solid #000;
}
</style>
<main>
<div class="main-content ">
<br><br>
<div class="row">
<div class="col s9">
<div class="col s3">
<!-- Dropdown Trigger -->
<a class='dropdown-button btn' data-beloworigin="true" href='#' data-activates='dropdown1'>Select Class</a>

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
<a class='dropdown-button btn' data-beloworigin="true" href='#' data-activates='dropdown1'>Select Section</a>
<!-- Dropdown Structure -->
<ul id='dropdown1' class='dropdown-content'>
	<li><a href="#!">A</a></li>
	<li class="divider"></li>
	<li><a href="#!">B</a></li>
	<li class="divider"></li>
	<li><a href="#!">C</a></li>
</ul>
</div>
<div class="col s3">
<button class="btn waves-effect waves-light" type="submit" name="action">
	<i class="material-icons right">Select Date</i>
</button>
</div>
<div class="col s3">
<button class="btn waves-effect waves-light" type="submit" name="action">
	<i class="material-icons right">View REPORT</i>
</button>
</div>
</div>
</div>
<br><br>
<div>
<table class="responsive-table bordered">
	<thead>
		<tr>
			<th data-field="id">Name</th>
			<!-- <?php //for( i=1, i<=31, i++){?>
			<th data-field="name">1</th>
			<?php//}?> -->
			<th data-field="id">1</th>
			<th data-field="id">2</th>
			<th data-field="id">3</th>
			<th data-field="id">4</th>
			<th data-field="id">5</th>
			<th data-field="id">6</th>
			<th data-field="id">7</th>
			<th data-field="id">8</th>
			<th data-field="id">9</th>
			<th data-field="id">10</th>
			<th data-field="id">11</th>
			<th data-field="id">12</th>
			<th data-field="id">13</th>
			<th data-field="id">14</th>
			<th data-field="id">15</th>
			<th data-field="id">16</th>
			<th data-field="id">17</th>
			<th data-field="id">18</th>
			<th data-field="id">19</th>
			<th data-field="id">20</th>
			<th data-field="id">21</th>
			<th data-field="id">22</th>
			<th data-field="id">23</th>
			<th data-field="id">24</th>
			<th data-field="id">25</th>
			<th data-field="id">26</th>
			<th data-field="id">27</th>
			<th data-field="id">28</th>
			<th data-field="id">29</th>
			<th data-field="id">30</th>
			<th data-field="id">31</th>
			<th data-field="id">% ATT</th>
			
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>P</td>
			<td>P</td>
			<td>P</td>
			<td>P</td>
			<td>P</td>
			<td>P</td>
			<td>P</td>
			<td>P</td>
			<td>P</td>
			<td>P</td>
			<td>P</td>
			<td>P</td>
			<td>&nbsp;</td>


		</tr>
		<tr>
			<td>Alan</td>
		</tr>
		<tr>
			<td>Jonathan</td>
		</tr>
		<tr>
			<td>Alvin</td>
		</tr>
		<tr>
			<td>Alan</td>
		</tr>
		<tr>
			<td>Jonathan</td>
		</tr>
		<tr>
			<td>Alvin</td>
		</tr>
		<tr>
			<td>Alan</td>
		</tr>
		<tr>
			<td>Jonathan</td>
		</tr>
		<tr>
			<td>Alvin</td>
		</tr>
		<tr>
			<td>Alan</td>
		</tr>
		<tr>
			<td>Jonathan</td>
		</tr>
		<tr>
			<td>Alvin</td>
		</tr>
		<tr>
			<td>Alan</td>
		</tr>
		<tr>
			<td>Jonathan</td>
		</tr>
		<tr>
			<td>Alvin</td>
		</tr>
		<tr>
			<td>Alan</td>
		</tr>
		<tr>
			<td>Jonathan</td>
		</tr>
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