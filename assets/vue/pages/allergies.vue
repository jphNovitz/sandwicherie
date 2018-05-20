<template>
<div>
    <sui-message
            color="orange"
            icon="info"
            header="Allergènes"
            content="Certains produits peuvent contenir des ingrédients provoquant des allergies alimentaires.  N'hésitez pas
à demander une information."
   class="orange" />
    

    <sui-list>
        <sui-list-item v-for="allergy in allergies">{{allergy.name}}</sui-list-item>
    </sui-list>

</div>
</template>

<script>
    export default {
        name: 'allergies',
        components: { },
        data(){
            return {}
        },
        computed: {
            allergies: function () {
                return this.$store.getters.allergies
            }
        }
    }

</script>
<style scoped>
    .medium {
        width: 7rem !important;
    }
</style>