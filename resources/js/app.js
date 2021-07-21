require('./bootstrap');

import Vue from "vue";
import Vuetify from "./plugins/vuetify";
import VueRouter from 'vue-router';
import routes from "./routes";
import App from "./pages/app";

Vue.use(VueRouter);
Vue.use(Vuetify);

// Filters
Vue.filter('truncate_title_xs', function(value){
    return value.slice(0, 50) + '...'
})

Vue.filter('truncate_title_sm', function(value){
    return value.slice(0, 100) + '...'
})

Vue.filter('truncate_title_md', function(value){
    return value.slice(0, 180) + '...'
})

// Vue.filter('truncate_text_xs', function(value){
//     return value.slice(0, 10) + '...'
// })

// Vue.filter('truncate_text_sm', function(value){
//     return value.slice(0,20) + '...'
// })

// Vue.filter('truncate_text_md', function(value){
//     return value.slice(0, 40) + '...'
// })

// Vue.filter('truncate_text_md', function(value){
//     return value.slice(0, 150) + '...'
// })

// Vue.filter('truncate_text_lg', function(value){
//     return value.slice(0, 80) + '...'
// })

const app = new Vue({
    vuetify: Vuetify,
    el: '#app',
    router: new VueRouter(routes),
    components: {
        App
    }
});
