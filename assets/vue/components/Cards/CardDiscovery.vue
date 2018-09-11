<template>
    <sui-list-item >

            <sui-list-header>{{disco.name}}
                <router-link :to="{name: 'detail', params: {slug: disco.slug}}" target="_blank"><sui-button basic color="blue" icon="external alternate" circular /></router-link>
                <sui-button basic color="red" icon="minus" circular @click="remove(disco.slug)" />
                <input v-model.number="in_cart" type="number" @click="add_cart(disco)"  style="width: 4rem" v-if="in_cart"/>
                <sui-button basic color="green" icon="cart plus" circular @click="in_cart++ ; add_cart(disco)" v-if="!in_cart" />
            </sui-list-header>
            <sui-list-content>
                {{disco.description}}
            </sui-list-content>

        </sui-list-item>
</template>
<script>
    import order from '../../mixins/order'
    export default {
        name: 'CardDiscovery',
        props: ['disco'],
        mixins: [order],
        data(){
            return {

            }
        },
        methods: {
            remove: function(slug){
                this.$emit('remove_discovery', slug)
            }
        }

    }
</script>