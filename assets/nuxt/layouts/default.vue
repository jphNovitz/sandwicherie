<template>
  <div>
    <sidebar
      class="ui large sidebar vertical orange icon menu"
      :class="{ uncover: sidebarActive, visible: sidebarActive }"
    >
    </sidebar>
    <!-- 
    <div
      class="ui large sidebar vertical orange icon menu"
      :class="{ uncover: sidebarActive, visible: sidebarActive }"
    >
      <div class="ui fluid orange card">
        <div class="content">
          <div class="header">
            Bonjour Invité
          </div>
        </div>
        <div class="extra content">
          <div class="ui two buttons">
            <div class="ui basic grey small button">Se connecter</div>
            <div class="ui blue button">S' inscrire</div>
          </div>
        </div>
      </div>
      <a class="item">
        <i class="home icon"></i>
        Accueil
      </a>
    </div> -->
    <div class="pusher ui grid">
      <div class="row">
        <site-header @opensesame="show"></site-header>
      </div>
      <div v-click-out class="row">
        <nuxt class="sixteen wide column" />
      </div>
    </div>
    <div v-click-out>
      <site-footer></site-footer>
    </div>
  </div>
</template>

<script>
import siteHeader from './Header'
import sidebar from './Sidebar'
import siteFooter from './Footer'
// import store from 'vuex'
export default {
  components: {
    siteHeader,
    sidebar,
    siteFooter
  },
  directives: {
    'click-out': {
      bind(el, binding, vnode) {
        el.addEventListener('click', function() {
          if (vnode.context.sidebarActive === true) {
            vnode.context.sidebarActive = false
          }
        })
      }
    }
  },
  data() {
    return {
      sidebarActive: false
    }
  },
  computed: {
    infos: function() {
      return this.$store.getters['init/infos']
    }
  },
  mounted() {},
  methods: {
    show: function() {
      this.sidebarActive = !this.sidebarActive
    }
  }
}
</script>

<style>
html {
  font-family: 'Source Sans Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI',
    Roboto, 'Helvetica Neue', Arial, sans-serif;
  font-size: 16px;
  word-spacing: 1px;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
  -moz-osx-font-smoothing: grayscale;
  -webkit-font-smoothing: antialiased;
  box-sizing: border-box;
}

*,
*:before,
*:after {
  box-sizing: border-box;
  margin: 0;
}

/* .button--green {
  display: inline-block;
  border-radius: 4px;
  border: 1px solid #3b8070;
  color: #3b8070;
  text-decoration: none;
  padding: 10px 30px;
}

.button--green:hover {
  color: #fff;
  background-color: #3b8070;
}

.button--grey {
  display: inline-block;
  border-radius: 4px;
  border: 1px solid #35495e;
  color: #35495e;
  text-decoration: none;
  padding: 10px 30px;
  margin-left: 15px;
}

.button--grey:hover {
  color: #fff;
  background-color: #35495e;
} */
</style>
