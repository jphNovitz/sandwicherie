<template>
    <article class="row">
        <h2>Nouveautés !</h2>
        <sui-card-group :items-per-row="3" stackable>
            <sui-card v-for="suggestion in suggestions">
                <sui-image :src="return_name(suggestion)"/>
                <sui-card-content>
                    <sui-card-header>{{suggestion.name}}</sui-card-header>
                    <sui-card-meta>{{suggestion.price}} €</sui-card-meta>
                    <sui-card-description>
                        {{suggestion.description}}
                    </sui-card-description>
                </sui-card-content>
                <sui-card-content extra>

                    <sui-button animated="vertical" color="orange" @click="add_cart(suggestion)">
                        <sui-button-content hidden>ajouter</sui-button-content>
                        <sui-button-content visible>
                            <sui-icon name="cart plus icon" />
                        </sui-button-content>
                    </sui-button>
             <!--   <sui-button animated="vertical" color="blue">
                        <sui-button-content hidden>detail</sui-button-content>
                        <sui-button-content visible>
                            <sui-icon name="zoom in icon" />
                        </sui-button-content>
                    </sui-button> -->
                    <sui-button color="grey" content="j'aime" basic v-if="!likes(suggestion)" @click="likeAction(suggestion)" />
                    <sui-button color="pink" content="j'aime"  v-if="likes(suggestion)" @click="likeAction(suggestion)" />
         <!--   <sui-button color="red" content="Two" basic v-if="likes(suggestion.liked_by)"/>
                <sui-button animated="vertical" color="pink" v-if="!likes(suggestion.liked_by)">
                        <sui-button-content hidden>j'aime</sui-button-content>
                        <sui-button-content visible>
                            <sui-icon name="like icon" />
                        </sui-button-content>
                    </sui-button>
-->
                    </sui-card-content >
            </sui-card>
        </sui-card-group>



    </article>
</template>
<script>

    import axios from 'axios'

export default {
    name: 'Suggestions',
    data () {
        return{
            base_api: 'http://localhost:8000/api/'
        }
    },
    computed: {
       suggestions: function () {
            return this.$store.getters.suggestions
        }
    },
    methods: {
        return_name: function (elm) {
             let imageName = elm.images[0].imageName
            return "/images/products/" + imageName
        },
        add_cart: function (p) {
            this.$store.dispatch('add_cart', {'item': p})
        },
        likes: function (s) {
            // this must be changed
            let userID = 1;
            return s.likedBy.filter(like => {
                return like.id === userID
            }).length
        },
        likeAction: function (p) {
            let userID = 1;
            let slug='totolehero'  // this MUST BE CHANGED
            axios.patch(this.base_api+'products/'+p.slug+'/like/'+slug).then((response) => {
                let obj = this.suggestions.filter(p=> p.slug === slug)
                this.$store.dispatch('call_products')
            })
        }
    }
}
</script>
<style scoped>

</style>