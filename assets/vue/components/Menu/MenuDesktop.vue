<template>
    <div class="ui padded middle aligned grid toolbar" id="nav-h">
        <div class="row">
            <div class="three wide column">  <img src="./logo.png"  class="ui standard image"/></div>
            <div class=" thirteen wide column  ui medium celled horizontal list right aligned">
                <div class="item"><router-link :to="{name: 'home'}">Accueil</router-link></div>
                <div class="item"><router-link :to="{name: 'products'}">La Carte</router-link></div>
                <div class="item"><router-link :to="{name: 'photos'}">Photos</router-link></div>

                <div class="item">Horaires</div>
                <div class="item"><router-link :to="{name: 'contact'}">Contact</router-link></div>
                <router-link :to="{ name: 'allergies'}" class="ui circular" >
                    <sui-button circular icon="info" size="mini"/>
                </router-link>
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
        font-size: 1.5rem;
    }
    @media (min-width: 690px) {
        #nav-h .item{
            font-size: 2rem;
        }
    }


</style>