<template>
    <div>
        <section class="content-header content-header-list">
            <b-container fluid>
                <b-row class="mb-2">
                    <b-col sm="6">
                        <h1>Trainers</h1>
                    </b-col>
                    <b-col sm="6" style="margin-top: 8px;">
                        
                        <router-link to='/trainer/add' class="btn btn-info float-right">
                            <i class="fa fa-plus"></i> Add New Trainers
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
           
            <table class="table table-bordered dr-table-responsive">
                <thead>
                    <tr>
                        <!-- <th style="min-width:76px">
                            <span class="cursor-pointer d-flex justify-content-between align-items-center" @click="sort('id')">ID 
                        <i class="fa fa-sort"></i></span>
                        
                        </th> -->
                        <th class="min-120">
                            <span class="cursor-pointer d-flex justify-content-between align-items-center" @click="sort('firstname')">First Name 
                        <i class="fa fa-sort"></i></span>
                        
                        </th>
                        <th class="min-120">
                            <span class="cursor-pointer d-flex justify-content-between align-items-center" @click="sort('lastname')">Last Name 
                        <i class="fa fa-sort"></i></span>
                        
                        </th>
                        <th class="min-180">
                            <span class="cursor-pointer d-flex justify-content-between align-items-center" @click="sort('email')">Email 
                        <i class="fa fa-sort"></i></span>
                        
                        </th>
                        <th class="min-180">
                            <span class="cursor-pointer d-flex justify-content-between align-items-center" @click="sort('trainers.created_at')">Registration Date 
                        <i class="fa fa-sort"></i></span>
                        </th>
                        
                        <th class="min-150">
                            <span class="cursor-pointer d-flex justify-content-between align-items-center" @click="sort('cnic')">CNIC 
                        <i class="fa fa-sort"></i></span>
                        
                        </th>
    
                        <th class="min-105">
                            <span class="cursor-pointer d-flex justify-content-between align-items-center" @click="sort('active')">Active 
                        <i class="fa fa-sort"></i></span>
                        
                        </th>
                        <th v-if="list_data.length" class="min-110 text-center">ACTIONS</th>
                    </tr>
                    <tr>
                        <!-- <td>
                            <b-form v-on:submit.prevent="browse" class="search-column">
                                    <b-form-input 
                                    v-model="search_data.id" 
                                    type="text"
                                    placeholder="Search">
                                    </b-form-input>
                            </b-form>
                        </td> -->
                        <td>
                            <b-form v-on:submit.prevent="browse" class="search-column">
                                    <b-form-input 
                                    v-model="search_data.firstname" 
                                    type="text"
                                    placeholder="Search">
                                    </b-form-input>
                            </b-form>
                        </td>
                        <td>
                            <b-form v-on:submit.prevent="browse" class="search-column">
                                    <b-form-input 
                                    v-model="search_data.lastname" 
                                    type="text"
                                    placeholder="Search">
                                    </b-form-input>
                            </b-form>
                        </td>
                        <td>
                            <b-form v-on:submit.prevent="browse" class="search-column">
                                    <b-form-input 
                                    v-model="search_data.email" 
                                    type="text"
                                    placeholder="Search">
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
                        <td>
                            <b-form v-on:submit.prevent="browse" class="search-column">
                                    <b-form-input 
                                    v-model="search_data.cnic" 
                                    type="text"
                                    placeholder="Search">
                                    </b-form-input>
                            </b-form>
                        </td>
                        
                        <td>
                                    <b-form-select 
                                    v-model="search_data.is_trainer"
                                    class="search_select_sort"
                                    @change="browse">
                                    <b-form-select-option value="">Select</b-form-select-option>
                                    <b-form-select-option value=1>Yes</b-form-select-option>
                                    <b-form-select-option value=0>No</b-form-select-option>
                                    </b-form-select>
                        </td>
                    </tr>
                </thead>
                <tbody v-if="list_data.length">
                    
                    <tr v-for="row in list_data" :key="row.id">
                        <!-- <td class="text-center">{{ row.id }}</td> -->
                        <td>{{ row.user.firstname }}</td>
                        <td>{{row.user.lastname}}</td>
                        <td>{{ row.user.email }}</td>
                        <td class="text-center">{{ row.created_at | format_date }}</td>
                        <td class="text-center">{{ row.cnic }}</td>
                        <td class="text-center" v-show="row.active === 0">No</td>
                        <td class="text-center" v-show="row.active === 1">Yes</td>
                        <td class="text-center action-btns">
                        <router-link :to="'trainer/edit/' + row.id" class="btn btn-success">
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
            <pagination v-if="search_data.pagination.last_page > 1" :pagination="search_data.pagination" :offset="2" @paginate="browse()"></pagination>
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
                show: false,

                search_data: {
                    pagination:{},
                    sort:'',
                    id: '',
                    firstname: '',
                    lastname: '',
                    email: '',
                    created_at: '',
                    cnic: '',
                    is_trainer: '',
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
                axios.get('trainers?' + $.param(this.search_data))
                .then(res => {
                    loader.hide();
                    this.list_data =  res.data.data.data;
                    this.search_data.pagination = res.data.pagination;
                    this.show = true;
                })
                .catch(error => {
                    console.log(error);
                });;
            },
            delete_by_id: function (id) {
                
                this.$dialog.confirm('Do you really want to delete?', {
                    loader: true,
                    okText: 'Delete',
                })
                .then((dialog) => {
                    axios.post('trainer/delete/' + id)
                    .then(response => {
                        this.browse();
                        dialog.close();
                    });
                })
            }
        }
    }
</script>