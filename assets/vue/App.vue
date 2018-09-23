<template>
    <div >
        <top> </top>
        <page-header> </page-header>
        <!--<div class="ui fourteen wide column">-->
            <!--<sui-message class="flash" :class="flash_message.type" v-if="flash_message!==undefined" >-->
                <!--{{flash_message.message}}-->
            <!--</sui-message>-->
        <!--</div>-->
        <div class="wrapper">
            <router-view> </router-view>
        </div>
            <page-footer :site="parsed.site"></page-footer>
    </div>
</template>

<script>
    import router from './router' ;
    import Top from './components/Top/Top' ;
    import PageHeader from "./components/PageHeader/PageHeader" ;
    import PageFooter from "./components/Footer/Footer"

    export default {
        name: 'App',
        router,
        components: {
            PageHeader,
            Top,
            PageFooter
        },
        data () {
          return {
              site: ''
          }
        },
        beforeCreate: function() {

        },
        mounted () {
            let raw = document.getElementById('products').dataset.vars
            //this.$store.commit('SET_SUGGESTIONS', JSON.parse(raw).last)
            this.$store.dispatch('call_allergies')
            this.$store.dispatch('call_categories')
            this.$store.dispatch('call_products')
            this.$store.dispatch('call_types')
            this.$store.dispatch('call_privacy')
            this.$store.commit('SET_SITE', this.parsed.site)
            // setTimeout(() =>{
            //     this.flash_message = this.$session.flash.get('message');
            // }, 1000);
        },
        computed: {
            parsed: function() {
                let raw =  document.getElementById('site').dataset.vars
                return JSON.parse(raw)
            },
            // flash_message: function () {
            //     return this.$session.flash.get('message')
            // }
        },
        watch: {}
            // flash_message: function (val) {
            //     if (val.length > 0){
            //         this.flash_message = {} ;
            //     }
            // }



    }
</script>

<style scoped>

</style>