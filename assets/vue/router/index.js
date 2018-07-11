import Vue from 'vue'
import Router from 'vue-router'
import home from '../pages/home'
import contact from '../pages/contact'
import products from '../pages/products'
import detail from '../pages/detail'
import allergies from '../pages/allergies'
import cart from '../pages/cart'
import login from '../pages/login'
import profile from '../pages/profile'

Vue.use(Router)


export default new Router({
    routes: [
        {
            name: 'home',
            path: '/',
            component: home
        },
        {
            name: 'products',
            path: '/menu',
            component: products
        },
        {
            name: 'detail',
            path: '/menu/:slug',
            component: detail
        },
        {
            name: 'allergies',
            path: '/allergies',
            component: allergies
        },
        {
            name: 'contact',
            path: '/contact',
            component: contact
        },
        {
            name: 'cart',
            path: '/panier-achats',
            component: cart
        },
        {
            name: 'login',
            path: '/login',
            component: login
        },
        {
            name: 'profile',
            path: '/profil',
            component: profile
        }
    ]
})