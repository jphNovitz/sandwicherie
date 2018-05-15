<template>
    <div>
        <top> </top>
        <page-header> </page-header>
        <router-view> </router-view>
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
          return {}
        },
        mounted () {},
        computed: { },
        methods: {
        }
    }
</script>

<style >
</style>