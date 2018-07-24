<template>
    <div>
        <form v-on:submit.prevent="send">
            <label>Utilisateur</label>: <input type="text" v-model="input._username"/>

            <label>Mot de passe</label>: <input type="password" v-model="input._password" />
            <button type="submit"> login</button>
        </form>

        <sui-message v-if="error">
            <sui-message-header>Erreur</sui-message-header>
            <p>
                Une erreur s'est produite veuillez  vérifier votre nom d'utilisateur et votre mot de passe.
            </p>
        </sui-message>
    </div>
</template>
<script>

    export default {
        name: 'login',
        data() {
            return {
                input: {
                    _username: '',
                    _password: ''
                },
                error: false,
                destination: 'menu'
            }
        },
        mounted() {},
        created() {
            this.destination = this.$route.params.destination ;
        },
        methods: {
            send() {
                this.$auth.login(this, this.input, this.destination, (errors) => {
                    console.log(errors);
                    this.error = true
                })
                setTimeout( function() {
                    this.$store.dispatch('update_logged', this.$auth.check())
                }, 1000)
                this.$store.dispatch('set_auth', this.input)
            }
        }
    }

</script>
<style>

</style>