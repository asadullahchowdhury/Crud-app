<template>
    <div class="header">
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

                   <div class="right-side-header">
                       <div class="user-wrap d-flex align-items-center position-relative" @click="dropdownToggle()">
                           <div class="avatar-wrap shadow me-3">
                               <img :src="`/images/auth.svg`" alt="avatar">
                           </div>
                           <div class="user-info " >
                               <div class="name mb-1 fw-semibold">Admin</div>
                               <div class="email text-muted">admin@gmail.com</div>
                           </div  >

                           <div class="header-dropdown-wrap shadow rounded-4 outsideClick">
                               <ul class="header-dropdown">
                                   <li class="rounded-4"><a href="javascript:void(0)">Profile</a></li>
                                   <li class="rounded-4"><a class="text-danger" href="javascript:void(0)" @click="logout()">Logout</a></li>
                               </ul>
                           </div>
                       </div>
                   </div>
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
            logoutLoading: false,
            profileLoading: false,
            profileData: '',
        }
    },
    mounted() {
        // =========================
        // getting profile data on load
        // =========================
        this.getProfile()

        this.outsideClick()
    },
    methods: {
        // =========================
        // log out api
        // =========================
        logout() {
            this.logoutLoading = true

            apiService.POST(apiRoutes.Logout, (res) => {
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

        // =========================
        // profile data api
        // =========================
        getProfile() {
            this.profileLoading = true;
            apiService.POST(apiRoutes.Profile, (res) => {
                this.profileLoading = false;
                if (res.status === 200) {
                    this.profileData = res.data
                }
            })
        },


        // =========================
        // Header dropdown toggle
        // =========================
        dropdownToggle() {
            let dropdown = document.querySelector('.header-dropdown-wrap');
            if (dropdown.classList.contains('active')) {
                dropdown.classList.remove('active');
            } else {
                dropdown.classList.add('active');
            }
        },

        // =========================
        // Outside Click
        // =========================
        outsideClick() {
            document.addEventListener('mouseup', function (e) {
                const containers = Array.from(document.querySelectorAll('.outsideClick'));
                for (let i = 0; i < containers.length; i++) {
                    const clickedElement = e.target;
                    const isContainer = containers[i].contains(clickedElement);
                    if (isContainer) {
                        break;
                    } else {
                        containers[i].classList.remove('active');
                    }
                }
            });
        }
    }
}
</script>


