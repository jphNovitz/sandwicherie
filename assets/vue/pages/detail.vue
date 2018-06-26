<template>
    <div>

        <div v-if="product">
            <sui-grid>
                <sui-grid-column :width="6">
                    <sui-grid>
                        <sui-grid-column :width="16">
                            <img :src="'../'+images[0]" :alt="product.name" style="width: 100%"/>
                        </sui-grid-column>
                    </sui-grid>

                    <sui-grid :columns="2" divided>
                        <sui-grid-row v-for="(i) in rows" :key="i">
                            <sui-grid-column v-for="(col, j) in images" :key="j">
                                <img :src="col" :alt="product.name" style="width: 100%" @click="sortImages(j)"/>
                            </sui-grid-column>
                        </sui-grid-row>
                    </sui-grid>
                </sui-grid-column>
                <sui-grid-column :width="10">


                    <sui-segment raised>
                        <sui-header size="huge"> {{product.name}}
                            <sui-header-subheader>{{product.types[0].name}}</sui-header-subheader>
                        </sui-header>
                        <p>{{product.description}}</p>
                    </sui-segment>

                    <sui-header size="normal">Plusieurs sortes de pains vous sont proposées: </sui-header>
                    <sui-list >
                        <sui-list-item v-for="bread in product.breads">{{bread.name}}</sui-list-item>
                    </sui-list>
                    <sui-header size="normal">crudités: </sui-header>
                    <sui-list >
                        <sui-list-item v-for="vege in product.vegetables">{{vege.name}}</sui-list-item>
                    </sui-list>


                    <div class="horizontal">
                    <h5 is="sui-header" >Ingrédients</h5>
                    <sui-list horizontal>
                        <sui-list-item v-for="ingredient in product.ingredients">{{ingredient.name}}</sui-list-item>
                    </sui-list>
                    </div>
                </sui-grid-column>
            </sui-grid>
        </div>
        <div v-else>
            <sui-icon name="notched circle" loading/>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'detail',
        data() {
            return {
                slug: '',
                loading: true,
                rows: 0,
                images: ''
            }
        },
        mounted: function () {
            this.slug = this.$route.params.slug
            setTimeout(() => {
                this.fetch_images()
            }, 2000)

        },
        computed: {
           product: function () {
                return this.$store.getters.products.find(p => {
                    return p.slug === this.slug
                })

            }/*,
            images: function () {
                let imgs = []
                this.product.images.map(i => {
                    imgs.push("/images/products/" + i.image_name)
                });
                this.rows = imgs.length / 2
                return imgs
            }*/
        },
        methods: {
            fetch_product: function () {
                this.product = this.$store.getters.products.find(p => {
                    return p.slug === this.slug
                })
            },
            fetch_images: function () {

                let imgs = []
                this.product.images.map(i => {
                    imgs.push("/images/products/" + i.image_name)
                });
                this.rows = imgs.length / 2
                this.images = imgs
            }
            ,
            sortImages: function (pos) {
                let temp = this.images[pos]
                this.images.splice(pos,1)
                this.images.unshift(temp)

            }
        }

    }

</script>

<style scoped>
    p {
        text-align: left
    }
    .horizontal {
        text-align: left;
    }
    .horizontal h5{
        display: inline;
        color: green;
    }

</style>