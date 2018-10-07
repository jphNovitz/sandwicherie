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
                    <sui-table-row v-for="(element, index) in definitive_cart"  :key="index" >

                        <sui-table-cell>1</sui-table-cell>
                        <sui-table-cell>{{element.name}}</sui-table-cell>
                        <sui-table-cell>{{element.price}}</sui-table-cell>
                        <sui-table-cell v-if="breads[element.slug]">
                            <select :options="breads[element.slug]" v-model="definitive_cart[index].bread">
                                <option disabled value="">Choisissez</option>
                                <option v-for="(bread, i) in breads[element.slug]" :key="i">{{bread}}</option>
                            </select>
                        </sui-table-cell>
                        <sui-table-cell v-if="vegetables[element.slug]">
                            <select id="vagetables[indice]" v-model="definitive_cart[index].vegetables" multiple>
                                <option disabled value="">Choisissez</option>
                                <option v-for="(vege, i) in vegetables[element.slug]" :key="i">{{vege}}</option>
                            </select>
                        </sui-table-cell>
                        <sui-table-cell>
                            <input type="checkbox" id="definitive_cart[index].halal" v-model="definitive_cart[index].halal">
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
    import userCheck from '../mixins/userCheck'

export default {
        name: 'cart',
        mixins: [userCheck],
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
        },
        methods:{
            validate: function () {
                let that=this
                const box = {
                    user: this.user.username,
                    items: this.definitive_cart
                };
                // console.log(JSON.stringify(box))

                    this.$http.post(this.url, JSON.stringify(box))
                        .then(response => {
                        that.$store.dispatch('reset_cart', {'items': []})
                        that.$router.push({ name: 'home'})
                        }, error => {
                        console.log(error.data);
                    });
            }
        },
        mounted() {
        let  definitive = [] ;
        let index = 0 ;
            this.cart.items.map(it =>{
                this.total += it.item.price*it.qty;
            it.item.breads.forEach(bread =>{
                this.breads[it.item.slug] =[]
                this.breads[it.item.slug].push(bread.name)
            })

            it.item.vegetables.forEach(vege =>{
                this.vegetables[it.item.slug] =[]
                this.vegetables[it.item.slug].push(vege.name)
            })

            for (let i = 0 ; i< it.qty ; i++){
                let tmp = Object.assign({}, it.item);
                definitive.push(tmp) ;
            }
        })
        this.definitive_cart =  definitive;
        }
    }

</script>
<style scoped>

</style>