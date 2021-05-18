    <!-- Left Menu Start -->
    <template>
    <nav class="navbar navbar-vertical navbar-expand-lg navbar-light">
        <a class="navbar-brand mx-auto d-none d-lg-block my-0 my-lg-4" href="#">
            <img src="assets/icons/delivery-logo.png" alt="JRJ">
            <h5>Delivery</h5>
        </a>
        <div class="navbar-collapse">
            <ul class="navbar-nav mb-2" id="accordionExample" data-simplebar>

                <li class="nav-item">
                    <a class="nav-link" href="dashboard.html">
                        <i class="fal fa-chart-line"></i>
                        <span class="ms-2">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fal fa-cart-plus"></i>
                        <span class="ms-2">Orders</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" id="customermenu" href="#customersage" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="customersage">
                        <i class="fal fa-user-tie"></i><span class="ms-2">Customers</span></a>
                    <div class="collapse-box collapse" id="customersage" data-bs-parent="#customermenu">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="customers-all.html" class="nav-link">All Customers</a>
                            </li>
                            <li class="nav-item">
                                <a href="customer-new.html" class="nav-link">New Customers</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" id="submenu" href="#productsage" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="productsage"><i class="fal fa-cheeseburger"></i>
                      <span class="ms-2">Products</span></a>
                    <div class="collapse-box collapse" id="productsage" data-bs-parent="#submenu">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="products-all.html" class="nav-link">All Products</a>
                            </li>
                            <li class="nav-item">
                                <a href="product-new.html" class="nav-link">New Product</a>
                            </li>
                            <li class="nav-item">
                                <a href="product-categories.html" class="nav-link">Categories</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="transactions-all.html">
                        <i class="fal fa-wallet"></i>
                        <span class="ms-2">Transactions</span>
                    </a>
                </li>

                <li class="nav-item">
                    <li class="nav-item">
                        <a class="nav-link collapsed" id="usermenu" href="#usersage" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="usersage">
                            <i class="fal fa-user-friends"></i><span class="ms-2">Users</span></a>
                        <div class="collapse-box collapse" id="usersage" data-bs-parent="#usermenu">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="users-all.html" class="nav-link">All Users</a>
                                </li>
                                <li class="nav-item">
                                    <a href="user-new.html" class="nav-link">New User</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </li>



                <li class="nav-item">
                    <a class="nav-link active" href="branch.html">
                        <i class="fal fa-store"></i>
                        <span class="ms-2">Branches</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="settings.html">
                        <i class="fal fa-user-cog"></i>
                        <span class="ms-2">Account</span>
                    </a>
                </li>


            </ul>

        </div>
    </nav>
</template>
    <!-- Left Menu End -->