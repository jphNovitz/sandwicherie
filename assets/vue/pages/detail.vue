<template>
    <div>
       <!-- {{rows}}
        <ul>
            <li v-for="image in images" :key="image.id"><img :src="'images/products/'+image.image_name" /></li>
        </ul>
        -->
        <sui-grid stackable>
            <sui-grid-row v-if="product">
            <sui-grid-column :width="16" >
                <h1 is="sui-header" size="huge" style="margin-bottom: 5rem;" >
                    {{product.name}}
                </h1>

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
            <sui-grid-column :width="10">

                <p class="emph">
                    {{product.description}}
                </p>
                <sui-segment v-if="product.ingredients">
                    <p>
                        <sui-list horizontal>
                            <sui-list-item
                                    v-for="ingredient in product.ingredients"
                                    :key="ingredient.id"
                            >
                                {{ingredient.name}}
                                <span v-if="ingredient.components.length > 0">
                                    (<sui-list horizontal>
                                        <sui-list-item v-for="component in ingredient.components"
                                        :key="component.id">
                                        {{component.name}}
                                        </sui-list-item>
                                    </sui-list>
                                )</span>
                            </sui-list-item>
                        </sui-list>
                    </p>
                </sui-segment>
                <div style="margin-top: 2em" v-if="product.breads.length > 0">
                    <h3 is="sui-header">pains disponibles</h3>
                    <sui-list>
                        <sui-list-item
                                v-for="bread in product.breads"
                                :key="bread.id">
                            {{bread.name}}
                        </sui-list-item>
                    </sui-list>
                </div>
                <div style="margin-top: 2em" v-if="product.vegetables.length > 0" >
                    <h3 is="sui-header">Les crudités suivantes peuvent accompagner votre repas :</h3>
                    <sui-list>
                        <sui-list-item
                                v-for="vegetable in product.vegetables"
                                :key="vegetable.id">
                            {{vegetable.name}}
                        </sui-list-item>
                    </sui-list>
                </div>
            </sui-grid-column>
            </sui-grid-row>
        </sui-grid>
        <allergies-finder :product="product"></allergies-finder>
    </div>
</template>

<script>

    import AllergiesFinder from '../components/AllergiesFinder/AllergiesFinder'
    export default {
        name: 'detail',
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

<style>

    @import url('https://fonts.googleapis.com/css?family=Cuprum');

    .green {
        font-weight: bold;
        color: green;
    }

    .emph {
        font-size: 1.6em;
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

</style>