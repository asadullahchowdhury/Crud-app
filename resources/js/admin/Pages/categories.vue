<template>
    <div class="container">
        <!--page header start-->
        <div class="page-header d-flex justify-content-between align-items-center my-md-5 my-3">
            <div class="form-group position-relative">
                <input type="text" class="form-control" placeholder="Search" >
                <img class="search-icon" :src="`/images/search.svg`" alt="search">
            </div>
            <button type="button" class="btn btn-outline-dark h-45" ><span
                class="d-sm-inline-block d-none">Add</span> New
                Category
            </button>
        </div>
        <!--page header end  -->


<!--Page content start-->
        <div class="page-content">
            <div class="card list-card p-3 mb-3 rounded-4 shadow border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Categories</h3>
                    <a href="javascript:void(0)" class="btn btn-icon btn-light">
                        <img :src="`/images/trash.svg`" alt="trash">
                    </a>
                </div>

                <!--no data start-->
                <div class="card-body" >
                    <div class="page-no-data-text">
                        <div class="icon mb-5">
                            <img :src="`/images/no-data.svg`" alt="no data">
                        </div>
                        <div class="text mb-3">There are currently no categories.</div>
                        <span>Click “New” to add new category.</span>
                    </div>
                </div>
                <!--no data end  -->

            </div>
        </div>
<!--Page content end  -->
    </div>
</template>
