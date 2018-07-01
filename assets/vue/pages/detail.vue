<template>
    <div>
        {{slug}}<br />
        {{zoomImage}}<br />
        {{images}}<br />
        {{zoomImage}}<br />
            <sui-grid>
                <sui-grid-column :width="6" >
                    <sui-grid>
                        {{zoomImage}}
                        <sui-grid-column :width="16">
                            <img :src="'images/products/' + zoomImage"
                                 :alt="product.name"
                                 v-if="zoomImage"
                                 style="width: 100%" />
                        </sui-grid-column>
                    </sui-grid>
                 <sui-grid :columns="2" divided>
                        <sui-grid-row v-for="(i) in rows" :key="i">
                            <sui-grid-column v-for="(col, j) in images" :key="col.id">
                                <img  :src="'images/products/'+col.image_name"
                                      @click="selectImage(col.image_name)"
                                      :alt="product.name"
                                      style="width: 100%"/>
                            </sui-grid-column>
                        </sui-grid-row>
                    </sui-grid>
                </sui-grid-column>
                <sui-grid-column :width="10">
                   <p>
                      <span class="green"> {{product.name}} </span> .::.{{product.description}}
                   </p>
                    <sui-segment v-if="product.ingredients">
                        <p>
                            Les ingrédients principaux sont :
                            <sui-list horizontal>
                                <sui-list-item
                                        v-for="ingredient in product.ingredients"
                                        >
                                    {{ingredient.name}}
                                </sui-list-item>
                            </sui-list>
                        </p>
                    </sui-segment>
                </sui-grid-column>
            </sui-grid>

    </div>
</template>

<script>
    export default {
        name: 'detail',
        data() {
            return {
                slug: '',
                zoomImage: null,
                images: null,

            }
        },
        created: function () {
            this.slug = this.$route.params.slug
        },
        mounted: function () {
          //  this.images = this.product.images
            //this.zoomImage = this.images[0].image_name

            setTimeout(() => {
                    this.images = this.product.images
                    this.zoomImage = this.images[0].image_name


            },1000)
        },
        computed: {
            product: function () {
                return this.$store.getters.products.find(product => {
                    return product.slug === this.slug
                })
            }/*,
            images: function () {
                setTimeout(()=>{
                    return this.product.images
                }, 5000)
            }*/,
            rows: function () {
                if (this.zoomImage) {
                    return this.images.length/2 ;
                } else {
                    return 0 ;
                }

            }
        },
        methods: {
            selectImage: function (image){
                this.zoomImage = image ;
            }
        },


    }

</script>

<style scoped>
    p {
        font-family: 'Cuprum', sans-serif !important;
        text-align: left
    }
    .green {
        font-weight: bold;
        color: green;
    }

    .horizontal {
        text-align: left;
    }

    .horizontal h5 {
        display: inline;
        color: green;
    }

</style>