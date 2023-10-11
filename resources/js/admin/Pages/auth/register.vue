<template>

    <div class="auth-page">
        <div class="auth-bg-wrap">
            <img :src="`/images/undraw_through_the_park_lxnl.svg`" alt="">
        </div>

        <div class="auth-box d-flex justify-content-center align-items-center">

            <form @submit.prevent="register()" class="auth-form reg-form py-5 px-4 rounded-5 shadow-lg bg-white">
                <div class="logo text-center mb-5">
                    <img :src="`/images/Rahat-logo.png`" alt="logo" class="img-fluid">
                </div>
                <div class="error-report-g text-center"></div>

                <div class="form-group position-relative mb-3">
                    <input type="text" class="form-control shadow-none rounded-pill" placeholder="First Name"
                           v-model="registerParam.first_name"
                           name="first_name">
                    <div class="error-report text-danger"></div>
                </div>

                <div class="form-group position-relative mb-3">
                    <input type="text" class="form-control shadow-none rounded-pill" placeholder="Last Name"
                           v-model="registerParam.last_name"
                           name="last_name">
                    <div class="error-report text-danger"></div>
                </div>


                <div class="form-group position-relative mb-3">
                    <input type="text" class="form-control shadow-none rounded-pill" placeholder="E-mail Address"
                           v-model="registerParam.email"
                           name="email">
                    <div class="error-report text-danger"></div>
                </div>

                <div class="form-group position-relative mb-3">
                    <input type="text" class="form-control shadow-none rounded-pill" placeholder="Phone Number"
                           v-model="registerParam.mobile"
                           name="mobile">
                    <div class="error-report text-danger"></div>
                </div>

                <div class="form-group position-relative mb-3">
                    <input type="password" class="form-control shadow-none rounded-pill"
                           v-model="registerParam.password"
                           placeholder="New Password"
                           name="password">
                    <div class="error-report text-danger"></div>
                </div>

                <div class="form-group position-relative mb-4">
                    <input type="password" class="form-control shadow-none rounded-pill"
                           v-model="registerParam.password_confirmation"
                           placeholder="Confirm New Password"
                           name="password_confirmation">
                    <div class="error-report text-danger"></div>
                </div>


                <div class="form-group text-center">
                    <button type="submit" class="btn btn-outline-dark w-50 rounded-pill" v-if="loading != true">Sign up
                    </button>
                    <button type="button" class="btn btn-outline-dark w-50 rounded-pill btn-loading"
                            v-if="loading === true"></button>
                </div>

                <div class="auth-bottom text-center mt-4">
                    Already have and account?
                    <router-link :to="{name:'Login'}" href="javascript:void(0)"
                                 class=" ms-2 text-decoration-none fw-semibold text-dark">Sign in
                    </router-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import apiService from "../../Services/apiService";
import apiRoutes from "../../Services/apiRoutes";
import {createToaster} from "@meforma/vue-toaster";


const toaster = createToaster({
    position: 'top-right',
});

export default {
    data() {
        return {

            loading: false,
            registerParam: {
                first_name: '',
                last_name: '',
                email: '',
                mobile: '',
                password: '',
                password_confirmation: '',
            }
        }
    },
    mounted() {
    },
    methods: {


        register() {
            this.loading = true;
            apiService.POST(apiRoutes.Register, this.registerParam, (res) => {
                this.loading = false;
                if (res.status === 200) {
                    toaster.info(res.msg)
                } else {
                    apiService.ErrorHandler(res.errors)
                }
            })
        }
    }
}
</script>
