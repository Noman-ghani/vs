<template>
    <div>
        <section class="content-header content-header-list">
            <b-container fluid>
                <b-row class="mb-1">
                    <b-col sm="12">
                        <h1>Modules</h1>
                    </b-col>

                </b-row>
            </b-container>
        </section>
       
        <!-- <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Modules</h1>
                    </div>
                    <div class="col-sm-6">
                        <button data-toggle="modal" data-target="#advanced_search_modal" class="btn btn-success pull-right" style="margin-top: 8px; margin-left: 8px;"><i class="fa fa-search"></i> Advanced Search</button>
                        <button @click="create" class="btn btn-success pull-right" style="margin-top: 8px;"><i class="fa fa-plus"></i> Add</button>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">ID</th>
                        <th>NAME</th>
                        <th width="5%" class="text-center">SORT</th>
                        <th width="9%" class="text-center">CREATED AT</th>
                        <th v-if="list_data.length" width="7%" class="text-center">ACTIONS</th>
                    </tr>
                </thead>
                <tbody v-if="list_data.length">
                    <tr v-for="row in list_data" :key="row.id">
                        <td class="text-center">{{ row.id }}</td>
                        <td>{{ row.title }}</td>
                        <td class="text-center">{{ row.sort }}</td>
                        <td class="text-center">{{ row.created_at | format_date_time }}</td>
                        <td class="text-center">
                            <a href="javascript:;" @click="update(row.id)">
                                <i class="fa fa-edit"></i>
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
        </section>
        <div class="modal fade" id="advanced_search_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form @submit.prevent="browse">
                        <div class="modal-header">
                            <h4 class="modal-title">Advanced Search</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="search_title">Name</label>
                                        <input v-model="search_data.title" type="text" class="form-control" name="title" id="search_title" max="100" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                            <button @click="reset" type="button" class="btn btn-success"><i class="fa fa-refresh"></i> Reset</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> -->
    </div>
</template>

   