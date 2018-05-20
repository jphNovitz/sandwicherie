<template>
<div>
        <sui-list>
                <sui-list-item v-for="product in products">{{product.nam}}</sui-list-item>
        </sui-list>
</div>
</template>

<script>
    export default {
        name: 'products',
        components: { },
        data(){
            return {}
        },
        computed: {
            products: function () {
                return this.$store.getters.products
            }
        }
    }

</script>
<style scoped>
</style>