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
import Example from './components/ExampleComponent';
import Home from './components/HomeComponent';
const router=new VueRouter({
    mode:'history',
    routes:[
        {path:'/home',name:'home',component:Home},
        {path:'/example',name:'example',component:Example},
    ]
});
// const app = new Vue({
//     el: '#app',
//     components:{Home},
//     router
// });
const app = new Vue({
    el: '#app',
    components:{Home},
    router
});
