<template>
    <div class="layout-body">
        <div class="main-section">
            <Header/>
            <div class="inner-section">
                <div class="route-body">
                    <router-view/>
                </div>
            </div>
        </div>

    </div>
</template>


<script>
import Header from '../Layout/includes/header.vue'

export default {
    components:{
        Header,
    }
}
</script>
