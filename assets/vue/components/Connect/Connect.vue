<template>
    <div>
        <span v-if="isLogged">

            <sui-list-item>
                <router-link :to="{name: 'profile'}">
                    <i class="user icon"></i> Mon compte
                </router-link>
            </sui-list-item>
            <sui-list-item>
                <router-link :to="{name: 'logout'}">
                    <i class="sign out alternate icon"></i> <span class="notPhone">Déconnexion </span>
                </router-link>
            </sui-list-item>

        </span>
        <span v-else>
            <sui-list-item>
                <router-link :to="{name: 'login'}">
                    <i class="sign in alternate icon"></i> <span class="notPhone">Connexion</span>
                </router-link>
            </sui-list-item>
            <sui-list-item>
                <a href="/inscription">
                    <i class=""></i> <span class="notPhone">Enregistrement</span>
                </a>
            </sui-list-item>
        </span>
    </div>
</template>

<script>

    export default {
        name: 'connect',
        components: {},
        data (){
            return { 
                isLogged: false
            }
        },
        created() {
            this.$store.watch(
                (state)=>{
                    return this.$store.getters.is_logged
                }, (val)=>{
                    this.isLogged = val ;
                console.log('---------> ' + val) 
                }
            )
        },
        computed: {},
        watch: {},
        methods: {
            connectionStatus: function (val) {
                this.isLogged = val ;
                console.log('---------> ' + val)
            }
        }
    }
</script>

<style>

</style>