<template>
  <header class="sixteen wide column ui fluid container">
    <div class="ui grid">
      <div class="orange row">
        <div class="two wide column">
          <i class="white bars big link icon" @click="clickMenu"></i>
        </div>

        <div class="eight wide column mobile only">
          <img
            src="./../assets/logo_white-400.png"
            class="ui mini inline image"
          />
        </div>
        <div class="eight wide column computer only tablet only">
          <img
            src="./../assets/logo_white-400.png"
            class="ui tiny inline image"
          />
          <span class="ui white medium header">
            .: Sanwicherie :.
          </span>
        </div>
        <div
          class="right floated right aligned three wide computer six wide mobile column"
        >
          <i class="large right user icon"></i>
          <i class="large shopping cart link icon"></i>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
export default {
  components: {},
  methods: {
    clickMenu: function() {
      this.$emit('opensesame')
    }
  }
}
</script>

<style scopped>
header {
  margin-left: 0 !important;
  margin-right: 0 !important;
}

.white {
  color: #fff !important;
}
</style>
