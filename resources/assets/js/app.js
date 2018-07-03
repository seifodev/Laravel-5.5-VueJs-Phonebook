
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'

Vue.use(VueRouter)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.config.productionTip = false;

let AppHeader = require('./components/AppHeader.vue');
let AppFooter = require('./components/AppFooter.vue');

let AppHome = require('./components/AppHome.vue');
let AppAbout = require('./components/AppAbout.vue');

const routes = [
    { path: '/home', component: AppHome },
    { path: '/about', component: AppAbout }
];

const router = new VueRouter({
    // mode: 'history',
    routes // short for `routes: routes`
});


const app = new Vue({
    el: '#app',
    router,
    components: {
        'app-header': AppHeader,
        'app-footer': AppFooter,
    }
});
