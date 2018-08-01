<template>

    <div >
        <flash-message />
        <form v-on:submit.prevent="login">
        <!--<sui-form v-on:submit.prevent="login">-->
            <sui-form-field>
                <label>Nom d'utilisateur</label>
                <input placeholder="Nom d'utilisateur" v-model="input._username">
            </sui-form-field>
            <sui-form-field>
                <label>Mot de passe</label>
                <input placeholder="Mot de passe" v-model="input._password" type="password">
            </sui-form-field>
            <sui-button type="submit">Je me connecte</sui-button>
        <!--</sui-form>-->
        </form>
    </div>
</template>
<script>
   import flashMessage from '../components/Messages/flashMessage'

    export default {
        name: 'login',
        components: {flashMessage},
        data() {
            return {
                input: {
                    _username: '',
                    _password: ''
                },
                error: false,
                destination: '',
                user: {},
                flash_message: {}

            }
        },
        computed: {
            // session: function () {
            //     return this.$session.flash.get('message')
            // }
        },
        beforeCreate() {},
        mounted() {
            if(this.$session.exists()){
                this.$router.push({name: 'profile'})
            }

        },
        watch: { },
        methods: {
            login: function () {

                this.$http.post('http://localhost:8000/api/login_check', this.input).then(function (response) {
                    if (response.status === 200 && 'token' in response.body) {
                        this.$session.start()
                        this.$session.set('jwt', response.body.token)
                        this.$http.headers.common['Authorization'] = 'Bearer ' + response.body.token
                        this.$session.flash.set('message', {
                            'type': 'success',
                            'message': 'Bienvenue'
                        })
                        this.$router.push({name: 'profile'})
                    }
                }, function (err) {
                    console.log('err', err)
                    this.$session.flash.set('message', {
                        'type': 'error',
                        'message': 'Mauvais Username ou mauvais mot de passe'
                    })
                    this.$router.go(this.$router.currentRoute)
                })
                // },
                // send() {
                //
                //     this.$auth.login(this, this.input, this.destination, (errors) => {
                //         console.log(errors);
                //         this.error = true
                //     })
                //     setTimeout( function() {
                //         this.$store.dispatch('update_logged', this.$auth.check())
                //     }, 1000)
                //     this.$store.dispatch('set_auth', this.input)
                // }
            }
        // },
        // watch: {
        //     d: function (val) {
        //         alert(this.$session.flash.get('message'));
        //
        //     }

// mixin_user: function () {
            //     this.user =  JSON.parse(this.mixin_user)
            // }
        }
    }

</script>
<style>

</style>