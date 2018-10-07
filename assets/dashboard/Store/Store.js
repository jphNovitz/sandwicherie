import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)


export const store = new Vuex.Store({
    state: {
        activeList: []
    },
    mutations: {
        ADD_ITEM(state, id){
            state.activeList.push(id)
        }
    },
    getters: {
        activeItems: state => state.activeList
    },
    actions: {
        add_item(context, payload){
            this.commit('ADD_ITEM', payload)
        }
    }
});