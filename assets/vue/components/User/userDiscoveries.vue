<template>
    <div class="ui sixteen wide column">

        <h2>Vos produits à découvrir</h2>
        <sui-list divided relaxed style="text-align: left">
            <card-discovery
                    v-on:remove_discovery="remove_discovery"
                    v-for="toto in discoveries"
                    :key="toto.id"
                    :disco="toto"/>
        </sui-list>
    </div>
</template>
<script>
import order from '../../mixins/order'
import CardDiscovery from '../Cards/CardDiscovery'

    export default {
        name: 'userDiscoveries',
        components: {CardDiscovery},
        mixins: [order],
        props: ['user'],
        data() {
            return {
                discoveries: []
            }
        },
        created(){
          this.fetch_discoveries()
        },
        methods: {
            fetch_discoveries: function () {
                this.$http.get('/api/s/profile/discoveries')
                    .then(response => {
                        this.discoveries = JSON.parse(response.bodyText)
                        // later this.$store.dispatch('set_user', this.user)
                    }, error => {
                        console.log('error with discoveries')
                        console.log(error)
                        this.$router.push({name: 'login', params: {destination: this.destination}})
                    });

            },
            remove_discovery: function (slug) {
                this.$http.patch('/api/s/products/'+slug+'/discovery')
                    .then(response => {
                        this.fetch_discoveries()
                    }, error => {
                        console.log('error with discovery')
                        console.log(error)
                    });
            }
        }
    }

</script>
<style>

</style>