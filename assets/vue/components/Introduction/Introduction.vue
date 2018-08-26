<template>
    <div class="ui row" id="introduction-wrapper">
        <div class="ui sixteen wide column">
            {{text}}
        </div>
    </div>

</template>

<script>

    export default {
        name: 'introuction',
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
    #introduction-wrapper{
        margin: 5rem 0 ;
        border-radius: 20px ;
        padding-bottom: 28rem;
        background-image: url("./500_carly-jayne-464057-unsplash.png");
        background-size: cover;
        background-repeat: no-repeat;
        background-position-y: bottom;
    }
    @media (min-width: 800px) {
        #introduction-wrapper{
        background-image: url("./1200_carly-jayne-464057-unsplash.png");
        background-position: bottom center;
    }
}

</style>