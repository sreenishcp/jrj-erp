    <!-- Left Menu Start -->
    <template>
    <div>
    <!-- Left Menu Start -->
    <nav class="navbar navbar-vertical navbar-expand-lg navbar-light">
        <a class="navbar-brand mx-auto d-none d-lg-block my-0 my-lg-4" href="dashboard.html">
            <img src="/assets/icons/delivery-logo.png" alt="JRJ">
        </a>
        <div class="navbar-collapse">
            <ul class="navbar-nav mb-2" id="accordionExample" data-simplebar>

                <li class="nav-item">
                    <router-link to="/dashboard" class="nav-link">
                        <i class="fal fa-chart-line"></i>
                        <span class="ms-2">Dashboard</span>
                    </router-link>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fal fa-cart-plus"></i>
                        <span class="ms-2">Orders</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="products-all.html">
                        <i class="fal fa-cheeseburger"></i>
                        <span class="ms-2">Products</span>
                    </a>
                </li>

                <li class="nav-item">
                    <router-link to="/customers" class="nav-link">
                        <i class="fal fa-user-tie"></i>
                        <span class="ms-2">Customers</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/employees" class="nav-link">
                        <i class="fal fa-user-tie"></i>
                        <span class="ms-2">All Employees</span>
                    </router-link>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="transactions-all.html">
                        <i class="fal fa-wallet"></i>
                        <span class="ms-2">Transactions</span>
                    </a>
                </li>
                

                <li class="nav-item">
                    <router-link to="/users" class="nav-link">
                        <i class="fal fa-user-friends"></i>
                        <span class="ms-2">Users</span>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link to="/branch" class="nav-link">
                        <i class="fal fa-store"></i>
                        <span class="ms-2">Branch</span>
                    </router-link>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="settings.html">
                        <i class="fal fa-user-cog"></i>
                        <span class="ms-2">Account</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/log-out">
                        <i class="fal fa-user-cog"></i>
                        <span class="ms-2">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <transition name="fade">
        <router-view></router-view>
    </transition>
</div>
</template>


    <!-- Left Menu End -->