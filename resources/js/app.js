require('./bootstrap');

import Vue from "vue";
import Vuetify from "./plugins/vuetify";
import VueRouter from 'vue-router';
import routes from "./routes";
import App from "./pages/app";

import store from "./store"

Vue.use(VueRouter);
Vue.use(Vuetify);

// Filters
Vue.filter('truncate_title_xs', function(value){
    if(value.length >= 50){
        return value.slice(0, 50) + '...'
    }
    else{
        return value
    }
})

Vue.filter('truncate_title_sm', function(value){
    if(value.length >= 100){
        return value.slice(0, 100) + '...'
    }
    else{
        return value
    }
})

Vue.filter('truncate_title_md', function(value){
    if(value.length >= 190){
        return value.slice(0, 190) + '...'
    }
    else{
        return value
    }
})

const app = new Vue({
    vuetify: Vuetify,
    store,
    el: '#app',
    router: new VueRouter(routes),
    components: {
        App
    }
});
