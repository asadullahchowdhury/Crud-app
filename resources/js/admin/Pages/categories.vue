<template>
    <div class="container">
        <!--page header start-->
        <div class="page-header d-flex justify-content-between align-items-center my-md-5 my-3">
            <div class="form-group position-relative">
                <input type="text" class="form-control" placeholder="Search" v-model="param.keyword"
                       @keyup="SearchData">
                <img class="search-icon" :src="`/images/search.svg`" alt="search">
            </div>
            <button type="button" class="btn btn-outline-dark h-45" @click="productModal(1,null)"><span
                class="d-sm-inline-block d-none">Add</span> New
                Product
            </button>
        </div>
        <!--page header end  -->
    </div>
</template>
