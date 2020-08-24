<template>
<transition name="slide-fade">
    <div v-show="show">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Settings</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <form @submit.prevent="submit">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            
                                <b-form-group
                                    id="module_time"
                                    label="Modeule 2 start time after: *"
                                    label-for="module2_time_select"
                                    class="col-sm-6">
                                    <b-form-select
                                    id="module2_time_select"
                                    v-model="post.module2_time.value">
                                    <b-form-select-option value="" >Select Time</b-form-select-option>
                                        <b-form-select-option v-for="(data,idx) in module_time_option" :key="idx" :value="data.value">
                                            {{ data.title }}
                                        </b-form-select-option>
                                    </b-form-select>
                                    <span v-if="error.module_time" class="text-danger direct-chat-name float-left mt-1 w-100">{{ error.module_time[0]}}</span>
                                </b-form-group>
                                <b-form-group
                                    id="module_time1"
                                    label="Modeule 3 start time after: *"
                                    label-for="module3_time_select"
                                    class="col-sm-6">
                                    <b-form-select
                                    id="module3_time_select"
                                    v-model="post.module3_time.value">
                                    <b-form-select-option value="" >Select Time</b-form-select-option>
                                        <b-form-select-option v-for="(data,idx) in module_time_option" :key="idx" :value="data.value">
                                            {{ data.title }}
                                        </b-form-select-option>
                                    </b-form-select>
                                    <span v-if="error.module_time" class="text-danger direct-chat-name float-left mt-1 w-100">{{ error.module_time[0]}}</span>
                                </b-form-group>
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
                    module_time_option: [{
                        value: '30',
                        title: '30 Minutes',
                    },
                    {
                        value: '60',
                        title: '1 Hour',
                    },
                    {
                        value: '90',
                        title: '1.5 Hour',
                    },
                    {
                        value: '120',
                        title: '2 Hours',
                    }
                    ]
                ,
                post: {
                    module2_time: {
                        short_code : 'module_2_start',
                        value : ''
                    },
                    module3_time: {
                        short_code : 'module_3_start',
                        value : ''
                    },
                },
                show: false,
                error: []
            }
        },

      created: function () {
           this.getSettings();
        },

        methods: {
            getSettings: function(){
                let loader = this.$loading.show();
                axios.get('settings')
                .then(response => {
                   
                    loader.hide();
                    this.show = true;
                })
            },
            submit: function () {
                let loader = this.$loading.show();
                axios.post('settings/add',this.post)
                .then(response => {
                    loader.hide();
                    this.show = true;
                })
            }
        }
    }
</script>