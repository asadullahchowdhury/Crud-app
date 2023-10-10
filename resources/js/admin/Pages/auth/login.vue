<template>

    <div class="auth-page">
        <div class="auth-bg-wrap">
            <img :src="`/images/undraw_through_the_park_lxnl.svg`" alt="">
        </div>
        <div class="auth-box d-flex justify-content-center align-items-center">

            <form @submit.prevent="login()" class="auth-form login-form py-5 px-4 rounded-5 shadow-lg bg-white">
                <div class="logo text-center mb-5">
                    <img :src="`/images/Rahat-logo.png`" alt="logo" class="img-fluid">
                </div>
                <div class="error-report-g text-center"></div>
                <div class="form-group position-relative mb-3">
                    <input type="text" class="form-control shadow-none rounded-pill" placeholder="Enter Your Email"
                           v-model="param.email"
                           name="email">
                    <div class="form-icon">
                        <img :src="`/images/mail.svg`" alt="mail">
                    </div>

                    <div class="error-report text-danger"></div>
                </div>

                <div class="form-group position-relative mb-3">
                    <input :type="passwordFieldType" class="form-control shadow-none rounded-pill"
                           v-model="param.password"
                           placeholder="Enter Your Password"
                           name="password">
                    <div class="form-icon">
                        <img :src="`/images/lock.svg`" alt="lock">
                    </div>
                    <div class="eye-icon" @click="switchVisibility()">
                        <img class="eye-hide" :src="`/images/eye-off.svg`" alt="eye off"
                             v-if="passwordFieldType === 'Password'">
                        <img class="eye-show" :src="`/images/eye.svg`" alt="eye" v-if="passwordFieldType === 'Text'">
                    </div>
                    <div class="error-report text-danger"></div>
                </div>

                <div class="form-group mb-4">
                    <label for="remember-me" class="user-select-none">
                        <input type="checkbox" class="form-check-input" id="remember-me">
                        Remember Me?
                    </label>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-outline-dark w-50 rounded-pill" v-if="loading != true">Login
                    </button>
                    <button type="button" class="btn btn-outline-dark w-50 rounded-pill btn-loading"
                            v-if="loading === true"></button>
                </div>

                <div class="auth-bottom text-center mt-4">
                    Not a member? <router-link :to="{name:'Register'}" href="javascript:void(0)" class=" ms-2 text-decoration-none fw-semibold text-dark">Create
                    an account</router-link>
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
            passwordFieldType: 'Password',
            loading: false,
            param: {
                email: '',
                password: '',
            }
        }
    },
    mounted() {
    },
    methods: {
        switchVisibility() {
            if (this.passwordFieldType === 'Password') {
                this.passwordFieldType = 'Text'
            } else {
                this.passwordFieldType = 'Password'
            }
        },


        login() {
            this.loading = true;
            apiService.POST(apiRoutes.Login, this.param, (res) => {
                this.loading = false;
                if (res.status === 200) {
                    toaster.info(res.msg)
                    window.location.href = '/admin/home';
                } else {
                    apiService.ErrorHandler(res.errors)
                }
            })
        }
    }
}
</script>
