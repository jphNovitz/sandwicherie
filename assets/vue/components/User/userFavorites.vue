<template>
    <div class="ui sixteen wide column">

        <h2>Vos produits favoris</h2>

        <sui-list divided relaxed style="text-align: left">
            <sui-list-item v-for="fav in favorites" :key="fav.id">
                <sui-list-header>{{fav.name}}
                    <router-link :to="{name: 'detail', params: {slug: fav.slug}}" target="_blank"><sui-button basic color="blue" icon="external alternate" circular /></router-link>
                    <sui-button basic color="red" icon="minus" circular @click="remove_favorite(fav.slug)" />
                    <sui-button basic color="green" icon="cart plus" circular />

                </sui-list-header>
                <sui-list-icon name="github"></sui-list-icon>
                <sui-list-content>
                    {{fav.description}}
                </sui-list-content>

            </sui-list-item>
        </sui-list>
    </div>
</template>
<script>

    export default {
        name: 'userFavorites',
        props: ['user'],
        data() {
            return {
                favorites: []
            }
        },
        created() {
            this.fetch_favorites();
        },
        methods: {
            fetch_favorites: function () {
                this.$http.get('/api/s/profile/favorites')
                    .then(response => {
                        this.favorites = JSON.parse(response.bodyText)
                        console.log(JSON.parse(response.bodyText))
                        // later this.$store.dispatch('set_user', this.user)
                    }, error => {
                        console.log('error with favorites')
                        console.log(error)
                        this.$router.push({name: 'login', params: {destination: this.destination}})
                    });

            },
            remove_favorite: function (slug) {
                this.$http.patch('/api/s/products/'+slug+'/like')
                    .then(response => {
                        console.log('*** ok for favorites ***')
                        this.fetch_favorites()
                    }, error => {
                        console.log('error with favorites')
                        console.log(error)
                    });
            }
        }
    }

</script>
<style scoped>
    .ui.list .list>.item .header, .ui.list>.item .header{
        padding: 1.2rem 0;
    }
</style>