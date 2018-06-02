import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

Vue.prototype.$http = axios

const url_allergies = "http://localhost:8000/api/allergies"
const url_categories = "http://localhost:8000/api/categories"
const url_products = "http://localhost:8000/api/products"
export const store = new Vuex.Store({
    state: {
        site: {},
        allergies: [],
        categories: [],
        products: [],
        cart: {
            'items': []
        }
    },
    mutations: {
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
        ADD_PRODUCT_CART(state, p) {
            let flag = false
            state.cart.items.map(c => {
                if (c.product.slug ===p.slug){
                    c.qty ++
                    flag = true
                }
            })
            if (!flag){
                let qty = 1

            let line = {
                'qty': qty,
                'product': p
            }

            state.cart.items.push(line)
            }
        }
    },
    getters: {
        site : state => state.site,
        allergies : state => state.allergies,
        categories : state => state.categories,
        products : state => state.products,
        cart: state => state.cart
    },
    actions: {
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
        add_cart (context, payload){
            this.commit('ADD_PRODUCT_CART', payload.item)
        }
    }
})