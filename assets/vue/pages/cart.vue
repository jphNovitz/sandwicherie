<template>
    <div>
        <h2>Vote panier d'achats</h2>
        <p v-if="!cart">
            <em>Votre panier est vide</em>
        </p>
        <div v-if="cart">
            <sui-table single-line>
                <sui-table-header>
                    <sui-table-row>
                        <sui-table-header-cell>Qté</sui-table-header-cell>
                        <sui-table-header-cell>Produit</sui-table-header-cell>
                        <sui-table-header-cell>P.U</sui-table-header-cell>
                        <sui-table-header-cell>Total</sui-table-header-cell>
                    </sui-table-row>
                </sui-table-header>
                <sui-table-body>
                    <sui-table-row v-for="item in cart.items"  :key="item.id">
                        <sui-table-cell>{{item.qty}}</sui-table-cell>
                        <sui-table-cell>{{item.product.name}}</sui-table-cell>
                        <sui-table-cell>{{item.product.price}}</sui-table-cell>
                        <sui-table-cell>-</sui-table-cell>
                    </sui-table-row>
                </sui-table-body>
            </sui-table>

            <sui-button @click="validate" >Valider  </sui-button>

        </div>

    </div>
</template>

<script>
import axios from 'axios'

export default {
        name: 'cart',
        components: {},
        data(){
            return {}
        },
        computed: {
            url: function(){
              return this.$store.getters.post_cart
            },
            cart: function () {
                let cart =  this.$store.getters.cart
                if (cart.items.length > 0) { return cart }
                else { return null}
            }
        },
        methods:{
            validate: function () {
                const box = {
                    user: 'totolehero',
                    items: []
                }
                this.cart.items.filter(i=>{
                    let item_temp = {}
                    item_temp.slug=  i.product.slug
                    item_temp.qty = i.qty
                    box.items.push(item_temp)
                })

                console.log(JSON.stringify(box))
                axios.post(this.url, {
                    cart: JSON.stringify(box)
                })
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }  
        }
    }

</script>
<style scoped>

</style>