import Vue from 'vue';
import VueSocketio from 'vue-socket.io';
import Vuex from 'vuex'
//import {store} from './Store/Store';
import SuiVue from 'semantic-ui-vue';
import 'semantic-ui-css/semantic.css';
Vue.config.extractCss = true;
import Dashboard from './Dashboard';
import VueResource from 'vue-resource';

Vue.prototype.$http = VueResource;
Vue.use(VueSocketio, 'https://d28339bd.ngrok.io');

//Vue.use(Vuex)
Vue.use(SuiVue)

/**
 * Create a fresh Vue Application instance
 */
new Vue({
    el: '#dashboard',
    //store,
    template: '<Dashboard/>',
    components: { Dashboard },

})