import 'bootstrap/dist/css/bootstrap.css'
import bootstrap from 'bootstrap/dist/js/bootstrap.bundle.min'
window.bootstrap = bootstrap

import axios from "axios";
import Toaster from "@meforma/vue-toaster";


/*
* *******************************************************************
*  Jquery
* *******************************************************************
* */
import jQuery from "jquery";
const $ = jQuery;
window.$ = $;



import App from "./App.vue";
import {createApp} from "vue";
import router from "./Router/admin-routes";


createApp(App)
    .use(router, axios, Toaster)
    .mount('#app')

