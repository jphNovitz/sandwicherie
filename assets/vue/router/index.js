import Vue from 'vue'
import Router from 'vue-router'
import home from '../pages/home'
import contact from '../pages/contact'
import products from '../pages/products'
import detail from '../pages/detail'
import allergies from '../pages/allergies'
import cart from '../pages/cart'
import login from '../pages/login'
import logout from '../pages/logout'
import profile from '../pages/profile'
import photos from '../pages/photos'
import oups from '../pages/404'
import play from '../pages/play'
import privacy from '../pages/privacy'

Vue.use(Router)


const router = new Router({
    // mode: 'history',
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
            component: contact,
            meta: {
                title: 'La clémentine - contact',
                metaTags: [
                    {
                        name: 'contact',
                        content: 'contactez la clémentine'
                    },
                    {
                        property: 'og:description',
                        content: 'La Clémentine sandwicherie'
                    }
                ]
            }
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
            name: 'logout',
            path: '/logout',
            component: logout
        },
        {
            name: 'profile',
            path: '/profil',
            component: profile
        },
        {
            name: 'photos',
            path: '/photos',
            component: photos
        },
        {
            name: 'privacy',
            path: '/apropos/donnees',
            component: privacy
        },
        {
            name: '404',
            path: '/oups',
            component: oups
        },
        {
            name: 'play',
            path: '/play',
            component: play
        }
    ]
})

export default router

router.beforeEach((to, from, next) => {
    if (!to.matched.length) {
        next('/oups');
    } else {
        next();
    }
});