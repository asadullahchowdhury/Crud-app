<template>
    <div class="container">
        <div class="page-header d-flex justify-content-between align-items-center my-5">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search" v-model="param.keyword"
                       @keyup="SearchData">
            </div>
            <button type="button" class="btn btn-outline-dark" @click="productModal(1,null)">Add New
                Product
            </button>
        </div>

        <div class="page-content">

            <div class="card list-card p-3 rounded-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Products</h3>
                    <a href="javascript:void(0)" class="btn btn-icon" v-if="selectedData.length > 0"
                       @click="ManageDeleteModal(1,selectedData)">
                        <img :src="`/images/trash.svg`" alt="trash">
                    </a>
                </div>


                <div class="card-body" v-if="listLoading === false  && tableData.length > 0">
                    <div class="table-wrap table-responsive">
                        <table class="table table-borderless">
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
                                <th>Price</th>
                                <th>Description</th>
                                <th>
                                    Image
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
                                <td>
                                    {{ each.price }}
                                </td>

                                <td>
                                    <div class="desc">
                                        {{ each.description }}
                                    </div>
                                </td>

                                <td>
                                    <div class="img-wrap no-image" v-if="each.image === null"></div>
                                    <div class="img-wrap has-image" v-if="each.image != null">
                                        <img :src="each.media.full_file_path" alt="">
                                    </div>
                                </td>
                                <td class="text-end position-relative">
                                    <a class="option-btn outsideClick px-3" @click="toggleDropdown($event)">
                                        <img :src="`/images/three-dots.svg`" alt="three dots">
                                        <div class="dropdown-wrapper outsideClick">
                                            <ul>
                                                <li><a href="javascript:void(0)"
                                                       @click="productModal(2,each)">Edit</a>
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

                <div class="card-body" v-if="listLoading === false  && tableData.length === 0">
                    <!--no data start-->
                    <div class="page-no-data-text">
                        <div class="icon mb-5">
                            <img :src="`/images/no-data.svg`" alt="no data">
                        </div>
                        <div class="text mb-3">There are currently no products.</div>
                        <span>Click “New” to add new products.</span>
                    </div>
                    <!--no data end  -->
                </div>

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
                    <div class="d-flex justify-content-center">
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

        <!--Product  Modal start-->
        <div class="modal fade" id="manageModal" tabindex="-1" aria-labelledby="manageModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="manageModalLabel">
                            <span v-if="productParam.id === ''">Create Product</span>
                            <span v-if="productParam.id != ''">Update Product</span>
                        </h1>
                        <button type="button" class="btn-close" @click="productModal(3,null)"></button>
                    </div>
                    <form @submit.prevent="manageProduct">
                        <div class="modal-body">

                            <div class="form-group mb-3">
                                <div class="form-label">
                                    Name
                                </div>
                                <input class="form-control" placeholder="Product Name" name="name"
                                       v-model="productParam.name">
                                <div class="error-report text-danger d-block" style="font-size: 12px"></div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="form-label">
                                    Price
                                </div>
                                <input class="form-control" placeholder="Product Price" name="price"
                                       v-model="productParam.price">
                                <div class="error-report text-danger d-block" style="font-size: 12px"></div>
                            </div>
                            <div class="form-group mb-3 ">
                                <div class="form-label">
                                    Description
                                </div>
                                <textarea id="" cols="30" rows="4" class="form-control"
                                          v-model="productParam.description"
                                          placeholder="Product description" name="description"></textarea>
                                <div class="error-report text-danger d-block" style="font-size: 12px"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="image-input" class="upload-wrap">
                                    <input type="file" class="d-none" id="image-input" @change="attachFile($event)"
                                           accept="image/png, image/gif, image/jpeg">
                                    Upload image
                                </label>
                            </div>

                            <div class="brand-wrap position-relative" v-if="productParam.image != null">
                                <div class="branding-logo-wrap">
                                    <img :src="product_image_path" class="img-fluid logo" alt="Product image">
                                </div>
                                <div class="remove-icon btn-icon" @click="removeImage">
                                    <img :src="`/images/trash.svg`" alt="delete">
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary w-100px" @click="productModal(3)">Close
                            </button>
                            <button type="submit" class="btn btn-primary w-100px" v-if="createLoading !=true">Confirm
                            </button>
                            <button type="button" class="btn btn-primary btn-loading w-100px"
                                    v-if="createLoading === true"></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!--Product  Modal end  -->

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
                                @click="deleteProduct()"
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
import ApiService from "../Services/apiService.js";

const toaster = createToaster({
    position: 'top-right',
});
export default {
    data() {
        return {
            createLoading: false,
            deleteLoading: false,
            listLoading: false,
            imageLoading: false,
            tableData: [],
            selectedData: [],
            productParam: {
                name: '',
                price: '',
                description: '',
                image: null,
            },
            product_image_path: null,
            param: {
                keyword: '',
                date: 'today',
                limit: 10,
            },

            /*Pagination Variables*/
            total_pages: 0,
            current_page: 0,
            buttons: [],

            /*search*/
            searchTimeout: null,

            delete_param: {
                id: '',
            }
        }
    },
    mounted() {
        this.getList();
        this.outsideClick();
    },
    methods: {
        getList() {
            this.listLoading = true;
            apiService.POST(apiRoutes.ProductList, this.param, (res) => {
                this.listLoading = false;
                if (res.status == 200) {
                    this.tableData = res.data.data


                    this.total_pages = res.data.total < res.data.per_page ? 1 : Math.ceil((res.data.total / res.data.per_page))
                    this.current_page = res.data.current_page;
                    this.buttons = [...Array(this.total_pages).keys()].map(i => i + 1);
                }
            })
        },


        productModal(type, data = null) {

            if (type === 1) {
                this.productParam = {
                    id:'',
                    name: '',
                    price: '',
                    description: '',
                    image: null,
                }
                let modal = new bootstrap.Modal(document.getElementById('manageModal'))
                modal.show();
            } else if (type === 2) {
                this.productParam = {
                    id: data.id,
                    name: data.name,
                    price: data.price,
                    description: data.description,
                    image: data.image,
                }
                this.product_image_path = data.media.full_file_path
                console.log(data)
                let modal = new bootstrap.Modal(document.getElementById('manageModal'))
                modal.show();
            } else if (type === 3) {
                console.log('hide')
                const Modal = document.querySelector('#manageModal');
                const Instance = bootstrap.Modal.getInstance(Modal);
                Instance.hide();
            }
        },

        manageProduct() {
            this.createLoading = true;
            let url = null;
            if (this.productParam.id === '') {
                url = apiRoutes.ProductCreate
            } else {
                url = apiRoutes.ProductUpdate
            }
            apiService.POST(url, this.productParam, (res) => {
                this.createLoading = false
                if (res.status === 200) {
                    console.log('api')
                    this.productModal(3,null);
                    this.getList();
                    this.product_image_path =  this.tableData.media.full_file_path;
                    toaster.info(res.msg)
                } else {
                    apiService.ErrorHandler(res.errors)
                    console.log(ApiService.ErrorHandler(res.errors))
                }
            })
        },

        /* product image attachment */
        attachFile(event) {
            this.imageLoading = true;
            let file = event.target.files[0];
            let formData = new FormData();
            formData.append("file", file)
            formData.append("media_type", 1);
            apiService.UPLOAD(apiRoutes.Media, formData, (res) => {
                event.target.value = ''
                this.imageLoading = false
                if (res.status === 200) {
                    this.productParam.image = res.data.id
                    this.product_image_path = res.data.full_file_path
                }
            })

        },

        removeImage() {
            this.productParam.image = null
            this.product_image_path = null
        },

        /*pagination functions*/
        PrevPage() {
            if (this.current_page > 1) {
                this.current_page = this.current_page - 1;
                this.getList()
            }
        },

        NextPage() {
            if (this.current_page < this.total_pages) {
                this.current_page = this.current_page + 1;
                this.getList()
            }
        },

        pageChange(page) {
            this.current_page = page;
            this.getList();
        },


        /*option dropdown*/
        toggleDropdown(e) {
            let visitorDrop = e.currentTarget.querySelector('.dropdown-wrapper')
            if (visitorDrop.classList.contains('active')) {
                visitorDrop.classList.remove('active')
            } else {
                visitorDrop.classList.add('active')
            }

        },


        /*outside click*/
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

        /* delete modal show/hide */
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


        deleteProduct() {
            this.deleteLoading = true;
            console.log(this.delete_param.id)
            apiService.POST(apiRoutes.ProductDelete, this.delete_param, (res) => {
                this.deleteLoading = false;
                if (res.status === 200) {
                    toaster.info(res.msg)
                    this.selectedData = []
                    this.getList();
                    this.ManageDeleteModal(2, null)
                }
            })
        },

        // Search Data
        SearchData() {
            clearInterval(this.searchTimeOut);
            this.highlightText()
            this.searchTimeOut = setTimeout(() => {
                this.current_page = 1;
                this.getList();
            }, 800)
        },


        /* highlight text*/
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


        /*check all data*/
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

        /*toggleCheck*/
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


        /*check if exists*/
        checkIfChecked(id) {
            return this.selectedData.indexOf(id) > -1;
        },

        /*check if exists*/
        checkIfExists(id) {
            return this.selectedData.includes(id);
        }

    }
}
</script>
