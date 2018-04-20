<template>
    <div>
        <!-- card with call to action -->

        <div class="ui stackable  grid" id="cta-wrapper" :style="cta_background">
            <div class="ui row bg ">
                <div class="sixteen wide middle aligned centered column">
                    <h1 class="ui sizer header">{{featured_products.name}}</h1>
                </div>
                <div class="five wide middle aligned centered column">
                    <button class="ui orange basic button">
                        <i class="cart plus icon"></i>
                        Je Commande
                    </button>
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
                featured_products: {},
                cta_background: ''
            }
        },
        mounted: function () {
            let raw =  document.getElementById('products').dataset.vars
            const parsed = JSON.parse(raw).featured
            var that = this
            for (let i = 0 ; i < parsed.length ; i++ ){
                    setTimeout (function () {
                        that.featured_products = parsed[i]
                        let name = parsed[i].images[0].imageName;
                        that.cta_background = 'background-image: url(./images/products/' + name + ')'
                    }, 5000 * i)
                }
        },
        watch: {
         /*   featured_products: function () {
                let raw =  document.getElementById('products').dataset.vars
                return JSON.parse(raw).featured[0]
            },
         cta_background: function () {
             alert()
              let name = this.featured_products.images[0].imageName;
              this.cta_background = 'background-image: url(./images/products/' + name + ')'
            }
 */
        }
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
        #cta-wrapper .header{
            font-size: 4.8rem;
        }

        #cta-wrapper .ui.positive.button, .ui.positive.buttons .button{
            font-size: 3rem ;
        }
    }
</style>