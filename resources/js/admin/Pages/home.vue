<template>
    <div>
        <div class="container vh-75 d-flex justify-content-center align-items-center">
            <div class="h1">Home</div>
        </div>
    </div>
</template>

<script>
import apiService from "../Services/apiService";
import apiRoutes from "../Services/apiRoutes.js";

export default {
    data() {
        return {}
    },

    mounted() {
        this.getProfile()
    },

    methods: {
        getProfile(){
            apiService.GET(apiRoutes.Profile, (res) =>{
                console.log(res)
            })
        }
    }
}
</script>
