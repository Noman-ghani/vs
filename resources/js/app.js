require('./bootstrap')

window.Vue = require('vue')

import * as generalhelpers from './GeneralHelper.js';

const helpers = {
	install (Vue, options) {
		Vue.prototype.$helpers = generalhelpers; // we use $ because it's the Vue convention
	}
};

Vue.use(helpers)

import VueRouter from 'vue-router'
import Loading from 'vue-loading-overlay'
import 'vue-loading-overlay/dist/vue-loading.css'
import router from './router'
import moment from 'moment'
import BootstrapVue from 'bootstrap-vue'
import VuejsDialog from "vuejs-dialog"

import 'vuejs-dialog/dist/vuejs-dialog.min.css';

import DateRangePicker from 'vue2-daterange-picker'
//you need to import the CSS manually (in case you want to override it)
import 'vue2-daterange-picker/dist/vue2-daterange-picker.css'

Vue.component('date-range-picker', DateRangePicker)


import SequentialEntrance from 'vue-sequential-entrance'
import 'vue-sequential-entrance/vue-sequential-entrance.css'
Vue.use(SequentialEntrance);


Vue.use(moment);
Vue.use(VueRouter);
Vue.use(Loading);
Vue.use(BootstrapVue);
Vue.use(VuejsDialog)

window.$ = require('jquery')

Vue.component('AreaChart', require('./components/charts/AreaChart').default);
Vue.component('PieChart', require('./components/charts/PieChart').default);
Vue.component('DoughnutChart', require('./components/charts/DoughnutChart').default);
Vue.component('BarChart', require('./components/charts/BarChart').default);
Vue.component('RadarChart', require('./components/charts/RadarChart').default);
Vue.component('LineChart', require('./components/charts/LineChart').default);
Vue.component('pagination', require('./components/PaginationComponent').default);
Vue.component('sidebar-menu', require('./components/SidebarMenu').default)

Vue.filter('format_date_time', function(value) {
    return moment(String(value)).format('DD MMM YYYY hh:mm a')
});
Vue.filter('format_date', function(value) {
    return moment(String(value)).format('DD MMM YYYY')
});


axios.interceptors.response.use(
    response => response,
    error => {
        if (error.response.status === 401) {
            localStorage.removeItem('token')
            window.location = '/securedportal'
        }

        return Promise.reject(error)
    }
)

axios.defaults.baseURL = '/securedportal/api/'

const app = new Vue({
    el: '#app',
    router
});