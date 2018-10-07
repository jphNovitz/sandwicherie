<template>
<div>
    <flash-message />
    <section class="ui middle aligned centered grid container">
       <article class="ui middle aligned centered grid cta-full-width">
           <call-to-action> </call-to-action>
       </article>
        <Search-Product></Search-Product>
        <Suggestions> </Suggestions>
        <introduction></introduction>
    </section>

    <section class="ui middle aligned grid container">

    </section>
</div>
</template>

<script>
    import CallToAction from '../components/CallToAction/CallToAction'
    import Suggestions from '../components/Suggestions/Suggestions'
    import SearchProduct from '../components/SearchProduct/SearchProduct'
    import Introduction from '../components/Introduction/Introduction'
    import FlashMessage from '../components/Messages/flashMessage'
    import userCheck from "../mixins/userCheck";

    export default {
        name: 'home',
        mixins: [userCheck],
        components: {
            FlashMessage,
            CallToAction,
            Suggestions,
            SearchProduct,
            Introduction,
        },
        data(){
            return {}
        }
    }

</script>

<style scoped>
    @media (min-width: 502px) {
        .cta-full-width {
            background-color: #efbc72 ;
            width: 100vw ;
            padding: 25vh 0;
            overflow: -webkit-paged-x;
            overflow-y: auto;
            background-image: url("./rawpixel-623444-unsplash.jpg");
            background-position: bottom left;
            background-repeat: no-repeat;
            background-size: cover;
        }
    }



</style>