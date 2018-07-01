<template>
             <sui-card >


               <sui-image :src="imageName" />
                <sui-card-content>
                    <router-link :to="{ name: 'detail', params: { slug: product.slug }}">
                        <sui-card-header>
                             {{product.name}}
                        </sui-card-header>
                    </router-link>
                    <sui-card-meta>{{product.price}} €</sui-card-meta>
                    <sui-card-description>
                        {{product.description}}
                    </sui-card-description>
                </sui-card-content>
                 <sui-card-content extra>
                     <input v-model.number="in_cart" type="number" @click="add_cart()"  style="width: 2rem" v-if="in_cart"/>
                    <sui-button animated="vertical" color="orange"  @click="in_cart++ ; add_cart()" v-if="!in_cart">
                        <sui-button-content hidden>ajouter</sui-button-content>
                        <sui-button-content visible>
                            <sui-icon name="cart plus icon" />
                        </sui-button-content>
                    </sui-button>

                   <sui-button color="grey" content="j'aime" basic v-if="!likes()" @click="likeAction()" />
                   <sui-button color="pink" content="j'aime"  v-if="likes()" @click="likeAction()" />
                 </sui-card-content >
       </sui-card>

</template>
<script>
    import  axios from 'axios'
    export default {
        name: 'CardProduct',
        props: ['product', 'group'],
        data() {
            return {
               // base_api: 'http://localhost:8000/api/',
               // only for dev remove if data exist on server
                in_cart: 0
            }
        },
        computed: {
            imageName: function (){
                let elm = this.product;
                let imageName = elm.images[0].image_name;
                console.log(imageName)
                return  'images/products/' + imageName;
            }
        },
        methods: {
            return_name: function () {
                let elm = this.product;
                let imageName = elm.images[0].image_name;
                return  'images/products/' + imageName;

            },
            add_cart: function () {
                this.$store.dispatch('update_cart', {'item': this.product, 'qty': this.in_cart});
            },
            likes: function () {
                // this must be changed
                let userID = 1;

                return this.product.liked_by.filter(like => {
                    return like.id === userID
                }).length
            },
            likeAction: function () {
                let userID = 1;
                let username='totolehero'  // this MUST BE CHANGED
                axios.patch(/*this.base_api+*/'/api/products/'+this.product.slug+'/like/'+username).then((response) => {
                    //let obj = this.group.filter(p=> p.slug === this.product.slug)

                    this.$store.dispatch('call_products')
                })
            }
        }
    }
</script>
<style>

</style>