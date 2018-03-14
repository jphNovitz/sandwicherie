<template>
        <div class="ui container" id="wrapper">
            <Top> </Top>
            <CallToAction></CallToAction>

        </div> <!-- end  ui container grid -->
</template>
<script>
    //import 'semantic-ui-css/semantic.css';
    import  Top from './components/Top/Top'
    import  CallToAction from './components/CallToAction/CallToAction'
    export default {
        name: 'App',
        components: {
            Top,
            CallToAction
        }
    }
</script>
<style >
   #wrapper{
       background-color: #ffffff;
       min-height: 100vh;
       margin-top: 5vh;
       padding: 2%;
       border: solid 1px rgb(255, 230, 230);
       border-radius: 4%;
   }
    h1{
        font-family: 'Pacifico', cursive;

    }
</style>