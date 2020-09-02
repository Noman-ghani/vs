<template>
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <router-link to='/dashboard' :class="'nav-link ' + ((this.$route.name == 'dashboard') ? 'active' : '')">
                <i class="nav-icon fa fa-dashboard"></i>
                <p>Dashboard</p>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to='/students' :class="'nav-link ' + ((this.$route.name == 'student'||this.$route.name == 'student_add'||this.$route.name == 'student_edit') ? 'active' : '')">
                <i class="nav-icon fa fa-user-md"></i>
                <p>Students</p>
            </router-link>
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
