<template>
    <div>
       <top> </top>
        <page-header> </page-header>
    </div>
</template>

<script>
    //import 'semantic-ui-css/semantic.css';
    import  Top from './components/Top/Top'
    import PageHeader from "./components/PageHeader/PageHeader";
    export default {
        name: 'App',
        components: {
            PageHeader,
            Top
        },
        computed: {}
    }
</script>

<style >
</style>