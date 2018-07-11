
import Vue from 'vue';
import socketio from 'socket.io-client'
import VueSocketIO from 'vue-socket.io'
import Vuex from 'vuex'
import {store} from './Store/Store';
import SuiVue from 'semantic-ui-vue';
import 'semantic-ui-css/semantic.css';
Vue.config.extractCss = true
import App from './App'
//import Axios from 'axios'
import VueResource from 'vue-resource'
import Auth from 'vue-token'

export const SocketInstance = socketio('http://localhost:6379');

Vue.use(VueSocketIO, SocketInstance)
Vue.use(Vuex)
Vue.use(VueResource)
Vue.use(SuiVue)
//Vue.prototype.$http = Axios;
//Vue.prototype.$http = VueResource;
const options={
    loginUrl: "/api/login_check",
    signupUrl: "/api/users",
    logoutUrl: "/api/logout",
    refresh: false // Utalize the automatic refresh of tokens (it will use the token from response.token as the new token)
}
Vue.use(Auth, options );
/**
 * Create a fresh Vue Application instance
 */
new Vue({
    el: '#app',
    store,
    template: '<App/>',
    components: { App }
})