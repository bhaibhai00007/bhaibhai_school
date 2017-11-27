<?php
echo $html_heading . $header;
?>
<div id="content">
    <div id="content-header">
        <?php echo $breadcrumb; ?>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="widget-box">
                <div class="widget-title">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab1">Class List</a></li>
                        <li><a data-toggle="tab" href="#tab2">Add Class</a></li>
                    </ul>
                </div>
                <div class="widget-content tab-content">
                    <div id="tab1" class="tab-pane active">
                        <div class="widget-box">
                            <div class="widget-title">
                                <span class="icon"><i class="icon-th"></i></span> 
                                <h5>Data table</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <table class="table table-bordered data-table">
                                    <thead>
                                        <tr>
                                            <th>Rendering engine</th>
                                            <th>Browser</th>
                                            <th>Platform(s)</th>
                                            <th>Engine version</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="gradeX">
                                            <td>Trident</td>
                                            <td>Internet
                                                Explorer 4.0</td>
                                            <td>Win 95+</td>
                                            <td class="center">4</td>
                                        </tr>
                                        <tr class="gradeC">
                                            <td>Trident</td>
                                            <td>Internet
                                                Explorer 5.0</td>
                                            <td>Win 95+</td>
                                            <td class="center">5</td>
                                        </tr>
                                        <tr class="gradeA">
                                            <td>Trident</td>
                                            <td>Internet
                                                Explorer 5.5</td>
                                            <td>Win 95+</td>
                                            <td class="center">5.5</td>
                                        </tr>
                                        <tr class="gradeA">
                                            <td>Trident</td>
                                            <td>Internet
                                                Explorer 6</td>
                                            <td>Win 98+</td>
                                            <td class="center">6</td>
                                        </tr>
                                        <tr class="gradeA">
                                            <td>Trident</td>
                                            <td>Internet Explorer 7</td>
                                            <td>Win XP SP2+</td>
                                            <td class="center">7</td>
                                        </tr>
                                        <tr class="gradeA">
                                            <td>Trident</td>
                                            <td>AOL browser (AOL desktop)</td>
                                            <td>Win XP</td>
                                            <td class="center">6</td>
                                        </tr>
                                        <tr class="gradeA">
                                            <td>Gecko</td>
                                            <td>Mozilla 1.1</td>
                                            <td>Win 95+ / OSX.1+</td>
                                            <td class="center">1.1</td>
                                        </tr>
                                        <tr class="gradeA">
                                            <td>Gecko</td>
                                            <td>Mozilla 1.2</td>
                                            <td>Win 95+ / OSX.1+</td>
                                            <td class="center">1.2</td>
                                        </tr>
                                        <tr class="gradeA">
                                            <td>KHTML</td>
                                            <td>Konqureror 3.5</td>
                                            <td>KDE 3.5</td>
                                            <td class="center">3.5</td>
                                        </tr>
                                        <tr class="gradeX">
                                            <td>Tasman</td>
                                            <td>Internet Explorer 4.5</td>
                                            <td>Mac OS 8-9</td>
                                            <td class="center">-</td>
                                        </tr>
                                        <tr class="gradeC">
                                            <td>Tasman</td>
                                            <td>Internet Explorer 5.1</td>
                                            <td>Mac OS 7.6-9</td>
                                            <td class="center">1</td>
                                        </tr>
                                        <tr class="gradeC">
                                            <td>Tasman</td>
                                            <td>Internet Explorer 5.2</td>
                                            <td>Mac OS 8-X</td>
                                            <td class="center">1</td>
                                        </tr>
                                        <tr class="gradeA">
                                            <td>Misc</td>
                                            <td>NetFront 3.1</td>
                                            <td>Embedded devices</td>
                                            <td class="center">-</td>
                                        </tr>
                                        <tr class="gradeA">
                                            <td>Misc</td>
                                            <td>NetFront 3.4</td>
                                            <td>Embedded devices</td>
                                            <td class="center">-</td>
                                        </tr>
                                        <tr class="gradeX">
                                            <td>Misc</td>
                                            <td>Dillo 0.8</td>
                                            <td>Embedded devices</td>
                                            <td class="center">-</td>
                                        </tr>
                                        <tr class="gradeX">
                                            <td>Misc</td>

                                            <td>Links</td>
                                            <td>Text only</td>
                                            <td class="center">-</td>
                                        </tr>
                                        <tr class="gradeX">
                                            <td>Misc</td>
                                            <td>Lynx</td>
                                            <td>Text only</td>
                                            <td class="center">-</td>
                                        </tr>
                                        <tr class="gradeC">
                                            <td>Misc</td>
                                            <td>IE Mobile</td>
                                            <td>Windows Mobile 6</td>
                                            <td class="center">-</td>
                                        </tr>
                                        <tr class="gradeC">
                                            <td>Misc</td>
                                            <td>PSP browser</td>
                                            <td>PSP</td>
                                            <td class="center">-</td>
                                        </tr>
                                        <tr class="gradeU">
                                            <td>Other browsers</td>
                                            <td>All others</td>
                                            <td>-</td>
                                            <td class="center">-</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="tab2" class="tab-pane">
                        <div class="widget-box">
                            <div class="widget-title">
                                <span class="icon"><i class="icon-th"></i></span> 
                                <h5>Add Class Form</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <form action="#" method="get" class="form-horizontal">
                                    <div class="control-group span6">
                                        <label class="control-label">Select input</label>
                                        <div class="controls">
                                            <select >
                                                <option>First option</option>
                                                <option>Second option</option>
                                                <option>Third option</option>
                                                <option>Fourth option</option>
                                                <option>Fifth option</option>
                                                <option>Sixth option</option>
                                                <option>Seventh option</option>
                                                <option>Eighth option</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group span6">
                                        <label class="control-label">Multiple Select input</label>
                                        <div class="controls">
                                            <select multiple >
                                                <option>First option</option>
                                                <option selected>Second option</option>
                                                <option>Third option</option>
                                                <option>Fourth option</option>
                                                <option>Fifth option</option>
                                                <option>Sixth option</option>
                                                <option>Seventh option</option>
                                                <option>Eighth option</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group span6">
                                        <label class="control-label">Radio inputs</label>
                                        <div class="controls">
                                            <label>
                                                <input type="radio" name="radios" />
                                                First One</label>
                                            <label>
                                                <input type="radio" name="radios" />
                                                Second One</label>
                                            <label>
                                                <input type="radio" name="radios" />
                                                Third One</label>
                                        </div>
                                    </div>
                                    <div class="control-group span6">
                                        <label class="control-label">Checkboxes</label>
                                        <div class="controls">
                                            <label>
                                                <input type="checkbox" name="radios" />
                                                First One</label>
                                            <label>
                                                <input type="checkbox" name="radios" />
                                                Second One</label>
                                            <label>
                                                <input type="checkbox" name="radios" />
                                                Third One</label>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">File upload input</label>
                                        <div class="controls">
                                            <input type="file" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Disabled Input</label>
                                        <div class="controls">
                                            <input type="text" placeholder="You can't type anything…" disabled="" class="span11">
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>                            
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>