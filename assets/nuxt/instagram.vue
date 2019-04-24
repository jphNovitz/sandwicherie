<template>
  <div>
    instagram
  </div>
</template>
<script>
export default {
  data() {
    return {}
  },
  async fetch({ app, store }) {
    const response = await app.$axios.get(store.getters['instagram/url'], {
      params: {
        access_token: store.getters['instagram/access_token']
      }
    })
    store.commit('init/SET_INFOS', response.data)
  }
}
</script>
