import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

Vue.prototype.$http = axios

const url = "http://localhost:8000/api/allergies"
export const store = new Vuex.Store({
    state: {
        site: {},
        allergies: []
    },
    mutations: {
        SET_SITE(state, infos){
            state.site = infos
        },
        SET_ALLERGIES(state, infos){
            state.allergies = infos
        },

    },
    getters: {
        site : state => state.site,
        allergies : state => state.allergies
    },
    actions: {
        call_allergies ({commit}){
            axios.get(url).then((response) => {
                commit('SET_ALLERGIES', response.data)
            })
        }
    }
})