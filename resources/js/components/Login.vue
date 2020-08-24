<template>
    <b-form @submit.prevent="login">
        <h4 class="textclr-wit p-0">Login</h4>
        <b-alert variant="info" :show="info_message != ''">
            <i class="fa fa-info-circle"></i>
            {{ info_message }}
        </b-alert>
        <b-alert variant="danger" :show="error_message != ''">
            <i class="fa fa-remove"></i>
            {{ error_message }}
        </b-alert>
        <b-input-group class="position-relative has-icon-left mb-3">
            <template v-slot:prepend>
                <b-input-group-text><i class="fa fa-envelope"></i></b-input-group-text>
            </template>
            <b-form-input v-model="form_data.email.value" :state="form_data.email.is_valid" type="email" name="email" id="email" placeholder="Enter Email Address"></b-form-input>
            <b-form-invalid-feedback :state="form_data.email.is_valid">
                {{ form_data.email.error }}
            </b-form-invalid-feedback>
        </b-input-group>
        <b-input-group class="position-relative has-icon-left mb-3">
            <template v-slot:prepend>
                <b-input-group-text><i class="fa fa-key"></i></b-input-group-text>
            </template>
            <b-form-input v-model="form_data.password.value" :state="form_data.password.is_valid" type="password" name="password" id="password" placeholder="Enter Your Password"></b-form-input>
            <b-form-invalid-feedback :state="form_data.password.is_valid">
                {{ form_data.password.error }}
            </b-form-invalid-feedback>
        </b-input-group>
            <b-button type="submit" class="submit-btn float-right login-submit" block :disabled="is_loading">
                <i v-if="is_loading" class="fa fa-refresh fa-spin"></i>
                <i v-if="!is_loading" class="fa fa-unlock"></i>
                Login
            </b-button>
            <router-link :to="'/reset_password'" class="btn btn-light float-left login-submit">
                            <i class="fa fa-key"></i> Forgot Password
            </router-link> 
    </b-form>
</template>
<script>
    export default {
        data: function () {
            return {
                form_data: {
                    email: {
                        value: "",
                        is_valid: null,
                        error: ""
                    },
                    password: {
                        value: "",
                        is_valid: null,
                        error: ""
                    }
                },
                info_message: "",
                error_message: "",
                is_loading: false,
                
            }
        },
        created: function(){
            let loader = this.$loading.show();
        setTimeout(() => {
            loader.hide();
        }, 1000);
        },
        mounted: function () {
            if (this.$route.query.autologout) {
                this.info_message = 'Your Session Has Expired'
            }
        },

        methods: {
            login: function () {
                this.info_message = ""
                this.error_message = ""
                this.is_loading = true

                let loader = this.$loading.show();
                for (var field in this.form_data) {
                    // this.form_data[field].is_valid = true
                    this.form_data[field].error = ""
                }

                axios.post('login', {email: this.form_data.email.value, password: this.form_data.password.value})
                .then(response => {
                    loader.hide();
                    localStorage.setItem('token', response.data.token)
                    this.$router.push({ path: '/dashboard'});
                })
                .catch(error => {
                    loader.hide();
                    if (error.response.status === 400) {
                        const errors = error.response.data.error
                        
                        if (typeof(errors) === 'object') {
                            for (var field in errors) {
                                this.form_data[field].is_valid = false
                                this.form_data[field].error = errors[field][0]
                            }
                        } else {
                            this.error_message = errors
                        }
                    }
                        console.log(this.form_data.password.error);

                    // this.form_data.password.value = ""
                    // this.form_data.password.is_valid = null
                    this.is_loading = false
                });
                
            }
        }
    }
</script>