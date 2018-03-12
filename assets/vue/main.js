import Vue from 'vue';
import SuiVue from 'semantic-ui-vue';
import 'semantic-ui-css/semantic.css';


import App from './App'
Vue.use(SuiVue)

import Example from './components/Example'

/**
 * Create a fresh Vue Application instance
 */
new Vue({
    el: '#app',
    components: { App },
    template: '<App/>'
})