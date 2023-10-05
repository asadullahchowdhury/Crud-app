<template>
    <div class="container">
        <!--page header start-->
        <div class="page-header d-flex justify-content-between align-items-center my-md-5 my-3">
            <div class="form-group position-relative">
                <input type="text" class="form-control" placeholder="Search">
                <img class="search-icon" :src="`/images/search.svg`" alt="search">
            </div>
            <button type="button" class="btn btn-outline-dark h-45"><span
                class="d-sm-inline-block d-none" @click="categoryModal(1,null) , console.log('123213')">Add</span> New
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
                <div class="card-body">
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


        <!--category modal start-->
        <div class="modal fade" id="categoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="categoryModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="categoryModalLabel">Create Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="">
                    <div class="modal-body">
                     <div class="form-group">
                         <input type="text" placeholder="Category Name" name="name" v-model="categoryParam.name">
                     </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary w-100px" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-outline-dark w-100px">Confirm</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!--category modal end  -->
    </div>
</template>


<script>
export default {
    data() {
        return {
            categoryParam: {
                name: '',
            }
        }
    },

    mounted() {
    },

    methods: {


        // =========================
        // Product modal open/close
        // =========================
        categoryModal(type, data = null) {

            if (type === 1) {
                this.categoryParam = {
                    name: '',
                }
                let modal = new bootstrap.Modal(document.getElementById('categoryModal'))
                modal.show();
            } else if (type === 2) {
                this.categoryParam = {
                    name: data.name,
                }
                let modal = new bootstrap.Modal(document.getElementById('categoryModal'))
                modal.show();
            } else if (type === 3) {
                const Modal = document.querySelector('#categoryModal');
                const Instance = bootstrap.Modal.getInstance(Modal);
                Instance.hide();
            }
        },
    }
}
</script>
