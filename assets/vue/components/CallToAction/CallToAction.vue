<template>
    <div>
        <!-- card with call to action -->
        <div class="ui stackable  grid" id="cta-wrapper" :style="cta_background">
            <div class="ui row bg ">
                <div class="sixteen wide middle aligned centered column">
                    <transition name="fade">
                    <h1 class="ui sizer header" v-if="change">{{featured_product.name}}<br />{{featured_product.price}} €</h1>
                    </transition>
                </div>
                <div class="five wide middle aligned centered column">
                    <transition name="fade">
                        <button class="ui orange basic button" v-if="change">
                            <i class="cart plus icon"></i>
                            Je Commande
                        </button>
                    </transition>
                </div>

            </div>
            <!-- cta wrapper -->
    </div>
    </div>
</template>
<script>
    export default {
        name: "call-to-action",
        data (){
            return {
                change: true,
               featured_product: {},
                cta_background: {
                    transition: 'all ease .9s' ,
                },
                name :  ''
            }
        },
        mounted: function () {
            this.set_featured(1)
            this.cta_background.backgroundImage = 'url(./images/products/' + this.name + ')'
            const that = this
            let i = 0
                setInterval(function () {
                    if (i > that.parsed.length-1) i=0
                    that.change = true
                    that.set_featured(i)
                    that.cta_background.backgroundImage = 'url(./images/products/' + that.name + ')'
                    setTimeout(function () {
                        that.change = false
                    }, 11000)
                    i++
                }, 12000)
        },
        computed: {
            parsed: function() {
                let raw =  document.getElementById('products').dataset.vars
                return JSON.parse(raw).featured
            }
        },
        methods: {
          set_featured: function (count=0) {
              this.featured_product = this.parsed[count]
              this.name = this.parsed[count].images[0].imageName;
          }
        },
        watch: {}
    }
</script>
<style scoped>
    #cta-wrapper{
        height: calc(100vw/1.91);
        /*ackground-image: url(images/burger_big_02.png);*/
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;

    }
    .bg{
        background-image: url(./bg-01.png);
        background-size: 4px;
        width: 100%;
    }
    #cta-wrapper .header{
        background-color: inherit;
        color: #fff;
        font-weight: bolder;
        text-shadow: 2px 2px orange;
    }
    #cta-wrapper .ui.button{
        background-color: rgba(255, 255, 255, .6) !important;
        font-weight: bold;
        border-radius: 20px;
        color: orangered !important;
    }
    .fade-enter-active, .fade-leave-active {
        transition: opacity 2s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
    @media (min-width: 502px) {
        #cta-wrapper .header{
            font-size: 2.8rem;
        }

        #cta-wrapper .ui.button{
            font-size: 1.8rem ;
        }
    }
    @media (min-width: 690px) {
        #cta-wrapper .header{
            font-size: 3.8rem;
        }
        #cta-wrapper .ui.positive.button, .ui.positive.buttons .button{

            font-size: 2.5rem ;
        }
    }
    @media (min-width: 1200px) {

        #cta-wrapper {
            height: 65vh;
            width: calc(65vh*1.908);
        }
        #cta-wrapper .header{
            font-size: 4.8rem;
        }

        #cta-wrapper .ui.positive.button, .ui.positive.buttons .button{
            font-size: 3rem ;
        }
    }
</style>