<template>
    <div class="ui stackable five column grid row middle aligned">
        <div class="column">
            <div class="ui circular segment">
                <h3 class="ui header">
                    Burger
                    <div class="sub header">3,5 €</div>
                </h3>
            </div>
        </div>
        <div class="column">
            <div class="ui circular segment">
                <h3 class="ui header">
                    Le New Yorkais
                    <div class="sub header">3,5 €</div>
                </h3>
            </div>
        </div>
        <div class="column">
            <div class="ui circular segment">
                <h3 class="ui header">
                    Croque Moniseur
                    <div class="sub header">3,5 €</div>
                </h3>
            </div>
        </div>
        <div class="column">
            <div class="ui circular segment">
                <h3 class="ui header">
                    Thon Piquant
                    <div class="sub header">3,5 €</div>
                </h3>
            </div>
        </div>
         <div class="column">
            <div class="ui circular segment ">
                <h3 class="ui header">
                    Potage du jour
                    <div class="sub header">3,5 €</div>
                </h3>
            </div>
        </div>

    </div>

</template>
<script>
    export default {
        name: "call-to-action"
    }
</script>
<style scoped>
    .ui.circular.segment{
        background-image: url("./test-04.jpg");
        background-size: cover;
        background-repeat: no-repeat;
    width: 175px !important;
    height: 175px;
}
    .ui.header{

        border-radius: 10px;
        background-color: rgba(255, 230, 230, .6);
    }
</style>