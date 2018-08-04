<template>
             <sui-card >


               <sui-image :src="imageName" v-if="imageName"/>
               <img src="./no-photo-01.png" class="ui image" v-else/>
                <sui-card-content>
                    <router-link :to="{ name: 'detail', params: { slug: product.slug }}">
                        <sui-card-header>
                             {{product.name}}
                        </sui-card-header>
                    </router-link>
                    <sui-card-meta huge class="orange">{{product.price}} €</sui-card-meta>
                    <sui-card-description>
                        {{product.description}}
                    </sui-card-description>
                </sui-card-content>
                 <sui-card-content extra v-if="userID">
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
        props: ['product', 'group', 'user'],
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
                if ( imageName !== undefined) {
                    return  'images/products/' + imageName;
                } else {
                    return false ;
                }

            },
            userID: function(){
                if (this.user) {
                    return this.user.userID;
                }
            },
            username: function () {
                return this.user.username;
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
                return this.product.liked_by.filter(like => {
                    return like.id === this.userID
                }).length
            },
            likeAction: function () {
                axios.patch(/*this.base_api+*/'/api/products/'+this.product.slug+'/like/'+this.username).then((response) => {
                    //let obj = this.group.filter(p=> p.slug === this.product.slug)
                    this.$store.dispatch('call_products')
                })
            }
        }
    }
</script>
<style scoped>
.ui.card {
        border-radius: 1rem !important;
}
.ui.card>.image, .ui.cards>.card>.image {
        border-radius: 1rem !important;
}
.orange {
    color: orangered !important;
}
.meta {
    font-size: 1.5rem !important;
    font-weight: bold;
}
</style>