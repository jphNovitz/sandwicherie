<template>
    <div>
        <component  v-on:active="changeActive" :is="dashComponent" :orders="orders"  :current="active" class="sixteen wide column"></component>
        <!--<sui-card-group>-->
            <!--<sui-card :items-per-row="3" v-for="order in orders" :key="order.id">-->
                <!--<sui-card-content>-->
                    <!--<sui-card-header>{{order.client.firstName}} {{order.client.lastName}} </sui-card-header>-->
                    <!--<sui-card-meta>{{order.id}}</sui-card-meta>-->
                    <!--<sui-card-meta>{{order.created|dateReadable}}</sui-card-meta>-->
                    <!--<sui-card-description>-->
                        <!--<sui-list>-->
                            <!--<sui-list-item v-for="item in order.items" :key="item.id">-->
                                <!--<h3>{{item.product.name}} </h3><strong v-if="item.halal">halal</strong>-->
                                <!--<sui-list-content>Pain: {{item.bread}}</sui-list-content>-->
                                <!--<br />-->
                                    <!--<sui-list-content>-->
                                        <!--Crudités:-->
                                            <!--<sui-list horizontal v-if="item.vegetables">-->
                                                <!--<sui-list-item v-for="vegetable in item.vegetables" :key="vegetable.id">-->
                                                    <!--{{vegetable}}-->
                                                <!--</sui-list-item>-->
                                            <!--</sui-list>-->
                                <!--</sui-list-content>-->
                            <!--</sui-list-item>-->
                        <!--</sui-list>-->
                    <!--</sui-card-description>-->
                <!--</sui-card-content>-->
                <!--<sui-button attached="bottom">-->
                    <!--<sui-icon name="hand paper" /> Je prends-->
                <!--</sui-button>-->
                <!--<sui-button attached="bottom" positive @click="setDone(order.id)">-->
                    <!--<sui-icon name="shopping basket" /> Prêt-->
                <!--</sui-button>-->
                <!--<sui-button attached="bottom" negative @click="deleteItem(order.id)">-->
                    <!--<sui-icon name="trash" /> Annuler-->
                <!--</sui-button>-->
            <!--</sui-card>-->
        <!--</sui-card-group>-->
    </div>
</template>

<script>

    import moment from 'moment' ;
    import ListGrid from './ListGrid' ;
    import OrderDetail from './OrderDetail' ;

    export default {
        name: 'Dashboard',
        components: {ListGrid, OrderDetail},

    //}
    // import moment from 'moment'
    // export default {
    //     name: 'Dashboard',
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