<template>
    <div id="login" >
        <h2>Connexion</h2>
        <sui-grid>
            <sui-grid-row  :columns="1">
                <sui-grid-column>
                    <sui-form  v-on:submit.prevent="login">
                        <sui-form-field>
                            <label>Nom d'utilisateur</label>
                            <input placeholder="nom d'utilisateur" type="text" v-model="input._username" />
                        </sui-form-field>

                        <sui-form-field>
                            <label>Mot de passe</label>
                            <sui-input type="password" placeholder="choisissez bien votre mot de passe" v-model="input._password" />
                        </sui-form-field>
                            <sui-button type="submit"> Se connecter </sui-button>

                    </sui-form>
                </sui-grid-column>
            </sui-grid-row>
        </sui-grid>
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
       components: {},
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
                    this.destination = 'profil'
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
    }
    }

</script>
<style scoped>
    #login{
        text-align: left;
        width: 50%;
    }

</style>