import {createRouter, createWebHistory} from "vue-router"


import Layout from "../Layout/layout.vue";
import Home from "../Pages/home.vue";
import Products from "../Pages/products.vue";
import Categories from "../Pages/categories.vue";
import Login from "../Pages/auth/login.vue"


const ROOT_URL = "/admin"
const routes = [
    // Authentication
    {path: ROOT_URL + '/auth', redirect: {name: 'Login'}},
    {path: ROOT_URL + '/auth/login', name: 'Login', component: Login, meta: {title: 'Login'}},

    {
        path: ROOT_URL, name: 'Layout' , component:Layout,
        children:[
            {path: ROOT_URL + '/home', name: 'home', component: Home, meta: {title: 'Home'}},
            {path: ROOT_URL + '/products', name: 'products', component: Products, meta: {title: 'Products'}},
            {path: ROOT_URL + '/categories', name: 'categories', component: Categories, meta: {title: 'Categories'}},
        ]
    },

]


const router = createRouter({
    history: createWebHistory(),
    routes
})


export default router ;
