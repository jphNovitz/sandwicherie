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
            console.log('***'+this.mixin_user+'******' )
            if (this.$store.getters.user !== undefined ){
                this.$store.dispatch('set_user', {})
            }
            if (this.$store.getters.is_logged === true){
                this.$store.dispatch('update_logged', false)
            }
            if (this.$store.getters.get_auth === true){
                this.$store.dispatch('set_auth', {})
            }
            this.mixin_user = {}
            this.deconnected = true

            setTimeout(function () {
                this.$router.push({ name: 'home', params: {}})

            }, 1500)
        }
    }
</script>