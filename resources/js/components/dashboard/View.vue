<template>
    <div>
        <section class="content-header">
            <b-col sm="12">
                <h1 class="d-flex align-items-center">Dashboard <span class="from-to-btn" v-if="show">From :  {{dashboardFrom}}</span>  <span class="from-to-btn" v-if="show"> To : {{dashboardTo}} </span></h1>
            </b-col>
        </section>
        <section class="content">
            <div class="has-sequential-flex row">
                <sequential-entrance delay="100">
                <div class="col-sm-3" v-for="(data,idx) in card" :key="idx">
                    <div class="card d-flex flex-row w-100">
                    <div style="width:80px" :class="'card-header d-flex justify-content-center align-items-center content-center '+data.iconbg">
                        <i style="font-size:24px;" :class="'text-white fa '+ data.icon"></i>
                    </div>
                    <div class="card-body dash-top-card row text-center">
                        <div class="col">
                        <div class="lead font-weight-bold">{{data.leadTitle}}</div>
                        <div class="text-uppercase font-weight-bold small">{{data.leadText}}</div>
                        </div>
                    </div>
                    </div>
                </div>
                </sequential-entrance>
            </div>
            <transition name="slide-fade">
            <div v-if="show" class="filter-area">
                 <b-form-group
                    id="daterange"
                    label="Filter By Date"
                    label-for="daterange"
                    class="col-sm-6 d-flex align-items-center m-0">
                    <date-range-picker 
                        v-model="search_data.daterange"
                        :minDate="MinDate" :maxDate="MaxDate"
                        @update="applyDate"
                        :locale-data="locale"
                        :ranges="false"
                        id="daterange"
                        :opens="opens">
                    </date-range-picker>
                  
                 </b-form-group>
            </div>
            </transition>
            <div class="row mt-3">
                <div class="col-sm-6">
                    <BarChart title="Month Wise Breakup" :label="barLabel" :data="this.barData" v-if="showChart"/>
                </div>
                <div class="col-sm-6">
                    <DoughnutChart :labels="pieLabels" title="Province Wise Breakup" :data="pieData" v-if="showChart"/>
                </div>
                <!-- <div class="col-sm-6">
                    <LineChart  title="Total Registered students" :label="'Total Registered'" :data="lineData" v-if="showChart"/>
                </div>
                <div class="col-sm-6">
                    <AreaChart :labels="['Total Register','Students','Non Students']" title="Total Records" :dataset="areadataset" v-if="showChart"/> 
                </div> -->
            </div>
               
        </section>
    </div>
    
</template>
<script>

import moment from 'moment'
export default {

  data: function () {
            return {
                show :false,
                showChart: false,
                barLabel:[],
                barData: [],
                pieLabels: [],
                pieData: [],
                statename : '',
                //start Date picker
                MinDate: new Date(new Date().getFullYear()),
                MaxDate: new Date(),
                opens: "right",//which way the picker opens, default "center", can be "left"/"right"
                locale: {
                    firstDay: 1,
                    format: 'dd mmm yyyy'
                },
                dashboardFrom:'',
                dashboardTo:'',
                search_data: {
                    daterange : {
                        startDate: new Date(new Date().getFullYear(), new Date().getMonth(), 1), 
                        endDate: new Date()
                    }
                },
                //End Date Picker
                
                post:{
                    totalRegister: 0,
                    attemptPretest: 0,
                    isStudent: 0,
                    nonStudent: 0,
                },
                card:[]
            }
        },
        created: function () {  
                this.applyDate(this.search_data.daterange);
        },
        methods: {
            UpdateDate(res){
                this.StartDate = null;
                this.EndDate = null;
            },
             applyDate (res) {
                this.showChart = false;
                this.fetchDashboard();
                this.dashboardFrom = this.$helpers.format_date(res.startDate);
                this.dashboardTo = this.$helpers.format_date(res.endDate);
            },
            fetchDashboard :function () {
                 let loader = this.$loading.show();
               axios.get('/getDashboadData?'+$.param(this.search_data))
                .then(response => {
                    loader.hide();
                    this.show = true;
                    this.post = response.data.results;
                    // this.barData = response.data.bardata;
                    let registerd   = [];
                    let is_student   = [];
                    let non_student = [];
                    this.barLabel = [];
                    //Get label for bar chart
                    for (const data of response.data.bardata) {
                        this.barLabel.push(data.monthname);
                        registerd.push(data.registered);
                        is_student.push(data.is_student);
                        non_student.push(data.non_student);
                    }
                    //Get data for bar chart
                    this.barData = [
                        {
                            label: "Total Registered",
                            data : registerd,
                            backgroundColor: this.$helpers.generator_random_rgba(0.5),
                            borderColor: this.$helpers.generator_random_rgba(),
                            borderWidth:2
                        },
                        {
                            label: "Students",
                            data : is_student,
                            backgroundColor: this.$helpers.generator_random_rgba(0.5),
                            borderColor: this.$helpers.generator_random_rgba(),
                            borderWidth:2
                        },
                        {
                            label: "Non Students",
                            data : non_student,
                            backgroundColor: this.$helpers.generator_random_rgba(0.5),
                            borderColor: this.$helpers.generator_random_rgba(),
                            borderWidth:2
                        }
                    ];

                    //Get label for Pie Chart

                    this.pieLabels = [];
                    this.pieData = [];
                    for (const data of response.data.pieData) {
                        
                        this.pieLabels.push(data.title);
                        this.pieData.push(data.registered);

                    }
                    console.log(this.pieLabels);
                   
                   setTimeout(() => {
                       this.showChart = true;
                   }, 1000);
                   
                    this.card = [{
                        icon: 'fa-bar-chart',
                        iconbg: 'bg-yahoo',
                        leadTitle: this.post.totalRegister,
                        leadText: 'Total Registration',
                    },
                    {
                        icon: 'fa-line-chart',
                        iconbg: 'bg-vk',
                        leadTitle: this.post.attemptPretest,
                        leadText: 'Attempted Pre-Test',
                    },
                    {
                        icon: 'fa-user-md',
                        iconbg: 'bg-xing',
                        leadTitle: this.post.isStudent,
                        leadText: 'Register as Students',
                    },
                    {
                        icon: 'fa-user-times',
                        iconbg: 'bg-youtube',
                        leadTitle: this.post.nonStudent,
                        leadText: 'Register as Non-Students',
                    },
                ]
                });
            },
        }
}
</script>