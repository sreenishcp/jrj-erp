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
                                <router-link to="/customers" class="nav-link active"><i class="fal fa-eye"></i> All Customers</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/customers/create" class="nav-link"><i class="fal fa-plus"></i> Add Customers</router-link>
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

                <div class="card rounded-12 shadow-dark-80 border border-gray-50">
                    <div class="d-flex align-items-center px-3 px-md-4 py-3">
                        <h5 class="card-header-title mb-0 ps-md-2 font-weight-semibold">All Customers</h5>
                        <div class="ms-auto pe-md-2">
                            <div class="row" style="min-width: 600px;">
                                <div class="col-8">
                                    <div class="input-group bg-white border border-gray-300 rounded py-1 px-3">
                                        <i class="fal fa-search"></i>
                                        <input type="search" class="form-control border-0" placeholder="Search...">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="dropdown export-dropdown my-1 me-md-3">
                                        <a href="#" role="button" id="UserOverview" data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-outline-dark border-gray-600 text-gray-600"><span>Most recent </span> <svg class="ms-2" xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13">
                                    <rect data-name="Icons/Tabler/Chevron Down background" width="13" height="13" fill="none"></rect>
                                    <path d="M.214.212a.738.738,0,0,1,.952-.07l.082.07L7.1,5.989a.716.716,0,0,1,.071.94L7.1,7.011l-5.85,5.778a.738.738,0,0,1-1.034,0,.716.716,0,0,1-.071-.94l.071-.081L5.547,6.5.214,1.233A.716.716,0,0,1,.143.293Z" transform="translate(13 3.25) rotate(90)" fill="#6c757d"></path>
                                    </svg>
                                    </a>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="UserOverview" style="margin: 0px;">
                                            <li><a class="dropdown-item" href="#"><span>Today</span></a></li>
                                            <li><a class="dropdown-item" href="#"><span>Yesterday</span></a></li>
                                            <li><a class="dropdown-item" href="#"><span>Last 7 days</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="table-responsive mb-0">
                        <table class="table card-table table-nowrap overflow-hidden">
                            <thead>
                                <tr>
                                    <th width="50px"></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Membership Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <tr v-for="customer in customers" :key="customer.id">
                                    <td><span class="avatar avatar-circle" v-if="customer.image">
                                        <img class="avatar-img" v-bind:src="'/storage/images/customers/'+ customer.image" alt="Employee">
                                        </span>
                                        <span class="avatar avatar-circle" v-else>
                                        <img class="avatar-img" src="assets/img/avatar1.png" alt="Employee">
                                        </span>
                                    </td>
                                    <td><span class="font-weight-semibold text-gray-700">{{customer.name}} {{customer.last_name != '' ? customer.last_name:''}}</span></td>
                                    <td><span class="text-gray-700">{{customer.email}}</span></td>
                                    <td><span class="text-gray-700">{{customer.phone}}</span></td>
                                    <td><span class="badge bg-green-200 p-2">{{customer.status == 0 ? 'Active' : 'InActive'}}</span></td>
                                    <td><span class="badge bg-green-200 p-2">{{customer.member_status == 1 ? 'Member' : 'Non Member'}}</span></td>

                                    <td>
                                        <div class="dropdown ">
                                            <a href="#" class="btn btn-dark-100 btn-icon btn-sm rounded-circle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="icon menu"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <router-link :to="{name: 'customers.edit', params: { id: customer.id }}" class="dropdown-item">
                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                </router-link>                                         <a href="#!" class="dropdown-item" @click.prevent="deleteCustomer(customer.id)">
                                                    <i class="far fa-trash-alt"></i>Delete
                                                </a>
                                                <a href="#!" class="dropdown-item">
                                                    <i class="far fa-eye"></i>View
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex align-items-center p-3 p-md-4 border-top border-gray-200">
                        <a href="#" class="my-1 font-weight-semibold mx-auto btn btn-link link-dark">View More<svg class="ms-1" data-name="icons/tabler/chevron right" xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 16 16">
                    <rect data-name="Icons/Tabler/Chevron Right background" width="16" height="16" fill="none"></rect>
                    <path d="M.26.26A.889.889,0,0,1,1.418.174l.1.086L8.629,7.371a.889.889,0,0,1,.086,1.157l-.086.1L1.517,15.74A.889.889,0,0,1,.174,14.582l.086-.1L6.743,8,.26,1.517A.889.889,0,0,1,.174.36Z" transform="translate(4)" fill="#1e1e1e"></path>
                    </svg></a>
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
    <form id="addEditBranch" action="">
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
                                        <input type="text" class="form-control border-0" maxlength="200" placeholder="Enter branch name">
                                    </div>
                                </div>

                                <div class="p-4 px-lg-5 border-bottom border-gray-200">
                                    <label for="branchAddress" class="form-label form-label-lg">Branch Address</label>
                                    <textarea class="form-control form-control-xl" id="branchAddress" maxlength="500" rows="3" placeholder="Enter branch"></textarea>
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
</div>
</template>
<!-- End Right sidebar-->
<script>
  export default {
      data() {
        return {
          customers: [],
        }
      },
      created() {
      let uri = '/api/customers';
      this.axios.get(uri).then(response => {
        this.customers = response.data.data;
      });
    },
    methods: {
      deleteCustomer(id)
      {
        if(confirm("Do you really want to delete?")){
            let uri = `/api/customers/delete/${id}`;
            this.axios.delete(uri).then(response => {
            this.customers.splice(this.customers.indexOf(id), 1);
        });
        }
      }
    }
  }
</script>