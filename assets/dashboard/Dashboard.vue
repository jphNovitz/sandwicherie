<template>
    <div>
        <component  v-on:active="changeActive" :is="dashComponent" :orders="orders"  :current="active" class="sixteen wide column"></component>
    </div>
</template>

<script>

    import moment from 'moment' ;
    import ListGrid from './ListGrid' ;
    import OrderDetail from './OrderDetail' ;

    export default {
        name: 'Dashboard',
        components: {ListGrid, OrderDetail},

        sockets:{
            connect: function(){
                console.log('socket connected') ;
            },
            order: function(val){
                console.log('!! Stock de commandes +1 !!') ;
                let order = JSON.parse(val) ;
                console.log(order)
                this.orders.push(order) ;
            },
            remove_order: function (id) {
                let pos = -1 ;
                for (let i =0 ; i <  this.orders.length ; i++){
                    if (this.orders[i].id === id){
                        pos=i;
                        break ;
                    }
                }
                this.orders.splice(pos, 1);
            },
            update_order: function (id) {
                this.removeTemplateITem(id);
            },
            active_order: function (id) {
                console.log(id);
                this.active = id ;
            }
         },
        data () {
            return {
                orders: [],
                active: '',
                dashComponent: 'ListGrid',
            }
        },
        methods: {
            changeActive: function(val){
                this.orders =  val ;
                this.dashComponent = "OrderDetail" ;
            },
            setDone: function (id) {
                Vue.http.patch('/api/order/'+id+'/done');
            },
            deleteItem: function (id) {
                Vue.http.delete('/api/order/'+id);
            },
            removeTemplateITem:function (id) {
                let pos = -1 ;
                for (let i =0 ; i <  this.orders.length ; i++){
                    if (this.orders[i].id === id){
                        pos=i;
                        break ;
                    }
                }
                this.orders.splice(pos, 1);
            }
        },
        mounted() {
            this.active = '' ;
        },
        filters: {
            dateReadable: function (val) {
                if (val){
                    return moment(String(val)).format('DD/MM/YYYY (hh:mm)')
                }
            }
        }
    }

</script>

<style>
</style>