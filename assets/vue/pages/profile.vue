<template>
    <div>
        {{user.username}}
    </div>

</template>
<script>
    export default {
        name: 'profile',
        data (){
            return{
                user: ''
            }
        },
        computed: {
            auth: function () {
                return this.$store.getters.get_auth;
            },

        },
        mounted () {
            if (this.$auth.check()){
                this.$http.get('http://localhost:8000/api/s/profile').then(response => {
                    console.log(response)
                    console.log('ok')
                    let user = {}
                    user.username= response.body.username;
                    this.user = user

                }, response => {
                    console.log(response)
                    if (response.status === 401) {
                        if (this.auth.length > 0){
                            send()
                            {
                                this.$auth.login(this, this.input, "menu", (errors) => {
                                    console.log(errors);
                                    router.push({ name: 'login', params: {}})
                                })
                            }
                            router.push({ name: 'profile', params: {}})
                        } else {
                            this.$router.push({ name: 'login', params: {destination: 'profile'}})
                        }
                    }
            });
            } else {
                console.log('pas de token') ;
                console.log('redirection') ;
                this.$router.push({name: 'login', params: {destination: 'profil'}}) ;

            }
        },
      methods: {
          send(input, destination = null) {
              this.$auth.login(this, input, destination , (errors) => {
                  console.log(errors);
              })
      }
     }
    }
</script>
<style>

</style>