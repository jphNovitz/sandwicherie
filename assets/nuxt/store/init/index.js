export const state = () => ({
  infos: ''
})

export const getters = {
  infos: state => {
    return state.infos
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
  SET_INFOS(state, datas) {
    state.infos = datas
  }
}
