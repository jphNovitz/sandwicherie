<template>
<div>

    <sui-grid >
        <sui-grid-row>
            <sui-grid-column :width="2">
                <h3>Allergies</h3>
                <sui-list>
                    <sui-list-item
                            v-for="allergy in allergies"
                            :key="allergy.id"
                            @click="changeAllergies(allergy.id)">
                        {{allergy.name}}
                    </sui-list-item>
                </sui-list>
            </sui-grid-column>
            <sui-grid-column :width="14">
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

                <sui-card-group stackable :items-per-row="3">
                   <card-product v-for="product in products"
                                 :product="product" :group="'products'">
                   </card-product>
                </sui-card-group>
            </sui-grid-column>
        </sui-grid-row>
    </sui-grid>
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
                selected: null,
                allergiesList: []
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
                return this.$store.getters.types ;
            },
            allergies: function(){
                return this.$store.getters.allergies;
            },
            blacklist: function(){
                let filtered = this.allergies.filter(a =>{
                    return  this.allergiesList.indexOf(a.id) > -1
                })
                let list =  []
                filtered.map(fil => {
                    fil.categories.map(cat =>{
                        list.push(cat.slug)
                    });
                    fil.ingredients.map(ing =>{
                        list.push(ing.slug)
                    })
                })
                return list;
            }

        },
        methods: {
            return_name: function (elm) {
                let imageName = elm.images[0].image_name
                return "/images/products/" + imageName
            },
            select: function (t) {
                this.selection = t;
            },
            changeAllergies: function (a) {
               let pos = this.allergiesList.indexOf(a);
               if (pos === -1) {
                   this.allergiesList.push(a)
               } else {
                   this.allergiesList.splice(pos,1)
               }
            }
        }
    }

</script>
<style scoped>
    .ui.card>.image, .ui.cards>.card>.image{
        border-radius: 20% !important;
    }
</style>