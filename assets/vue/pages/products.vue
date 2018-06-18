<template>
<div>
    <sui-menu secondary>
        <sui-menu-item  link
                       @click="selected=null"
                       :class="{active: selected === null}">Tout</sui-menu-item>
        <sui-menu-item link v-for="type in types"
                       :key="type.slug"
                       @click="selected=type.id"
                       :class="{active: type.id === selected}">{{type.name}}

        </sui-menu-item>
    </sui-menu>

    <sui-card-group :items-per-row="3">
       <card-product v-for="product in products"
                     :product="product" :group="'products'">
       </card-product>
    </sui-card-group>
</div>
</template>

<script>

    import  cardProduct from '../components/Cards/CardProduct';

    export default {
        name: 'products',
        components: {
            'card-product': cardProduct
        },
        data(){
            return {
                activeType: '',
                selected: null
            }
        },
        computed: {
            all_products: function () {
                return this.$store.getters.products
            },
            products: function () {
                var stack = [];
                if (this.selected === null) {
                    return this.all_products;
                } else {
                    this.all_products.map(item=>{
                        item.types.map(type=>{
                            if (type.id  === this.selected) {
                                stack.push(item);
                            }
                        })
                    })
                }
                return stack ;
            },
            types: function() {
                return this.$store.getters.types
            }
        },
        methods: {
            return_name: function (elm) {
                let imageName = elm.images[0].image_name
                return "/images/products/" + imageName
            },
            select: function (t) {
                this.selection = t;
            }
        }
    }

</script>
<style scoped>
    .ui.card>.image, .ui.cards>.card>.image{
        border-radius: 20% !important;
    }
</style>