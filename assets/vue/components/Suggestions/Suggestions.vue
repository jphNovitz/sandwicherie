<template>
    <div>
        <h2>Nouveautés !</h2>
    <article class="row">
        <sui-card-group :items-per-row="3"  stackable>
             <card-product v-for="suggestion in suggestions"
                           :product="suggestion"
                           :group="'suggestions'"
                           :key="suggestion.slug">

             </card-product>
        </sui-card-group>

    </article>
    </div>
</template>
<script>

    import axios from 'axios';
    import  cardProduct from '../Cards/CardProduct';

export default {
    name: 'Suggestions',
    components: {
      'card-product': cardProduct
    },
    data () {
        return{
            base_api: 'http://localhost:8000/api/'
        }
    },
    computed: {
       suggestions: function () {
            return this.$store.getters.products.filter(p=> p.featured===true)
        }
    }
}
</script>
<style scoped>

</style>