<template>
    <div>
        <section class="content-header">
            <b-container fluid>
                <b-row class="mb-2">
                    <b-col sm="6">
                        <h1 v-if="this.$route.params.id">Edit Role</h1>
                        <h1 v-else>Add Role</h1>
                    </b-col>
                </b-row>
            </b-container>
        </section>
        <section class="content">
            <b-form v-on:submit.prevent="addRole">
                 <div class="card">
                    <div class="card-body">
                    <div class="row">
            <b-form-group
                id="title-group"
                label="Title:"
                label-for="title"
                class="col-sm-12"
                description="Role Title"
            >
                <b-form-input
                id="title"
                v-model="post.title"
                type="text"
                placeholder="Enter Title"
                ></b-form-input>
                <span v-if="error.title" class="text-danger direct-chat-name">{{ error.title[0]}}</span>
            </b-form-group>
            </div>
            </div>
              
            <h5 class="card-header border-top">Set Permissions</h5>
            <table class="card-table table">
    <thead>
      <tr>
        <th class="text-center"></th>
        <th class="text-center">View</th>
        <th class="text-center">Add</th>
        <th class="text-center">Edit</th>
        <th class="text-center">Delete</th>
      </tr>
    </thead>
    <tbody>
     
      <tr v-for="(data, idx) in permissions" :key="idx">
        <td> <strong class="col-sm-12">{{data.title}}</strong></td>
        <td
        v-for="(option, idx) in capabilities"
        :key="idx"
        class="text-center">
            <b-form-checkbox-group id="capability_id" 
            v-model="post.capability_id">
            <b-form-checkbox 
            class="form-group" 
            :checked="checked_capability"
            :value="data.short_code+'_'+option.id"
            :title="option.title"></b-form-checkbox>
            </b-form-checkbox-group>
        </td>
      </tr>
    
    </tbody>
  </table>
    <span v-if="error.capability_id" class="text-danger col-sm-12 direct-chat-name">{{ error.capability_id[0]}}</span>

    
    
            <div class="card-footer">
                <b-button type="submit" variant="success"><i class="fa fa-check"></i> Submit</b-button>
                <b-button v-if="!this.$route.params.id" type="reset" @click="reset" variant="danger">Reset</b-button>
            </div>
                    </div>
            </b-form>
        </section>
  </div>
</template>
<script>
    export default {
        data: function () {
            return {
                post:{
                    title: '',
                    short_code: '',
                    type: 'role',
                    role_id: '',
                    capability_id: []
                },
                checked_capability: [],
                capabilities: [],
                permissions: [],
                error:''
            }
        },
        created: function () {
            this.getOptions();
            this.getPermissions();
            if(this.$route.params.id){
                this.fetchData();
            }
        },
        methods: {
            getPermissions() {
                let loader = this.$loading.show();
                var url = '/permissions';
               axios.get(url,this.post)
                .then((res) => {
                    loader.hide();
                    this.permissions = res.data.data.data;
                })
            },
            getAllowedPermission(){
                let loader = this.$loading.show();
                var url = '/allowed_permissions/'+this.$route.params.id;
               axios.get(url,this.post)
                .then((res) => {
                    loader.hide();
                   
                        this.checked_capability = res.data;
                   
                })
            },
            getOptions() {
                let loader = this.$loading.show();
                axios.get('./capability').then(res => {
                    let title = [];
                    let capabilities = res.data.data.data;
                    capabilities.forEach(element => {
                        title.push(element);
                    });
                    
                    this.capabilities = title;
                    loader.hide();
                    return capabilities;
                });
            },
             fetchData: function() {
                 let loader = this.$loading.show();
               axios.get('/role/edit/'+this.$route.params.id)
                .then(response => {
                    loader.hide();
                    this.post = response.data;
                    this.getAllowedPermission();
                    
                });
            },
            addRole: function (div) {
               var url = '/role/add'
                    if(this.$route.params.id){
                        url = '/role/edit/'+this.$route.params.id
                    }
            axios.post(url,this.post)
                .then((res) => {
                    this.error = '';
                    if(this.$route.params.id){
                     this.$root.$emit('alertify', {type: 'success', message: 'Role updated Successfully'});
                    }else{
                        this.$root.$emit('alertify', {type: 'success', message: 'Role added Successfully'});
                    }
                    this.$router.push({ name: "role" });
                })
                .catch((err) => {
                    this.error = err.response.data.errors;
                })
            },
            reset(){
                this.error = '';
            }
        },
        
    }
</script>