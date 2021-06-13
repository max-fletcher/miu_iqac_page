require('./bootstrap');

import Vue from "vue";
import Vuetify from "./plugins/vuetify";
import VueRouter from 'vue-router';
import routes from "./routes";
import App from "./components/app"

Vue.use(VueRouter);
Vue.use(Vuetify)

const app = new Vue({
    vuetify: Vuetify,
    el: '#app',
    router: new VueRouter(routes),
    components: {
        App
    }
});
