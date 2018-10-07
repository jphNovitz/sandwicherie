<template>
    <div>
        <component
                :is="dashComponent"
                :orders="orders"
                :current="current"
                class="sixteen wide column">

        </component>
    </div>
</template>

<script>

    import moment from 'moment' ;
    import ListGrid from './ListGrid' ;
    import OrderDetail from './OrderDetail' ;
    import { EventBus } from './EventBus.js';

    export default {
        name: 'Dashboard',
        components: {ListGrid, OrderDetail},

        sockets:{
            connect: function(){
                console.log('socket connected') ;
            },
            order: function(val){
                console.log('!! Stock de commandes +1 !!') ;
                console.log(typeof(val))
                var order = []
                if (typeof  val === 'string') {
                    order = JSON.parse(val) ;
                } else {
                    order = val
                }
                // let order = JSON.parse(val) ;
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
                EventBus.$emit('remove', id);
                this.removeTemplateITem(id);
            }
         },
        data () {
            return {
                orders: [],
                active: '',
                current: '',
                dashComponent: 'ListGrid',
            }
        },
        methods: {
            addActive: function(val){
                // this.$store.dispatch('add_item', val.id)
                this.current =  val ;
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
                console.log(pos)
                this.orders.splice(pos, 1);
            }
        },
        mounted() {
            this.active = '' ;
            EventBus.$on('current', order=> {
                this.addActive(order)
            })
            EventBus.$on('component', component=> {
                this.dashComponent = component
            })
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