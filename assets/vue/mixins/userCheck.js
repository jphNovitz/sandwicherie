export default {
    name: 'userCheck',
    data (){
        return {
            user: {}
        }
    },
    computed: {
        authenticated: function(){
            return this.$auth.authenticated ;
        }
    },
    created() {
        if (this.authenticated){
           if (Object.keys(this.$store.getters.get_user).length ===0){
               this.$http.get('/api/s/profile')
                   .then(response => {
                       console.log('got the user')
                       this.user = JSON.parse(response.bodyText) //set user in datas
                       this.$store.dispatch('set_user', this.user) // set user in store
                       this.$store.dispatch('update_logged', true)
                   }/*, error => {
                       console.log('cant get the user ==> 401')
                       this.$router.push({name: 'login', params: {destination: this.destination}})
                   }*/);
           } else {
               this.user = this.$store.getters.get_user
           }
        }
    }
}