import Home from './components/Home.vue';
import Login from './components/auth/Login.vue';
import Register from './components/auth/Register.vue';

import ListProducts from './components/products/ListProducts.vue';
import MainProducts from './components/products/MainProducts.vue';
import NewProduct from './components/products/NewProduct.vue';

import MainCategories from './components/categories/MainCategories.vue';
import ListCategories from './components/categories/ListCategories.vue';
import NewCategory from './components/categories/NewCategory.vue';


export const routes = [
    {
        path: '/',
        component: Home,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/register',
        component: Register
    },
    {
        path: '/categories',
        component: MainCategories,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '/',
                component: ListCategories
            },
            {
                path: 'new',
                component: NewCategory
            }/*,
            {
                path: ':id',
                component: Customer
            }*/
        ]        

    },
    {
        path: '/products',
        component: MainProducts,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '/',
                component: ListProducts
            },
            {
                path: 'new',
                component: NewProduct
            }/*,
            {
                path: ':id',
                component: Customer
            }*/
        ]        

    }
];