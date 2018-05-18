import Vue from 'vue'
import Router from 'vue-router'
import home from '../pages/home'
import contact from '../pages/contact'
Vue.use(Router)


export default new Router({
    routes: [
        {
            name: 'home',
            path: '/',
            component: home
        },
        {
            name: 'contact',
            path: '/contact',
            component: contact
        }
    ]
})