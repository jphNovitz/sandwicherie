<template>
    <sui-list-item >
            <sui-list-header>{{fav.name}}
                <router-link :to="{name: 'detail', params: {slug: fav.slug}}" target="_blank"><sui-button basic color="blue" icon="external alternate" circular /></router-link>
                <sui-button basic color="red" icon="minus" circular @click="remove(fav.slug)" />
                <input v-model.number="in_cart" type="number" @click="add_cart(fav)"  style="width: 4rem" v-if="in_cart"/>
                <sui-button basic color="green" icon="cart plus" circular @click="in_cart++ ; add_cart(fav)" v-if="!in_cart" />
            </sui-list-header>
            <sui-list-content>
                {{fav.description}}
            </sui-list-content>

        </sui-list-item>
</template>
<script>
    import order from '../../mixins/order'
    export default {
        name: 'CardFavorite',
        props: ['fav'],
        mixins: [order],
        data(){
            return {

            }
        },
        methods: {
            remove: function(slug){
                this.$emit('remove_favorite', slug)
            }
        }

    }
</script>