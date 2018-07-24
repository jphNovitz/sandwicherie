<template>
    <div>
        <p>
        {{user.username}} <br />
            {{user.last_name}} {{user.first_name}}
        </p>
        <p>
            {{user.phone}}
        </p>
    </div>

</template>
<script>
    import securityCheck from '../mixins/securityCheck'
    export default {
        name: 'profile',
        mixins: [securityCheck],
        data (){
            return{
                user: {}
            }
        },
        watch: {
            mixin_user: function () {
                this.user =  JSON.parse(this.mixin_user)
            }
        }
            /*,
        computed: {
            auth: function () {
                return this.$store.getters.get_auth;
            },

        },
        mounted () {
            if (this.$auth.check()){
                this.$http.get('http://localhost:8000/api/s/profile').then(response => {
                    console.log(response)
                    let user = response.bodyText
                    console.log('******* '+user+' *********')
                    this.user = user
                    this.$store.dispatch('set_user', user)

                }, response => {
                    console.log(response)
                    if (response.status === 401) {
                        if (this.auth.length > 0){
                            send()
                            {
                                this.$auth.login(this, this.input, "menu", (errors) => {
                                    console.log(errors);
                                    this.$store.dispatch('update_logged', false)
                                    router.push({ name: 'login', params: {destination: 'profil'}})
                                })
                            }
                            router.push({ name: 'profile', params: {}})
                        } else {

                            this.$store.dispatch('update_logged', false)
                            this.$router.push({ name: 'login', params: {destination: 'profil'}})
                        }
                    }
            });
            } else {
                this.$router.push({name: 'login', params: {destination: 'profil'}}) ;

            }
        },
      methods: {
          send(input, destination = null) {
              this.$auth.login(this, input, destination , (errors) => {
                  console.log(errors);
              })
      }
     }*/
    }
</script>
<style>

</style>