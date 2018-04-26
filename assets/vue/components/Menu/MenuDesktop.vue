<template>
    <div class="ui padded middle aligned grid toolbar" id="nav-h">
        <div class="row">
            <div class="three wide column">  <img src="./logo.png"  class="ui tiny image"/></div>
            <div class=" thirteen wide column  ui medium celled horizontal list right aligned">
                <div class="item">Accueil</div>
                <div class="item">Produits</div>
                <div class="item">Allergies</div>
                <div class="item">Horaires</div>
                <div class="item">Contact</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"MenuDesktop",
}
</script>

<style scoped>
    #nav-h .item{
        font-size: 1.2rem;
    }
    @media (min-width: 690px) {
        #nav-h .item{
            font-size: 1.5rem;
        }
    }


</style>