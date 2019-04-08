export const state = () => ({
  products: []
})

export const getters = {
  products: state => {
    return state.products
  }
}

export const actions = {
  async GET_STARS({ commit }) {
    const { data } = await this.$axios.$get(
      'http://localhost:8000/api/privacy/public/infos'
    )
    commit('SET_INFOS', data)
  }
}

export const mutations = {
  SET_PRODUCTS(state, datas) {
    state.products = datas
  }
}
