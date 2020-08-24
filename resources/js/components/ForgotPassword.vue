<template>
<div style="max-height: 350px;">
  
    <b-form @submit.prevent="requestResetPassword">
        <h4 class="textclr-wit p-0">Forgot Password</h4>
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
            <b-button type="submit" class="submit-btn float-right login-submit" block :disabled="is_loading">
                <i v-if="is_loading" class="fa fa-refresh fa-spin"></i>
                <i v-if="!is_loading" class="fa fa-unlock"></i>
                Submit
            </b-button> 
            <router-link :to="'/'" class="btn btn-light float-left login-submit">
                            <i class="fa fa-lock"></i> Login Page
            </router-link>  
            
    </b-form>
    
</div>
</template>
<script>
export default {
    data() {
      return {
       form_data: {
                    email: {
                        value: "",
                        is_valid: null,
                        error: ""
                    },
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
        requestResetPassword() {
          let loader = this.$loading.show();
          for (var field in this.form_data) {
                    // this.form_data[field].is_valid = true
                    this.form_data[field].error = "";
                    this.form_data[field].is_valid = null
                }
            axios.post("/reset_password", {email: this.form_data.email.value})
            .then(res => {
              loader.hide();
                this.info_message = res.data.message;
                console.log("result is "+res);
            }, err => {
               loader.hide();
                console.log(err.response.data.error);
                 this.form_data.email.error = err.response.data.error;
                 this.form_data.email.is_valid = false;
            });
        }
    }
}
</script>