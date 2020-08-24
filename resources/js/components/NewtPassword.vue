<template>
    <b-form @submit.prevent="resetPassword" autocomplete="off">
        <h4 class="textclr-wit p-0">New Password</h4>
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
            <b-form-input autocomplete="false" :disabled='form_data.email.disable' v-model="form_data.email.value" :state="form_data.email.is_valid" type="email" name="email" id="email" placeholder="Enter Email Address"></b-form-input>
            <b-form-invalid-feedback :state="form_data.email.is_valid">
                {{ form_data.email.error }}
            </b-form-invalid-feedback>
        </b-input-group>
         <b-input-group class="position-relative has-icon-left mb-3">
            <template v-slot:prepend>
                <b-input-group-text><i class="fa fa-key"></i></b-input-group-text>
            </template>
            <b-form-input autocomplete="false" v-model="form_data.password.value" :state="form_data.password.is_valid" type="password" name="password" id="password" placeholder="New Password"></b-form-input>
            <b-form-invalid-feedback :state="form_data.password.is_valid">
                {{ form_data.password.error }}
            </b-form-invalid-feedback>
        </b-input-group>
         <b-input-group class="position-relative has-icon-left mb-3">
            <template v-slot:prepend>
                <b-input-group-text><i class="fa fa-key"></i></b-input-group-text>
            </template>
            <b-form-input autocomplete="false" v-model="form_data.password_confirmation.value" :state="form_data.password.is_valid" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password"></b-form-input>
            <b-form-invalid-feedback :state="form_data.password.is_valid">
                {{ form_data.password.error }}
            </b-form-invalid-feedback>
        </b-input-group>
            <b-button type="submit" class="submit-btn float-right login-submit" block :disabled="is_loading">
                <i v-if="is_loading" class="fa fa-refresh fa-spin"></i>
                <i v-if="!is_loading" class="fa fa-unlock"></i>
                Submit
            </b-button> 
            <router-link :to="'/'" class="btn btn-light float-left login-submit">
                            <i class="fa fa-lock"></i> Login Page
            </router-link>  
            
    </b-form>
</template>

<script>
export default {
    data() {
      return {
        form_data: {
                    email: {
                        value: "",
                        is_valid: null,
                        error: "",
                        disable: false
                    },
                    password: {
                        value: "",
                        is_valid: null,
                        error: ""
                    },
                     password_confirmation: {
                        value: "",
                        is_valid: null,
                        error: ""
                    }
                },
                token: null,
                info_message: "",
                error_message: "",
                is_loading: false,
      }
    },
    created: function() {
      let loader = this.$loading.show();
      this.getEmail();
        setTimeout(() => {
            loader.hide();
        }, 1500);
    },
    mounted: function () {
            if (this.$route.query.autologout) {
                this.info_message = 'Your Session Has Expired'
            }
    },
    methods: {
      getEmail: function(){
        let loader = this.$loading.show();
        axios.get('/reset_new_password/'+this.$route.params.token,{
                token: this.$route.params.token
        })
        .then(res => {
          loader.hide();
          if(res.status == 200){
            this.form_data.email.value = res.data.email;
            this.form_data.email.is_valid = true;
            this.form_data.email.disable = true;
          }
        }).catch(err => {
          loader.hide();
          this.error_message = err.response.data.error;
        });
      },
        resetPassword() {
            this.info_message = ""
                this.error_message = ""
                this.is_loading = true

                let loader = this.$loading.show();
                for (var field in this.form_data) {
                    // this.form_data[field].is_valid = true
                    this.form_data[field].error = "";
                    this.form_data[field].is_valid = null
                    
                }

                axios.post('/reset_new_password', {
                    token: this.$route.params.token,
                    email: this.form_data.email.value,
                    password: this.form_data.password.value,
                    password_confirmation: this.form_data.password_confirmation.value
                    })
                .then(response => {
                    loader.hide();
                    this.is_loading = false;
                    this.info_message = response.data.message;
                    this.error_message = '';
                    this.$router.push({ name: 'login'});
                })
                .catch(error => {
                    loader.hide();
                    if (error.response.status == 400 || error.response.status == 422 || error.response.status == 442) {
                        const errors = error.response.data.errors;
                        if (typeof(errors) === 'object') {
                            for (var field in errors) {
                                this.form_data[field].is_valid = false;
                                this.form_data[field].error = errors[field][0]
                            }
                        } else {
                            this.error_message = errors;
                        }
                    }
                    

                    // this.form_data.password.value = ""
                    // this.form_data.password.is_valid = null
                    this.is_loading = false
                });
        }
    }
}
</script>