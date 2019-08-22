<template>
    <div>
        <sui-grid stackable>
            <sui-grid-row v-if="product">
            <sui-grid-column :width="16" >
               
                <sui-list horizontal relaxed  v-if="userID">
                    <sui-list-item>
                        <sui-button  circular
                                     icon="cart plus"
                                     @click="in_cart++ ; add_cart(product)"
                                     v-if="!in_cart" >
                            <span class="desktop">Ajouter au panier</span>
                        </sui-button>
                        <input v-model.number="in_cart" type="number" @click="add_cart(product)"  style="width: 4rem" v-if="in_cart"/>
                    </sui-list-item>

                    <sui-list-item>
                        <sui-button  circular
                                     icon="heart outline"
                                     v-if="!likes()"
                                     @click="likeAction()">
                            <span class="desktop">J'aime</span>
                        </sui-button>
                        <sui-button circular
                                    color="pink" icon="heart"
                                    v-if="likes()"
                                    @click="likeAction()" >

                            <span class="desktop">Je n'aime plus</span>
                        </sui-button>
                    </sui-list-item>

                    <sui-list-item>
                        <sui-button circular fluid
                                    icon="thumbtack">
                            <span class="desktop">Je n'aime plus</span>
                        </sui-button>
                    </sui-list-item>
                </sui-list>

            </sui-grid-column>
             <sui-grid-column :width="6" >
                 <div v-if="images">
                    <sui-grid>
                        <sui-grid-column :width="16">
                            <img :src="'images/products/' + zoom_image"
                                 :alt="product.name"
                                 v-if="zoom_image"
                                 style="width: 100%" />
                        </sui-grid-column>
                    </sui-grid>
                    <sui-grid :columns="2" divided>
                    <sui-grid-row v-for="(i) in rows" :key="i">
                        <sui-grid-column v-for="(col, j) in images" :key="col.id">
                            <img  :src="'images/products/'+col.image_name"
                                  @click="selectImage(col.image_name)"
                                  :alt="product.name"
                                  style="width: 90%"/>
                        </sui-grid-column>
                    </sui-grid-row>
                </sui-grid>
                 </div>
            </sui-grid-column>
            <sui-grid-column :width="10" class="ui left aligned">
                 <div is="sui-header" size="huge" style="margin-bottom: 2rem;" 
                 class=" orange">
                    {{product.name}}
                </div>
                <div is="sui-header" size="huge" class="green"> 
                    eur
                </div>

                <p is="sui-header" size="large" class="emph" v-if="product.description.length >0">
                    {{product.description}}
                </p>
                    <template v-if="product.breads.length > 0"> 
                       <p is="sui-header" 
                                size="medium"
                                class="left aligned">
                            Pains disponibles
                        </p>
                        <sui-list  bulleted>
                            <sui-list-item clear
                                v-for="bread in product.breads"
                                :key="bread.id">
                                 {{bread.name}}
                            </sui-list-item>
                        </sui-list>
                       
                    </template>            
                    <template  v-if="product.vegetables.length > 0"> 
                        <p  is="sui-header" 
                            size="medium"
                            class="left aligned">
                        Les crudités proposées :
                    </p>    
                        <sui-list>
                            <sui-list-item
                                    v-for="vegetable in product.vegetables"
                                    :key="vegetable.id">
                                {{vegetable.name}}
                            </sui-list-item>
                        </sui-list>
                    </template>
                <template v-if="product.ingredients">
                    <p  is="sui-header" 
                        size="medium"
                        class="left aligned">
                            Ingrédients:
                    </p>
                        <sui-list horizontal class="bulleted">
                            <sui-list-item
                                    v-for="ingredient in product.ingredients"
                                    :key="ingredient.id"
                            >
                                <em>{{ingredient.name}}</em>
                               <!-- <span v-if="ingredient.components.length > 0">
                                    (<sui-list horizontal>
                                        <sui-list-item v-for="component in ingredient.components"
                                        :key="component.id">
                                        {{component.name}}
                                        </sui-list-item>
                                    </sui-list>
                                )</span> -->
                            </sui-list-item>
                        </sui-list>
                </template>

            </sui-grid-column>
            </sui-grid-row>
        </sui-grid>
        <allergies-finder :product="product"></allergies-finder>
    </div>
</template>

<script>
    import usercheck from '../mixins/userCheck'
    import order from '../mixins/order'
    import AllergiesFinder from '../components/AllergiesFinder/AllergiesFinder'

    export default {
        name: 'detail',
        mixins: [usercheck, order],
        components: {AllergiesFinder},
        data() {
            return {
                slug: '',
                zoom_image: '',
                images: null,
                rows: 1
            }
        },
        created: function () {
            this.slug = this.$route.params.slug
        },
        computed: {
            product: function () {
                return this.$store.getters.products.find(product => {
                    return product.slug === this.slug
                })
            }
        },
        watch: {
          product: function(){
              if (this.product.images.length > 0 ){
                  this.images = this.product.images
                  this.zoom_image = this.product.images[0].image_name
/*                  if (this.images.length  > 0){
                      this.rows = Math.ceil(this.images.length/2)
                  }*/
              } else {
                  this.zoom_image = '/common/no-photo.jpg'
              }
          }
        },
        methods: {
            selectImage: function (image){
                this.zoom_image = image ;
            }
        },


    }

</script>

<style scoped>

    @import url('https://fonts.googleapis.com/css?family=Cuprum');

    .desktop{
        display: none;
    }

    .ui.segment:last-child.orange{
        background-color: orange;
        color: #000;

    }
    .ui.green.segment:not(.inverted) {
        background-color: #21ba45 !important ;
        color: floralwhite;
    }
    .emph {
        font-size: 1.2em;
    }
    .emph:before {
        content: "\f10d";
        font-family: FontAwesome;
        font-style: normal;
        font-weight: normal;
        font-size: 1.8em;
        text-decoration: inherit;
        color: #cecece;
    }
    .emph:after {
        content: "\f10e";
        font-family: FontAwesome;
        font-style: normal;
        font-weight: normal;
        font-size: 1.8em;
        text-decoration: inherit;
        color: #cecece;
    }


    .horizontal {
        text-align: left;
    }

    .horizontal h5 {
        display: inline;
        color: green;
    }
    @media (min-width: 768px) {

        .desktop{
            display: inline;
        }
        .emph {
            font-size: 1.6em;
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
        }
    }

</style>