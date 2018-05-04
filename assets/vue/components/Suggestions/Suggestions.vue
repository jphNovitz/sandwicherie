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

                    <sui-button animated="vertical" color="orange">
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
                <sui-button animated="vertical" color="pink">
                        <sui-button-content hidden>j'aime</sui-button-content>
                        <sui-button-content visible>
                            <sui-icon name="like icon" />
                        </sui-button-content>
                    </sui-button>

                    </sui-card-content extra>
            </sui-card>
        </sui-card-group>



    </article class="row">
</template>
<script>

export default {
    name: 'Suggestions',
    data () {
        return{
        }
    },
    computed: {
       suggestions: function () {
            let raw = document.getElementById('products').dataset.vars
            return JSON.parse(raw).last
        }
    },
    methods: {
        return_name: function (elm) {
             let imageName = elm.images[0].imageName
            return "/images/products/" + imageName
        }
    }
}
</script>
<style scoped>

</style>