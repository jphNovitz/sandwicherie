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
                        <sui-table-header-cell>Pain</sui-table-header-cell>
                        <sui-table-header-cell>Crudités</sui-table-header-cell>
                        <sui-table-header-cell>Halal</sui-table-header-cell>
                    </sui-table-row>
                </sui-table-header>
                <sui-table-body>
                    <sui-table-row v-for="(element, indice) in this.definitive_cart"  :key="indice">
                        <sui-table-cell>1</sui-table-cell>
                        <sui-table-cell>{{element.name}}</sui-table-cell>
                        <sui-table-cell>{{element.price}}</sui-table-cell>
                        <sui-table-cell v-if="breads[element.slug]">
                            <select v-model="definitive_cart[indice].bread">
                                <option disabled value="">Choisissez</option>
                                <option v-for="(bread, i) in breads[element.slug]" :key="i">{{bread}}</option>
                            </select>
                        </sui-table-cell>
                        <sui-table-cell v-if="vegetables[element.slug]">
                            <select v-model="definitive_cart[indice].vegetables">
                                <option disabled value="">Choisissez</option>
                                <option v-for="(vege, i) in vegetables[element.slug]" :key="i">{{vege}}</option>
                            </select>
                        </sui-table-cell>
                        <sui-table-cell>
                            <input type="checkbox" id="halal[indice]" v-model="definitive_cart[indice].halal">
                        </sui-table-cell>
                    </sui-table-row>
                </sui-table-body>
            </sui-table>
            <p>total de la commande: {{total}}</p>

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
            return {
                definitive_cart: [],
                breads : {},
                vegetables: {},
                total : 0,

            }
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
            // ,
            // definitive_cart: function () {
            //     let  definitive= []
            //     this.cart.items.forEach(it =>{
            //         let tmp = {} ;
            //
            //         it.item.breads.forEach(bread =>{
            //             this.breads[it.item.slug] =[]
            //             this.breads[it.item.slug].push(bread.name)
            //         })
            //
            //         for (let i = 0 ; i< it.qty ; i++){
            //             tmp.slug = it.item.slug ;
            //             tmp.name = it.item.name ;
            //             tmp.bread = '' ;
            //             tmp.price = it.item.price ;
            //             this.total += it.item.price;
            //             definitive.push(tmp) ;
            //         }
            //         //definitive[it.item.slug]=tmp ;
            //
            //     })
            //     return definitive;
            // }

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
        },
        mounted() {
        let  definitive = [] ;
        this.cart.items.forEach(it =>{
            let tmp = {} ;
            it.item.breads.forEach(bread =>{
                this.breads[it.item.slug] =[]
                this.breads[it.item.slug].push(bread.name)
            })

            it.item.vegetables.forEach(vege =>{
                this.vegetables[it.item.slug] =[]
                this.vegetables[it.item.slug].push(vege.name)
            })

            for (let i = 0 ; i< it.qty ; i++){
                tmp.slug = it.item.slug ;
                tmp.name = it.item.name ;
                tmp.bread = '' ;
                tmp.vegetables = '' ;
                tmp.halal = false ;
                tmp.price = it.item.price ;
                this.total += it.item.price;
                definitive.push(tmp) ;
            }

        })
        this.definitive_cart =  definitive;
        }

    }

</script>
<style scoped>

</style>