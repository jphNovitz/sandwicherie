import Vue from 'vue';
import VueSocketio from 'vue-socket.io';
// import {store} from './Store/Store';

import SuiVue from 'semantic-ui-vue';
import 'semantic-ui-css/semantic.css';
Vue.config.extractCss = true;
import Dashboard from './Dashboard';
import VueResource from 'vue-resource';

Vue.prototype.$http = VueResource;
Vue.use(VueSocketio, 'http://7b4e4fe1.ngrok.io');

Vue.use(SuiVue)

/**
 * Create a fresh Vue Application instance
 */
new Vue({
    el: '#dashboard',
    template: '<Dashboard/>',
    components: { Dashboard },

})