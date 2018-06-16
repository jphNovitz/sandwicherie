<template>
<div>
       <sui-card-group :items-per-row="3">
           <card-product v-for="product in products"
                         :product="product" :group="'products'">

           </card-product>
          <!-- <sui-card v-for="product in products">
               <sui-image :src="return_name(product)"/>
               <sui-card-content>
                   <sui-card-header>{{product.name}}</sui-card-header>
                   <sui-card-meta>{{product.type}}</sui-card-meta>
                   <sui-card-description>
                       {{product.description}}
                   </sui-card-description>
               </sui-card-content>
               <sui-card-content extra>
                   <sui-icon name="user" /> 75 Friends
                   <span slot="right">Joined in 2013</span>
               </sui-card-content>
           </sui-card>-->
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
            return {}
        },
        computed: {
            products: function () {
                return this.$store.getters.products
            }
        },
        methods: {
            return_name: function (elm) {
                let imageName = elm.images[0].image_name
                return "/images/products/" + imageName
            }
        }
    }

</script>
<style scoped>
    .ui.card>.image, .ui.cards>.card>.image{
        border-radius: 20% !important;
    }
</style>