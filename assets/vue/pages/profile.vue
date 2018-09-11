<template>
    <sui-container>
        <h2>Espace membre</h2>
        <sui-list horizontal>
            <sui-list-item >
                <a @click="setComponent('userDetails'), setActive('userDetails')"
                   :class="{ active: isActive('userDetails') }" >
                    Mon Profil
                </a>
            </sui-list-item>
            <sui-list-item>
                <a @click="setComponent('userFavorites'), setActive('userFavorites')"
                   :class="{ active: isActive('userFavorites') }">
                Mes favoris
                </a>
            </sui-list-item>
            <sui-list-item>
                <a @click="setComponent('userDiscoveries'), setActive('userDiscoveries')"
                    :class="{ active: isActive('userDiscoveries') }">
                    Mes découvertes
                </a>
            </sui-list-item>
            <sui-list-item>
                <a @click="setComponent('userOrders'), setActive('userOrders')"
                :class="{ active: isActive('userOrders') }">
                    mes commandes
                </a> </sui-list-item>
        </sui-list>

        <component :is="userComponent" :user="user"></component>
    </sui-container>

</template>
<script>
    import flashMessage from '../components/Messages/flashMessage' ;
    import securityCheck from '../mixins/securityCheck' ;
    import userDetails from '../components/User/userDetails'
    import userFavorites from '../components/User/userFavorites'
    import userDiscoveries from '../components/User/userDiscoveries'
    import userOrders from '../components/User/userOrders'

    export default {
        name: 'profile',
        mixins: [securityCheck],
        components: {flashMessage, userDetails, userFavorites, userDiscoveries, userOrders},
        data (){
            return{
               userComponent: 'userDetails',
                active: null
            }
        },
        computed: {
            // user: function () {
            //     return this.mixin_user;
            // }
    },
        methods: {
            setComponent: function (name) {
                this.userComponent = name ;
            },
            isActive: function (item) {
                return this.active === item
            },
            setActive: function (item) {
                this.active = item
            }
        }
    }
</script>
<style>
.active{
    background-color: #cecece;
    color: floralwhite;
}
</style>