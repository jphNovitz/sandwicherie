<template>
  <header class="sixteen wide column ui fluid container">
    <div class="ui middle aligned grid">
      <div class="orange row" style="height: 8.4rem">
        <div class="eight wide column mobile only">
          <img src="./../assets/logo_white-400.png" class="ui small image" />
        </div>
        <!--
        <div class="eight wide column computer only tablet only">
          <img src="./../assets/logo_white-400.png" class="ui fluid image" />
          <span class="ui white medium header">
            .: Sanwicherie :.
          </span>
        </div>
        -->
        <div class="eight wide column">
          <div class="ui three column grid">
            <div class="column">
              <i class="right user big icon"></i>
            </div>
            <div class="column">
              <i class="shopping cart link big icon"></i>
            </div>
            <div class="column">
              <i class="white bars big link icon" @click="clickMenu"></i>
            </div>
          </div>
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
