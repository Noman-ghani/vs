<template>
    <div>
        <section class="content-header">
            <b-container fluid>
                <b-row class="mb-2">
                    <b-col sm="6">
                        <transition name="slide-fade">
                            <h1 v-if="show">Add PDF</h1>
                        </transition>
                    </b-col>
                </b-row>
            </b-container>
        </section>
        <transition name="slide-fade">
            <section class="content" v-if="show">
                <b-form v-on:submit.prevent="uploadPDF">
                        <div class="card">
                            <div class="card-body">        
                                <div class="row">
                                    <b-form-group
                                        id="fname-group"
                                        label="Upload PDF: *"
                                        label-for="upload"
                                        description="(pdf) max-size = 1000kb"
                                        class="form-group col-sm-12">
                                        <div class="input-group">
                                            <b-form-file
                                            v-model="post.file"
                                            id="upload"
                                            @change="onImageChange"
                                            accept=".pdf"
                                            :placeholder="filePlaceholder"
                                            ></b-form-file>
                                            <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Upload">
                                        </div>
                                            <span v-if="error.file" class="text-danger direct-chat-name">{{ error.file[0]}}</span>
                                    </b-form-group>
                                </div>    
                            </div>
                        </div>
                </b-form>
                <div class="d-flex flex-wrap align-items-start" v-if="ifram_url != ''">

                    <iframe class="myiframe" 
                    style="width:50%;min-height: 65vh;"
                    :src="'/images/module/1/'+ifram_url"></iframe>
                    <b-button
                        variant="danger" 
                        class="ml-4"
                        @click="removePDF">
                        <i class="fa fa-close"></i>
                        Remove PDF
                    </b-button>
                </div>
            </section>
        </transition>
    </div>
</template>
<script>
    export default {
        data: function () {
            return {
                post : {
                    file: null,
                    module: '1'
                },
                ifram_url : '',
                filePlaceholder : 'Choose File',
                show : false,
                error: []
            }
        },
        created: function () {
            this.get_file_by_id();
        },
        methods: {
            get_file_by_id: function() {
                 let loader = this.$loading.show();
               axios.get('/module/1')
                .then(response => {
                    loader.hide();
                        this.ifram_url = response.data.file;
                        this.filePlaceholder = response.data.file;

                        if(this.ifram_url == ''){
                            this.post.file = null;
                            this.filePlaceholder = 'Choose File';
                        }
                        
                        this.show = true;
                    
                })
                 .catch((err) => {
                    this.error = err.response.data.errors
                });
            },
            uploadPDF: function(){
                
                const formData = new FormData();
                formData.append('file', this.post.file);
                formData.append('module', this.post.module);

                axios.post('/uploadFile',formData)
                .then((res) => {
                    this.get_file_by_id();
                })
                .catch((err) => {
                    this.error = err.response.data.errors
                })
            },
            removePDF: function () {
                 const formData = new FormData();
                
                formData.append('file', this.ifram_url);
                formData.append('module', this.post.module);

                axios.post('/deleteFile',formData)
                .then((res) => {
                    this.get_file_by_id();
                })
                .catch((err) => {
                    this.error = err.response.data.errors
                })
            },
             onImageChange(e){
                this.post.file = e.target.files[0];
            },
        }
    }
</script>