<template>
    <div>

        <!-- header-->
        <header>

            <div class="header-content">

                    <!-- menu -->
                    <TopMenu> </TopMenu>

                <!-- card with call to action -->
                <div class="ui one column stackable center aligned grid">
                    <call-to-action> </call-to-action>
                </div>

            </div>
        </header>
    </div>
</template>

<script>
    import CallToAction from '../CallToAction/CallToAction'
    import TopMenu from '../Menu/Menu'
    export default {
        name: "pageHeader",
        components: {CallToAction, TopMenu}
    }
</script>

<style scoped>
    .bg{
        background-image: url(./bg-01.png);
        background-size: 4px;
        width: 100%;
    }

    .header-content{
        width: 100%;
        min-height: calc(100vw/1.2);
        padding-bottom: 1rem;

    }

    .header-card{
        width: 70% !important;
    }
    .ui.header>.image:not(.icon), .ui.header>img {
        width: 5em;
    }

    #cta-wrapper{
        height: calc(100vw/1.91);
        background-image: url(./burger_big_02.png);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;

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


    #slider{
        border:  solid 1px;
        width: 90vw;
        margin:  auto;
        /*  height: 47.1vw; */
        /*overflow: hidden;
        position: relative; */
    }

    /*#slider .image{
        width: 100%;
    }*/
    #slider .cta{
        position: absolute;
        background-color: rgba(188, 189, 189, .4);
        bottom: 45%;
        right: 45%;
        padding: 2em;
    }

    @media (min-width: 502px) {
        #cta-wrapper .header{
            font-size: 2.8rem;
        }

        #cta-wrapper .ui.button{
            font-size: 1.8rem ;
        }

        #slider{
            width: 80vw;
            /*  height: 35vw; */
        }

        .fade-enter-active, .fade-leave-active {
            transition: opacity .5s;
        }
        .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
            opacity: 0;
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