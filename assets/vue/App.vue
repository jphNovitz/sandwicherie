<template>
    <div>
       <top> </top>
        <page-header> </page-header>
        <Map> </Map>
        <section class="ui middle aligned grid container">
            <Search-Product></Search-Product>
        </section><section class="ui middle aligned grid container">
            <Suggestions> </Suggestions>
        </section>

   </div>

</template>

<script>
    //import 'semantic-ui-css/semantic.css';
    import  Top from './components/Top/Top'
    import PageHeader from "./components/PageHeader/PageHeader";
    import Suggestions from "./components/Suggestions/Suggestions"
    import SearchProduct from "./components/SearchProduct/SearchProduct"
    import Map from "./components/Map/Map"
    export default {
        name: 'App',
        components: {
            PageHeader,
            Top,
            Suggestions,
            SearchProduct,
            Map
        },
        computed: { }
    }
</script>

<style >
</style>