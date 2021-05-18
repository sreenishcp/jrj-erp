require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';
import App from './App.vue';
Vue.use(VueAxios, axios);
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)


import DashboardComponent from './components/DashboardComponent.vue';
import AddEmployee from './components/employee/add.vue';
import ListEmployee from './components/employee/list.vue';
import Branch from './components/branch/branch.vue';
import EditEmployee from './components/employee/edit.vue';

import AddCustomer from './components/customers/add.vue';
import ListCustomers from './components/customers/list.vue';
import EditCustomer from './components/customers/edit.vue';

import AddUser from './components/users/add.vue';
import ListUser from './components/users/list.vue';
import EditUser from './components/users/edit.vue';
const routes = [
    {
        name: 'dashboard',
        path: '/dashboard',
        component: DashboardComponent
    },
    {
        name: 'employees',
        path: '/employees',
        component: ListEmployee
    },
    {
        name: 'employees.create',
        path: '/employees/create',
        component: AddEmployee
    },
    {
        name: 'employees.edit',
        path: '/employees/edit/:id',
        component: EditEmployee
    },
    {
        name: 'customers',
        path: '/customers',
        component: ListCustomers
    },
    {
        name: 'customers.create',
        path: '/customers/create',
        component: AddCustomer
    },
    {
        name: 'customers.edit',
        path: '/customers/edit/:id',
        component: EditCustomer
    },
    {
        name: 'branch',
        path: '/branch',
        component: Branch
    },
    {
        name: 'branches',
        path: '/branches',
        component: Branch
    },
    {
        name: 'users',
        path: '/users',
        component: ListUser
    },
    {
        name: 'users.create',
        path: '/users/create',
        component: AddUser
    },
    {
        name: 'users.edit',
        path: '/users/edit/:id',
        component: EditUser
    },
  ];

const router = new VueRouter({ mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');