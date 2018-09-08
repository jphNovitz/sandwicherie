import axios from 'axios'
export default {
    name: 'order',
    data() {
        return {
            in_cart: 0
        }
    },
    computed: {
        userID: function(){
            return this.user.id;
        },
        username: function () {
            return this.user.username;
        }
    },
    methods: {
        add_cart: function (product) {
            this.$store.dispatch('update_cart', {'item': product, 'qty': this.in_cart});
        },
        likes: function () {
            return this.product.liked_by.filter(like => {
                return like.id === this.userID
            }).length
        },
        likeAction: function () {
            this.$http.patch(/*this.base_api+*/'/api/s/products/'+this.product.slug+'/like')
                .then((response) => {
                //let obj = this.group.filter(p=> p.slug === this.product.slug)
                this.$store.dispatch('call_products')
            })
        }
    }
}