import "bootstrap/dist/js/bootstrap.bundle.min"
import axios from "axios";
import Toaster from "@meforma/vue-toaster";


import App from "./App.vue";
import {createApp} from "vue";
import router from "./Router/admin-routes";


createApp(App)
    .use(router, axios, Toaster)
    .mount('#app')

