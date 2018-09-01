
export default {
    name: 'securityCheck',
        data (){
            return {
                user: ''
        }
    },
    computed: {
        authenticated: function(){
            return this.$auth.authenticated ;
        },
        destination: function(){
            if (this.$route.name !== 'login'){
                return this.$route.path
            }
            return 'profile';
        }
    },
    created(){},
    mounted () {
       if ( !this.authenticated || (Object.keys(this.$store.getters.get_user).length ===0) ) {
            console.log(this.$auth.getToken())
           this.$http.get('/api/s/profile')
               .then(response => {
                   console.log('got the user')
                   this.user = JSON.parse(response.bodyText) ; //set user in datas
                   this.$store.dispatch('set_user', this.user) ; // set user in store
                   this.$store.dispatch('update_logged', true) ;
               }, error => {
                   console.log('cant get the user ==> 401')
                   this.$store.dispatch('update_logged', false) ;
                   this.$router.push({name: 'login', params: {destination: this.destination}})
               });
       }
        else {
           this.user = this.$store.getters.get_user ;
           this.$store.dispatch('update_logged', true) ;
       }
    }
}