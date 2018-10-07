<template>
        <div class="ui centered fourteen wide column">
            <sui-segment raised class="intro" >
                {{text}}
            </sui-segment>
        </div>
</template>

<script>
    export default {
        name: 'introdction',
        components: {},
        data (){
            return { }
        },
        computed: {
            text: function(){
                return this.$store.getters.site.introduction ;
            }
        }
    }

</script>

<style scoped>
    .intro{
        padding: 3rem;
        margin: 2rem auto !important;
        font-size: large;
    }

</style>