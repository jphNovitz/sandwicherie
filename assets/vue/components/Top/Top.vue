<template>
    <div>
        <!-- contact block-->
        <div class="ui padded stackable grid" style="border-top: solid 2px orangered">
            <div class="green row">
                <div class="sixteen wide column">
                    <div class="ui large celled horizontal list">
                        <div class="item">
                            <i class="phone icon"></i>0468538605 </div>
                        <div class="item">
                            <i class="mail icon"></i>
                            <a href="mailto:info@laclementine.be">info@laclementine.be</a>
                        </div>
                        <div class="item">
                            <i class="shopping cart icon"></i>Panier</div>
                        <div class="item">
                            <i class="user icon"></i>Mon compte</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "top"
    }
</script>

<style lang="scss">
    #test{
        display: none;
    }
    .site-title{
        display: none;
        font-family: 'Pacifico', cursive;
        background-color: inherit;
        color: orangered;
    }
</style>