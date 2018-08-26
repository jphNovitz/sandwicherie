<template>
    <div id="top">
        <!-- contact block-->
        <div class="ui padded stackable grid" style="border-top: solid 2px orangered">
            <div class="green row">
                <div class="sixteen wide column">
                    <div class="ui large celled horizontal relaxed list ">
                        <div class="item">
                            <i class="phone icon"></i> {{site.phone}} </div>
                        <div class="item">
                            <i class="mail icon"></i>
                            <a href="mailto:info@laclementine.be"> <span class="notPhone"> {{site.email}} </span></a>
                        </div>
                        <div class="item">
                            <router-link :to="{name: 'cart'}">
                                <i class="shopping cart icon"></i> <span class="notPhone"> Panier </span>
                            </router-link>
                                <span class="ui circular mini label" style="color: #000">
                                    {{cart_length}}
                                </span>

                        </div>
                        <div class="item">
                           <connect />
                            <!-- <i class="user icon"></i> Mon compte -->
                        </div>
                    </div>
                </div>
                <span class="ui sixteen wide column spaced lowPadding">
                    <h3>{{site.subTitle}}</h3>
                </span>
            </div>
        </div>

    </div>
</template>

<script>
    import connect from '../Connect/Connect'
    export default {
        name: "top",
        components: {connect},
        data() {
          return {
              testPos: null,
              logged: false
          }
        },
        watch: {
        },
        computed: {
            site: function () {
                return this.$store.getters.site;
            },
            cart_length: function (){
                return this.$store.getters.length_cart;
            }
        },
        methods: {}

    }
</script>

<style lang="scss" >
    #top {
        font-family: 'Cuprum', sans-serif;
    }
    #top h3 {
        font-size: 1.2rem;
    }

    .ui.large.horizontal.list>.item {
        font-size: 1.2rem ;
    }

    .ui.large.horizontal.list>.item a {
        color: #fff;
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
        .ui.large.horizontal.list>.item {
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