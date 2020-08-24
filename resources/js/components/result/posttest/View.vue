<template>
    <div>
        <section class="content-header">
            <b-container fluid>
                <b-row class="mb-2">
                    <b-col sm="6">
                        <h1>{{post.name}}</h1>
                        <p>{{post.email}}</p>
                    </b-col>
                    <div class="col-sm-6 d-flex align-items-end justify-content-between flex-column">
                    <span v-show="post.total_attempts" style="border-bottom: 1px solid #f4f6f9;cursor: default;width: 180px;background: rgb(53, 127, 98);padding: 8px 10px 10px;color: #FFF;text-align: center;">
                        Total Attempts
                        <b-badge variant="light">{{post.total_attempts}} <span class="sr-only"></span></b-badge>
                    </span>
                    <span v-show="post.total_correct" style="border-bottom: 1px solid #f4f6f9;cursor: default;width: 180px;background: rgb(53, 127, 98);padding: 8px 10px 10px;color: #FFF;text-align: center;">
                        Total Correct
                        <b-badge variant="light">{{post.total_correct}} <span class="sr-only"></span></b-badge>
                    </span>
                    </div>
                </b-row>
            </b-container>
        </section>
        <section class="pretest-results-sec content">
            
            <div class="card" v-for="(data,key, index) in post.data" :key="data.attempt_answer_id">
                <header class="card-header" variant="primary">
                   <strong> Q {{index + 1}} : {{data.question}} </strong>
                </header>
                
                    <b-list-group>
                        <b-list-group-item v-for="(ans,idx) in data.answers" :key="idx" v-html="ans" :variant="getVariant(data, idx)">
                           <i class="fa fa-dot-circle-o mr-2"></i> {{ans}}
                            <i class="fa fa-check pull-right" v-if="data.correct_answer_id == idx"></i>
                            <i class="fa fa-close pull-right" v-if="data.attempt_answer_id == idx && data.attempt_answer_id != data.correct_answer_id"></i>
                        </b-list-group-item>
                    </b-list-group>
                
            </div>
            

        </section>
        
  </div>
</template>
<script>
    export default {
        data: function () {
            return {
                post:{
                    
                },
                type : 'post_test_module_1'
            }
        },
        created: function () {    
                this.fetchData();
        },
        methods: {
            getVariant: function(data, idx) {
               if(data.correct_answer_id == idx){
                   return "success";
               }
               if(data.attempt_answer_id == idx && data.attempt_answer_id != data.correct_answer_id){
                   return "danger";
               }
               return 'light';
                
            },
             fetchData: function() {
                 let loader = this.$loading.show();
               axios.get('/post-result/view/'+this.$route.params.id + '?type='+this.type)
                .then(response => {
                    loader.hide();
                    this.post = response.data;
                    console.log(response);
                    
                });
            },
        },
        
    }
</script>