export default {
    name: 'securityCheck',
        data () {
            return {
                mixin_user: ''
        }
    },
    computed: {
        dest: function () {
            return this.$route.path
        },
        // auth is set in login page
        auth: function () {
            if (this.$store.getters.get_auth) {
                return this.$store.getters.get_auth ;
            }
        }
    },
    created(){},
    mounted () {
        if (this.$auth.check()){
            this.$http.get('http://localhost:8000/api/s/profile')
                .then(response => {
                    console.log('got the user')
                    this.mixin_user = response.bodyText //set user in datas
                    this.$store.dispatch('set_user', this.mixin_user) // set user in store
            }, response => {
                console.log('cant get the user ==> 401')
                if (response.status === 401) {
                    if  (this.auth !== undefined && this.auth.length > 0){
                        console.log('token is not empty ' + this.auth + ' => try it')
                        if (this.send()) {
                            router.push({ name: 'profile', params: {}})
                        } else {
                            console.log('error')
                            this.setConnectionFalse();
/*                            this.$store.dispatch('update_logged', false)
                            router.push({ name: 'login', params: {destination: 'profil'}})
*/                        }
                    } else {
                        console.log('no token all flags false and redirect')
                        this.setConnectionFalse();
/*                        this.$store.dispatch('update_logged', false)
                        this.$router.push({ name: 'login', params: {destination: 'profil'}})
*/                    }
                }
            });
        } else {
            this.$router.push({name: 'login', params: {destination: 'profil'}}) ;

        }
    },
    watch: {},
    methods: {
        send() {
            this.$auth.login(this, this.input, "menu", (errors) => {
                console.log("can't log in ");
                return false ;
                /*this.$store.dispatch('update_logged', false)
                router.push({ name: 'login', params: {destination: 'profil'}})*/
            })
            return true ;
        },
        setConnectionFalse (){
            this.$store.dispatch('update_logged', false)
            this.$router.push({ name: 'login', params: {destination: this.dest}})
        }
    }
}