import Vue from 'vue';
import socketio from 'socket.io-client'
import VueSocketIO from 'vue-socket.io'
import Vuex from 'vuex'
import {store} from './Store/Store';
import SuiVue from 'semantic-ui-vue';
import 'semantic-ui-css/semantic.css';
Vue.config.extractCss = true
import App from './App'
import VueSession from 'vue-session'
import VueResource from 'vue-resource'
import Auth from 'vue-token'
Vue.use(Vuex)
Vue.use(VueResource)
Vue.use(SuiVue)

const options={
    loginUrl: "/api/login_check",
    signupUrl: "/api/users",
    logoutUrl: "/api/logout",
    refresh: false // Utalize the automatic refresh of tokens (it will use the token from response.token as the new token)
}
Vue.use(Auth, options );
Vue.use(VueSession, { persist: true })

/**
 * Create a fresh Vue Application instance
 */
new Vue({
    el: '#app',
    store,
    template: '<App/>',
    components: { App }
})