import vue from 'vue';
import VueResource from 'vue-resource'
// import regeneratorRuntime from "regenerator-runtime"
// import AsyncComputed from 'vue-async-computed'

// Vue.use(VueResource);

new Vue({
    el: '#ingredients-api',
    delimiters: ['${', '}'],
    data: function () {
        return {
            code: '01',
            product: {}
        }
    },
    // asynComputed: {
    //     async productInfos() {
    //         var product={}
    //         // this.$http.get('https://fr.openfoodfacts.org/api/v0/produit/' + this.code + '.json').then(response => {
    //         //     if (response.data.status === 1) {
    //         //         let raw = response.data.product
    //         //         product.brands = raw.brands
    //                 // console.log(response.data.product.brands)
    //                 // product.generic_name_fr = response.data.product.genericNameFr
    //                 // product.name = raw.product_name
    //                 // console.log(product)
    //                 // product.image_ingredients_url = raw.image_ingredients_url
    //             //     productInfos.image_nutrition_url = response.data.product.image_nutrition_url
    //             //     productInfos.image_url = response.data.product.image_url
    //             //     productInfos.ingredients_text_fr = response.data.product.ingredients_text_fr
    //             //
    //             //     // this.$refs.brands = this.productInfos.brands
    //             //     // var element = document.getElementById('ingredient_code');
    //             //     // element.value = 'toto'
    //             //     // console.log(element.value)
    //             //     console.log(productInfos)
    //             //     }
    //             // })
    //         // console.log(product)
    //         // console.log(productInfos)
    //         return 'product'
    //     }
    //
    //     },
    mounted() {
        // this.$http.get('https://fr.openfoodfacts.org/api/v0/produit/27065655.json').then((response) => {
        //     // console.log(response.data)
        //         })

        },
    methods: {
        resetInfos: function () {
            this.code = ''
            this.product = {}
        },
        getInfos: function () {
                var product={}
                this.$http.get('https://fr.openfoodfacts.org/api/v0/produit/' + this.code + '.json').then(response => {
                    if (response.data.status === 1) {
                        let raw = response.data.product
                        product.brands = raw.brands
                        product.generic_name_fr = response.data.product.genericNameFr
                        product.name = raw.product_name
                        product.image_ingredients_url = raw.image_ingredients_url
                        product.image_nutrition_url = raw.image_nutrition_url
                        product.image_url = raw.image_url
                        //     productInfos.ingredients_text_fr = response.data.product.ingredients_text_fr
                        //
                        //     // this.$refs.brands = this.productInfos.brands
                        //     // var element = document.getElementById('ingredient_code');
                        //     // element.value = 'toto'
                        //     // console.log(element.value)
                        //     console.log(productInfos)
                    }
                })
                // console.log(product)
                // console.log(productInfos)
                setTimeout( ()=> {
                    this.product = product
                }, 100)
            }
        }

})
