<template>
    <div>
        <div v-for="order in orders" :key="order.id">
            <h2>{{order.id}}</h2>
            {{order.created}}

        </div>
    </div>
</template>

<script>

    export default {
        name: 'Dashboard',
        sockets:{
            connect: function(){
                console.log('socket connected') ;
            },
            orders: function(val){
                console.log('** Stock de commandes +1 **') ;
                console.log(JSON.parse(val))
                let old_order = JSON.parse(val) ;
                this.orders.push(old_order) ;
            }
         },
        data () {
            return {
                orders: []
            }
        },
        mounted(){
        },
        methods: {
        }
    }

</script>

<style>
</style>