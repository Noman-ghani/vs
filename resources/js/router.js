import VueRouter from 'vue-router'
import AuthLayout from './components/AuthLayout';
import ThemeLayout from './components/ThemeLayout';


const routes = [
    {
        name: 'login',
        path: '/',
        component: () =>
            import ('./components/Login.vue'),
        meta: {
            is_auth: true,
            layout: AuthLayout
        }
    },
    { 
        name: 'reset-password', 
        path: '/reset_password', 
        component: () =>
            import ('./components/ForgotPassword.vue'), 
        meta: { 
            is_auth: true,
            layout: AuthLayout
        } 
      },
      { 
        name: 'reset-password-form', 
        path: '/reset_password/:token', 
        component: () =>
            import ('./components/NewtPassword.vue'),
        meta: { 
            is_auth: true,
            layout: AuthLayout
        } 
      },
    // {
    //     name: 'reset_new_password',
    //     path: '/reset_new_password/:token',
    //     component: () =>
    //         import ('./components/NewtPassword.vue'),
    //     meta: {
    //         is_auth: true,
    //         layout: AuthLayout
    //     }
    // },
    
    {
        name: 'dashboard',
        path: '/dashboard',
        component: () =>
            import ('./components/dashboard/View.vue'),
        meta: {
            layout: ThemeLayout,
        }
    },
    {
        name: 'role',
        path: '/role',
        component: () =>
            import ('./components/roles/List.vue'),
        meta: {
            layout: ThemeLayout,
        }
    },
    {
        name: 'role_add',
        path: '/role/add',
        component: () =>
            import ('./components/roles/Form.vue'),
        meta: {
            layout: ThemeLayout,
        }
    },
    {
        name: 'role_edit',
        path: '/role/edit/:id',
        component: () =>
            import ('./components/roles/Form.vue'),
        meta: {
            layout: ThemeLayout,
        }
    },
    
    {
        name: 'permissions',
        path: '/permissions',
        component: () =>
            import ('./components/permissions/List.vue'),
        meta: {
            layout: ThemeLayout,
        }
    },
    {
        name: 'permission_add',
        path: '/permission/add',
        component: () =>
            import ('./components/permissions/Form.vue'),
        meta: {
            layout: ThemeLayout,
        }
    },
    {
        name: 'permission_edit',
        path: '/permission/edit/:id',
        component: () =>
            import ('./components/permissions/Form.vue'),
        meta: {
            layout: ThemeLayout,
        }
    },
    {
        name: 'student',
        path: '/students',
        component: () =>
            import ('./components/students/List.vue'),
        meta: {
            layout: ThemeLayout,
        }
    },
    {
        name: 'student_add',
        path: '/student/add',
        component: () =>
            import ('./components/students/Form.vue'),
        meta: {
            layout: ThemeLayout,
        }
    },
    {
        name: 'student_edit',
        path: '/student/edit/:id',
        component: () =>
            import ('./components/students/Form.vue'),
        meta: {
            layout: ThemeLayout,
        }
    },
    {
        name: 'trainer',
        path: '/trainers',
        component: () =>
            import ('./components/trainers/List.vue'),
        meta: {
            layout: ThemeLayout,
        }
    },
    {
        name: 'trainer_add',
        path: '/trainer/add',
        component: () =>
            import ('./components/trainers/Form.vue'),
        meta: {
            layout: ThemeLayout,
        }
    },
    {
        name: 'trainer_edit',
        path: '/trainer/edit/:id',
        component: () =>
            import ('./components/trainers/Form.vue'),
        meta: {
            layout: ThemeLayout,
        }
    },
    {
        name: 'categories',
        path: '/categories',
        component: () =>
            import ('./components/categories/List.vue'),
        meta: {
            layout: ThemeLayout,
        }
    },
    {
        name: 'category_add',
        path: '/category/add',
        component: () =>
            import ('./components/categories/Form.vue'),
        meta: {
            layout: ThemeLayout,
        }
    },
    {
        name: 'category_edit',
        path: '/category/edit/:id',
        component: () =>
            import ('./components/categories/Form.vue'),
        meta: {
            layout: ThemeLayout,
        }
    },
    {
        name: 'settings',
        path: '/settings',
        component: () =>
            import ('./components/Settings.vue'),
        meta: {
            layout: ThemeLayout,
        }
    },
    {
        name: 'profile',
        path: '/profile',
        component: () =>
            import ('./components/Profile.vue'),
        meta: {
            layout: ThemeLayout,
        }
    }
]

const router = new VueRouter({
    base: 'securedportal',
    history: true,
    mode: 'history',
    routes
})

router.beforeEach((to, from, next) => {
    if (to.meta.is_auth) {
        
        $('body').addClass('login-page');
        $('body').removeClass('sidebar-mini');
        if (localStorage.getItem('token')) {
            next('/dashboard');
        } else {
            next();
        }
    } else {
        if (localStorage.getItem('token')) {
            $('.auth-box-custom').css('opacity','0');
            $('body').addClass('sidebar-mini');
            $('body').removeClass('login-page');
            next();
        } else {
            next('/');
        }
    }
});

export default router;