<template>
    <sui-card>
            <sui-image :src="imageName" />
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
             <input v-model.number="in_cart" type="number" @click="add_cart(product)"  style="width: 4rem" v-if="in_cart"/>
           <sui-button  icon="cart plus" circular @click="in_cart++ ; add_cart(product)" v-if="!in_cart" />

           <sui-button  circular  icon="heart outline"  v-if="!likes()" @click="likeAction()" />
           <sui-button circular color="pink" icon="heart" v-if="likes()" @click="likeAction()" />
           <sui-button circular icon="thumbtack"  />
         </sui-card-content >
   </sui-card>
</template>
<script>
    import  axios from 'axios'
    import order from '../../mixins/order'
    export default {
        name: 'CardProduct',
        mixins: [order],
        props: ['product', 'group', 'user'],
        data() {
            return {
               // base_api: 'http://localhost:8000/api/',
               // only for dev remove if data exist on server
               //  in_cart: 0
            }
        },
        computed: {
            imageName: function (){
                let elm = this.product;
                if ( elm.images !== undefined) {
                    let imageName = elm.images[0].image_name;
                    if (imageName !== undefined) {
                        return 'images/products/' + imageName;
                    } else {
                        return  'images/common/image-nophoto-clem.png';
                    }
                } else {
                    return  'images/common/image-nophoto-clem.png';
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
            // add_cart: function () {
            //     this.$store.dispatch('update_cart', {'item': this.product, 'qty': this.in_cart});
            // },
            // likes: function () {
            //     return this.product.liked_by.filter(like => {
            //         return like.id === this.userID
            //     }).length
            // },
            // likeAction: function () {
            //     axios.patch(/*this.base_api+*/'/api/products/'+this.product.slug+'/like/'+this.username).then((response) => {
            //         //let obj = this.group.filter(p=> p.slug === this.product.slug)
            //         this.$store.dispatch('call_products')
            //     })
            // }
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