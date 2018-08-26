<template>
    <div>
        <sui-message v-if="deconnected = true ">
            Vous êtes déconnecté.
        </sui-message>
    </div>
</template>

<script>
    import securityCheck from '../mixins/securityCheck'

    export default {
        name: 'logout',
        components: {},
        mixins: [securityCheck],
        data (){
            return {
                deconnected : false
            }
        },
        mounted () {
            this.$store.dispatch('set_user', {})
            this.$store.dispatch('update_logged', false)
            this.$auth.setToken(null);
            if ((Object.keys(this.$store.getters.get_user).length === 0 ) &&
                (this.$store.getters.is_logged === false) &&
                (this.$auth.authenticated === false)){
                this.$store.dispatch('update_logged', false)
                this.$router.push({name: 'home', params: {}})
            }
        }
    }
</script>