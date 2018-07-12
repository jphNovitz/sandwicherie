import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

Vue.prototype.$http = axios
//const baseURl = "http://localhost:8000"
const url_allergies = "/api/allergies"
const url_categories =  "/api/categories"
const url_products =  "/api/products"
const url_types =  "/api/types"

export const store = new Vuex.Store({
    state: {
        logged: '',
        auth: {},
        user: {},
        post_cart: '/api/cart',
        site: {},
        allergies: [],
        categories: [],
        products: [],
        types: [],
        suggestions: [],
        cart: {
            'items': []
        }
    },
    mutations: {
        SET_LOGGED(state, status){
            state.logged = status
        },
        SET_AUTH(state, inputs){
            state.auth = inputs
        },
        SET_USER(state, infos){
            state.user = infos
        },
        SET_SITE(state, infos){
            state.site = infos
        },
        SET_ALLERGIES(state, infos){
            state.allergies = infos
        },
        SET_CATEGORIES(state, infos){
            state.categories = infos
        },
        SET_PRODUCTS(state, infos){
            state.products = infos
        },
        SET_TYPES(state, infos){
            state.types = infos
        },
        SET_SUGGESTIONS(state, infos){
            state.suggestions = infos
        },
        UPDATE_PRODUCT_CART(state, datasObj) {
                let found = state.cart.items.findIndex(line => {
                    return (line.item.slug === datasObj.item.slug)
                })

                if(found === -1){
                   state.cart.items.push(datasObj)
                }else {
                    Object.assign(state.cart.items[found], datasObj)
                }

        }
    },
    getters: {
        is_logged: state => state.logged,
        get_auth: state =>state.auth,
        post_cart: state => state.post_cart,
        length_cart: state => {
            let total = state.cart.items.reduce(function(prev, current) {
                return prev + current.qty ;
            }, 0 )
            return total;
        },
        site : state => state.site,
        allergies : state => state.allergies,
        categories : state => state.categories,
        products : state => state.products,
        /*product: (state) => (slug) => {
            return state.products.find(product => {
                return product.slug === slug
            })
        },*/
        types : state => state.types,
        suggestions : state => state.suggestions,
        cart: state => state.cart
    },
    actions: {
        update_logged(context, payload){
          this.commit('SET_LOGGED', payload)
        },
        set_auth(context, payload){
          this.commit('SET_AUTH', payload)
        },
        set_user(context, payload){
          this.commit('SET_USER', payload)
        },
        call_allergies ({commit}){
            axios.get(url_allergies).then((response) => {
                commit('SET_ALLERGIES', response.data)
            })
        },
        call_categories ({commit}){
            axios.get(url_categories).then((response) => {
                commit('SET_CATEGORIES', response.data)
            })
        },
        call_products ({commit}){
            axios.get(url_products).then((response) => {
                commit('SET_PRODUCTS', response.data)
            })
        },
        call_types ({commit}){
            axios.get(url_types).then((response) => {
                commit('SET_TYPES', response.data)
            })
        },
        add_cart (context, payload){
            this.commit('ADD_PRODUCT_CART', payload.item)
        },
        update_cart (context, payload){

            this.commit('UPDATE_PRODUCT_CART', {'item': payload.item, 'qty': payload.qty})
        }

    }
})
