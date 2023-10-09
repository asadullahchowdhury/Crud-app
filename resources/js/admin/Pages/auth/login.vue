<template>

    <div class="auth-page">
        <div class="auth-bg-wrap">
            <img src="/images/undraw_through_the_park_lxnl.svg" alt="">
        </div>
        <div class="auth-box d-flex justify-content-center align-items-center">

            <form action="" class="auth-form py-5 px-4 rounded-5 shadow-lg bg-white">
                <div class="logo text-center mb-5">
                    <img src="/images/Rahat-logo.png" alt="logo" class="img-fluid">
                </div>
                <div class="form-group position-relative mb-3">
                    <input type="text" class="form-control shadow-none rounded-pill" placeholder="Enter Your Email"
                           name="email">
                    <div class="form-icon">
                        <img src="/images/mail.svg" alt="mail">
                    </div>
                </div>
                <div class="form-group position-relative mb-3">
                    <input :type="passwordFieldType" class="form-control shadow-none rounded-pill"
                           placeholder="Enter Your Password"
                           name="password">
                    <div class="form-icon">
                        <img src="/images/lock.svg" alt="lock">
                    </div>
                    <div class="eye-icon" @click="switchVisibility()">
                        <img class="eye-hide" src="/images/eye-off.svg" alt="eye off" v-if="passwordFieldType === 'Password'">
                        <img class="eye-show" src="/images/eye.svg" alt="eye" v-if="passwordFieldType === 'Text'">
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="remeber-me">
                        <input type="checkbox" class="form-check-input" id="remeber-me">
                        Remember Me?
                    </label>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-outline-dark w-50 rounded-pill">Login</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            passwordFieldType: 'Password',
        }
    },
    mounted() {
    },
    methods:{
        switchVisibility() {
           if (this.passwordFieldType === 'Password'){
               this.passwordFieldType = 'Text'
           }else {
               this.passwordFieldType = 'Password'
           }
        },
    }
}
</script>
