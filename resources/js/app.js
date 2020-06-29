/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import $ from 'jquery';


import VueRouter from 'vue-router';
Vue.use(VueRouter);
import VueLoading from 'vuejs-loading-plugin';
Vue.use(VueLoading);
import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '2px'
})
import VueToastr from "vue-toastr";
Vue.use(VueToastr);
Vue.config.productionTip = false;

import vueSimpleAlert from 'vue-simple-alert';
Vue.use(vueSimpleAlert);
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'

import Example from './components/ExampleComponent';
import Home from './components/HomeComponent';
import Candidato from './components/CandidatoComponent';
const router=new VueRouter({
    mode:'history',
    routes:[
        {path:'/home',name:'home',component:Home},
        {path:'/candidato',name:'candidato',component:Candidato},
    ]
});
// const app = new Vue({
//     el: '#app',
//     components:{Home},
//     router
// });
const app = new Vue({
    // render: h => h(Home),
    el: '#app',
    components:{
        Home,
        PulseLoader
    },
    router,
    mounted() {
        // You are able to access plugin from everywhere via this.$toastr
        this.$toastr.defaultPosition = "toast-top-left";
        // Send message to browser screen
        // let pdfName = 'test';
        // var doc = new jsPDF();
        // doc.text("Hello World", 10, 10);
        // doc.save(pdfName + '.pdf');
    }
});
