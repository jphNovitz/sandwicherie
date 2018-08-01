<template>
    <div style="margin: 7rem auto;" v-if="flags.length > 0 ">

            <h5>Cet aliment peut provoquer une ou plusieures  allergie(s):
                <span v-for="(allergy, index) in flags" :key="index" >
                    {{allergy}}
                    <span v-if="index < flags.length-1">,</span>
                    <span v-else>.</span>
                </span>
                N'hésitez pas à nous contacter afin de demander plus de renseignements.
                </h5>
    </div>
</template>
<script>


export default {
    name: 'AllergiesFinder',
    components: {},
    props: ['product'],
    data () {
        return {
            flags: []
        }
    },
    computed: {
        allergies: function () {
            return this.$store.getters.allergies
        },
        list: function () {
            let l = {};
            this.allergies.map(al=>{
                l[al.slug]=[]
                al.categories.map(categ=>{
                    l[al.slug].push(categ.slug)
                })
                al.ingredients.map(ingr=>{
                    l[al.slug].push(ingr.slug)
                })
            })
            return l;
        },
        list_ingredients: function () {
            let i = [] ;
            this.product.ingredients.map(pi=>{
                i.push(pi.slug)
                pi.categories.map(pic=>{
                    i.push(pic.slug)
                })
            })
            this.product.breads.forEach(pb=>{
                i.push(pb.slug)
            })
            return i
        }
    },
    mounted() {

        for(let key in this.list) {
            let flag = null ;
            this.list[key].map(item =>{
                if (this.list_ingredients.indexOf(item) > -1) {
                    flag = key
                }
            })
            if (flag) {
                this.flags.push(flag);
            }
        }
    }
}
</script>
<style >
    @import url('https://fonts.googleapis.com/css?family=Cuprum');


.ui .message .header {
    font-family: 'Cuprum', sans-serif;

}
</style>