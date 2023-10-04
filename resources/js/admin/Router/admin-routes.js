import {createRouter, createWebHistory} from "vue-router"


import Layout from "../Layout/layout.vue";
import Home from "../Pages/home.vue";
import Products from "../Pages/products.vue";


const ROOT_URL = "/admin"
const routes = [

    {
        path: ROOT_URL, name: 'Layout' , component:Layout,
        children:[
            {path: ROOT_URL + '/home', name: 'home', component: Home, meta: {title: 'Home'}},
            {path: ROOT_URL + '/products', name: 'products', component: Products, meta: {title: 'Products'}},
        ]
    },

]


const router = createRouter({
    history: createWebHistory(),
    routes
})


export default router ;
