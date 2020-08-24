<template>
<transition name="slide-fade">
    <div v-show="show">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <form @submit.prevent="submit">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            
                                <div class="form-group col-sm-6">
                                    <label for="name">First Name</label>
                                    <input v-model="user.firstname" type="text" name="firstname" id="firstname" class="form-control" />
                                    <span v-if="error.firstname" class="text-danger direct-chat-name">{{ error.firstname[0]}}</span>
                                </div>
                    
                                <div class="form-group col-sm-6">
                                    <label for="name">Last Name</label>
                                    <input v-model="user.lastname" type="text" name="lastname" id="lastname" class="form-control" />
                                    <span v-if="error.lastname" class="text-danger direct-chat-name">{{ error.lastname[0]}}</span>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="email">Email address</label>
                                    <input v-model="user.email" type="email" name="email" id="email" class="form-control" disabled />
                                    <span v-if="error.email" class="text-danger direct-chat-name">{{ error.email[0]}}</span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="email">Password</label>
                                    <input v-model="user.password" type="password" name="password" id="password" class="form-control" />
                                    <span v-if="error.password" class="text-danger direct-chat-name">{{ error.password[0]}}</span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="email">Confirm Password</label>
                                    <input v-model="user.password_confirmation" type="password" name="password_confirmation" id="password_confirmation" class="form-control" />
                                    <span v-if="error.password_confirmation" class="text-danger direct-chat-name">{{ error.password_confirmation[0]}}</span>
                                </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Update Profile</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
</transition>
</template>
<script>
    export default {
        data: function () {
            return {
                user: {},
                show: false,
                error: []
            }
        },

        mounted: function () {
            let loader = this.$loading.show();
            axios.get('user')
            .then(response => {
                this.user = response.data
                loader.hide();
                this.show = true;
            })
        },

        methods: {
            submit: function () {
                let loader = this.$loading.show();
                axios.patch('profile', {firstname: this.user.firstname,lastname: this.user.lastname,email: this.user.email,password:this.user.password,password_confirmation:this.user.password_confirmation})
                .then(response => {
                    this.error = '';
                    if (response.data.success) {
                        this.$root.$emit('user', this.user)
                        this.$root.$emit('alertify', {type: 'success', message: 'Profile Updated Successfully'});
                    }
                    loader.hide();
                })
                .catch((err) => {
                    this.error = err.response.data.errors
                    loader.hide();
                    
                });
            }
        }
    }
</script>