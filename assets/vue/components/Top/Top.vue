<template>
    <div id="top">
        <!-- contact block-->
        <div class="ui padded stackable grid" style="border-top: solid 2px orangered">
            <div class="green row">
                <div class="sixteen wide column">
                    <div class="ui large celled horizontal relaxed list ">
                        <div class="item">
                            <i class="phone icon"></i> 0468538605 </div>
                        <div class="item">
                            <i class="mail icon"></i>
                            <a href="mailto:info@laclementine.be"> info@laclementine.be </a>
                        </div>
                        <div class="item">
                            <i class="shopping cart icon"></i> Panier </div>
                        <div class="item">
                            <i class="user icon"></i> Mon compte </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui sixteen wide column spaced">
            <h3>Sandwicherie, petite restauration, Traiteur, Salon de dégustation</h3>
        </div>
    </div>
</template>

<script>
    export default {
        name: "top",
        data() {
          return {
          }
        },
        mounted: function () {
            document.addEventListener('scroll', function(){
                const test = document.getElementById('top')
                if (test.getBoundingClientRect().y < - 2){
                    test.style.transform= "scale(.1)"
                    test.style.display='none'
                }
            })

        }
    }
</script>

<style lang="scss">
     #top{
         transition: scale .3s ease, display .5s ease;
     }
    .site-title{
        display: none;
        font-family: 'Pacifico', cursive;
        background-color: inherit;
        color: orangered;
    }
</style>