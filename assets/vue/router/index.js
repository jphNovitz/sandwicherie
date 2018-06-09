import Vue from 'vue'
import Router from 'vue-router'
import home from '../pages/home'
import contact from '../pages/contact'
import products from '../pages/products'
import allergies from '../pages/allergies'
import cart from '../pages/cart'
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
        }
    ]
})