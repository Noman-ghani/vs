<template>
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <router-link to='/dashboard' :class="'nav-link ' + ((this.$route.name == 'dashboard') ? 'active' : '')">
                <i class="nav-icon fa fa-dashboard"></i>
                <p>Dashboard</p>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to='/doctors' :class="'nav-link ' + ((this.$route.name == 'doctor'||this.$route.name == 'doctor_add'||this.$route.name == 'doctor_edit') ? 'active' : '')">
                <i class="nav-icon fa fa-user-md"></i>
                <p>Students</p>
            </router-link>
        </li>
        <li class="nav-item">
            <a href='javascript:;' data-toggle="collapse" data-target="#results" :class="'nav-link mb-0 text-truncate ' + ((this.$route.name == 'pre_result' || this.$route.name == 'post_result' || this.$route.name == 'pre_result_view' || this.$route.name == 'post_result_view') ? 'active' : 'collapsed')">
                <i class="nav-icon fa fa-book"></i>
                <p >Results</p>
            </a>
                    <div :class="'collapse' + ((this.$route.name == 'pre_result' || this.$route.name == 'post_result' || this.$route.name == 'pre_result_view' || this.$route.name == 'post_result_view') ? 'show' : '')" id="results" aria-expanded="false">
                        <ul class="flex-column nav nav-submenu">
                            <li class="nav-item">
                                <router-link to='/pre-result' :class="'pl-3 nav-link ' + ((this.$route.name == 'pre_result' || this.$route.name == 'pre_result_view') ? 'active' : '')">
                                    <i class="nav-icon fa fa fa-angle-double-right"></i>
                                    <p >Pre Test Results</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to='/post-result' :class="'pl-3 nav-link ' + ((this.$route.name == 'post_result' || this.$route.name == 'post_result_view') ? 'active' : '')">
                                    <i class="nav-icon fa fa fa-angle-double-right"></i>
                                    <p >Post Test Results</p>
                                </router-link>
                            </li>
                        </ul>
                    </div>
        </li>
        <li class="nav-item">
            <a href='javascript:;' data-toggle="collapse" data-target="#submenu1" :class="'nav-link mb-0 text-truncate ' + ((this.$route.name == 'modules' || this.$route.name == 'module1') ? 'active' : 'collapsed')">
                <i class="nav-icon fa fa-bars"></i>
                <p >Modules</p>
            </a>
                    <div :class="'collapse' + ((this.$route.name == 'module1') ? 'show' : '')" id="submenu1" aria-expanded="false">
                        <ul class="flex-column nav nav-submenu">
                            <li class="nav-item">
                                <router-link to='/module/1' :class="'pl-3 nav-link ' + ((this.$route.name == 'module1') ? 'active' : '')">
                                    <i class="nav-icon fa fa fa-angle-double-right"></i>
                                    <p >Module # 1</p>
                                </router-link>
                            </li>
                            <!-- <li class="nav-item">
                                <router-link to='/module/2' :class="'pl-3 nav-link ' + ((this.$route.name == 'module2') ? 'active' : '')">
                                    <i class="nav-icon fa fa fa-angle-double-right"></i>
                                    <p >Module # 2</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to='/module/3' :class="'pl-3 nav-link ' + ((this.$route.name == 'module3') ? 'active' : '')">
                                    <i class="nav-icon fa fa fa-angle-double-right"></i>
                                    <p >Module # 3</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to='/module/4' :class="'pl-3 nav-link ' + ((this.$route.name == 'module4') ? 'active' : '')">
                                    <i class="nav-icon fa fa fa-angle-double-right"></i>
                                    <p >Module # 4</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to='/module/5' :class="'pl-3 nav-link ' + ((this.$route.name == 'module5') ? 'active' : '')">
                                    <i class="nav-icon fa fa fa-angle-double-right"></i>
                                    <p >Module # 5</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to='/module/6' :class="'pl-3 nav-link ' + ((this.$route.name == 'module6') ? 'active' : '')">
                                    <i class="nav-icon fa fa fa-angle-double-right"></i>
                                    <p >Module # 6</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to='/module/7' :class="'pl-3 nav-link ' + ((this.$route.name == 'module7') ? 'active' : '')">
                                    <i class="nav-icon fa fa fa-angle-double-right"></i>
                                    <p >Module # 7</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to='/module/8' :class="'pl-3 nav-link ' + ((this.$route.name == 'module8') ? 'active' : '')">
                                    <i class="nav-icon fa fa fa-angle-double-right"></i>
                                    <p >Module # 8</p>
                                </router-link>
                            </li> -->
                        </ul>
                    </div>
        </li>
         <li class="nav-item">
            <router-link to='/settings' :class="'nav-link ' + ((this.$route.name == 'settings') ? 'active' : '')">
                <i class="nav-icon fa fa-gears"></i>
                <p>Settings</p>
            </router-link>
        </li>
        <li class="nav-item">
            <a href='javascript:;' data-toggle="collapse" data-target="#rolemenu" :class="'nav-link mb-0 text-truncate ' + ((this.$route.name == 'role' || this.$route.name == 'permissions') ? 'active' : 'collapsed')">
                <i class="nav-icon fa fa-lock"></i>
                <p >Role Permissions</p>
            </a>
                    <div :class="'collapse' + ((this.$route.name == 'role' || this.$route.name == 'permissions') ? 'show' : '')" id="rolemenu" aria-expanded="false">
                        <ul class="flex-column nav nav-submenu">
                            <li class="nav-item">
                                <router-link to='/role' :class="'nav-link ' + ((this.$route.name == 'role'||this.$route.name == 'role_add'||this.$route.name == 'role_edit') ? 'active' : '')">
                                    <i class="nav-icon fa fa-users"></i>
                                    <p>Roles</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to='/permissions' :class="'nav-link ' + ((this.$route.name == 'permissions' || this.$route.name == 'permission_add' || this.$route.name == 'permission_edit') ? 'active' : '')">
                                    <i class="nav-icon fa fa-key"></i>
                                    <p>Permissions</p>
                                </router-link>
                            </li>
                        </ul>
                    </div>
        </li>
        
    </ul>
</template>
