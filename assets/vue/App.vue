<template>
    <div>
       <top> </top>
        <page-header> </page-header>
    </div>
</template>

<script>
    //import 'semantic-ui-css/semantic.css';
    import  Top from './components/Top/Top'
    import  CallToAction from './components/CallToAction/CallToAction'
    import PageHeader from "./components/PageHeader/PageHeader";
    export default {
        name: 'App',
        components: {
            PageHeader,
            Top,
            CallToAction
        }
    }
</script>

<style >
</style>