<template>
<div>
    <div class="main-content">
        <div class="px-2 px-xxl-4 py-2 py-lg-3 border-bottom border-gray-200 after-header">
            <div class="container-fluid px-0">

                <a href="javascript:void(0);" class="muze-hamburger d-block d-lg-none col-auto">
                    <img src="assets/icons/hamburger1.svg" alt="img">
                    <img src="assets/icons/close1.svg" style="width:20px;" class="menu-close" alt="img">
                </a>


                <div class="row align-items-center">
                    <div class="col">
                        <h1 class="h2 mb-0 lh-sm">Employees</h1>
                    </div>
                    <div class="col-auto d-flex align-items-center my-2 my-sm-0">
                        <div class="pb-3">
                            <ul class="nav nav-tabs nav-tabs-md nav-tabs-line position-relative zIndex-0">
                                <li class="nav-item">
                                    <router-link to="/employees" class="nav-link"><i class="fal fa-eye"></i>All Employees</router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/employees/create" class="nav-link"><i class="fal fa-eye"></i>Add Employee</router-link>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" href="product-categories.html"><i class="fal fa-layer-group"></i> Categories</a>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>


            </div>

        </div>

        <div class="p-2 p-xxl-4">

            <div class="row">
                <div class="col-xl-12 col-xxl-12">
                    <div class="card rounded-12 shadow-dark-80 border border-gray-50 mb-3 mb-xl-5">
                        <div class="d-flex align-items-center px-3 px-md-4 py-3 border-bottom border-gray-200">
                            <h5 class="card-header-title my-2 ps-md-3 font-weight-semibold">Add New Employee</h5>
                        </div>
                        <div class="card-body px-0 p-md-4">
                            <form class="px-3 form-style-two" id="form"
                            @submit.prevent="EditEmployee"
                            enctype="multipart/form-data">
                            <input type="hidden" v-model="customer.old_image">
                            <input type="hidden" v-model="customer.old_proof">


                                <div class="row">
                                    <div class="mb-4 mb-xl-5">
                                        <input type="file" name="image" @change="onFileChange" >
                                        <label class="form-label form-label-lg mb-3 mb-md-4">Photo (Optional)</label>
                                        <div class="d-flex align-items-center">
                                            <span class="avatar avatar-circle" v-if="customer.image" v-show="existimage">
                                            <img class="avatar-img" v-bind:src="'/storage/images/employees/'+ customer.image" alt="Employee">
                                            </span>
                                            <span class="avatar avatar-circle" v-else v-show="existimage">
                                            <img class="avatar-img" src="assets/img/avatar1.png" alt="Employee" v-show="existimage"> 
                                            </span>
                                            <span class="avatar avatar-circle">
                                            <img v-bind:src="imagePreview" width="100" height="100" v-show="showPreview" class="avatar-img"/>
                                            </span>
                                            
                                            <div class="ps-2 ps-md-3">
                                                <label class="text-primary font-weight-semibold d-block mb-1 mb-md-2">Upload Image</label>
                                                <a href="#0" class="text-gray-700 font-weight-semibold">
                                                    <i class="fal fa-pencil"></i> Edit
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-6 mb-md-4 pb-3">
                                        <label for="FullName" class="form-label form-label-lg">Employee Name</label>
                                        <input type="text" class="form-control form-control-xl" id="empName" placeholder="Enter employee name"  v-model="customer.name">
                                    </div>
                                    <div class="col-sm-6 mb-md-4 pb-3">
                                        <label for="Email" class="form-label form-label-lg">Designation</label>
                                        <select class="form-select form-select-xl" id="" v-model="customer.designation">
                                        <!-- <option v-for="option in options" :key="option.value">
                                                {{ option.text }}
                                            </option> -->
                                            <option value="driver">Driver</option>
                                            <option value="delivery_executive">Delivery Executive</option>
                                            <option value="cook">Cook</option>
                                            <option value="manager">Manager</option>
                                            <option value="branch_head">Branch Head</option>
                                            <option value="accountant">Accountant</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 mb-md-4 pb-3">
                                        <label for="empEmail" class="form-label form-label-lg">Email</label>
                                        <input type="email" class="form-control form-control-xl" id="empEmail" placeholder="Enter phone" v-model="customer.email">
                                    </div>
                                    <div class="col-sm-6 mb-md-4 pb-3">
                                        <label for="empPhone" class="form-label form-label-lg">Phone</label>
                                        <input type="number" class="form-control form-control-xl" id="empPhone" placeholder="Enter phone number" v-model="customer.phone">
                                    </div>
                                </div>

                                <hr style="margin: 20px -40px; opacity: 0.1;">

                                <h6 class="text-gray-700 mb-4">Employee Identity</h6>

                                <div class="row">
                                    <div class="col-sm-6 mb-md-4 pb-3">
                                        <label for="productInfo" class="form-label form-label-lg">ID Proof Copy </label>
                                        <input type="file" class="form-control form-control-xl" name="proof"  v-on:change="onImageChange">
                                        <a href="#0" class="circle circle-xl border border-gray-300">
                                                <!-- <img src="assets/img/placeholder-camera.png" alt="User Image"> -->
                                            <!-- <img v-bind:src="ProofPreview" width="100" height="100" v-show="showProofPreview"/>  -->

                                            <span class="avatar avatar-circle" v-if="customer.proof" v-show="existimageproof">
                                            <img class="avatar-img" v-bind:src="'/storage/images/employees/proof/'+ customer.proof" alt="Employee">

                                            </span>
                                            <span class="avatar avatar-circle">
                                            <img v-bind:src="PreviewProof" width="100" height="100" v-show="showPreviewProof" class="avatar-img"/>

                                            </span>
                                        </a>
                                    </div>

                                    <div class="col-sm-6 mb-md-4 pb-3">
                                        <label for="productInfo" class="form-label form-label-lg">Proof Type</label>
                                        <select class="form-select form-select-xl" id="" v-model="customer.proof_type">
                                            <option value="identity_card">Identity Card</option>
                                            <option value="passport">Passport</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-md-4 pb-3">
                                        <label for="productInfo" class="form-label form-label-lg">Branch </label>
                                        <select class="form-select form-select-xl" id="" v-model="customer.branch_id" required>
                                            <option v-for='branch in branches' :value='branch.id' :key="branch.id">{{ branch.name }}</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6 mb-md-4 pb-3">
                                        <label for="productInfo" class="form-label form-label-lg">Status </label>
                                        <select class="form-select form-select-xl" id="" v-model="customer.status">
                                            <option value="0">Active</option>
                                            <option value="1">Deactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 mb-md-4 pb-3">
                                        <label for="productInfo" class="form-label form-label-lg">Address</label>
                                        <textarea class="form-control form-control-xl" id="productInfo" rows="3" placeholder="Enter address" v-model="customer.address"></textarea>
                                    </div>
                                </div>

                                <div class="text-end py-md-3">
                                    <router-link to="/employees" class="btn btn-xl btn-outline-dark text-gray-700 border-gray-700 me-2 me-md-4">
                                        Cancel
                                    </router-link>
                                    <button type="submit" class="btn btn-xl btn-primary"><span class="px-md-3">Save</span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Right sidebar-->
    <div class="customize-sidebar">
        <div class="border-bottom border-gray-200 p-2 p-md-2 px-md-4">
            <div class="text-end">
                <a href="javascript:void(0);" class="btn btn-light btn-icon rounded-pill toggle-rightsidebar">
                    <i class="icon close"></i>
                </a>
            </div>
            <div class="px-2 px-md-4">
                <h3 class="mb-0"> Ingredients</h3>

            </div>
        </div>
        <form id="manageIngredients" action="">
            <div class="customize-body" data-simplebar="init">
                <div class="simplebar-wrapper">
                    <div class="simplebar-height-auto-observer-wrapper">
                        <div class="simplebar-height-auto-observer"></div>
                    </div>
                    <div class="simplebar-mask">
                        <div class="simplebar-offset">
                            <div class="simplebar-content-wrapper">
                                <div class="simplebar-content">
                                    <div class="py-3 px-5">
                                        <div class="input-group bg-white border border-gray-300 rounded py-1 px-3 ">
                                            <i class="fal fa-search"></i>
                                            <input type="search" class="form-control fs-16 border-0" placeholder="Search">
                                        </div>
                                    </div>

                                    <div class="check-list py-3 px-5">
                                        <div class="form-check d-flex mb-4 pt-1">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault5">
                                            <label class="form-check-label ms-2" for="flexCheckDefault5">
                                                Rice
                                            </label>
                                        </div>
                                        <div class="form-check d-flex mb-4 pt-1">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault6">
                                            <label class="form-check-label ms-2" for="flexCheckDefault6">
                                                Chicken
                                            </label>
                                        </div>
                                        <div class="form-check d-flex mb-4 pt-1">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault7">
                                            <label class="form-check-label ms-2" for="flexCheckDefault7">
                                                Big Onion
                                            </label>
                                        </div>
                                        <div class="form-check d-flex mb-4 pt-1">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault8">
                                            <label class="form-check-label ms-2" for="flexCheckDefault8">
                                                Tomato
                                            </label>
                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="simplebar-placeholder" style="width: auto; height: 225px;"></div>
                </div>
                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                </div>
                <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                    <div class="simplebar-scrollbar" style="height: 0px; transform: translate3d(0px, 81px, 0px); display: none;"></div>
                </div>
            </div>
            <div class="p-4 px-lg-5 border-top border-gray-200 bg-white">
                <div class="row">
                    <div class="col-6 d-grid">
                        <a href="Javascript:void(0);" class="btn btn-xl btn-outline-dark" id="resetRightSidebar">Cancel</a>
                    </div>
                    <div class="col-6 d-grid">
                        <a href="Javascript:void(0);" class="btn btn-xl btn-primary" id="submitBranch">SUBMIT</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- End Right sidebar-->
</div>
</template>
<script>
import { required,email, minLength } from "vuelidate/lib/validators";
    export default {
        data(){
        return {
            imagePreview: null,
            showPreview: false,
            existimage:true,
            existimageproof:true,
            showPreviewProof:false,
            PreviewProof:null,
            options:[],
            branches:[],
            customer:{
                name:'',
                email:'',
                phone:'',
                new_image:'',
                proof_type:'',
                address:'',
                designation:'',
                proof:'',
                address:'',
                branch_id:'',
                status:'',
                user_type: '',
                old_image:'',
                old_proof:'',
                proof_new:'',
            }
        }
    },
    created() {
        this.getBranches();
        let uri = `/api/employees/edit/${this.$route.params.id}`;
        this.axios.get(uri).then((response) => {
            this.customer = response.data;
        });
    },
validations: {
    customer: {
      name: { required },
      email: { required, email },
      phone: { required,minLength:10 },
      proof_type: { required },
      address: { required },
      designation: { required },
      status: { required },
    }
  },
    methods: {
            onImageChange(e){
                this.existimageproof=false;
                this.customer.proof_new = e.target.files[0];
                let reader  = new FileReader();
                reader.addEventListener("load", function () {
                    this.showPreviewProof = true;
                    this.PreviewProof = reader.result;
                }.bind(this), false);
                if( this.customer.proof_new ){
                    if ( /\.(jpe?g|png|gif)$/i.test( this.customer.proof_new.name ) ) {
                        reader.readAsDataURL( this.customer.proof_new );
                    }
                }
            },
            onFileChange(event){
                this.existimage=false;
                this.customer.new_image = event.target.files[0];
                let reader  = new FileReader();
                reader.addEventListener("load", function () {
                    this.showPreview = true;
                    this.imagePreview = reader.result;
                }.bind(this), false);
                if( this.customer.new_image ){
                    if ( /\.(jpe?g|png|gif)$/i.test( this.customer.new_image.name ) ) {
                        reader.readAsDataURL( this.customer.new_image );
                    }
                }
            },
         EditEmployee(){
                let formData = new FormData();
                Object.keys(this.customer).forEach((key) => {
                    if (Array.isArray(this.customer[key])) {
                    formData.append(key, JSON.stringify(this.customer[key]));
                    } else {
                    formData.append(key, this.customer[key]);
                    }
                });
            let uri = `/api/employees/update/${this.$route.params.id}`;
            this.axios.post(uri,formData).then((response) => {
            this.$router.push({name: 'employees'});
            });
        },
        getBranches() {
        axios
            .get
            ("/api/branches")
            .then((response) => {
            this.branches = response.data.data;
            })
            .catch((error) => {});
        },
    }
  }
</script>
