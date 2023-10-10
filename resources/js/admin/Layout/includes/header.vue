<template>
    <div>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm py-3">
            <div class="container">
                <a class="navbar-brand text-uppercase fw-bold" href="#">Crud App</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <router-link :to="{name:'home'}" class="nav-link active" aria-current="page">Home
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{name:'products'}" class="nav-link">Products</router-link>
                        </li>
                        <li class="nav-item ">
                            <router-link :to="{name:'categories'}" class="nav-link">Categories</router-link>
                        </li>

                    </ul>

                    <a href="javascript:void(0)" class="text-decoration-none text-dark" @click="logout">Logout</a>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
 import apiService from "../../Services/apiService";
 import apiRoutes from "../../Services/apiRoutes.js";
 import {createToaster} from "@meforma/vue-toaster";


 const toaster = createToaster({
     position: 'top-right',
 });
export default {

    data() {
        return {
            logoutLoading:false,
        }
    },
    mounted() {
    },
    methods: {
        /*logout*/
        logout() {
            this.logoutLoading = true

            apiService.GET(apiRoutes.Logout, (res) => {
                this.logoutLoading = false
                if (res.status === 200) {
                    toaster.info('Logout Successful', {
                        position:
                            "top-right"
                    });
                    // window.location.reload()
                }
            })

        },
    }
}
</script>


