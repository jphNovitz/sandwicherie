<template>
    <div>
        <div class="ui stackable two column grid row middle aligned">
            <div class="column">
                <h1 class="ui  header">

                    <img class="ui image" src="./logo.png">
                    <div class="content site-title ">
                        La Clémentine
                        <div class="sub  header">Sandwicherie, traiteur et petite restauration</div>
                    </div>

                </h1>
            </div>
            <div class="column right floated right aligned">
                <div class="ui breadcrumb ">
                    <a class="section">Accueil</a>
                    <div class="divider"> / </div>
                    <a class="section">Produits</a>
                    <div class="divider"> / </div>
                    <div class="active section">Contact</div>
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

<style >
.site-title{
    font-family: 'Pacifico', cursive;
    background-color: inherit;
    color: orangered;
}
</style>