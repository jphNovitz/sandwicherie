<template>
    <div>
        <span v-if="isLogged">
            <i class="user icon"></i> Mon compte
            <a  @click="deconnect()"><i class="sign out alternate icon"></i> Déconnexion</a>
        </span>
        <span v-else>
            <i class="sign in alternate icon"></i> <router-link :to="{name: 'login'}">Connexion</router-link>
        </span>
    </div>
</template>

<script>
    export default {
        name: 'connect',
        components: {},
        data (){
            return {
                //isLogged: false,
                test: ''
            }
        },
        created() {
            this.isToken = this.$auth.check()
            console.log(this.$auth)
            //this.$store.dispatch('create_token')
        },
        computed: {
            isLogged: function() {
                return this.$store.getters.is_logged
            }
        },
        watch: {
/*            'this.$store.getters.is_logged': function(val){
                this.isLogged = val
            }*/
        },
        methods: {
            deconnect: function () {
                this.$auth.removeToken()
                this.$store.dispatch('update_logged', this.$auth.check())

            }
        }
    }
</script>

<style>

</style>