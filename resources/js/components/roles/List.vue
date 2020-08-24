<template>
    <div>
        <section class="content-header content-header-list">
            <b-container fluid>
                <b-row class="mb-2">
                    <b-col sm="6">
                        <h1>Role Management</h1>
                    </b-col>
                    <b-col sm="6" style="margin-top: 8px;">
                        <router-link to='/role/add' class="btn btn-info float-right">
                            <i class="fa fa-plus"></i> Add New Role
                        </router-link>
                    </b-col>
                </b-row>
            </b-container>
        </section>
       <transition name="slide-fade">
        <section v-if="show" class="content content-inner-box">
             <b-form-group
                id="show-record-group"
                label="Record per page:"
                label-for="show-record"
                class="w-10 record-per-page float-left px-0">
                <b-form-select 
                v-model="search_data.record" 
                id="show-record" 
                @change="show_record()">
                    <b-form-select-option value=10>10</b-form-select-option>
                    <b-form-select-option value=25>25</b-form-select-option>
                    <b-form-select-option value=50>50</b-form-select-option>
                    <b-form-select-option value=100>100</b-form-select-option>
                </b-form-select>
            </b-form-group>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="120">
                            <span class="cursor-pointer d-flex justify-content-between align-items-center" @click="sort('id')">ID 
                                <i class="fa fa-sort "></i>
                            </span>
                        </th>
                        <th>
                            <span class="cursor-pointer d-flex justify-content-between align-items-center" @click="sort('title')">Role Name 
                                <i class="fa fa-sort "></i>
                            </span>
                        </th>
                        <th width="200">
                            <span class="cursor-pointer d-flex justify-content-between align-items-center" @click="sort('created_at')">Created At 
                                <i class="fa fa-sort "></i>
                            </span>
                        </th>
            
                        <th width="110" v-if="list_data.length" class="text-center">ACTIONS</th>                    
                    </tr>
                    <tr>
                        <td>
                            <b-form v-on:submit.prevent="browse" class="">
                                    <b-form-input 
                                    v-model="search_data.id" 
                                    type="text"
                                    placeholder="Search id">
                                    </b-form-input>
                            </b-form>
                        </td>
                        <td>
                            <b-form v-on:submit.prevent="browse" class="">
                                    <b-form-input 
                                    v-model="search_data.name" 
                                    type="text"
                                    placeholder="Search Name">
                                    </b-form-input>
                            </b-form>
                        </td>
                        <td>
                            <b-form-datepicker  
                                v-model="search_data.created_at"
                                size="sm"
                                class=""
                                today-button
                                reset-button
                                close-button
                                :date-format-options="{ day: 'numeric' , month: 'short', year: 'numeric' , weekday: 'short' }"
                                 @context="browse"
                                placeholder="Search">
                                </b-form-datepicker>
                        </td>
                    </tr>
                </thead>
                <tbody v-if="list_data.length">
                    <tr v-for="row in list_data" :key="row.id">
                        <td class="text-center">{{ row.id }}</td>
                        <td>{{ row.title }}</td>
                        <td class="text-center">{{ row.created_at | format_date }}</td>
                        <td class="text-center action-btns">
                        <router-link :to="'role/edit/' + row.id" class="btn btn-success">
                            <i class="fa fa-edit"></i>
                        </router-link>
                        <a href="javascript:;" @click="delete_by_id(row.id)" class="btn btn-danger float-right">
                            <i class="fa fa-trash"></i>
                        </a>    
                        </td>
                    </tr>
                </tbody>
                <tbody v-if="!list_data.length">
                    <tr>
                        <td colspan="10" class="text-center">No Records Found</td>
                    </tr>
                </tbody>
            </table>
            <pagination v-if="pagination.last_page > 1" :pagination="pagination" :offset="2" @paginate="browse()"></pagination>
        </section>
        </transition>
    </div>
</template>
<script>
    export default {
        data: function () {
            return {
                fullPage: false,
                list_data: [],
                pagination:{},
                show: false,
                search_data: {
                    sort:'',
                    id: '',
                    name: '',
                    created:'',
                    sort_order: false,
                    page:'',
                    record: 10
                }
            }
        },
        
        created: function () {
            this.browse();
        },

        methods: {
            show_record: function(sort) {
                this.browse();
                this.$router.push({query: { page: '1' }});
            },
            sort: function(sort) {
                console.log("query is "+this.$route.query.page)
                if(this.$route.query.page){
                    this.$router.push({ query: { page: 1}})
                }
                this.search_data.sort_order = !this.search_data.sort_order;
                this.search_data.sort = sort;
                setTimeout(() => {
                    this.browse();
                }, 200);
               console.log(sort); 
                
            },
            browse: function () {
                let loader = this.$loading.show();
                if(this.$route.query.page){
                    this.search_data.page = this.$route.query.page;
                }
                axios.get('role?' + $.param(this.search_data))
                .then(res => {
                    loader.hide();
                    this.list_data =  res.data.data.data;
                    this.pagination = res.data.pagination;
                    this.show = true; 
                });
            },
            delete_by_id: function (id) {
                this.$dialog.confirm('Do you really want to delete?', {
                    loader: true 
                })
                .then((dialog) => {
                    axios.post('role/delete/' + id)
                    .then(response => {
                        this.browse();
                        dialog.close();
                    });
                })
            },
        }
    }
</script>