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
                    <h1 class="h2 mb-0 lh-sm">Customers</h1>
                </div>
                <div class="col-auto d-flex align-items-center my-2 my-sm-0">
                    <div class="pb-3">
                        <ul class="nav nav-tabs nav-tabs-md nav-tabs-line position-relative zIndex-0">
                            <li class="nav-item">
                                <router-link to="/customers" class="nav-link "><i class="fal fa-eye"></i> All Customers</router-link>
                            </li>
                            <li class="nav-item">
                               <router-link to="/customers/create" class="nav-link active"><i class="fal fa-eye"></i> Add Customers</router-link>
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
                        <h5 class="card-header-title my-2 ps-md-3 font-weight-semibold">Add New Customer</h5>
                    </div>
                    <div class="card-body px-0 p-md-4">
                        <form class="px-3 form-style-two" id="form"
                            @submit.prevent="AddCustomer"
                            enctype="multipart/form-data">

                            <div class="row">
                                <div class="mb-4 mb-xl-5">
                                    <input type="file" name="image" @change="onFileChange" >
                                    <label class="form-label form-label-lg mb-3 mb-md-4">Photo (Optional)</label>
                                    <div class="d-flex align-items-center">
                                        <a href="#0" class="circle circle-xl border border-gray-300">
                                            <!-- <img src="assets/img/placeholder-camera.png" alt="User Image"> -->
                                        <img v-bind:src="imagePreview" width="100" height="100" v-show="showPreview"/> 
                                        </a>
                                        <div class="ps-2 ps-md-3">
                                            <label class="text-primary font-weight-semibold d-block mb-1 mb-md-2">Upload Image</label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-6 mb-md-4 pb-3">
                                    <label for="FullName" class="form-label form-label-lg">Customer Name<span class="required">*</span></label>
                                    <input type="text" class="form-control form-control-xl" id="empName" placeholder="Enter customer name" v-model="customer.name" required>
                                </div>
                                <div class="col-sm-6 mb-md-4 pb-3">
                                    <label for="FullName" class="form-label form-label-lg">Last Name</label>
                                    <input type="text" class="form-control form-control-xl" id="emplaName" placeholder="Enter last name" v-model="customer.last_name">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 mb-md-4 pb-3">
                                    <label for="empEmail" class="form-label form-label-lg">Email<span class="required">*</span></label>
                                    <input type="email" class="form-control form-control-xl" id="empEmail" placeholder="Enter email"  v-model="customer.email" required>
                                </div>
                                <div class="col-sm-6 mb-md-4 pb-3">
                                    <label for="empPhone" class="form-label form-label-lg">Phone<span class="required">*</span></label>
                                    <input type="number" class="form-control form-control-xl" id="empPhone" placeholder="Enter phone number"  v-model="customer.phone" required>
                                </div>
                            </div>







                            <div class="row">
                                <div class="col-sm-6 mb-md-4 pb-3">
                                    <label for="empPassword" class="form-label form-label-lg">Password<span class="required">*</span></label>
                                    <input type="password" class="form-control form-control-xl" id="empPassword" placeholder="Enter password"  v-model="customer.password" required>
                                </div>

                                <div class="col-sm-6 mb-md-4 pb-3">
                                    <label for="empCPassword" class="form-label form-label-lg">Confirm Password<span class="required">*</span></label>
                                    <input type="password" class="form-control form-control-xl" id="empCPassword" placeholder="Confirm password" v-model="customer.conf_password" required>
                                </div>
                            </div>

                            <hr style="margin: 20px -40px; opacity: 0.1;">

                            <div class="row">
                                <div class="col-sm-6 mb-md-4 pb-3">
                                    <label for="empDoor" class="form-label form-label-lg">Door Number<span class="required">*</span></label>
                                    <input type="text" class="form-control form-control-xl" id="empDoor" placeholder="Enter door number"  v-model="customer.door_number" required>
                                </div>

                                <div class="col-sm-6 mb-md-4 pb-3">
                                    <label for="empPost" class="form-label form-label-lg">Postcode<span class="required">*</span></label>
                                    <input type="text" class="form-control form-control-xl" id="empPost" placeholder="Enter post code"  v-model="customer.postcode" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 mb-md-4 pb-3">
                                    <label for="empaddress" class="form-label form-label-lg">Address Line<span class="required">*</span></label>
                                    <input type="text" class="form-control form-control-xl" id="empaddress" placeholder="Enter address line"  v-model="customer.address_line" required>
                                </div>

                                <div class="col-sm-6 mb-md-4 pb-3">
                                    <label for="empStatus" class="form-label form-label-lg">status<span class="required">*</span></label>
                                    <select class="form-select form-select-xl" id="empStatus" v-model="customer.status" required>
                                        <option value="0">Active</option>
                                        <option value="1">Deactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 mb-md-4 pb-3">
                                    <label for="empBranch" class="form-label form-label-lg">Branch<span class="required">*</span></label>
                                        <select class="form-select form-select-xl"  v-model="customer.branch_id" required>
                                            <option v-for='branch in branches' :value='branch.id' :key="branch.id">{{ branch.name }}</option>
                                        </select>
                                </div>

                                <div class="col-sm-6 mb-md-4 pb-3">
                                    <label for="empMem" class="form-label form-label-lg">Member / Non Member<span class="required">*</span></label>
                                        <select class="form-select form-select-xl"  v-model="customer.member_status" required>
                                        <option value="0">Non Member</option>
                                        <option value="1">Member</option>
                                        </select>
                                </div>
                            </div>

                            <div class="text-end py-md-3">
                               <router-link to="/customers" class="btn btn-xl btn-outline-dark text-gray-700 border-gray-700 me-2 me-md-4">
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
</div>
</template>
<script>
import { required,email, minLength } from "vuelidate/lib/validators";
    export default {
        data(){
        return {
            imagePreview: null,
            showPreview: false,
            showProofPreview:false,
            ProofPreview:false,
            branches:[],
            options:[],
            customer:{
                name:'',
                last_name:'',
                email:'',
                phone:'',
                image:'',
                password:'',
                conf_password:'',
                door_number:'',
                status:'',
                postcode:'',
                address_line:'',
                branch_id:'',
                member_status:'',
            }
        }
    },
    validations: {
    customer: {
      name: { required },
      email: { required, email },
      phone: { required,minLength:10 },
      password: { required,minLength:6 },
      conf_password: { required,minLength:6 },
      door_number: { required },
      postcode: { required },
      status: { required },
      address_line:{ required },
      member_status:{ required },
      branch_id:{ required },
    }
  },
    methods: {
            onFileChange(event){
                this.customer.image = event.target.files[0];
                let reader  = new FileReader();
                reader.addEventListener("load", function () {
                    this.showPreview = true;
                    this.imagePreview = reader.result;
                }.bind(this), false);
                if( this.customer.image ){
                    if ( /\.(jpe?g|png|gif)$/i.test( this.customer.image.name ) ) {
                        reader.readAsDataURL( this.customer.image );
                    }
                }
            },
         AddCustomer(){
                let formData = new FormData();
                Object.keys(this.customer).forEach((key) => {
                    if (Array.isArray(this.customer[key])) {
                    formData.append(key, JSON.stringify(this.customer[key]));
                    } else {
                    formData.append(key, this.customer[key]);
                    }
                });
             let uri = '/api/customers/create';
            this.axios.post(uri,formData).then((response) => {
            this.$router.push({name: 'customers'});
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
    },
    created: function(){
    this.getBranches();
    }
}
</script>