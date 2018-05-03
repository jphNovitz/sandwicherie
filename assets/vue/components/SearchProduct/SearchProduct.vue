<template>
<div>
    <div class="emph"> Tu manges quoi à midi ?</div>
        <sui-input placeholder="Choisi ton repas " icon="search" v-model="typing" />
    <div class="ui left aligned selection massive list container">
        <div class="item" v-for="product in products">
            <img class="ui avatar image" :src="'/images/products/'+product.images[0].imageName">
            <div class="content">
                <div class="header">{{product.name}}</div>
                {{product.description}}
            </div>
     </div>
    </div>
</div>
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
            products: function () {
                let raw = document.getElementById('products').dataset.vars
                let list = JSON.parse(raw).last
                if (this.typing !== '') {
                    return list.filter(p => (
                        (p.name.toLowerCase().indexOf(this.typing)) !== -1) ||
                        (p.description.toLowerCase().indexOf(this.typing) !== -1)

                    )
                } else {
                    return this.typing
                }
            }
        }
    }

</script>

<style scoped>

</style>