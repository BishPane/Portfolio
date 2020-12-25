import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)
import Home from './public/home.vue';
import AdminHome from './admin/AdminHome.vue'
import Login from './admin/login.vue'
const routes = [

    {
        path: '/',
        component: Home
    },
    {
        path: '/admin',
        component: AdminHome,
        beforeEnter: requireAuth
    },
    {
        path: '/login',
        component: Login,

    },
]

function requireAuth(to, from, next) {
    let AuthCheck = window.AuthCheck;
    if (AuthCheck === "0") {
        next({
            path: '/login',
        })
    } else {
        next()
    }
}

export default new Router({
    mode: 'history',
    routes
})