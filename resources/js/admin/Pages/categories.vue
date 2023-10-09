<template>
    <div class="container">
        <!--page header start-->
        <div class="page-header d-flex justify-content-between align-items-center my-md-5 my-3">
            <div class="form-group position-relative">
                <input type="text" class="form-control" placeholder="Search" v-model="param.keyword" @keyup="SearchData()">
                <img class="search-icon" :src="`/images/search.svg`" alt="search">
            </div>
            <button type="button" class="btn btn-outline-dark h-45" @click="categoryModal(1,null)"><span
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
                    <a href="javascript:void(0)" class="btn btn-icon btn-light" v-if="selectedData.length > 0"
                       @click="ManageDeleteModal(1,selectedData)">
                        <img :src="`/images/trash.svg`" alt="trash">
                    </a>
                </div>

                <!--main table-->
                <div class="card-body d-md-block d-none" v-if="listLoading === false  && tableData.length > 0">
                    <div class="table-wrap h-100 table-responsive">
                        <table class="table table-borderless table-hover">
                            <thead>
                            <tr>
                                <th class="checkbox-wrap">
                                    <label class="form-check ">
                                        <input class="form-check-input" type="checkbox"
                                               :checked="tableData.length > 0 && tableData.length === selectedData.length"
                                               @change="toggleCheckAll($event),console.log(selectedData)">
                                    </label>
                                </th>

                                <th>Name</th>

                                <th>

                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr v-for="(each,index) in tableData">
                                <td class="checkbox-wrap">
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                               :checked="checkIfChecked(each.id)"
                                               @change="toggleCheck($event, each.id)">
                                    </label>
                                </td>
                                <td class="text-highlight">
                                    {{ each.name }}
                                </td>

                                <td class="text-end position-relative">
                                    <a class="option-btn outsideClick px-3" @click="toggleDropdown($event)">
                                        <img :src="`/images/three-dots.svg`" alt="three dots">
                                        <div class="dropdown-wrapper outsideClick">
                                            <ul>
                                                <li><a href="javascript:void(0)"
                                                       @click="categoryModal(2,each)">Edit</a>
                                                </li>
                                                <li><a href="javascript:void(0)"
                                                       @click=" ManageDeleteModal(1,each)">Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!--responsive table start-->
                <div class="card-body d-md-none d-block" v-if="listLoading === false && tableData.length > 1">
                    <div class="res-table-wrap">
                        <!--each responsive table data-->
                        <div class="each-td-res mb-3" v-for="(each,index) in tableData">
                            <div class="card rounded-4">
                                <div class="p-3">
                                    <div class="row">
                                        <div class="col-10"></div>
                                        <div class="col-2">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"
                                                       :checked="checkIfChecked(each.id)"
                                                       @change="toggleCheck($event, each.id)">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-6"><strong>Name :</strong></div>
                                        <div class="col-sm-8 col-6 text-end">{{ each.name }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--each responsive table data-->
                    </div>
                </div>
                <!--responsive table end  -->

                <!--main table-->

                <!--no data start-->
                <div class="card-body" v-if="tableData.length === 0 && listLoading === false">
                    <div class="page-no-data-text">
                        <div class="icon mb-5">
                            <img :src="`/images/no-data.svg`" alt="no data">
                        </div>
                        <div class="text mb-3">There are currently no categories.</div>
                        <span>Click “New” to add new category.</span>
                    </div>
                </div>
                <!--no data end  -->

                <!--loading-->
                <div class="card-body" v-if="listLoading === true">
                    <h6 class=" placeholder-glow" style="padding-top:10px;">
                        <span class="placeholder col-12" style="height: 28px; margin-bottom: 20px"></span>
                        <span class="placeholder col-11" style="height: 28px; margin-bottom: 20px"></span>
                        <span class="placeholder col-6" style="height: 28px; margin-bottom: 20px"></span>
                        <span class="placeholder col-8" style="height: 28px; margin-bottom: 20px"></span>
                        <span class="placeholder col-8" style="height: 28px; margin-bottom: 20px"></span>
                    </h6>
                </div>
                <!--loading-->

                <div class="card-footer border-0 bg-white">
                    <!-- Pagination Start -->
                    <div class="d-flex justify-content-center" v-if="listLoading === false  && tableData.length > 0">
                        <div class="pagination">
                            <div class="page-item" @click="PrevPage()">
                                <a class="page-link" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                         fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                         stroke-linejoin="round" class="acorn-icons acorn-icons-chevron-left undefined">
                                        <path
                                            d="M13 16L7.35355 10.3536C7.15829 10.1583 7.15829 9.84171 7.35355 9.64645L13 4"></path>
                                    </svg>
                                </a>
                            </div>
                            <div v-if="buttons.length <= 6">
                                <div v-for="(page, index) in buttons" class="page-item"
                                     :class="{'active': current_page == page}">
                                    <a class="page-link" @click="pageChange(page)" href="javascript:void(0)"
                                       v-text="page"></a>
                                </div>
                            </div>
                            <div v-if="buttons.length > 6">
                                <div class="page-item" :class="{'active': current_page == 1}">
                                    <a class="page-link" @click="pageChange(1)"
                                       href="javascript:void(0)">1</a>
                                </div>

                                <div v-if="current_page > 3" class="page-item">
                                    <a class="page-link" @click="pageChange(current_page - 2)"
                                       href="javascript:void(0)">...</a>
                                </div>

                                <div v-if="current_page == buttons.length" class="page-item"
                                     :class="{'active': current_page == (current_page - 2)}">
                                    <a class="page-link" @click="pageChange(current_page - 2)"
                                       href="javascript:void(0)" v-text="current_page - 2"></a>
                                </div>

                                <div v-if="current_page > 2" class="page-item"
                                     :class="{'active': current_page == (current_page - 1)}">
                                    <a class="page-link" @click="pageChange(current_page - 1)"
                                       href="javascript:void(0)" v-text="current_page - 1"></a>
                                </div>

                                <div v-if="current_page != 1 && current_page != buttons.length"
                                     class="page-item active">
                                    <a class="page-link" @click="pageChange(current_page)" href="javascript:void(0)"
                                       v-text="current_page"></a>
                                </div>

                                <div v-if="current_page < buttons.length - 1" class="page-item"
                                     :class="{'active': current_page == (current_page + 1)}">
                                    <a class="page-link" @click="pageChange(current_page + 1)"
                                       href="javascript:void(0)" v-text="current_page + 1"></a>
                                </div>

                                <div v-if="current_page == 1" class="page-item"
                                     :class="{'active': current_page == (current_page + 2)}">
                                    <a class="page-link" @click="pageChange(current_page + 2)"
                                       href="javascript:void(0)" v-text="current_page + 2"></a>
                                </div>

                                <div v-if="current_page < buttons.length - 2" class="page-item">
                                    <a class="page-link" @click="pageChange(current_page + 2)"
                                       href="javascript:void(0)">...</a>
                                </div>

                                <div class="page-item"
                                     :class="{'active': current_page == (current_page - buttons.length)}">
                                    <a class="page-link" @click="pageChange(buttons.length)"
                                       href="javascript:void(0)" v-text="buttons.length"></a>
                                </div>
                            </div>
                            <div class="page-item" @click="NextPage()">
                                <a class="page-link" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                         fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                         stroke-linejoin="round"
                                         class="acorn-icons acorn-icons-chevron-right undefined">
                                        <path
                                            d="M7 4L12.6464 9.64645C12.8417 9.84171 12.8417 10.1583 12.6464 10.3536L7 16"></path>
                                    </svg>
                                </a>
                            </div>

                        </div>
                    </div>
                    <!-- Pagination End -->
                </div>

            </div>
        </div>
        <!--Page content end  -->


        <!--category modal start-->
        <div class="modal fade" id="categoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="categoryModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="categoryModalLabel"><span
                            v-if="categoryParam.id === ''">Create</span><span
                            v-if="categoryParam.id != ''">Update</span> Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form @submit.prevent="manageCategory()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name" class="form-label">Category Name</label>
                                <input type="text" placeholder="Category Name" class="form-control" name="name"
                                       id="name" v-model="categoryParam.name">
                                <div class="error-report text-danger"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary w-100px" data-bs-dismiss="modal">Cancel
                            </button>
                            <button type="submit" class="btn btn-outline-dark w-100px" v-if="manageLoading != true">
                                Confirm
                            </button>
                            <button type="button" class="btn btn-outline-dark w-100px btn-loading"
                                    v-if="manageLoading === true"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--category modal end  -->

        <!--Delete Modal start-->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body p-5 text-center">
                        <div class="delete-icon mb-5">
                            <img :src="`/images/archive-red.svg`" alt="delete icon">
                        </div>
                        <h3 class="mb-5">Are you sure?</h3>

                        <button type="button" class="btn btn-outline-dark  w-100" aria-label="Confirm"
                                @click="deleteCategory()"
                                v-if="deleteLoading === false">
                            Confirm
                        </button>

                        <button v-if="deleteLoading === true"
                                class="btn btn-outline-dark btn-loading w-100">
                        </button>

                    </div>
                </div>
            </div>
        </div>
        <!--Delete Modal end  -->

    </div>
</template>


<script>
import apiService from "../Services/apiService.js";
import apiRoutes from "../Services/apiRoutes.js";
import {createToaster} from "@meforma/vue-toaster";


const toaster = createToaster({
    position: 'top-right',
});

export default {
    data() {
        return {
            manageLoading: false,
            listLoading: false,
            deleteLoading: false,
            categoryParam: {
                name: '',
            },
            param: {
                keyword: '',
                date: 'today',
                limit: 10,
                page: 1
            },
            tableData: [],

            /*Pagination Variables*/
            total_pages: 0,
            current_page: 0,
            buttons: [],

            /*search*/
            searchTimeout: null,

            selectedData: [],

            delete_param: {
                id: '',
            }
        }
    },

    mounted() {
        this.getCategoryList();

        this.outsideClick();
    },

    methods: {


        // =========================
        // Product modal open/close
        // =========================
        categoryModal(type, data = null) {
            apiService.ClearErrorHandler();
            if (type === 1) {
                this.categoryParam = {
                    id: '',
                    name: '',
                }
                let modal = new bootstrap.Modal(document.getElementById('categoryModal'))
                modal.show();
            } else if (type === 2) {
                this.categoryParam = {
                    id: data.id,
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

        // =========================
        // Category api (create/update)
        // =========================
        manageCategory() {
            this.manageLoading = true;
            let url = null;
            if (this.categoryParam.id === '') {
                url = apiRoutes.CategoryCreate
            } else {
                url = apiRoutes.CategoryUpdate
            }
            apiService.POST(url, this.categoryParam, (res) => {
                this.manageLoading = false;
                if (res.status === 200) {
                    this.categoryModal(3, null)
                    this.getCategoryList();
                    toaster.info(res.msg)
                } else {
                    apiService.ErrorHandler(res.errors)
                }
            })
        },

        // =========================
        // Category List api
        // =========================
        getCategoryList() {
            this.param.page = this.current_page;
            this.listLoading = true;
            apiService.POST(apiRoutes.CategoryList, this.param, (res) => {
                this.listLoading = false;
                if (res.status === 200) {
                    this.tableData = res.data.data
                    // pagination
                    this.total_pages = res.data.total < res.data.per_page ? 1 : Math.ceil((res.data.total / res.data.per_page))
                    this.current_page = res.data.current_page;
                    this.buttons = [...Array(this.total_pages).keys()].map(i => i + 1);
                    setTimeout(()=>{
                        this.highlightText()
                    }, 10)
                }
            })
        },

        // =========================
        // pagination previous
        // =========================
        PrevPage() {
            if (this.current_page > 1) {
                this.current_page = this.current_page - 1;
                this.getCategoryList()
            }
        },

        // =========================
        // pagination next
        // =========================
        NextPage() {
            if (this.current_page < this.total_pages) {
                this.current_page = this.current_page + 1;
                this.getCategoryList()
            }
        },

        // =========================
        // pagination per page
        // =========================
        pageChange(page) {
            this.current_page = page;
            this.getCategoryList();
        },


        // =========================
        // dropdown toggle
        // =========================
        toggleDropdown(e) {
            let visitorDrop = e.currentTarget.querySelector('.dropdown-wrapper')
            if (visitorDrop.classList.contains('active')) {
                visitorDrop.classList.remove('active')
            } else {
                visitorDrop.classList.add('active')
            }

        },


        // =========================
        // Outside click
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
        },

        // =========================
        // Delete modal show/hide
        // =========================
        ManageDeleteModal(type, id) {
            if (type === 1) {
                let myModal = new bootstrap.Modal(document.getElementById('deleteModal'))
                this.delete_param.id = id
                console.log(this.delete_param)
                myModal.show()
            } else {
                var myModalEl = document.getElementById('deleteModal');
                var modal = bootstrap.Modal.getInstance(myModalEl)
                modal.hide();
            }
        },

        // =========================
        // Product delete api
        // =========================
        deleteCategory() {
            this.deleteLoading = true;
            apiService.POST(apiRoutes.CategoryDelete, this.delete_param, (res) => {
                this.deleteLoading = false;
                if (res.status === 200) {
                    toaster.info(res.msg)
                    this.selectedData = []
                    this.getCategoryList();
                    this.ManageDeleteModal(2, null)
                }
            })
        },

        // =========================
        // Search data
        // =========================
        SearchData() {
            clearInterval(this.searchTimeOut);
            this.highlightText()
            this.searchTimeOut = setTimeout(() => {
                this.current_page = 1;
                this.getCategoryList();
            }, 800)
        },


        // =========================
        // Text Highlighter
        // =========================
        highlightText() {
            const searchText = this.param.keyword.replace(/\)/g, '\\)');
            const pattern = new RegExp(searchText, "gi");
            const wrappers = document.querySelectorAll('.text-highlight');
            wrappers.forEach(wrapper => {

                if (wrapper) {
                    wrapper.innerHTML = wrapper.textContent.replace(pattern, match => searchText == '' ? '' : `<mark>${match}</mark>`);
                }
            })
        },

        // =========================
        // Check all data
        // =========================
        toggleCheckAll(e) {
            if (e.target.checked) {
                this.tableData.forEach((each, index) => {
                    if (!this.checkIfExists(each.id)) {
                        this.selectedData.push(each.id)
                    }
                })
            } else {
                this.selectedData = []
            }
        },

        // =========================
        // Check single
        // =========================
        toggleCheck(e, id) {
            if (e.target.checked) {
                if (!this.checkIfExists(id)) {
                    this.selectedData.push(id)
                }
            } else {
                this.selectedData.forEach((v, i) => {
                    if (v === id) {
                        this.selectedData.splice(i, 1)
                    }
                })
            }
        },


        // =========================
        // Check if checked
        // =========================
        checkIfChecked(id) {
            return this.selectedData.indexOf(id) > -1;
        },

        // =========================
        // Check if checked
        // =========================
        checkIfExists(id) {
            return this.selectedData.includes(id);
        }
    }
}
</script>
