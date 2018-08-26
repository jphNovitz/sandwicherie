<template>
    <div id="top">
        <!-- contact block-->
        <sui-grid>
            <sui-grid-row  :columns="1" color="green" style="border-top: solid 2px orangered">
                <sui-grid-column>
                    <sui-list horizontal>
                        <sui-list-item>
                            <a href="sms:+320468538605">
                            <i class="phone icon"></i> {{site.phone}}
                            </a>
                        </sui-list-item>
                        <sui-list-item>
                            <a href="mailto:info@laclementine.be">
                                <i class="mail icon"></i>
                                <span class="notPhone"> {{site.email}} </span>
                            </a>
                        </sui-list-item>
                        <template v-if="isLogged">
                            <sui-list-item>
                                <router-link :to="{name: 'cart'}">
                                    <i class="shopping cart icon"></i> <span class="notPhone"> Panier </span>
                                </router-link>
                                <span class="ui circular mini label" style="color: #000">
                                    {{cart_length}}
                                </span>
                            </sui-list-item>
            <sui-list-item>
                <router-link :to="{name: 'profile'}">
                    <i class="user icon"></i> Mon compte
                </router-link>
            </sui-list-item>
            <sui-list-item>
                <router-link :to="{name: 'logout'}">
                    <i class="sign out alternate icon"></i> <span class="notPhone">Déconnexion </span>
                </router-link>
            </sui-list-item>

        </template>
        <template v-else>
            <sui-list-item>
                <router-link :to="{name: 'login'}">
                    <i class="sign in alternate icon"></i> <span class="notPhone">Connexion</span>
                </router-link>
            </sui-list-item>
            <sui-list-item>
                <a href="/inscription">
                    <i class=""></i> <span class="notPhone">Enregistrement</span>
                </a>
            </sui-list-item>
        </template>
                    </sui-list>
                </sui-grid-column>
            </sui-grid-row>
            <sui-grid-row :columns="1" style="background-color: #fff; ">
                <sui-grid-column class="spaced lowPadding">
                    <h3>{{site.subTitle}}</h3>
                </sui-grid-column>
            </sui-grid-row>
        </sui-grid>
    </div>
</template>

<script>
    export default {
        name: "top",
        components: {},
        data() {
          return {
              isLogged: false
          }
        },
        created() {
            this.$store.watch(
                (state)=>{
                    return this.$store.getters.is_logged
                }, (val)=>{
                    this.isLogged = val ;
                }
            )
        },
        computed: {
            site: function () {
                return this.$store.getters.site;
            },
            cart_length: function (){
                return this.$store.getters.length_cart;
            }
        },
        methods: {
            connectionStatus: function (val) {
                this.isLogged = val ;
            }
        }
    }
</script>

<style lang="scss" scoped >
    #top {
        font-family: 'Cuprum', sans-serif;
    }
    #top h3 {
        color: green;
        font-size: 1.2rem;
        border-bottom: 1px solid green
    }

    .ui.horizontal.list>.item a {
        color: #fff;
        font-size: 1.3rem ;
    }
    .notPhone {
        display: none;
    }

    .lowPadding {
        padding-top: .5rem !important;
        padding-bottom: .5rem !important;
    }

    @media screen and (min-width: 800px)
    {
        .ui.horizontal.list>.item {
            font-size: 1.8rem ;
        }

        #top h3 {
            font-size: 1.8rem;
            word-spacing: .8rem;
            letter-spacing: .2rem;
        }

        .notPhone {
            display: inline;
        }

        .lowPadding {
            padding-top: .9rem !important;
            padding-bottom: .9rem !important;
        }

    }

</style>