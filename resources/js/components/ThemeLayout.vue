<template>
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand" style="justify-content: space-between;">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a @click="toggleFullScreen" class="nav-link" href="javascript:;"><i class="fa fa-expand"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:;" @click="togglePushMenu"><i class="fa fa-bars"></i></a>
                </li>
            </ul>
            <ul class="nav navbar-nav float-right">
                <li class="dropdown dropdown-user nav-item">
                    <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                        <span class="user-name">{{ user.firstname }} {{ user.lastname }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <router-link class="dropdown-item" to='/profile'>
                            <i class="fa fa-user"></i> Edit Profile
                        </router-link>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:;" @click="logout(false)">
                            <i class="fa fa-sign-out"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="javascript:;" class="brand-link text-center">
                <span class="brand-small-text font-weight-light"><b-img src="/assets/images/main-logo.png" fluid alt="Responsive image"></b-img></span>
                <span class="brand-text font-weight-light"><b-img src="/assets/images/main-logo.png" fluid alt="Responsive image" style="max-width:200px"></b-img></span>
            </a>
            <div class="sidebar">
                <nav class="">
                    <sidebar-menu></sidebar-menu>
                </nav>
            </div>
        </aside>
        <div class="content-wrapper" style="display: flow-root;">
            <section v-if="alertify.message" class="content-header">
                <div class="container-fluid">
                    <div id="alert_message" :class="'alert alert-' + alertify.type">
                        <i :class="'fa fa-' + alertify.icon"></i>
                        {{ alertify.message }}
                    </div>
                </div>
            </section>
            <slot />
        </div>
        <footer class="main-footer text-right">
            Copyright. All rights reserved.
        </footer>
    </div>
</template>
<script>
    export default {
        data: function () {
            return {
                user: {},
                alertify: {}
            }
        },

        created: function () {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token')
            var $context = this

            axios.get('user')
            .then(response => {
                this.user = response.data
            })

            this.$root.$on('user', function(user_data) {
                $context.user = JSON.parse(JSON.stringify(user_data))
            })

            this.$root.$on('alertify', function (data) {
                $context.alertify = data

                switch (data.type) {
                    case "success":
                        $context.alertify.icon = "check"
                        break
                    
                    case "danger":
                        $context.alertify.icon = "remove"
                        break
                }

                setTimeout(function () {
                    $('#alert_message').fadeOut('slow', function () {
                        $context.alertify = {}
                    })
                }, 1500)
            });
        },

        methods: {
            toggleFullScreen: function () {
                document.body.requestFullscreen()
            },

            togglePushMenu: function () {
                if ($('body').hasClass('sidebar-collapse')) {
                    $('body').removeClass('sidebar-collapse')
                } else {
                    $('body').addClass('sidebar-collapse')
                }
            },

            logout: function (has_session_expired) {
                axios.post('logout')
                .then(response => {
                    if (response.data.success) {
                        localStorage.removeItem("token")
                        delete axios.defaults.headers.common['Authorization']

                        if (has_session_expired) {
                            window.location = '/securedportal?autologout=true'
                        } else {
                            window.location = '/securedportal'
                        }
                    }
                })
            }
        }
    }
</script>