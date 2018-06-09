
import Vue from 'vue';
import socketio from 'socket.io-client'
import VueSocketIO from 'vue-socket.io'
import Vuex from 'vuex'
import {store} from './Store/Store';
import SuiVue from 'semantic-ui-vue';
import 'semantic-ui-css/semantic.css';
Vue.config.extractCss = true
import App from './App'
export const SocketInstance = socketio('http://localhost:6379');

Vue.use(VueSocketIO, SocketInstance)
Vue.use(Vuex)
Vue.use(SuiVue)

/**
 * Create a fresh Vue Application instance
 */
new Vue({
    el: '#app',
    store,
    template: '<App/>',
    components: { App }
})