/**
 * ingredient add via api management
 * author: Novitz Jean-Philippe <novitz@gmail.com>
 * date: february 2019
 */

import vue from 'vue';
import VueResource from 'vue-resource'

new Vue({
    el: '#ingredients-api',
    delimiters: ['${', '}'],
    data: function () {
        return {
            code: '',
            product: {},
            message: {},
            pdf: {
                lastID: -1,
                isActive: false
            },
        }
    },
    mounted() {},
    methods: {
        resetInfos: function () {
            this.code = ''
            this.product = {}
            this.message = {}
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
                        product.ingredients_text_fr = raw.ingredients_text_fr
                    }
                })
                setTimeout( ()=> {
                    this.product = product
                }, 100)
            },
        sendInfos: function () {
                let packed = JSON.stringify(this.product)
                //console.log(JSON.stringify(this.product))
                this.$http.post('/api/ingredient/new', packed).then(response => {
                console.log(response.data)
                this.resetInfos()
                if(response.status === 200) {
                    /* manage message*/
                    this.message.color = "green"
                    this.message.text =  "L'ingrédient a été ajouté."
                    this.message.active = 1
                    /* manage last product id & pdf action */
                    this.pdf.lastID = JSON.parse(response.data)
                    this.pdf.isActive = true

                } else {
                    /* manage message*/
                    this.message.color = "red"
                    this.message.text =  "Erreur"
                    this.message.active = 1
                }
         })
        }
    }

})
