<template>
    <div>
        <section class="content-header">
            <b-container fluid>
                <b-row class="mb-2">
                    <b-col sm="6">
                        <h1 v-if="this.$route.params.id">Edit Categories</h1>
                        <h1 v-else>Add Categories</h1>
                    </b-col>
                </b-row>
            </b-container>
        </section>
        <section class="content">
            <b-form v-on:submit.prevent="addcategory" class="row">
            <b-form-group
                id="title-group"
                label="Title:"
                label-for="title"
                class="col-sm-12"
                description="Category Title"
            >
                <b-form-input
                id="title"
                v-model="post.title"
                type="text"
                required
                placeholder="Enter Title"
                ></b-form-input>
            </b-form-group>
        

            <div class="btn-wrapper col-sm-12">
                <b-button type="submit" variant="success">Submit</b-button>
                <b-button v-if="!this.$route.params.id" type="reset" variant="danger">Reset</b-button>
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
                }
            }
        },
        created: function () {
            if(this.$route.params.id){
            this.fetchData();
            }
            
        },
        computed: {
            isDisabled() {
                if(this.$route.params.id){
                    return true;
                }
            }
        },
        methods: {
             fetchData: function() {
               axios.get('/category/edit/'+this.$route.params.id)
                .then(response => {
                    console.log(response.data);
                    this.post = response.data
                });
            },
            addcategory: function (div) {
                console.log(div)
               var url = '/category/add'
                    if(this.$route.params.id){
                        url = '/category/edit/'+this.$route.params.id
                    }
            axios.post(url,this.post)
                .then((res) => {
                    this.$router.push({name: 'categories'})
                })
                .catch((err) => {
                    console.log(err)
                })
            }
        },
        
    }
</script>