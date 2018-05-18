<template>
    <div >
        <top> </top>
        <page-header> </page-header>
        <div class="ui container">
            <router-view> </router-view>
        </div>
    </div>
</template>

<script>
    import router from './router'
    import Top from './components/Top/Top'
    import PageHeader from "./components/PageHeader/PageHeader";

    export default {
        name: 'App',
        router,
        components: {
            PageHeader,
            Top
        },
        data () {
          return {
              site: ''
          }
        },
        mounted () {
            this.$store.commit('SET_SITE', this.parsed.site)
        },
        computed: {
            parsed: function() {
                let raw =  document.getElementById('site').dataset.vars
                return JSON.parse(raw)

            }
        },
        methods: {}
    }
</script>

<style >
</style>