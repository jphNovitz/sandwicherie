<template>
<div>
    <sui-grid container>
        <sui-grid-row class="stackable">
            <sui-grid-column :width="2">
                <h3>Allergies</h3>
                <sui-list>
                    <sui-list-item
                            v-for="allergy in allergies"
                            :key="allergy.id"
                            @click="changeAllergies(allergy.id)">
                        <sui-button basic color="green" v-if="!check_allergy(allergy.id)">{{allergy.name}}</sui-button>
                        <sui-button color="orange" :content="allergy.name" v-else />
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

    export default {
        name: 'products',
        mixins: [userCheck],
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
        created() { console.log(Object.keys(this.user).length)},
        computed: {
            user_cred: function(){
                if(Object.keys(this.user).length > 0){
                    return {'userID': this.user.id, 'username': this.user.username }
                } else {
                    return false ;
                }
            },
            // user: function (){
            //     console.log(this.$store.getters.get_user)
            //     if (Object.keys(this.$store.getters.get_user).length > 0) {
            //         return this.$store.getters.get_user ;
            //     } else {
            //         return {}
            //     }
            // },
            all_products: function () {
                return this.$store.getters.products
            },
            products: function () {
                let base = this.all_products.filter(ap=>{
                    let list = []
                    ap.ingredients.map(ing=>{
                        if (this.blacklist.indexOf(ing.slug) > -1){
                            list.push(ing.slug)
                        }
                        for (var i in ing) {
                            for (var cat in i.categories) {
                                if (this.blacklist.indexOf(cat.slug) > -1) {
                                    list.push(cat.slug)
                                }
                            }
                        }
                    })
                    return list.length  === 0
                })
                var stack = [];
                if (this.selected === null) {
                    return base /*this.all_products.filter(ap=>{
                        let list = []
                        ap.ingredients.map(ing=>{
                            if (this.blacklist.indexOf(ing.slug) > -1){
                                list.push(ing.slug)
                            }
                            for (var i in ing) {
                                for (var cat in i.categories) {
                                    if (this.blacklist.indexOf(cat.slug) > -1) {
                                        list.push(cat.slug)
                                    }
                                }
                            }
                        })
                        return list.length  === 0
                    })*/
                    //return this.all_products;
                } else {
                     base.map(item=>{
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
    .ui .header {
        font-size: 1.7rem !important;
    }
    .ui.card>.image, .ui.cards>.card>.image{
        border-radius: 20% !important;
    }
</style>