<div class="nav-wrapper">
    <a href="<?php echo BASE_URL;?>" class="brand-logo">
        <img src="img/logo.png" />
        <span class="valign">
            <b class="main-text">School</b> ERP Admininistrator
        </span>
    </a>
    <ul class="right hide-on-med-and-down">
        <li class="active"><a href="<?php echo BASE_URL; ?>">Dashboard</a></li>
        <li>
            <a class="dropdown-button" href="#!" data-activates="dropdown-css" data-constrainwidth="false" data-beloworigin="true">
                <?php echo $this->lang->line('SCHOOL',FALSE);?><i class="material-icons dropdown-icon right">&nbsp;</i>
            </a>
        </li>
        <li>
            <a class="dropdown-button" href="#!" data-activates="dropdown-components" data-constrainwidth="false" data-beloworigin="true">
                <?php echo $this->lang->line('ACCOUNT',FALSE);?><i class="material-icons dropdown-icon right">&nbsp;</i>
            </a>
        </li>
        <li>
            <a class="dropdown-button" href="#!" data-activates="dropdown-javascript" data-constrainwidth="false" data-beloworigin="true">
                <?php echo $this->lang->line('LIBRARY',FALSE);?><i class="material-icons dropdown-icon right">&nbsp;</i>
            </a>
        </li>
        <li>
            <a class="dropdown-button" href="#!" data-activates="dropdown-apps" data-constrainwidth="false" data-beloworigin="true">
                <?php echo $this->lang->line('HRM',FALSE);?><i class="material-icons dropdown-icon right">&nbsp;</i>
            </a>
        </li>
        <li class="profile ">
            <a class="dropdown-button" href="#!" data-activates="dropdown-profile" data-constrainwidth="false" data-beloworigin="true" data-alignment="right">
                <div class="valign-wrapper">
                    <img src="img/profile.jpg" alt="My profile" class="circle responsive-img margin-right-10">
                    John Doe
                    <i class="material-icons dropdown-icon right">arrow_drop_down</i>
                </div>
            </a>
        </li>
    </ul>

    <ul id="dropdown-css" class="dropdown-content">
        <li>
            <table class="bordered responsive-table">
                <thead>
                    <tr>
                        <th data-field="id"><?php echo $this->lang->line('SETUP',FALSE);?></th>
                        <th data-field="id"><?php echo $this->lang->line('MISC_MENU',FALSE);?></th>
                        <th data-field="id"><?php echo $this->lang->line('COMMUNICATION',FALSE);?></th>
                        <th data-field="id"><?php echo $this->lang->line('USEFULL',FALSE);?></th>
                        <th data-field="id"><?php echo $this->lang->line('R_HONG_OUT',FALSE);?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $this->lang->line('ADMISSION',FALSE);?></td>
                        <td><?php echo $this->lang->line('ATTENDANCE',FALSE);?></td>
                        <td><?php echo $this->lang->line('UPDATE',FALSE);?></td>
                        <td><?php echo $this->lang->line('TRANSPORT',FALSE);?></td>
                        <td><?php echo $this->lang->line('EXAM',FALSE);?></td>
                    </tr>
                    <tr>
                        <td><?php echo $this->lang->line('ENQUIRY',FALSE);?></td>
                        <td><?php echo $this->lang->line('STUDY_MATERIAL',FALSE);?></td>
                        <td><?php echo $this->lang->line('EVENT_MGT',FALSE);?></td>
                        <td><?php echo $this->lang->line('DORMITORY',FALSE);?></td>
                        <td><?php echo $this->lang->line('ONLINE_EXAM',FALSE);?></td>
                    </tr>
                    <tr>
                        <td><?php echo $this->lang->line('CLASS',FALSE);?></td>
                        <td><?php echo $this->lang->line('CLASS_TIME_TABLE',FALSE);?></td>
                        <td><?php echo $this->lang->line('FEEDBACK',FALSE);?></td>
                        <td><?php echo $this->lang->line('INVENTORY',FALSE);?></td>
                        <td><?php echo $this->lang->line('DISCIPNARY',FALSE);?></td>
                    </tr>
                    <tr>
                        <td><?php echo $this->lang->line('SECTION',FALSE);?></td>
                        <td><?php echo $this->lang->line('ACCOUNTING_REPORT',FALSE);?></td>
                        <td><?php echo $this->lang->line('CUSTOM_MSG',FALSE);?></td>
                        <td><?php echo $this->lang->line('ONLINE_POLL',FALSE);?></td>
                        <td><?php echo $this->lang->line('CIRTIFICATE',FALSE);?></td>
                    </tr>
                    <tr>
                        <td><a href="<?php echo BASE_URL.$this->erpUserTypeArr[$this->userType].'/principal/show_teacher_list';?>"><?php echo $this->lang->line('TEACHERS',FALSE);?></a></td>
                        <td><a href="<?php echo BASE_URL.$this->erpUserTypeArr[$this->userType].'/principal/manage_student_attendance';?>"><?php echo $this->lang->line('MANAGE_ATTENDANCE',FALSE);?></a></td>
                        <td><?php echo $this->lang->line('DISCUSSION_FRM',FALSE);?></td>
                        <td><?php echo $this->lang->line('DISCIPNARY',FALSE);?></td>
                        <td><?php echo $this->lang->line('CLINICAL_RECORD',FALSE);?></td>
                    </tr>
                    <tr>
                        <td><a href="<?php echo BASE_URL.$this->erpUserTypeArr[$this->userType].'/principal/show_parent_list';?>"><?php echo $this->lang->line('PARENT',TRUE);?></a></td>
                        <td><a href="<?php echo BASE_URL.$this->erpUserTypeArr[$this->userType].'/principal/student_attendance_report';?>"><?php echo $this->lang->line('ATTENDANCE_REPORT',FALSE);?></a></td>
                        <td><?php echo $this->lang->line('BLOG',FALSE);?></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td><?php echo $this->lang->line('SUBJECT',FALSE);?></td>
                        <td>&nbsp;</td>
                        <td><?php echo $this->lang->line('MESSAGE',FALSE);?></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </tbody>
            </table>
        </li>
    </ul>
    <ul id="dropdown-apps" class="dropdown-content">
        <li><a href="apps_crud.html">CRUD</a></li>
        <li><a href="apps_pricing_table.html">Pricing Table</a></li>
        <li><a href="apps_datatables.html">DataTables</a></li>
        <li><a href="apps_maps.html">Maps</a></li>
        <li><a href="apps_charts.html">Charts</a></li>
    </ul>
    <ul id="dropdown-pages" class="dropdown-content">
        <li><a href="pages_blank.html">Blank</a></li>
        <li class="divider"></li>
        <li><a href="login.html">Login</a></li>
        <li><a href="register.html">Register</a></li>
        <li><a href="forgot_password.html">Forgot Password</a></li>
        <li class="divider"></li>
        <li><a href="error_400.html">Error 400</a></li>
        <li><a href="error_403.html">Error 403</a></li>
        <li><a href="error_404.html">Error 404</a></li>
        <li><a href="error_500.html">Error 500</a></li>
    </ul>
    <ul id="dropdown-profile" class="dropdown-content">
        <li><a href="<?php echo BASE_URL.'principal/my_profile';?>">Profile</a></li>
        <li><a href="<?php echo BASE_URL.'principal/school_settings';?>">School Settings</a></li>
        <li><a href="<?php echo BASE_URL.$this->erpUserTypeArr[$this->userType].'/'.'principal/logout';?>">Logout</a></li>
    </ul>

    <a href="#" data-activates="mobile-demo" class="button-collapse">
        <i class="material-icons">menu</i>
    </a>
</div>
<ul class="side-nav" id="mobile-demo">
    <li class="logo">
        <img src="img/logo.png" />
        <p>
            <b class="main-text">Aero</b> Admin
        </p>
    </li>
    <li>
        <a href="index-2.html" class="waves-effect">Dashboard</a>
    </li>
    <li class="padding-0">
        <ul class="collapsible collapsible-accordion">
            <li class="bold">
                <a class="collapsible-header waves-effect">CSS</a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="css_color.html">Color</a></li>
                        <li><a href="css_grid.html">Grid</a></li>
                        <li><a href="css_helpers.html">Helpers</a></li>
                        <li><a href="css_media.html">Media</a></li>
                        <li><a href="css_sass.html">Sass</a></li>
                        <li><a href="css_shadow.html">Shadow</a></li>
                        <li><a href="css_table.html">Table</a></li>
                        <li><a href="css_typography.html">Typography</a></li>
                    </ul>
                </div>
            </li>
            <li class="bold">
                <a class="collapsible-header waves-effect">Components</a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="components_badges.html">Badges</a></li>
                        <li><a href="components_buttons.html">Buttons</a></li>
                        <li><a href="components_breadcrumbs.html">Breadcrumbs</a></li>
                        <li><a href="components_cards.html">Cards</a></li>
                        <li><a href="components_chips.html">Chips</a></li>
                        <li><a href="components_collections.html">Collections</a></li>
                        <li><a href="components_footer.html">Footer</a></li>
                        <li><a href="components_forms.html">Forms</a></li>
                        <li><a href="components_icons.html">Icons</a></li>
                        <li><a href="components_navbar.html">Navbar</a></li>
                        <li><a href="components_pagination.html">Pagination</a></li>
                        <li><a href="components_preloader.html">Preloader</a></li>
                    </ul>
                </div>
            </li>
            <li class="bold">
                <a class="collapsible-header waves-effect">JavaScript</a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="js_collapsible.html">Collapsible</a></li>
                        <li><a href="js_dialogs.html">Dialogs</a></li>
                        <li><a href="js_dropdown.html">Dropdown</a></li>
                        <li><a href="js_media.html">Media</a></li>
                        <li><a href="js_modals.html">Modals</a></li>
                        <li><a href="js_parallax.html">Parallax</a></li>
                        <li><a href="js_pushpin.html">Pushpin</a></li>
                        <li><a href="js_scrollfire.html">ScrollFire</a></li>
                        <li><a href="js_scrollspy.html">Scrollspy</a></li>
                        <li><a href="js_sidenav.html">SideNav</a></li>
                        <li><a href="js_tabs.html">Tabs</a></li>
                        <li><a href="js_transitions.html">Transitions</a></li>
                        <li><a href="js_waves.html">Waves</a></li>
                    </ul>
                </div>
            </li>
            <li class="bold">
                <a class="collapsible-header waves-effect">APPs</a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="apps_crud.html">CRUD</a></li>
                        <li><a href="apps_pricing_table.html">Pricing Table</a></li>
                        <li><a href="app_datatables.html">Datatables</a></li>
                        <li><a href="app_maps.html">Maps</a></li>
                        <li><a href="app_charts.html">Charts</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </li>
</ul>
