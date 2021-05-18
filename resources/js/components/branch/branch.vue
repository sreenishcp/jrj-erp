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
                    <span class="text-uppercase tiny text-gray-600 Montserrat-font font-weight-semibold">Master</span>
                    <h1 class="h2 mb-0 lh-sm">Branches</h1>
                </div>

            </div>
        </div>
    </div>



    <div class="p-2 p-xxl-4">
        <div class="container px-0">
            <div class="row justify-content-md-center">
                <div class="col-xl-8 col-xxl-8">

                    <div class="card rounded-12 shadow-dark-80 border border-gray-50 mb-4">
                        <div class="d-flex flex-wrap align-items-center px-3 px-md-4 py-3 border-bottom border-gray-200">
                            <div class="col">
                                <h5 class="card-header-title mb-0 my-md-2 ps-md-3 font-weight-semibold">Branches List</h5>
                            </div>
                            <div class="ms-auto pe-md-2">
                                <a href="#" onclick="toggleRightSidebar(event)" class="btn btn-lg btn-primary">
                                    <i class="icon plus me-2"></i>
                                    <span>New Branch</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item px-md-4" v-for="(branch,i) in branches" :key="i">
                                    <div class="row px-3">
                                        <div class="col-auto">
                                            <span class="avatar avatar-xs avatar-circle">
                                        <i class="far fa-building"></i>
                                   </span>
                                        </div>
                                        <div class="col ps-0">
                                            <span class="mb-2 d-block text-gray-800">
                                   <strong class="text-black-600">{{branch.name}}</strong>
                                   </span>
                                            <p class="card-text text-gray-600 lh-sm">{{branch.address}}</p>
                                        </div>
                                        <div class="col-auto">
                                            <div class="dropdown ">
                                                <a href="#" class="btn btn-dark-100 btn-icon btn-sm rounded-circle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="icon menu"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="#" onclick="toggleRightSidebar(event)" class="dropdown-item" v-on:click="EditBranch(branch.id)">
                                                        <i class="fas fa-pencil-alt"></i> Edit
                                                    </a>
                                                    <a href="#!" class="dropdown-item">
                                                        <i class="far fa-trash-alt"></i>Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
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
                <h3 class="mb-0"> New Branch</h3>

            </div>
        </div>
        <form class="px-3 form-style-two" id="form"
                                @submit.prevent="AddBranch"
        >
            <div class="customize-body" data-simplebar="init">
                <div class="simplebar-wrapper" style="margin: 0px;">
                    <div class="simplebar-height-auto-observer-wrapper">
                        <div class="simplebar-height-auto-observer"></div>
                    </div>
                    <div class="simplebar-mask">
                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                            <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden;">
                                <div class="simplebar-content" style="padding: 0px;">

                                    <div class="p-4 px-lg-5 border-bottom border-gray-200">
                                        <label for="branchAddress" class="form-label form-label-lg">Branch Name</label>
                                        <div class="input-group input-group-xl bg-white border border-gray-300 rounded px-3 me-2 me-xl-4">
                                            <input type="text" class="form-control border-0" maxlength="200" placeholder="Enter branch name" v-model="branch.name" value="new branch" required>
                                        </div>
                                    </div>
                                    <div class="p-4 px-lg-5 border-bottom border-gray-200">
                                        <label for="branchAddress" class="form-label form-label-lg">Zipcode</label>
                                        <div class="input-group input-group-xl bg-white border border-gray-300 rounded px-3 me-2 me-xl-4">
                                            <input type="text" class="form-control border-0" maxlength="200" placeholder="Enter branch zipcode" v-model="branch.zipcode" value="123123" required>
                                        </div>
                                    </div>

                                    <div class="p-4 px-lg-5 border-bottom border-gray-200">
                                        <label for="branchAddress" class="form-label form-label-lg">Branch Address</label>
                                        <textarea class="form-control form-control-xl" id="branchAddress" maxlength="500" rows="3" placeholder="Enter branch address" v-model="branch.address" value="address" required></textarea>
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
                    <button type="submit" class="btn btn-xl btn-primary"><span class="px-md-3">Submit</span></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</template>
<script>
import { required,email, minLength } from "vuelidate/lib/validators";
    export default {
            data(){
            return {
                isEditing:false,
                 branches: [],
                 Editbranch:{},
                branch:{
                    name:'',
                    address:'',
                    zipcode:''
                }
            }
        },
validations: {
    branch: {
      name: { required },
      address: { required },
      zipcode: { required,minLength:6 },

    }
  },
        created() {
            let uri = '/api/branches';
            this.axios.get(uri).then(response => {
                this.branches = response.data.data;
                this.isEditing=false;
            });
        },
        methods: {
            AddBranch(){
                let formData = new FormData();
                Object.keys(this.customer).forEach((key) => {
                    if (Array.isArray(this.customer[key])) {
                    formData.append(key, JSON.stringify(this.customer[key]));
                    } else {
                    formData.append(key, this.customer[key]);
                    }
                });
                let uri = '/api/branch/create';
                this.axios.post(uri,formData).then((response) => {
                this.$router.push({name: 'branches'});
                });
            },
            EditBranch(id){
                this.isEditing=true;
                let uri = `/api/branch/edit/${id}`;
                this.axios.get(uri).then((response) => {
                    console.log(response.data);
                    this.Editbranch = response.data;
                });
            }
        }
    }   
</script>