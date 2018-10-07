<template>
<div>
    <sui-grid container>
        <sui-grid-row class="stackable">
            <sui-grid-column :width="3">
                <h3>Allergies</h3>
                <sui-list >
                    <sui-list-item
                            v-for="allergy in allergies"
                            :key="allergy.id"
                            @click="changeAllergies(allergy.id, allergy.slug)">
                        <sui-button fluid basic color="green" v-if="!check_allergy(allergy.id)">{{allergy.name}}</sui-button>
                        <sui-button fluid color="orange" :content="allergy.name" v-else />
                    </sui-list-item>
                </sui-list>
            </sui-grid-column>
            <sui-grid-column :width="13">
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

                   <card-product v-if="products.length>0"
                                 v-for="product in products"
                                 :product="product"
                                 :group="'products'"
                                 :key="product.slug"
                                 :user="user_cred">
                   </card-product>
                    <p v-if="products.length===0">Aucun produit trouvé, appelez nous !</p>
                </sui-card-group>
            </sui-grid-column>
        </sui-grid-row>
    </sui-grid>
</div>
</template>

<script>

    import  cardProduct from '../components/Cards/CardProduct';
    import userCheck from '../mixins/userCheck';
    import list_allergies from '../Classes/Allergies_list'

    export default {
        name: 'products',
        mixins: [userCheck],
        components: {
            'card-product': cardProduct
        },
        data(){
            return {
                activeType: '',
                selected: [],
                allergiesList: []
            }
        },
        created() {},
        computed: {
            user_cred: function(){
                if(Object.keys(this.user).length > 0){
                    return {'userID': this.user.id, 'username': this.user.username }
                } else {
                    return false ;
                }
            },

            all_products: function () {
                return this.$store.getters.products
            },
            products: function () {
                return this.all_products.filter(product=>{
                    let flag = true ;
                    product.ingredients.map(ing=>{
                        if (this.blacklist.indexOf(ing.slug) > -1) {
                            flag = false ;
                        }
                        ing.categories.map(category=>{
                            if (this.blacklist.indexOf(category.slug) > -1) {
                                flag = false ;
                            }
                        })
                    })
                    product.breads.map(bread=>{
                        if (this.blacklist.indexOf(bread.slug) > -1) {
                            flag = false ;
                        }
                    })
                    product.vegetables.map(vege=>{
                        if (this.blacklist.indexOf(vege.slug) > -1) {
                            flag = false ;
                        }
                    })
                    product.sauces.map(sauce=>{
                        if (this.blacklist.indexOf(sauce.slug) > -1) {
                            flag = false ;
                        }
                    })


                    if (flag) {
                        return product
                    }
                })
            },
            types: function() {
                return this.$store.getters.types ;
            },
            allergies: function(){
                return this.$store.getters.allergies;
            },
            blacklist: function () {
                let list = [] ;
                let bad = list_allergies(this.allergies)
                this.selected.forEach(alist=>{
                    bad[alist].forEach(i=>{
                        list.push(i);
                    })

                })
                return list;
            }

        },
        methods: {
            check_allergy: function(a){
              // check if allergy is in list
              if (this.allergiesList.length > 0){
                  return (this.allergiesList.indexOf(a) > -1) ;
              } else { return false ; }
            },
            return_name: function (elm) {
                let imageName = elm.images[0].image_name
                return "/images/products/" + imageName
            },
            select: function (t) {
                this.selection = t;
            },
            changeAllergies: function (id, slug) {
               let pos = this.allergiesList.indexOf(id);
               let posSel = this.selected.indexOf(slug);
               console.log(pos)
               if (pos === -1) {
                   this.allergiesList.push(id)
                   this.selected.push(slug)
               } else {
                   this.allergiesList.splice(pos,1)
                   this.selected.splice(posSel,1)
               }
            }
        }
    }

</script>
<style scoped>
    .ui .header {
        font-size: 1.7rem !important;
    }
    .ui.card>.image, .ui.cards>.card>.image{
        border-radius: 20% !important;
    }
</style>