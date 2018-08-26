<template>
<article class="ui stackable left aligned row search-wrapper">
    <div class="ui six wide left column stackable">
        <span class="emph"> Tu manges quoi à midi ?</span>
    </div>
    <div class="ui ten wide column stackable">
        <sui-input placeholder="Choisi ton repas " class="rounded" icon="search" v-model="typing" id="search"  />
    </div>
    <div class="ui sixteen wide column stackable left aligned selection list">
        <div class="item" v-for="product in products">
            <img class="ui small rounded image" :src="'/images/products/'+product.images[0].image_name">
            <div class="content" >
                <div class="ui green header">{{product.name}}</div>
                <span>{{product.description}}</span> <br />
                <sui-list horizontal divided >
                    <sui-list-item class="price">{{product.price}} € </sui-list-item>
                    <sui-list-item>
                        <!-- nested list -->
                        <sui-list horizontal divided >
                            <sui-list-item v-for="ingredient in product.ingredients" :key="ingredient.id">{{ingredient.name}}</sui-list-item>
                        </sui-list>
                        <!-- /nested list -->
                    </sui-list-item>
                </sui-list>
            </div>
     </div>
    </div>
</article>
</template>

<script>
    export default {
        name: "SearchProduct",
        data (){
            return {
                typing: ''
            }
        },
        computed: {
            //products here is for searching
            products: function () {
                const list = this.$store.getters.products ;
                if (this.typing !== '') {
                    return list.filter(p => {
                        return p.name.toLowerCase().indexOf(this.typing.toLowerCase()) > -1
                    })
                    //|| (p.description.toLowerCase().indexOf(this.typing.toLowerCase()) > -1)

                } else {
                    return this.typing
                }
            }
        }
    }

</script>

<style scoped>
    .search-wrapper {
        margin: 2rem 0;
    }
  .ui .header{
      font-family: 'Cuprum', sans-serif !important;
      font-size: 2rem;
  }
 @media (min-width: 502px) {
     .search-wrapper {
         margin: 5rem 0;
     }
    #search{
        width: 100% !important ;
        font-size: 1.4rem !important;
        border-radius: 20px !important;
    }

    .emph {
        font-family: 'Cuprum', sans-serif;
        font-size: 1.95rem;
    }
    .content{
        font-size: 1.45rem;
    }
     .ui.list>.item>.image {
        font-size: 3.5rem !important;
         vertical-align: middle !important;
    }
     .price {
         color: orangered !important;
         font-weight: bolder;
     }

}
</style>