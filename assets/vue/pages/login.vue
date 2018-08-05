<template>
    <div>
        <form v-on:submit.prevent="login">
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
   // import securityCheck from '../mixins/securityCheck'

    export default {
        name: 'login',
     //   mixins: [securityCheck],
        data() {
            return {
                input: {
                    _username: '',
                    _password: ''
                },
                error: false,
                destination: '',
                user: {}
            }
        },
        mounted() {},
        created() {
                if (this.$route.params.destination !== undefined) {
                    this.destination = this.$route.params.destination;
                } else {
                    this.destination = 'profile'
                }
                if (this.user.username !== undefined) {
                    this.$router.push({ name: this.destination, params: {}})
                }
        },
        methods: {
            login () {
                this.$auth.login(this, this.input, this.destination, (errors) => {
                    console.log(errors);
                    this.error = true
                })
            }
        // },
        // watch: {
        //     mixin_user: function () {
        //         this.user =  JSON.parse(this.mixin_user)
        //     }
        // }
    }
    }

</script>
<style>

</style>