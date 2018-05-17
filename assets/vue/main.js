
import Vue from 'vue';
import Vuex from 'vuex'
import {store} from './Store/Store';
import SuiVue from 'semantic-ui-vue';
import 'semantic-ui-css/semantic.css';
Vue.config.extractCss = true
import App from './App'
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