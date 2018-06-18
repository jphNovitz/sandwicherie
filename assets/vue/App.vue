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
              site: '',
              isConnected: false,
          }
        },
        mounted () {
            let raw = document.getElementById('products').dataset.vars
            //this.$store.commit('SET_SUGGESTIONS', JSON.parse(raw).last)
            this.$store.dispatch('call_allergies')
            this.$store.dispatch('call_categories')
            this.$store.dispatch('call_products')
            this.$store.dispatch('call_types')
            this.$store.commit('SET_SITE', this.parsed.site)
        },
        computed: {
            parsed: function() {
                let raw =  document.getElementById('site').dataset.vars
                return JSON.parse(raw)

            }
        }/*,
        sockets: {
            connect() {
                // Fired when the socket connects.
                this.isConnected = true;
            },

            disconnect() {
                this.isConnected = false;
            },

            // Fired when the server sends something on the "messageChannel" channel.
            messageChannel(data) {
                this.socketMessage = data
            }
        },

        methods: {
            pingServer() {
                // Send the "pingServer" event to the server.
                this.$socket.emit('pingServer', 'PING!')
            }
        }*/

    }
</script>

<style >
</style>