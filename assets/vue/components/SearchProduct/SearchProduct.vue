<template>
<div>
    <div class="emph"> Tu manges quoi à midi ?</div>
    <sui-input placeholder="Search..." icon="search" v-model="typing" />
    <div v-for="product in products">{{product.name}}</div>
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
                if (this.typing != '') {
                    return list.filter(p => (
                        (p.name.toLowerCase().indexOf(this.typing)) != -1) ||
                        (p.description.toLowerCase().indexOf(this.typing) != -1)
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