<?php
echo $html_heading;?> 
<link href="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-file-upload/css/jquery.fileupload.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SchoolSiteResourcesURL;?>bower_components/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SchoolSiteCSSURL;?>apps/crud.css" rel="stylesheet" type="text/css" />
<?php echo $header;
?>
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
            <h4 class="main-text lighten-1">Manage Student</h4>
            <ul class="tabs tab-demo z-depth-1">
                <li class="tab col s3"><a class="active" href="#StudentList">Student List</a></li>
                <li class="tab col s3"><a  href="#StudentAdd">Add Student</a></li>
            </ul>
            <div id="StudentList" class="col s12">
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
                                                <label for="chkDeleteAll"></label>
                                            </th>
                                            <th>Name</th>
                                            <th>Item Name</th>
                                            <th>Item Price</th>
                                            <th class="center-align" data-searchable="false" data-orderable="false">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="center-align">
                                                <input type="checkbox" id="chkDeleteAlvin">
                                                <label for="chkDeleteAlvin"></label>
                                            </td>
                                            <td>Alvin</td>
                                            <td>Eclair</td>
                                            <td>$0.87</td>
                                            <td class="center-align">
                                                <div class="btn-group">
                                                    <a href="apps_crud_form.html" class="btn-flat btn-small waves-effect">
                                                        <i class="material-icons">create</i>
                                                    </a>
                                                    <a class="btn-flat btn-small waves-effect btnDelete">
                                                        <i class="material-icons">delete</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center-align">
                                                <input type="checkbox" id="chkDeleteAlvin">
                                                <label for="chkDeleteAlvin"></label>
                                            </td>
                                            <td>Alvin</td>
                                            <td>Eclair</td>
                                            <td>$0.87</td>
                                            <td class="center-align">
                                                <div class="btn-group">
                                                    <a href="apps_crud_form.html" class="btn-flat btn-small waves-effect">
                                                        <i class="material-icons">create</i>
                                                    </a>
                                                    <a class="btn-flat btn-small waves-effect btnDelete">
                                                        <i class="material-icons">delete</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center-align">
                                                <input type="checkbox" id="chkDeleteAlvin">
                                                <label for="chkDeleteAlvin"></label>
                                            </td>
                                            <td>Alvin</td>
                                            <td>Eclair</td>
                                            <td>$0.87</td>
                                            <td class="center-align">
                                                <div class="btn-group">
                                                    <a href="apps_crud_form.html" class="btn-flat btn-small waves-effect">
                                                        <i class="material-icons">create</i>
                                                    </a>
                                                    <a class="btn-flat btn-small waves-effect btnDelete">
                                                        <i class="material-icons">delete</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center-align">
                                                <input type="checkbox" id="chkDeleteAlvin">
                                                <label for="chkDeleteAlvin"></label>
                                            </td>
                                            <td>Alvin</td>
                                            <td>Eclair</td>
                                            <td>$0.87</td>
                                            <td class="center-align">
                                                <div class="btn-group">
                                                    <a href="apps_crud_form.html" class="btn-flat btn-small waves-effect">
                                                        <i class="material-icons">create</i>
                                                    </a>
                                                    <a class="btn-flat btn-small waves-effect btnDelete">
                                                        <i class="material-icons">delete</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center-align">
                                                <input type="checkbox" id="chkDeleteAlvin">
                                                <label for="chkDeleteAlvin"></label>
                                            </td>
                                            <td>Alvin</td>
                                            <td>Eclair</td>
                                            <td>$0.87</td>
                                            <td class="center-align">
                                                <div class="btn-group">
                                                    <a href="apps_crud_form.html" class="btn-flat btn-small waves-effect">
                                                        <i class="material-icons">create</i>
                                                    </a>
                                                    <a class="btn-flat btn-small waves-effect btnDelete">
                                                        <i class="material-icons">delete</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center-align">
                                                <input type="checkbox" id="chkDeleteAlvin">
                                                <label for="chkDeleteAlvin"></label>
                                            </td>
                                            <td>Alvin</td>
                                            <td>Eclair</td>
                                            <td>$0.87</td>
                                            <td class="center-align">
                                                <div class="btn-group">
                                                    <a href="apps_crud_form.html" class="btn-flat btn-small waves-effect">
                                                        <i class="material-icons">create</i>
                                                    </a>
                                                    <a class="btn-flat btn-small waves-effect btnDelete">
                                                        <i class="material-icons">delete</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center-align">
                                                <input type="checkbox" id="chkDeleteAlvin">
                                                <label for="chkDeleteAlvin"></label>
                                            </td>
                                            <td>Alvin</td>
                                            <td>Eclair</td>
                                            <td>$0.87</td>
                                            <td class="center-align">
                                                <div class="btn-group">
                                                    <a href="apps_crud_form.html" class="btn-flat btn-small waves-effect">
                                                        <i class="material-icons">create</i>
                                                    </a>
                                                    <a class="btn-flat btn-small waves-effect btnDelete">
                                                        <i class="material-icons">delete</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center-align">
                                                <input type="checkbox" id="chkDeleteAlvin">
                                                <label for="chkDeleteAlvin"></label>
                                            </td>
                                            <td>Alvin</td>
                                            <td>Eclair</td>
                                            <td>$0.87</td>
                                            <td class="center-align">
                                                <div class="btn-group">
                                                    <a href="apps_crud_form.html" class="btn-flat btn-small waves-effect">
                                                        <i class="material-icons">create</i>
                                                    </a>
                                                    <a class="btn-flat btn-small waves-effect btnDelete">
                                                        <i class="material-icons">delete</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center-align">
                                                <input type="checkbox" id="chkDeleteAlvin">
                                                <label for="chkDeleteAlvin"></label>
                                            </td>
                                            <td>Alvin</td>
                                            <td>Eclair</td>
                                            <td>$0.87</td>
                                            <td class="center-align">
                                                <div class="btn-group">
                                                    <a href="apps_crud_form.html" class="btn-flat btn-small waves-effect">
                                                        <i class="material-icons">create</i>
                                                    </a>
                                                    <a class="btn-flat btn-small waves-effect btnDelete">
                                                        <i class="material-icons">delete</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center-align">
                                                <input type="checkbox" id="chkDeleteAlvin">
                                                <label for="chkDeleteAlvin"></label>
                                            </td>
                                            <td>Alvin</td>
                                            <td>Eclair</td>
                                            <td>$0.87</td>
                                            <td class="center-align">
                                                <div class="btn-group">
                                                    <a href="apps_crud_form.html" class="btn-flat btn-small waves-effect">
                                                        <i class="material-icons">create</i>
                                                    </a>
                                                    <a class="btn-flat btn-small waves-effect btnDelete">
                                                        <i class="material-icons">delete</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center-align">
                                                <input type="checkbox" id="chkDeleteAlan">
                                                <label for="chkDeleteAlan"></label>
                                            </td>
                                            <td>Alan</td>
                                            <td>Jellybean</td>
                                            <td>$3.76</td>
                                            <td class="center-align">
                                                <div class="btn-group">
                                                    <a href="apps_crud_form.html" class="btn-flat btn-small waves-effect">
                                                        <i class="material-icons">create</i>
                                                    </a>
                                                    <a class="btn-flat btn-small waves-effect btnDelete">
                                                        <i class="material-icons">delete</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center-align">
                                                <input type="checkbox" id="chkDeleteJonathan">
                                                <label for="chkDeleteJonathan"></label>
                                            </td>
                                            <td>Jonathan</td>
                                            <td>Lollipop</td>
                                            <td>$7.00</td>
                                            <td class="center-align">
                                                <div class="btn-group">
                                                    <a href="apps_crud_form.html" class="btn-flat btn-small waves-effect">
                                                        <i class="material-icons">create</i>
                                                    </a>
                                                    <a class="btn-flat btn-small waves-effect btnDelete">
                                                        <i class="material-icons">delete</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="center-align">
                                                <input type="checkbox" id="chkDeleteShannon">
                                                <label for="chkDeleteShannon"></label>
                                            </td>
                                            <td>Shannon</td>
                                            <td>KitKat</td>
                                            <td>$9.99</td>
                                            <td class="center-align">
                                                <div class="btn-group">
                                                    <a href="apps_crud_form.html" class="btn-flat btn-small waves-effect">
                                                        <i class="material-icons">create</i>
                                                    </a>
                                                    <a class="btn-flat btn-small waves-effect btnDelete">
                                                        <i class="material-icons">delete</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div id="StudentAdd" class="col s12">
                <form type="POST">
                    <div class="row">
                        <div class="col s12 m8">
                            <div class="panel panel-bordered">
                                <div class="panel-header">
                                    <div class="title">General elements</div>
                                    <div class="subtitle">Customize in your own way. See more <a href="components_forms.html">clicking here.</a></div>
                                </div>
                                <div class="panel-body">
                                    <div class="row no-gutter">
                                        <div class="input-field col s6">
                                            <input placeholder="Placeholder" id="first_name" type="text" class="validate" required="">
                                            <label for="first_name">First Name</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input id="last_name" type="text">
                                            <label for="last_name">Last Name</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <input disabled value="I am not editable" id="disabled" type="text" class="validate">
                                            <label for="disabled">Disabled</label>
                                        </div>
                                        <div class="input-field col s3">
                                            <input id="last_name" type="text">
                                            <label for="last_name">Last Name</label>
                                        </div>
                                        <div class="input-field col s3">
                                            <input id="last_name" type="text">
                                            <label for="last_name">Last Name</label>
                                        </div>
                                        <div class="input-field col s3">
                                            <input id="last_name" type="text">
                                            <label for="last_name">Last Name</label>
                                        </div>
                                        <div class="input-field col s3">
                                            <input id="last_name" type="text">
                                            <label for="last_name">Last Name</label>
                                        </div>
                                        <div class="input-field col s3">
                                            <input id="last_name" type="text">
                                            <label for="last_name">Last Name</label>
                                        </div>
                                        <div class="input-field col s3">
                                            <input id="last_name" type="text">
                                            <label for="last_name">Last Name</label>
                                        </div>
                                        <div class="input-field col s3">
                                            <input id="last_name" type="text">
                                            <label for="last_name">Last Name</label>
                                        </div>
                                        <div class="input-field col s3">
                                            <input id="last_name" type="text">
                                            <label for="last_name">Last Name</label>
                                        </div>
                                        <div class="input-select2 col s12">
                                            <select id="state" name="state">
                                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                                    <option value="AK">Alaska</option>
                                                    <option value="HI">Hawaii</option>
                                                </optgroup>
                                                <optgroup label="Pacific Time Zone">
                                                    <option value="CA">California</option>
                                                    <option value="NV">Nevada</option>
                                                    <option value="OR">Oregon</option>
                                                    <option value="WA">Washington</option>
                                                </optgroup>
                                                <optgroup label="Mountain Time Zone">
                                                    <option value="AZ">Arizona</option>
                                                    <option value="CO">Colorado</option>
                                                    <option value="ID">Idaho</option>
                                                    <option value="MT">Montana</option>
                                                    <option value="NE">Nebraska</option>
                                                    <option value="NM">New Mexico</option>
                                                    <option value="ND">North Dakota</option>
                                                    <option value="UT">Utah</option>
                                                    <option value="WY">Wyoming</option>
                                                </optgroup>
                                            </select>
                                            <label for="state" data-error="wrong" data-success="right">State</label>
                                        </div>
                                    </div>
                                    <div class="row no-gutter">
                                        <div class="input-field col s12">
                                            <input disabled value="I am not editable" id="disabled" type="text" class="validate">
                                            <label for="disabled">Disabled</label>
                                        </div>
                                    </div>
                                    <div class="row no-gutter">
                                        <div class="input-field col s12">
                                            <input id="password" type="password" class="validate">
                                            <label for="password">Password</label>
                                        </div>
                                    </div>
                                    <div class="row no-gutter">
                                        <div class="input-field col s12">
                                            <input id="email" type="email" class="validate">
                                            <label for="email" data-error="wrong" data-success="right">Email</label>
                                        </div>
                                    </div>
                                    <div class="row no-gutter">
                                        <div class="input-select2 col s12">
                                            <select id="state" name="state">
                                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                                    <option value="AK">Alaska</option>
                                                    <option value="HI">Hawaii</option>
                                                </optgroup>
                                                <optgroup label="Pacific Time Zone">
                                                    <option value="CA">California</option>
                                                    <option value="NV">Nevada</option>
                                                    <option value="OR">Oregon</option>
                                                    <option value="WA">Washington</option>
                                                </optgroup>
                                                <optgroup label="Mountain Time Zone">
                                                    <option value="AZ">Arizona</option>
                                                    <option value="CO">Colorado</option>
                                                    <option value="ID">Idaho</option>
                                                    <option value="MT">Montana</option>
                                                    <option value="NE">Nebraska</option>
                                                    <option value="NM">New Mexico</option>
                                                    <option value="ND">North Dakota</option>
                                                    <option value="UT">Utah</option>
                                                    <option value="WY">Wyoming</option>
                                                </optgroup>
                                            </select>
                                            <label for="state" data-error="wrong" data-success="right">State</label>
                                        </div>
                                    </div>
                                    <div class="row no-gutter margin-bottom-0">
                                        <div class="input-fileupload col s12">
                                            <div class="form-section">Uploads</div>
                                            <div class="actions">
                                                <span class="btn-flat small font-size-0-95 waves-effect fileinput-button">
                                                    <i class="material-icons">add</i>
                                                    <span>Add files</span>
                                                    <input type="file" id="files" name="files[]" multiple>
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
                                <div class="panel-footer">
                                    <div class="right-align">
                                        <button type="reset" class="btn-flat waves-effect">
                                            RESET
                                        </button>
                                        <button type="submit" class="btn-flat waves-effect">
                                            SUBMIT
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m4">
                            <div class="helper">
                                <h5>Input fields</h5>
                                <p>Text fields allow user input. The border should light up simply and clearly indicating which field the user is currently editing. You must have a <code class="language-markup">.input-field</code> div wrapping your input and label. This helps our jQuery animate the label. This is only used in our Input and Textarea form elements.</p>
                                <p>The validate class leverages HTML5 validation and will add a <code class="language-markup">valid</code> and <code class="language-markup">invalid</code> class accordingly. If you don't want the Green and Red validation states, just remove the <code class="language-markup">validate</code> class from your inputs.</p>
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
<script src="<?php echo SchoolSiteJSURL; ?>apps/crud_list.js" type="text/javascript"></script>

<script src="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-file-upload/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-load-image/js/load-image.all.min.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-canvas-to-blob/js/canvas-to-blob.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-file-upload/js/jquery.iframe-transport.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-file-upload/js/jquery.fileupload.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-file-upload/js/jquery.fileupload-process.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-file-upload/js/jquery.fileupload-image.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-file-upload/js/jquery.fileupload-audio.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-file-upload/js/jquery.fileupload-video.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-file-upload/js/jquery.fileupload-validate.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-file-upload/js/jquery.fileupload-ui.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL;?>bower_components/blueimp-tmpl/js/tmpl.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteResourcesURL;?>bower_components/select2/dist/js/select2.min.js" type="text/javascript"></script>
<script src="<?php echo SchoolSiteJSURL; ?>apps/crud_form.js" type="text/javascript"></script>